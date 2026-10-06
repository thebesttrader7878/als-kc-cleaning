import fs from "node:fs";
import http from "node:http";
import path from "node:path";
import { fileURLToPath } from "node:url";
import { facilities } from "./src/content.mjs";
import { execFileSync } from "node:child_process";

const root = path.dirname(fileURLToPath(import.meta.url));
execFileSync(process.execPath, ["build.mjs"], { cwd: root, stdio: "inherit" });

const preview = path.join(root, "preview");
const leadsFile = path.join(root, "leads", "quotes.jsonl");
const port = Number(process.env.PORT || 4173);
const facilityValues = new Set(facilities.map(([value]) => value));
const hits = new Map();

const types = {
  ".html": "text/html; charset=utf-8",
  ".css": "text/css; charset=utf-8",
  ".js": "text/javascript; charset=utf-8",
  ".svg": "image/svg+xml",
  ".jpg": "image/jpeg",
  ".jpeg": "image/jpeg",
  ".json": "application/json; charset=utf-8",
  ".txt": "text/plain; charset=utf-8",
};

function readBody(req) {
  return new Promise((resolve, reject) => {
    const chunks = [];
    let size = 0;
    req.on("data", (chunk) => {
      size += chunk.length;
      if (size > 100000) {
        reject(new Error("too-large"));
        req.destroy();
        return;
      }
      chunks.push(chunk);
    });
    req.on("end", () => resolve(Buffer.concat(chunks).toString("utf8")));
    req.on("error", reject);
  });
}

function oneLine(value) {
  return String(value || "").replace(/[\r\n]+/g, " ").trim();
}

function safePath(value, fallback) {
  if (typeof value !== "string" || !value.startsWith("/") || value.startsWith("//") || value.includes("..")) {
    return fallback;
  }
  return value.split("#")[0];
}

function refererPath(req) {
  try {
    const url = new URL(req.headers.referer || "");
    if (url.hostname === "127.0.0.1" || url.hostname === "localhost") return url.pathname || "/";
  } catch {
    /* ignore a missing referer */
  }
  return "/";
}

function redirect(res, location) {
  res.writeHead(303, { Location: location });
  res.end();
}

function withQuote(target, code) {
  const url = new URL(target, "http://127.0.0.1");
  url.searchParams.set("quote", code);
  url.hash = "quote-banner";
  return `${url.pathname}${url.search}${url.hash}`;
}

function limited(ip) {
  const now = Date.now();
  const entry = hits.get(ip) || { count: 0, start: now };
  if (now - entry.start > 60 * 60 * 1000) {
    entry.count = 0;
    entry.start = now;
  }
  entry.count += 1;
  hits.set(ip, entry);
  return entry.count > 20;
}

async function handleQuote(req, res) {
  const ip = req.socket.remoteAddress || "local";
  const back = () => safePath(refererPath(req), "/");
  let params;
  try {
    params = new URLSearchParams(await readBody(req));
  } catch {
    redirect(res, withQuote(back(), "invalid"));
    return;
  }
  const destination = safePath(params.get("redirect") || "", back());
  if (limited(ip) || oneLine(params.get("als_hp"))) {
    redirect(res, withQuote(destination, "sent"));
    return;
  }
  const name = oneLine(params.get("name"));
  const phone = oneLine(params.get("phone"));
  const email = oneLine(params.get("email"));
  const facility = oneLine(params.get("facility"));
  const message = String(params.get("message") || "").trim().slice(0, 4000);
  const digits = phone.replace(/\D/g, "");
  const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) && email.length <= 120;
  if (name.length < 2 || name.length > 80 || digits.length < 10 || digits.length > 15 || !emailOk || !facilityValues.has(facility)) {
    redirect(res, withQuote(destination, "invalid"));
    return;
  }
  fs.mkdirSync(path.dirname(leadsFile), { recursive: true });
  fs.appendFileSync(
    leadsFile,
    `${JSON.stringify({
      at: new Date().toISOString(),
      name,
      phone,
      email,
      facility,
      message,
      source: oneLine(params.get("source")).slice(0, 80),
    })}\n`,
  );
  redirect(res, withQuote(destination, "sent"));
}

function fileFor(pathname) {
  let decoded = pathname;
  try {
    decoded = decodeURIComponent(pathname);
  } catch {
    return null;
  }
  if (decoded.includes("\0") || decoded.includes("..")) return null;
  const relative = decoded.replace(/^\/+/, "");
  const full = path.normalize(path.join(preview, relative));
  if (full !== preview && !full.startsWith(`${preview}${path.sep}`)) return null;
  if (fs.existsSync(full) && fs.statSync(full).isDirectory()) {
    return path.join(full, "index.html");
  }
  if (fs.existsSync(full) && fs.statSync(full).isFile()) return full;
  if (!path.extname(full)) {
    const indexed = path.join(full, "index.html");
    if (fs.existsSync(indexed)) return indexed;
  }
  return null;
}

const server = http.createServer(async (req, res) => {
  const url = new URL(req.url || "/", "http://127.0.0.1");
  if (req.method === "POST" && url.pathname === "/quote") {
    await handleQuote(req, res);
    return;
  }
  if (req.method !== "GET" && req.method !== "HEAD") {
    res.writeHead(405);
    res.end();
    return;
  }
  const file = fileFor(url.pathname);
  if (!file || !fs.existsSync(file)) {
    const missing = path.join(preview, "404.html");
    const body = fs.readFileSync(missing);
    res.writeHead(404, { "Content-Type": "text/html; charset=utf-8" });
    res.end(req.method === "HEAD" ? undefined : body);
    return;
  }
  const ext = path.extname(file);
  res.writeHead(200, { "Content-Type": types[ext] || "application/octet-stream" });
  res.end(req.method === "HEAD" ? undefined : fs.readFileSync(file));
});

server.listen(port, "127.0.0.1", () => {
  console.log(`Al's KC Cleaning preview: http://127.0.0.1:${port}`);
});

import { execFileSync } from "node:child_process";
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.dirname(path.dirname(fileURLToPath(import.meta.url)));
execFileSync(process.execPath, ["build.mjs"], { cwd: root, stdio: "inherit" });

const preview = path.join(root, "preview");
const files = [];
function walk(dir) {
  for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
    const full = path.join(dir, entry.name);
    if (entry.isDirectory()) walk(full);
    else if (entry.name.endsWith(".html")) files.push(full);
  }
}
walk(preview);

const banned = [
  /lorem ipsum/i,
  /martin kellis/i,
  /william adan/i,
  /lara alex/i,
  /jack fanks/i,
  /lora kavin/i,
  /ando pops/i,
  /william anaw/i,
  /charles lindsey/i,
  /nathan moran/i,
  /morehands/i,
  /clening/i,
  /ceaning/i,
  /signle/i,
  /high qualified/i,
  /jesse@upscaleengine/i,
  /leaders in clean/i,
  /\$330/,
  /hello world/i,
  /\bmaid\b/i,
  /\blaundry\b/i,
  /\berrand/i,
];

const failures = [];
function fail(message) {
  failures.push(message);
}

const html = new Map();
for (const file of files) {
  const text = fs.readFileSync(file, "utf8");
  html.set(path.relative(preview, file), text);
  for (const pattern of banned) {
    if (pattern.test(text)) fail(`${file} matches ${pattern}`);
  }
  for (const needle of ["816-945-2460", "info@als-cleaning.com", "Book Free Walkthrough", "Al's KC Cleaning"]) {
    if (!text.includes(needle)) fail(`${file} missing ${needle}`);
  }
}

const home = html.get("index.html") || "";
const order = ["utility", 'id="trust"', 'id="audiences"', 'id="services"', 'id="process"', 'id="why"', 'id="proof"', 'id="areas"', 'id="final-cta"', "site-footer"];
let cursor = -1;
for (const marker of order) {
  const at = home.indexOf(marker);
  if (at <= cursor) fail(`Home section out of order: ${marker}`);
  cursor = at;
}
for (const name of ["Wonderscope", "University Academy", "Dialysis Clinic Inc.", "grandmother"]) {
  if (!home.includes(name) && name !== "grandmother") fail(`Home missing ${name}`);
}
if (!html.get("about/index.html").includes("grandmother")) fail("About missing the origin story");

for (const [file, text] of html) {
  if (file.startsWith("services/") && file !== "services/index.html") {
    for (const field of ['name="name"', 'name="phone"', 'name="email"', 'name="facility"', 'name="message"']) {
      if (!text.includes(field)) fail(`${file} missing ${field}`);
    }
  }
  const hrefs = [...text.matchAll(/href="([^"]+)"/g)].map((match) => match[1]);
  for (const href of hrefs) {
    if (href.startsWith("#") || href.startsWith("tel:") || href.startsWith("mailto:") || href.startsWith("http")) continue;
    const clean = href.split("?")[0];
    const target = path.join(preview, clean.replace(/^\//, ""), clean.endsWith("/") ? "index.html" : "");
    const fileTarget = path.join(preview, clean.replace(/^\//, ""));
    const ok = fs.existsSync(target) || fs.existsSync(fileTarget) || fs.existsSync(path.join(fileTarget, "index.html"));
    if (!ok) fail(`${file} broken link ${href}`);
  }
}

function lum(hex) {
  const channels = hex.match(/../g).map((part) => {
    const value = parseInt(part, 16) / 255;
    return value <= 0.03928 ? value / 12.92 : ((value + 0.055) / 1.055) ** 2.4;
  });
  return 0.2126 * channels[0] + 0.7152 * channels[1] + 0.0722 * channels[2];
}
function contrast(a, b) {
  const [hi, lo] = [lum(a), lum(b)].sort((x, y) => y - x);
  return (hi + 0.05) / (lo + 0.05);
}
const pairs = [
  ["043e74", "fff203", 4.5],
  ["043e74", "ffffff", 4.5],
  ["3d5270", "f3f8fc", 4.5],
  ["0860b2", "ffffff", 4.5],
  ["f4f8fc", "043e74", 4.5],
  ["fff203", "043e74", 4.5],
];
for (const [fg, bg, min] of pairs) {
  const ratio = contrast(fg, bg);
  if (ratio < min) fail(`Contrast ${fg} on ${bg} is ${ratio.toFixed(2)}`);
}

const theme = path.join(root, "wordpress-theme", "als-kc-cleaning");
for (const file of ["functions.php", "style.css", "header.php", "footer.php", "front-page.php", "page.php"]) {
  if (!fs.existsSync(path.join(theme, file))) fail(`Theme missing ${file}`);
}
const header = fs.readFileSync(path.join(theme, "header.php"), "utf8");
if (!header.includes("als_book_href_attr") || !header.includes("wp_head")) fail("Header is missing WordPress hooks");
const partial = fs.readFileSync(path.join(theme, "pages", "commercial-cleaning.php"), "utf8");
if (!partial.includes("wp_nonce_field")) fail("Service form is missing the WordPress nonce");

if (failures.length) {
  console.error(failures.join("\n"));
  process.exit(1);
}
console.log(`Checked ${html.size} pages.`);

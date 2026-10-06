import { execFileSync } from "node:child_process";
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";
import { facilities, pages, schemaGraph, seo } from "./src/content.mjs";
import { renderDocument, renderWpFooter, renderWpHeader, renderWpPartial } from "./src/render.mjs";

const root = path.dirname(fileURLToPath(import.meta.url));
const preview = path.join(root, "preview");
const theme = path.join(root, "wordpress-theme", "als-kc-cleaning");

fs.rmSync(preview, { recursive: true, force: true });
fs.rmSync(path.join(theme, "pages"), { recursive: true, force: true });
fs.rmSync(path.join(theme, "assets"), { recursive: true, force: true });
fs.mkdirSync(path.join(theme, "inc"), { recursive: true });
fs.mkdirSync(path.join(theme, "pages"), { recursive: true });

function write(file, content) {
  fs.mkdirSync(path.dirname(file), { recursive: true });
  fs.writeFileSync(file, content);
}

function phpString(value) {
  return `'${String(value).replace(/\\/g, "\\\\").replace(/'/g, "\\'")}'`;
}

for (const page of pages) {
  write(path.join(preview, page.file), renderDocument(page.slug, page.slug));
  write(path.join(theme, "pages", `${page.slug}.php`), renderWpPartial(page.slug));
}

write(path.join(preview, "404.html"), renderDocument("not-found", "not-found"));
write(path.join(theme, "pages", "not-found.php"), renderWpPartial("not-found"));
write(path.join(theme, "header.php"), renderWpHeader());
write(path.join(theme, "footer.php"), renderWpFooter());

let seoPhp = "<?php\ndefined( 'ABSPATH' ) || exit;\nreturn array(\n";
for (const [key, value] of Object.entries(seo)) {
  seoPhp += `\t${phpString(key)} => array(\n\t\t'title' => ${phpString(value.title)},\n\t\t'description' => ${phpString(value.description)},\n\t),\n`;
}
seoPhp += ");\n";
write(path.join(theme, "inc", "seo.php"), seoPhp);

let facilitiesPhp = "<?php\ndefined( 'ABSPATH' ) || exit;\nreturn array(\n";
for (const [value, label] of facilities) {
  facilitiesPhp += `\t${phpString(value)} => ${phpString(label)},\n`;
}
facilitiesPhp += ");\n";
write(path.join(theme, "inc", "facilities.php"), facilitiesPhp);

let pagesPhp = "<?php\ndefined( 'ABSPATH' ) || exit;\nreturn array(\n";
for (const page of pages) {
  pagesPhp += `\tarray( 'slug' => ${phpString(page.slug)}, 'title' => ${phpString(page.title)}, 'parent' => ${phpString(page.parent)} ),\n`;
}
pagesPhp += ");\n";
write(path.join(theme, "inc", "pages.php"), pagesPhp);

write(path.join(theme, "inc", "schema.json"), JSON.stringify(schemaGraph(), null, 2));
fs.cpSync(path.join(root, "assets"), path.join(preview, "assets"), { recursive: true });
fs.cpSync(path.join(root, "assets"), path.join(theme, "assets"), { recursive: true });

const dist = path.join(root, "dist");
fs.mkdirSync(dist, { recursive: true });
const zipPath = path.join(dist, "als-kc-cleaning.zip");
// Render only publishes preview/. Skip the WordPress zip there so a missing zip tool cannot fail the static build.
if (process.env.RENDER === "true") {
  console.log("Built preview and theme. Zip skipped on Render.");
} else {
  fs.rmSync(zipPath, { force: true });
  execFileSync("zip", ["-qr", zipPath, "als-kc-cleaning"], {
    cwd: path.join(root, "wordpress-theme"),
  });
  console.log(`Built preview and theme. Zip: ${zipPath}`);
}

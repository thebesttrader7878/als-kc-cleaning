# Al's KC Cleaning

Local preview of the site, plus a classic WordPress theme for als-cleaning.com.

## Run it on this computer

```bash
cd /Users/sevenwilson/als-kc-cleaning
node server.mjs
```

Open http://127.0.0.1:4173

The quote form on the preview saves to `leads/quotes.jsonl` on this Mac. It does not send email. `node tests/check.mjs` rebuilds the pages and checks the copy, links, and color contrast.

`node build.mjs` refreshes `preview/`, the theme folder, and `dist/als-kc-cleaning.zip`.

## Publish the free static site on Render

The Render site is the static preview, not the WordPress theme. `render.yaml` builds with `node build.mjs` and publishes the `preview` folder. On that public URL the quote form is delivered to info@als-cleaning.com through FormSubmit. The first request asks that inbox to confirm the address. On this computer the form still saves to `leads/quotes.jsonl` and does not send email.

## Put it on WordPress

1. In wp-admin, go to Appearance → Themes → Add New → Upload Theme.
2. Upload `dist/als-kc-cleaning.zip` and activate it.
3. Open Settings → Permalinks and click Save so the page links work.
4. The theme creates Home, Services, each service, About, Service Areas, Reviews, Get a Quote, FAQ, and Privacy if those pages are missing. It sets Home as the front page.
5. Delete leftover demo pages (Hello World, Sample Page, fake team or pricing pages) when you are ready. The theme does not delete them for you.
6. Page content in the block editor stays blank on purpose. The words live in the theme templates. Change copy in `src/content.mjs`, run `node build.mjs`, and upload the theme again.

Settings → Al's KC Cleaning holds the quote inbox, Calendly link, social links, the Google reviews embed, and the trust-badge switch. Badges stay off until you confirm them. Social links stay empty until you add the real profiles.

Quote emails go to info@als-cleaning.com and request@als-cleaning.com. The public address on the site is info@als-cleaning.com. The phone is 816-945-2460.

## Photos and the logo

The header and footer use the ALS Cleaning Service logo from the current site. A custom logo set in Appearance → Customize replaces the header mark.

Photographs of rooms are in `assets/img/`. To swap a room photo, replace the file and keep the same name (`hero-lobby.jpg`, `clinic-hall.jpg`, `school-hall.jpg`, `office.jpg`, `windows.jpg`, `floors.jpg`, `community-room.jpg`, `home-interior.jpg`). Those room photos are the kinds of spaces, not a named client's job.

Real people and visits already in the theme: `founder.jpg` (Jacob Louisus), `lead-academy.jpg`, `university-academy.jpg`, `wonderscope.jpg`, and the clips in `assets/video/floors.mp4` and `assets/video/night-walk.mp4`. Instagram in the footer is https://www.instagram.com/alsfacilityservices/.

## Colors

Navy `#043e74`, blue `#0860b2` and `#298be7`, and yellow `#fff203` match the live als-cleaning.com theme. See `STYLE.md`.

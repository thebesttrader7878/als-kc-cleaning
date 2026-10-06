import {
  audiences,
  brand,
  cities,
  clients,
  facilities,
  faqs,
  gallery,
  films,
  origin,
  pages,
  story,
  privacy,
  promises,
  seo,
  serviceBySlug,
  services,
  trust,
} from "./content.mjs";

function t(value) {
  return String(value)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");
}

function url(mode, path) {
  if (mode === "wp") return `<?php echo esc_url( home_url( '${path}' ) ); ?>`;
  return path;
}

function asset(mode, path) {
  if (mode === "wp") return `<?php echo esc_url( get_template_directory_uri() . '${path}' ); ?>`;
  return path;
}

function pagePath(slug) {
  if (slug === "home") return "/";
  const page = pages.find((item) => item.slug === slug);
  if (!page) return "/";
  if (page.parent) return `/${page.parent}/${page.slug}/`;
  return `/${page.slug}/`;
}

function serviceActive(active) {
  return active === "services" || services.some((service) => service.slug === active);
}

function navClass(mode, id, active) {
  if (mode === "wp") return `<?php echo esc_attr( als_nav_active( '${id}' ) ); ?>`;
  if (id === "services") return serviceActive(active) ? "is-active" : "";
  return id === active ? "is-active" : "";
}

function ariaPage(mode, id, active) {
  if (mode === "wp") return `<?php echo als_is_nav( '${id}' ) ? ' aria-current="page"' : ''; ?>`;
  const on = id === "services" ? serviceActive(active) : id === active;
  return on ? ' aria-current="page"' : "";
}

function bookHref(mode, active) {
  if (mode === "wp") return `<?php echo als_book_href_attr(); ?>`;
  if (active === "about" || active === "privacy-policy" || active === "not-found") return "/get-a-quote/";
  return "#quote";
}

function calendlyHref(mode) {
  if (mode === "wp") return `<?php echo esc_url( als_setting( 'calendly', '${brand.calendly}' ) ); ?>`;
  return brand.calendly;
}

function photoNote() {
  return "";
}

function quoteBanners(mode) {
  if (mode === "wp") return "<?php als_quote_banner(); ?>";
  return `<div id="quote-banner">
<div class="banner banner-ok quote-banner-sent" role="status">Thanks — we got it. Someone from Al's KC Cleaning will reach out shortly to schedule your free walkthrough. <span class="local-note">Local preview: this request was saved on this computer, not emailed.</span></div>
<div class="banner banner-bad quote-banner-invalid" role="alert">Please check your name, phone, email, and facility type, then send it again.</div>
</div>`;
}

function quoteForm(mode, { id, source, titled = true }) {
  const action = mode === "wp" ? "<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" : "/quote";
  const hidden =
    mode === "wp"
      ? `<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="${t(source)}">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">`
      : `<input type="hidden" name="source" value="${t(source)}">
<input type="hidden" name="redirect" value="">`;
  const options = facilities
    .map(([value, label]) => `<option value="${t(value)}">${t(label)}</option>`)
    .join("");
  const title = titled
    ? `<h2 class="form-title">Book a free walkthrough</h2>`
    : `<h2 class="sr">Book a free walkthrough</h2>`;
  return `<form class="quote-form" id="${t(id)}" action="${action}" method="post" data-quote-form>
${title}
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
${hidden}
<div class="hp" aria-hidden="true">
<label for="${t(id)}-hp">Company website</label>
<input id="${t(id)}-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
</div>
<div class="form-row">
<label>Name <input name="name" type="text" autocomplete="name" required maxlength="80"></label>
<label>Phone <input name="phone" type="tel" autocomplete="tel" inputmode="tel" required maxlength="30"></label>
</div>
<div class="form-row">
<label>Email <input name="email" type="email" autocomplete="email" required maxlength="120"></label>
<label>Facility type
<select name="facility" required>
<option value="">Select a facility type</option>
${options}
</select>
</label>
</div>
<label>Message
<textarea name="message" rows="4" maxlength="4000" placeholder="Square footage, how often you need us, access hours, and anything we should know."></textarea>
</label>
<button class="btn btn-primary" type="submit">Book Free Walkthrough</button>
<p class="form-legal">Or call <a href="tel:${brand.phoneTel}">${brand.phoneDisplay}</a>. We use this only to reply about your walkthrough. <a href="${url(mode, "/privacy-policy/")}">Privacy policy</a></p>
<p class="form-legal"><a href="${calendlyHref(mode)}" target="_blank" rel="noopener noreferrer">Prefer a time on the calendar? Book a 15-minute call.</a></p>
</form>`;
}

function phoneBlock(mode) {
  return `<div class="phone-block">
<p>Rather talk now?</p>
<a class="btn btn-secondary" href="tel:${brand.phoneTel}">Call ${brand.phoneDisplay}</a>
<a href="mailto:${brand.email}">${brand.email}</a>
</div>`;
}

function quotePanel(mode, opts) {
  return `<div class="quote-panel" id="${t(opts.anchor || "quote")}">
${quoteForm(mode, opts)}
${phoneBlock(mode)}
</div>`;
}

function crumbs(mode, items) {
  const parts = items.map((item, index) => {
    const last = index === items.length - 1;
    if (last || !item.path) return `<li>${t(item.label)}</li>`;
    return `<li><a href="${url(mode, item.path)}">${t(item.label)}</a></li>`;
  });
  return `<nav class="breadcrumb" aria-label="Breadcrumb"><ol>${parts.join("")}</ol></nav>`;
}

function pageHero(mode, { eyebrow, title, lede, image, crumbs: trail }) {
  const figure = image
    ? `<figure class="page-figure"><img src="${asset(mode, image.image)}" alt="${t(image.alt)}" width="${image.width}" height="${image.height}"></figure>`
    : "";
  return `<header class="page-hero">
<div class="wrap page-hero-grid">
<div>
${trail ? crumbs(mode, trail) : ""}
<p class="eyebrow">${t(eyebrow)}</p>
<h1>${t(title)}</h1>
<p class="lede">${t(lede)}</p>
</div>
${figure}
</div>
</header>`;
}

function checklist(items) {
  return `<ul class="checklist">${items.map((item) => `<li>${t(item)}</li>`).join("")}</ul>`;
}

function header(mode, active) {
  const links = [
    ["about", "About", "/about/"],
    ["service-areas", "Areas", "/service-areas/"],
    ["reviews", "Reviews", "/reviews/"],
    ["faq", "FAQ", "/faq/"],
  ];
  const submenu = services
    .map((service) => {
      const cls = mode === "wp"
        ? `<?php echo is_page( '${service.slug}' ) ? ' class="is-active"' : ''; ?>`
        : service.slug === active
          ? ' class="is-active"'
          : "";
      return `<li><a href="${url(mode, pagePath(service.slug))}"${cls}>${t(service.name)}</a></li>`;
    })
    .join("");
  const simple = links
    .map(([id, label, path]) => `<li><a class="${navClass(mode, id, active)}" href="${url(mode, path)}"${ariaPage(mode, id, active)}>${label}</a></li>`)
    .join("");
  const logo = mode === "wp"
    ? `<?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?>${wordmark(mode)}<?php } ?>`
    : wordmark(mode);
  return `<div class="scroll-progress" aria-hidden="true"><span data-progress></span></div>
<div class="utility">
<div class="wrap utility-inner">
<p>${t(brand.area)}</p>
<p class="utility-links"><a href="tel:${brand.phoneTel}">${brand.phoneDisplay}</a><a href="mailto:${brand.email}">${brand.email}</a></p>
</div>
</div>
<header class="site-header">
<div class="wrap header-inner">
${logo}
<nav class="nav" id="site-nav" data-nav aria-label="Primary">
<ul class="nav-list">
<li><a class="${navClass(mode, "home", active)}" href="${url(mode, "/")}"${ariaPage(mode, "home", active)}>Home</a></li>
<li class="has-sub"><a class="${navClass(mode, "services", active)}" href="${url(mode, "/services/")}"${ariaPage(mode, "services", active)}>Services</a>
<ul class="submenu">${submenu}</ul></li>
${simple}
</ul>
</nav>
<div class="header-tools">
<a class="header-phone" href="tel:${brand.phoneTel}"><span class="sr">Call </span>${brand.phoneDisplay}</a>
<a class="btn btn-primary btn-small" href="${bookHref(mode, active)}" aria-label="Book Free Walkthrough"><span class="btn-long">Book Free Walkthrough</span><span class="btn-short" aria-hidden="true">Book</span></a>
<button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="site-nav">Menu</button>
</div>
</div>
</header>
${quoteBanners(mode)}`;
}

function wordmark(mode) {
  return `<a class="logo" href="${url(mode, "/")}">
<img class="logo-img" src="${asset(mode, "/assets/img/logo.png")}" alt="ALS Cleaning Service" width="900" height="620">
</a>`;
}

function footer(mode, active) {
  const explore = [
    ["Home", "/"],
    ["Services", "/services/"],
    ["About", "/about/"],
    ["Service areas", "/service-areas/"],
    ["Reviews", "/reviews/"],
    ["FAQ", "/faq/"],
    ["Free quote", "/get-a-quote/"],
    ["Privacy policy", "/privacy-policy/"],
  ];
  const year = mode === "wp" ? "<?php echo esc_html( gmdate( 'Y' ) ); ?>" : "2026";
  const social = mode === "wp"
    ? "<?php als_social_links(); ?>"
    : `<ul class="social"><li><a href="${brand.instagram}">Instagram</a></li></ul>`;
  return `<footer class="site-footer">
<div class="wrap footer-grid">
<div>
<a class="footer-logo-link" href="${url(mode, "/")}"><img class="footer-logo" src="${asset(mode, "/assets/img/logo-on-dark.png")}" alt="ALS Cleaning Service" width="900" height="620"></a>
<p>Family-rooted cleaning for the Greater Kansas City Metro. Care, consistency, and clear communication.</p>
<p><a href="tel:${brand.phoneTel}">${brand.phoneDisplay}</a><br><a href="mailto:${brand.email}">${brand.email}</a></p>
${social}
</div>
<div>
<p class="footer-label">Explore</p>
<ul>${explore.map(([label, path]) => `<li><a href="${url(mode, path)}">${label}</a></li>`).join("")}</ul>
</div>
<div>
<p class="footer-label">Services</p>
<ul>${services.map((service) => `<li><a href="${url(mode, pagePath(service.slug))}">${t(service.name)}</a></li>`).join("")}</ul>
</div>
<div>
<p class="footer-label">Service area</p>
<ul>${cities.map((city) => `<li>${t(city)}</li>`).join("")}<li>and nearby communities</li></ul>
</div>
</div>
<div class="wrap legal"><p>© ${year} Al's KC Cleaning. All rights reserved.</p></div>
</footer>
<div class="callbar">
<a class="callbar-call" href="tel:${brand.phoneTel}">Call ${brand.phoneDisplay}</a>
<a class="callbar-book" href="${bookHref(mode, active)}" aria-label="Book Free Walkthrough"><span class="wide-label">Book Free Walkthrough</span><span class="narrow-label" aria-hidden="true">Book</span></a>
</div>`;
}

function chapterNo(index) {
  return String(index + 1).padStart(2, "0");
}

function storyMedia(mode, chapter) {
  if (chapter.video) {
    const loop = chapter.loop ? " loop" : "";
    return `<video muted playsinline${loop} preload="metadata" poster="${asset(mode, chapter.poster)}" width="${chapter.width}" height="${chapter.height}" aria-label="${t(chapter.title)}"><source src="${asset(mode, chapter.video)}" type="video/mp4"></video><button type="button" class="sound-btn" data-sound aria-pressed="false">Play with sound</button>`;
  }
  return `<img src="${asset(mode, chapter.image)}" alt="${t(chapter.alt)}" width="${chapter.width}" height="${chapter.height}">`;
}

function storyMarkup(mode) {
  const slides = story
    .map((chapter, index) => {
      const quote = chapter.quote
        ? `<blockquote><p>${t(chapter.quote)}</p><footer>— ${t(chapter.cite)}</footer></blockquote>`
        : "";
      const sign = chapter.sign ? `<p class="story-sign">${t(chapter.sign)}</p>` : "";
      const more = chapter.more ? `<p class="story-more">${t(chapter.more)}</p>` : "";
      const on = index === 0 ? " is-on" : "";
      return `<div class="story-slide">
<figure class="story-frame${on}" data-story-frame>${storyMedia(mode, chapter)}</figure>
<article class="story-card${on}" data-story-card>
<span class="story-watermark" aria-hidden="true">${chapterNo(index)}</span>
<p class="story-kicker"><span>${chapterNo(index)}</span> ${t(chapter.kicker)}</p>
<h2>${t(chapter.title)}</h2>
<p>${t(chapter.text)}</p>
${more}${quote}${sign}
</article>
</div>`;
    })
    .join("");
  const rail = story
    .map(
      (chapter, index) =>
        `<button type="button" data-story-jump="${index}"${index === 0 ? ' aria-current="step"' : ""}><span>${chapterNo(index)}</span> <span class="story-rail-label">${t(chapter.kicker)}</span></button>`,
    )
    .join("");
  return `<section class="story-scroll" id="why" data-story style="--chapters:${story.length}">
<div class="story-pin">
<div class="story-top">
<p class="eyebrow">Why Al's</p>
<p class="sr" data-story-live aria-live="polite">Chapter 1. ${t(story[0].title)}</p>
</div>
<div class="story-stage">${slides}</div>
<nav class="story-rail" aria-label="Story chapters">${rail}</nav>
<div class="story-foot">
<div class="story-meter" aria-hidden="true"><span data-story-fill></span></div>
<a class="text-link" href="${url(mode, "/about/")}">Read the full story</a>
</div>
</div>
</section>`;
}

function momentGrid(mode, items) {
  return `<div class="moment-grid">${items
    .map(
      (item) => `<figure><img src="${asset(mode, item.image)}" alt="${t(item.alt)}" width="${item.width}" height="${item.height}"><figcaption>${t(item.caption)}</figcaption></figure>`,
    )
    .join("")}</div>`;
}

function filmGrid(mode) {
  return `<div class="film-grid">${films
    .map(
      (film) => `<figure><video controls playsinline preload="metadata" poster="${asset(mode, film.poster)}" width="${film.width}" height="${film.height}"><source src="${asset(mode, film.src)}" type="video/mp4"></video><figcaption>${t(film.caption)} Press play to hear the clip.</figcaption></figure>`,
    )
    .join("")}</div>`;
}

function renderHome(mode) {
  const audienceCards = audiences
    .map(
      (item) => `<article class="card card-media">
<img src="${asset(mode, item.image)}" alt="${t(item.alt)}" width="${item.width}" height="${item.height}">
<div class="card-body"><h3>${t(item.title)}</h3><p>${t(item.text)}</p></div>
</article>`,
    )
    .join("");
  const serviceCards = services
    .map(
      (service) => `<article class="card service-card">
<a class="card-link" href="${url(mode, pagePath(service.slug))}">
<img src="${asset(mode, service.image)}" alt="" width="${service.width}" height="${service.height}">
<div class="card-body"><h3>${t(service.name)}</h3><p>${t(service.card)}</p><span class="text-link">See this service</span></div>
</a>
</article>`,
    )
    .join("");
  const trustItems = trust
    .map((item) => `<li class="trust-item"><h3>${t(item.title)}</h3><p>${t(item.text)}</p></li>`)
    .join("");
  const promiseCards = promises
    .map((item, index) => `<article class="promise"><p class="step-no">0${index + 1}</p><h3>${t(item.title)}</h3><p>${t(item.text)}</p></article>`)
    .join("");
  const clientList = clients
    .map((client) => `<li><span>${t(client.name)}</span><small>${t(client.kind)}</small></li>`)
    .join("");
  const reel = story
    .filter((chapter) => chapter.image)
    .map(
      (chapter) => `<figure class="reel-card"><img src="${asset(mode, chapter.image)}" alt="${t(chapter.alt)}" width="${chapter.width}" height="${chapter.height}"><figcaption>${t(chapter.caption)}</figcaption></figure>`,
    )
    .join("");
  const pills = cities.map((city) => `<li><a href="${url(mode, "/service-areas/")}">${t(city)}</a></li>`).join("");
  return `<main id="main">
${mode === "static" || mode === "wp" ? photoNote(mode) : ""}
<section class="hero">
<div class="hero-media" data-parallax>
<img src="${asset(mode, "/assets/img/hero-lobby.jpg")}" alt="A clean clinic lobby in morning light." width="1280" height="720" fetchpriority="high">
</div>
<div class="wrap hero-grid">
<div class="hero-copy">
<p class="eyebrow">Greater Kansas City Metro</p>
<h1>Clean spaces. Clear minds. Kansas City businesses we take personally.</h1>
<p class="lede">Family-rooted commercial cleaning for medical facilities, schools, daycares, and offices across the metro — with a free walkthrough and no pressure.</p>
<div class="hero-actions">
<a class="btn btn-primary" href="#quote">Book Free Walkthrough</a>
<a class="btn btn-secondary" href="tel:${brand.phoneTel}">Call ${brand.phoneDisplay}</a>
</div>
</div>
<div class="hero-card" id="quote">${quoteForm(mode, { id: "quote-hero", source: "home" })}</div>
</div>
</section>
<section class="trust" id="trust" aria-label="Why people call">
<div class="wrap"><ul class="trust-list">${trustItems}</ul></div>
</section>
<section class="section section-cream" id="audiences">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">Who we clean for</p>
<h2>Buildings that serve people</h2>
<p class="lede">Medical facilities, schools, daycares, and offices lead the work. Banks, gyms, restaurants, and churches fit the same kind of care.</p>
</div>
<div class="card-grid audience-grid">${audienceCards}</div>
</div>
</section>
<section class="section" id="services">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">Services</p>
<h2>Professional cleaning services for every space</h2>
<p class="lede">Start with the building you have. Residential cleaning is here too — the homepage just leads with the facilities.</p>
</div>
<div class="card-grid service-grid">${serviceCards}</div>
</div>
</section>
<section class="process" id="process">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">How it works</p>
<h2>Let's start with a free walkthrough</h2>
<p>No commitments. Just a clear, honest assessment so you can make the best decision for your space.</p>
</div>
<ol class="steps">
<li><span>01</span><h3>Review</h3><p>Your current cleaning setup.</p></li>
<li><span>02</span><h3>Identify</h3><p>Gaps or areas being overlooked.</p></li>
<li><span>03</span><h3>Discuss</h3><p>What consistency and care could look like.</p></li>
</ol>
<ol class="flow">
<li>Free walkthrough</li>
<li>Simple scheduling</li>
<li>Professional cleaning</li>
<li>Easy payment</li>
</ol>
</div>
</section>
${storyMarkup(mode)}
<section class="section section-cream promise-band">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">Why Al's</p>
<h2>Built on family, tradition, and pride in a job well done.</h2>
</div>
<div class="promise-list promise-row">${promiseCards}</div>
</div>
</section>
<section class="reel-scroll" id="proof" data-reel>
<div class="reel-pin">
<div class="reel-copy">
<p class="eyebrow">Results</p>
<h2>Places we've shown up for</h2>
<p>LEAD Academy, University Academy, and Wonderscope, plus Dialysis Clinic Inc. Google reviews will live on the reviews page once that listing is connected.</p>
<ul class="clients">${clientList}</ul>
<p class="reel-hint">Keep scrolling. The film keeps moving.</p>
<a class="text-link" href="${url(mode, "/reviews/")}">See the reviews page</a>
</div>
<div class="reel-window">
<div class="reel-track" data-reel-track>${reel}</div>
</div>
</div>
</section>
<section class="section section-cream" id="areas">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">Service area</p>
<h2>Greater Kansas City, and nearby communities</h2>
</div>
<ul class="pills">${pills}<li><a href="${url(mode, "/service-areas/")}">and nearby communities</a></li></ul>
</div>
</section>
<section class="cta-band" id="final-cta">
<div class="wrap cta-grid">
<div>
<p class="eyebrow">Free walkthrough</p>
<h2>Tell us about your space and we'll handle the rest.</h2>
<p>Customer satisfaction is our top priority. Call now, or send the form and we will set the walkthrough.</p>
<a class="btn btn-secondary btn-on-dark" href="tel:${brand.phoneTel}">Call ${brand.phoneDisplay}</a>
</div>
${quoteForm(mode, { id: "quote-final", source: "home-footer", titled: false })}
</div>
</section>
</main>`;
}

function renderServices(mode) {
  const cards = services
    .map(
      (service) => `<article class="card service-card">
<a class="card-link" href="${url(mode, pagePath(service.slug))}">
<img src="${asset(mode, service.image)}" alt="" width="${service.width}" height="${service.height}">
<div class="card-body"><h2>${t(service.name)}</h2><p>${t(service.card)}</p><span class="text-link">See this service</span></div>
</a>
</article>`,
    )
    .join("");
  return `<main id="main" class="page">
${pageHero(mode, {
  eyebrow: "Services",
  title: "Professional cleaning for every space",
  lede: "Commercial and janitorial work leads. Homes are part of the company too. Every service ends with the same free walkthrough.",
  crumbs: [
    { label: "Home", path: "/" },
    { label: "Services" },
  ],
})}
<section class="section">
<div class="wrap card-grid service-grid">${cards}</div>
</section>
<section class="section section-tight">
<div class="wrap">${quotePanel(mode, { id: "quote-services", source: "services", anchor: "quote" })}</div>
</section>
</main>`;
}

function renderService(mode, service) {
  const touches = service.touches
    ? `<div class="chips" aria-label="High-touch spots">${service.touches.map((item) => `<span>${t(item)}</span>`).join("")}</div>`
    : "";
  const pull = service.pull ? `<blockquote class="pull">${t(service.pull)}</blockquote>` : "";
  return `<main id="main" class="page">
${pageHero(mode, {
  eyebrow: "Kansas City",
  title: service.h1,
  lede: service.lede,
  image: service,
  crumbs: [
    { label: "Home", path: "/" },
    { label: "Services", path: "/services/" },
    { label: service.name },
  ],
})}
<section class="section">
<div class="wrap split">
<div class="prose">
${service.paragraphs.map((paragraph) => `<p>${t(paragraph)}</p>`).join("")}
${pull}
${touches}
</div>
<div>
<h2>What's included</h2>
${checklist(service.included)}
<h2 class="h-follow">How we start</h2>
<ol class="mini-steps">
<li><strong>Review</strong> your current cleaning setup.</li>
<li><strong>Identify</strong> gaps or areas being overlooked.</li>
<li><strong>Discuss</strong> what consistency and care could look like.</li>
</ol>
</div>
</div>
</section>
<section class="section section-cream section-tight">
<div class="wrap">${quotePanel(mode, { id: `quote-${service.slug}`, source: service.slug, anchor: "quote" })}</div>
</section>
</main>`;
}

function renderAbout(mode) {
  return `<main id="main" class="page">
${pageHero(mode, {
  eyebrow: "Our story",
  title: "We're committed to caring.",
  lede: "Al's KC Cleaning was built on family, tradition, and pride in a job well done.",
  crumbs: [
    { label: "Home", path: "/" },
    { label: "About" },
  ],
})}
<section class="section">
<div class="wrap founder-layout">
<figure class="founder-sticky">
<img src="${asset(mode, "/assets/img/founder.jpg")}" alt="Jacob Louisus, founder of Al's KC Cleaning, standing outdoors with a golf club." width="588" height="794">
<figcaption>Jacob Louisus, founder</figcaption>
</figure>
<div class="prose">
${origin.map((paragraph) => `<p>${t(paragraph)}</p>`).join("")}
<p>What started as a passion has now grown into a company serving medical facilities, clinics, schools, daycares, and office spaces across the Kansas City area.</p>
</div>
</div>
</section>
<section class="section section-cream">
<div class="wrap">
<div class="section-head">
<h2>Showing up, in person</h2>
<p class="lede">First days and summer camp, with the people who use the buildings. More of these days are on <a href="${brand.instagram}">Instagram</a>.</p>
</div>
${momentGrid(mode, story.filter((chapter) => chapter.image && chapter.kicker !== "Founder"))}
<div class="promise-list promise-row promise-follow">
${promises.map((item, index) => `<article class="promise"><p class="step-no">0${index + 1}</p><h2>${t(item.title)}</h2><p>${t(item.text)}</p></article>`).join("")}
</div>
</div>
</section>
<section class="section">
<div class="wrap">
<div class="section-head">
<h2>On the floor, and after hours</h2>
<p class="lede">Two clips from the work, with sound. Press play: a floor in progress, and a night walk from the front path into the rooms.</p>
</div>
${filmGrid(mode)}
</div>
</section>
<section class="section section-cream">
<div class="wrap prose narrow">
<h2>You matter most.</h2>
<p>Customer satisfaction is our top priority. We show up on time, follow through, and keep the communication plain. Environmentally responsible products, safe for people and pets. Trained professionals. Industry-grade tools. A free walkthrough before anyone has to decide.</p>
<p><a class="btn btn-primary" href="${url(mode, "/get-a-quote/")}">Book Free Walkthrough</a></p>
</div>
</section>
</main>`;
}

function renderAreas(mode) {
  const cards = cities
    .map((city) => `<li><h2>${t(city)}</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li>`)
    .join("");
  return `<main id="main" class="page">
${pageHero(mode, {
  eyebrow: "Where we work",
  title: "Servicing the Greater Kansas City Metro",
  lede: "Kansas City on both sides of the state line, plus the communities around it. This list is easy to edit when the route grows.",
  crumbs: [
    { label: "Home", path: "/" },
    { label: "Service areas" },
  ],
})}
<section class="section">
<div class="wrap">
<ul class="city-grid">${cards}<li class="city-more"><h2>And nearby communities</h2><p>If your city is not named here, ask. If we can reach the building, we will say so on the walkthrough.</p></li></ul>
</div>
</section>
<section class="section section-cream section-tight">
<div class="wrap">${quotePanel(mode, { id: "quote-areas", source: "service-areas", anchor: "quote" })}</div>
</section>
</main>`;
}

function renderReviews(mode) {
  const photos = gallery
    .map(
      (item) => `<figure><img src="${asset(mode, item.image)}" alt="${t(item.alt)}" width="${item.width}" height="${item.height}"><figcaption>${t(item.caption)}</figcaption></figure>`,
    )
    .join("");
  const names = clients
    .map((client) => `<li><span>${t(client.name)}</span><small>${t(client.kind)}</small></li>`)
    .join("");
  const embed = mode === "wp" ? "<?php als_reviews_slot(); ?>" : `<div class="placeholder-box"><p class="eyebrow">Google reviews</p><p>Reviews from the Google listing will show here once that listing is connected. Until then, this space stays empty on purpose.</p></div>`;
  const badges = mode === "wp" ? "<?php als_badge_row(); ?>" : `<p class="fine">Insured, bonded, background-checked, and Google rating badges stay off until those facts are confirmed. Turn them on in WordPress settings only after that.</p>`;
  return `<main id="main" class="page">
${pageHero(mode, {
  eyebrow: "Results",
  title: "Spaces we take personally",
  lede: "LEAD Academy, University Academy, Wonderscope, and Dialysis Clinic Inc., plus the rooms we walk into. Google reviews have a place here once that listing is connected.",
  crumbs: [
    { label: "Home", path: "/" },
    { label: "Reviews" },
  ],
})}
<section class="section">
<div class="wrap proof-grid">
${embed}
<ul class="clients">${names}</ul>
</div>
<div class="wrap badge-row">${badges}</div>
</section>
<section class="section section-cream">
<div class="wrap">
<div class="section-head">
<h2>Days we showed up</h2>
<p class="lede">Jacob Louisus with the people at LEAD Academy, University Academy, and The Regnier Family Wonderscope Children's Museum.</p>
</div>
${momentGrid(mode, story.filter((chapter) => chapter.image))}
</div>
</section>
<section class="section">
<div class="wrap">
<div class="section-head">
<h2>On the floor, and after hours</h2>
<p class="lede">Press play to hear the clips.</p>
</div>
${filmGrid(mode)}
</div>
</section>
<section class="section section-cream">
<div class="wrap">
<div class="section-head">
<h2>The kind of rooms we walk into</h2>
<p class="lede">Clinics, schools, offices, halls, and homes across the metro. These photographs show the kind of rooms. They are not labeled as a specific client's job.</p>
</div>
<div class="gallery">${photos}</div>
</div>
</section>
<section class="section section-tight">
<div class="wrap">${quotePanel(mode, { id: "quote-reviews", source: "reviews", anchor: "quote" })}</div>
</section>
</main>`;
}

function renderQuote(mode) {
  return `<main id="main" class="page">
${pageHero(mode, {
  eyebrow: "Free walkthrough",
  title: "Tell us about your space.",
  lede: "We will review the cleaning you have now, point out what is being missed, and talk through what consistency could look like. No pressure. No commitment.",
  crumbs: [
    { label: "Home", path: "/" },
    { label: "Free quote" },
  ],
})}
<section class="section">
<div class="wrap split align-start">
<div class="prose">
<h2>What happens next</h2>
<ol class="mini-steps">
<li><strong>Review</strong> your current cleaning setup.</li>
<li><strong>Identify</strong> gaps or areas being overlooked.</li>
<li><strong>Discuss</strong> what consistency and care could look like.</li>
</ol>
<p>Then a simple schedule, professional cleaning, and easy payment — if you want to move ahead.</p>
${phoneBlock(mode)}
<p class="fine">Quote requests are read at ${brand.email}. Mail sent to ${brand.quoteEmail} reaches the same inbox.</p>
</div>
<div id="quote">${quoteForm(mode, { id: "quote-contact", source: "contact" })}</div>
</div>
</section>
</main>`;
}

function renderFaq(mode) {
  const items = faqs
    .map((item) => `<details><summary>${t(item.q)}</summary><p>${t(item.a)}</p></details>`)
    .join("");
  return `<main id="main" class="page">
${pageHero(mode, {
  eyebrow: "Questions",
  title: "Straight answers for facilities",
  lede: "Walkthroughs, scopes, hours, products, and the metro. Written for clinics, schools, daycares, and offices.",
  crumbs: [
    { label: "Home", path: "/" },
    { label: "FAQ" },
  ],
})}
<section class="section">
<div class="wrap faq">${items}</div>
</section>
<section class="section section-cream section-tight">
<div class="wrap">${quotePanel(mode, { id: "quote-faq", source: "faq", anchor: "quote" })}</div>
</section>
</main>`;
}

function renderPrivacy(mode) {
  const blocks = privacy.map((block) => `<h2>${t(block.h)}</h2><p>${t(block.p)}</p>`).join("");
  return `<main id="main" class="page">
${pageHero(mode, {
  eyebrow: "Legal",
  title: "Privacy policy",
  lede: "A plain account of what the quote form collects and what we do with it.",
  crumbs: [
    { label: "Home", path: "/" },
    { label: "Privacy" },
  ],
})}
<section class="section">
<div class="wrap prose narrow">
${blocks}
<p class="fine">Updated October 6, 2026.</p>
<p><a href="${url(mode, "/get-a-quote/")}">Book a free walkthrough</a> or call <a href="tel:${brand.phoneTel}">${brand.phoneDisplay}</a>.</p>
</div>
</section>
</main>`;
}

function renderNotFound(mode) {
  return `<main id="main" class="page">
<header class="page-hero"><div class="wrap">
<p class="eyebrow">404</p>
<h1>That page is not here.</h1>
<p class="lede">The cleaning pages are. Call us, or tell us about the space and we will set a walkthrough.</p>
<div class="hero-actions">
<a class="btn btn-primary" href="${url(mode, "/get-a-quote/")}">Book Free Walkthrough</a>
<a class="btn btn-secondary" href="tel:${brand.phoneTel}">Call ${brand.phoneDisplay}</a>
</div>
</div></header>
</main>`;
}

const bodies = {
  home: renderHome,
  services: renderServices,
  about: renderAbout,
  "service-areas": renderAreas,
  reviews: renderReviews,
  "get-a-quote": renderQuote,
  faq: renderFaq,
  "privacy-policy": renderPrivacy,
  "not-found": renderNotFound,
};

export function renderMain(slug, mode) {
  const service = serviceBySlug(slug);
  if (service) return renderService(mode, service);
  const render = bodies[slug];
  if (!render) throw new Error(`No page renderer for ${slug}`);
  return render(mode);
}

function staticHead(slug) {
  const meta = seo[slug] || seo["not-found"];
  const path = slug === "home" ? "/" : slug === "not-found" ? "/" : pagePath(slug);
  const canonical = `${brand.domain}${path}`;
  const schema =
    slug === "home"
      ? `<script type="application/ld+json">${JSON.stringify({
          "@context": "https://schema.org",
          "@type": "ProfessionalService",
          name: brand.name,
          url: `${brand.domain}/`,
          telephone: brand.phoneTel,
          email: brand.email,
          image: `${brand.domain}/assets/img/hero-lobby.jpg`,
          description: seo.home.description,
          areaServed: [...cities, "Greater Kansas City Metro"],
          address: {
            "@type": "PostalAddress",
            addressLocality: "Kansas City",
            addressRegion: "MO",
            addressCountry: "US",
          },
        })}</script>`
      : "";
  return `<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>${t(meta.title)}</title>
<meta name="description" content="${t(meta.description)}">
<link rel="canonical" href="${canonical}">
<meta property="og:title" content="${t(meta.title)}">
<meta property="og:description" content="${t(meta.description)}">
<meta property="og:type" content="website">
<meta property="og:url" content="${canonical}">
<meta property="og:locale" content="en_US">
<meta name="theme-color" content="#043e74">
<link rel="icon" href="/assets/favicon.png" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/site.css?v=20261006b">
<script>!function(){var d=document.documentElement;d.classList.add("js");if(matchMedia("(prefers-reduced-motion: reduce)").matches)d.classList.add("reduce");var q=new URLSearchParams(location.search).get("quote");if(q==="sent"||q==="invalid")d.setAttribute("data-quote",q)}();</script>
${schema}
</head>
<body>`;
}

export function renderDocument(slug, active) {
  return `${staticHead(slug)}
<a class="skip" href="#main">Skip to content</a>
${header("static", active)}
${renderMain(slug, "static")}
${footer("static", active)}
<script src="/assets/js/site.js"></script>
</body>
</html>`;
}

export function renderWpHeader() {
  return `<?php
defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to content</a>
${header("wp", "home")}
`;
}

export function renderWpFooter() {
  return `${footer("wp")}
<?php wp_footer(); ?>
</body>
</html>
`;
}

export function renderWpPartial(slug) {
  return `<?php
defined( 'ABSPATH' ) || exit;
?>
${renderMain(slug, "wp")}
`;
}

<?php
defined( 'ABSPATH' ) || exit;
?>
<main id="main" class="page">
<header class="page-hero">
<div class="wrap page-hero-grid">
<div>
<nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li><li>FAQ</li></ol></nav>
<p class="eyebrow">Questions</p>
<h1>Straight answers for facilities</h1>
<p class="lede">Walkthroughs, scopes, hours, products, and the metro. Written for clinics, schools, daycares, and offices.</p>
</div>

</div>
</header>
<section class="section">
<div class="wrap faq"><details><summary>How does a free walkthrough work?</summary><p>We come look at the space, review what is being cleaned now, and talk through what consistent care could look like. There is no fee and no commitment. You get a clear recommendation and a quote. You decide after that.</p></details><details><summary>What do you need from us to price the work?</summary><p>Facility type, city, a rough size, how often you want us there, and anything special — a clinic's rules, a daycare's hours, after-close access. The walkthrough fills in the rest. We do not publish package prices, because a school and a small office are not the same job.</p></details><details><summary>What is included in a regular commercial or janitorial visit?</summary><p>We write the scope with you. A typical visit covers floors, trash and recycling, restrooms, break areas, and the surfaces we agree on. Windows, floor restoration, and deep cleans are scheduled on purpose. They are not squeezed into a short visit and called done.</p></details><details><summary>Can you clean after we close?</summary><p>Yes. Offices often want evenings. Clinics, schools, and daycares may need early mornings or a window that does not interrupt care. Tell us when people use the building and we will build around that.</p></details><details><summary>Do you bring the products and equipment?</summary><p>Yes. We bring what the scoped job needs. If your building requires a specific product, or you want us to use what you already stock, say so at the walkthrough and we will follow that.</p></details><details><summary>Are the products safe for patients, children, and pets?</summary><p>We use environmentally responsible products chosen to be safe for people and pets, and we follow the label. If a clinic or daycare has an approved list or a restriction, that list wins.</p></details><details><summary>What does high-touch disinfecting cover?</summary><p>The places hands land all day: light switches, handrails, elevator buttons, door handles, entry doors, restroom faucets and dispensers, phones, mice, keyboards, printers, and similar spots we list with you. It can sit inside a regular visit or be added where traffic is heavy.</p></details><details><summary>Do you clean medical facilities?</summary><p>Yes. Clinics and medical facilities are a focus, along with schools, daycares, and offices. Those buildings need a crew that shows up on time and communicates in plain language.</p></details><details><summary>Do you clean homes too?</summary><p>Yes. Residential cleaning sits alongside the facility work. The homepage leads with commercial and janitorial because that is most of the company. A house still gets the same care, the same products standard, and the same follow-through.</p></details><details><summary>Is there a long contract?</summary><p>Recurring work should feel steady, not trapped. We explain the schedule and the terms before you start. The walkthrough itself is no-pressure and no-commitment.</p></details><details><summary>How do we pay?</summary><p>Once the scope is agreed, we keep payment easy and we confirm the method that fits your accounts process. We would rather explain that on the quote than invent a package price on the website.</p></details><details><summary>What if something gets missed?</summary><p>Tell us. Customer satisfaction is our top priority, and we would rather hear it the same day and make it right. Clear communication is part of the job.</p></details><details><summary>Where do you work?</summary><p>The Greater Kansas City Metro, including Kansas City MO, Kansas City KS, Overland Park, Independence, Lee's Summit, Olathe, Shawnee, Lenexa, and nearby communities. If your city is not on the list, ask. We will tell you honestly if we can reach it.</p></details><details><summary>How do we request a quote?</summary><p>Call 816-945-2460, use the form, or email info@als-cleaning.com. Messages sent to request@als-cleaning.com reach the same conversation. If you would rather pick a time, there is a 15-minute call link on the quote page.</p></details></div>
</section>
<section class="section section-cream section-tight">
<div class="wrap"><div class="quote-panel" id="quote">
<form class="quote-form" id="quote-faq" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-quote-form>
<h2 class="form-title">Book a free walkthrough</h2>
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="faq">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">
<div class="hp" aria-hidden="true">
<label for="quote-faq-hp">Company website</label>
<input id="quote-faq-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
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
<option value="medical">Medical facility or clinic</option><option value="school">School</option><option value="daycare">Daycare</option><option value="office">Office or commercial space</option><option value="bank">Bank</option><option value="gym">Gym</option><option value="restaurant">Restaurant</option><option value="church">Church</option><option value="residential">Residential home</option><option value="other">Something else</option>
</select>
</label>
</div>
<label>Message
<textarea name="message" rows="4" maxlength="4000" placeholder="Square footage, how often you need us, access hours, and anything we should know."></textarea>
</label>
<button class="btn btn-primary" type="submit">Book Free Walkthrough</button>
<p class="form-legal">Or call <a href="tel:+18169452460">816-945-2460</a>. We use this only to reply about your walkthrough. <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy policy</a></p>
<p class="form-legal"><a href="<?php echo esc_url( als_setting( 'calendly', 'https://calendly.com/alskccleaningllc/15min' ) ); ?>" target="_blank" rel="noopener noreferrer">Prefer a time on the calendar? Book a 15-minute call.</a></p>
</form>
<div class="phone-block">
<p>Rather talk now?</p>
<a class="btn btn-secondary" href="tel:+18169452460">Call 816-945-2460</a>
<a href="mailto:info@als-cleaning.com">info@als-cleaning.com</a>
</div>
</div></div>
</section>
</main>

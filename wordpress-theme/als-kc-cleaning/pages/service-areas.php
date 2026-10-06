<?php
defined( 'ABSPATH' ) || exit;
?>
<main id="main" class="page">
<header class="page-hero">
<div class="wrap page-hero-grid">
<div>
<nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li><li>Service areas</li></ol></nav>
<p class="eyebrow">Where we work</p>
<h1>Servicing the Greater Kansas City Metro</h1>
<p class="lede">Kansas City on both sides of the state line, plus the communities around it. This list is easy to edit when the route grows.</p>
</div>

</div>
</header>
<section class="section">
<div class="wrap">
<ul class="city-grid"><li><h2>Kansas City, MO</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li><li><h2>Kansas City, KS</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li><li><h2>Overland Park</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li><li><h2>Independence</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li><li><h2>Lee's Summit</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li><li><h2>Olathe</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li><li><h2>Shawnee</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li><li><h2>Lenexa</h2><p>Facilities and homes in the Greater Kansas City Metro.</p></li><li class="city-more"><h2>And nearby communities</h2><p>If your city is not named here, ask. If we can reach the building, we will say so on the walkthrough.</p></li></ul>
</div>
</section>
<section class="section section-cream section-tight">
<div class="wrap"><div class="quote-panel" id="quote">
<form class="quote-form" id="quote-areas" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-quote-form>
<h2 class="form-title">Book a free walkthrough</h2>
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="service-areas">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">
<div class="hp" aria-hidden="true">
<label for="quote-areas-hp">Company website</label>
<input id="quote-areas-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
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

<?php
defined( 'ABSPATH' ) || exit;
?>
<main id="main" class="page">
<header class="page-hero">
<div class="wrap page-hero-grid">
<div>
<nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li><li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a></li><li>Janitorial Services</li></ol></nav>
<p class="eyebrow">Kansas City</p>
<h1>Janitorial services for Kansas City facilities</h1>
<p class="lede">The steady visit. Nightly, weekly, or on the days your building is actually in use — so schools, offices, and shared rooms do not slide between deep cleans.</p>
</div>
<figure class="page-figure"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/school-hall.jpg' ); ?>" alt="A school hallway with cubbies and a polished floor." width="1248" height="832"></figure>
</div>
</header>
<section class="section">
<div class="wrap split">
<div class="prose">
<p>Janitorial is the rhythm. Commercial cleaning is the relationship. Most facilities need both: a regular route that covers the everyday, and a plan for the work that should not be rushed into a short visit.</p><p>You get a clear point of contact, a scope you have seen, and people who show up when the calendar says they will.</p><p>University Academy is one of the janitorial relationships. The same standard fits any workplace or shared building: a clean room is a productive one, and it stays that way because the work repeats. Service is timely and matched to your schedule, with products chosen to be safe for the people who use the space.</p>


</div>
<div>
<h2>What's included</h2>
<ul class="checklist"><li>Scheduled daytime or after-hours upkeep</li><li>Restrooms, break areas, and entryways</li><li>Floors, trash, and common surfaces</li><li>High-touch spots when they are part of the scope</li><li>A written list of what every visit covers</li><li>A person you can reach when the building changes</li></ul>
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
<div class="wrap"><div class="quote-panel" id="quote">
<form class="quote-form" id="quote-janitorial-services" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-quote-form>
<h2 class="form-title">Book a free walkthrough</h2>
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="janitorial-services">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">
<div class="hp" aria-hidden="true">
<label for="quote-janitorial-services-hp">Company website</label>
<input id="quote-janitorial-services-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
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

<?php
defined( 'ABSPATH' ) || exit;
?>
<main id="main" class="page">
<header class="page-hero">
<div class="wrap page-hero-grid">
<div>
<nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li><li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a></li><li>Disinfecting / High-Touch</li></ol></nav>
<p class="eyebrow">Kansas City</p>
<h1>High-touch disinfecting for Kansas City facilities</h1>
<p class="lede">Clinics, schools, daycares, and offices share the same problem: hands land on the same spots all day. We treat those spots on purpose.</p>
</div>
<figure class="page-figure"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/clinic-hall.jpg' ); ?>" alt="A sunlit clinic hallway with a polished floor." width="1248" height="832"></figure>
</div>
</header>
<section class="section">
<div class="wrap split">
<div class="prose">
<p>This is not a fogging promise or a percentage we invented. It is a list of touch points, cleaned with environmentally responsible products, used the way the label says, and safe for people and pets.</p><p>If your clinic or daycare already has an approved product list, we follow it. High-touch work can live inside a regular visit or stand on its own where traffic is heavy.</p><p>Specialized spaces need a specific list: switches, rails, handles, restrooms, and the desks people share. We use environmentally responsible products, safe for people and pets, and we follow the facility's approved list when it has one.</p>

<div class="chips" aria-label="High-touch spots"><span>Light switches</span><span>Handrails</span><span>Elevator buttons</span><span>Door handles</span><span>Entry doors</span><span>Restroom faucets</span><span>Soap and towel dispensers</span><span>Phones</span><span>Mice and keyboards</span><span>Printers and shared equipment</span></div>
</div>
<div>
<h2>What's included</h2>
<ul class="checklist"><li>A written list of touch points for your building</li><li>Products matched to the people who use the room</li><li>Label-led use, including dwell time when it matters</li><li>Restrooms, entries, and shared desks</li><li>Add-on to janitorial, or its own visit</li><li>A scope a clinic or daycare can actually approve</li></ul>
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
<form class="quote-form" id="quote-disinfecting" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-quote-form>
<h2 class="form-title">Book a free walkthrough</h2>
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="disinfecting">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">
<div class="hp" aria-hidden="true">
<label for="quote-disinfecting-hp">Company website</label>
<input id="quote-disinfecting-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
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

<?php
defined( 'ABSPATH' ) || exit;
?>
<main id="main" class="page">
<header class="page-hero">
<div class="wrap page-hero-grid">
<div>
<nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li><li>Services</li></ol></nav>
<p class="eyebrow">Services</p>
<h1>Professional cleaning for every space</h1>
<p class="lede">Commercial and janitorial work leads. Homes are part of the company too. Every service ends with the same free walkthrough.</p>
</div>

</div>
</header>
<section class="section">
<div class="wrap card-grid service-grid"><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/commercial-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/office.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h2>Commercial Cleaning</h2><p>Keep your business spotless and professional. A clean space means a clear mind and better first impressions.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/janitorial-services/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/school-hall.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h2>Janitorial Services</h2><p>Consistent, professional upkeep for workplaces, schools, and shared spaces, because a clean environment is a productive one.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/carpet-floor-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/floors.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h2>Carpet &amp; Floor Cleaning</h2><p>Revive tired floors and eliminate deep-set dirt with expert care for all carpet and flooring types.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/window-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/windows.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h2>Window Cleaning</h2><p>Let the light in. Interior and exterior streak-free windows that brighten every room and every view.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/deep-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/home-interior.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h2>Deep Cleaning / Move-In-Out</h2><p>Seasonal refreshes and move-in or move-out cleans. We tackle what regular cleaning misses.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/disinfecting/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/clinic-hall.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h2>Disinfecting / High-Touch</h2><p>The places hands land all day — switches, rails, handles, restrooms, and the desks people share.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/custom-packages/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/community-room.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h2>Custom / Recurring Packages</h2><p>Flexible cleaning solutions designed around your schedule, your space, and special requirements.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/residential-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/home-interior.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h2>Residential Cleaning</h2><p>Homes get the same care as the facilities. Recurring or a one-time reset, with products safe for people and pets.</p><span class="text-link">See this service</span></div>
</a>
</article></div>
</section>
<section class="section section-tight">
<div class="wrap"><div class="quote-panel" id="quote">
<form class="quote-form" id="quote-services" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-quote-form>
<h2 class="form-title">Book a free walkthrough</h2>
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="services">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">
<div class="hp" aria-hidden="true">
<label for="quote-services-hp">Company website</label>
<input id="quote-services-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
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

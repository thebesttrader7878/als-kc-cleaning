<?php
defined( 'ABSPATH' ) || exit;
?>
<main id="main" class="page">
<header class="page-hero">
<div class="wrap page-hero-grid">
<div>
<nav class="breadcrumb" aria-label="Breadcrumb"><ol><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li><li>Reviews</li></ol></nav>
<p class="eyebrow">Results</p>
<h1>Spaces we take personally</h1>
<p class="lede">LEAD Academy, University Academy, Wonderscope, and Dialysis Clinic Inc., plus the rooms we walk into. Google reviews have a place here once that listing is connected.</p>
</div>

</div>
</header>
<section class="section">
<div class="wrap proof-grid">
<?php als_reviews_slot(); ?>
<ul class="clients"><li><span>LEAD Academy</span><small>Community visit</small></li><li><span>Wonderscope</span><small>Custom packages</small></li><li><span>University Academy</span><small>Janitorial services</small></li><li><span>Dialysis Clinic Inc.</span><small>Commercial cleaning</small></li></ul>
</div>
<div class="wrap badge-row"><?php als_badge_row(); ?></div>
</section>
<section class="section section-cream">
<div class="wrap">
<div class="section-head">
<h2>Days we showed up</h2>
<p class="lede">Jacob Louisus with the people at LEAD Academy, University Academy, and The Regnier Family Wonderscope Children's Museum.</p>
</div>
<div class="moment-grid"><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/founder.jpg' ); ?>" alt="Jacob Louisus, founder of Al's KC Cleaning, standing outdoors with a golf club." width="588" height="794"><figcaption>Jacob Louisus, founder of Al's KC Cleaning.</figcaption></figure><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/lead-academy.jpg' ); ?>" alt="Jacob Louisus with a teammate behind stacks of Krispy Kreme boxes for LEAD Academy staff." width="586" height="785"><figcaption>LEAD Academy, before the first day of school. Coffee and Krispy Kreme for the staff.</figcaption></figure><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/university-academy.jpg' ); ?>" alt="Jacob Louisus with University Academy staff on the first day of school." width="792" height="785"><figcaption>University Academy, first day of school.</figcaption></figure><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/wonderscope.jpg' ); ?>" alt="Jacob Louisus with Wonderscope staff beside pizza boxes on the first day of summer camp." width="628" height="785"><figcaption>The Regnier Family Wonderscope Children's Museum, first day of summer camp.</figcaption></figure></div>
</div>
</section>
<section class="section">
<div class="wrap">
<div class="section-head">
<h2>On the floor, and after hours</h2>
<p class="lede">Press play to hear the clips.</p>
</div>
<div class="film-grid"><figure><video controls playsinline preload="metadata" poster="<?php echo esc_url( get_template_directory_uri() . '/assets/img/poster-floors.jpg' ); ?>" width="416" height="740"><source src="<?php echo esc_url( get_template_directory_uri() . '/assets/video/floors.mp4' ); ?>" type="video/mp4"></video><figcaption>A floor in progress. The clip also invites people who want to get paid while the crew cleans. Press play to hear the clip.</figcaption></figure><figure><video controls playsinline preload="metadata" poster="<?php echo esc_url( get_template_directory_uri() . '/assets/img/poster-night.jpg' ); ?>" width="416" height="740"><source src="<?php echo esc_url( get_template_directory_uri() . '/assets/video/night-walk.mp4' ); ?>" type="video/mp4"></video><figcaption>After hours: from the front walk into the rooms inside. Press play to hear the clip.</figcaption></figure></div>
</div>
</section>
<section class="section section-cream">
<div class="wrap">
<div class="section-head">
<h2>The kind of rooms we walk into</h2>
<p class="lede">Clinics, schools, offices, halls, and homes across the metro. These photographs show the kind of rooms. They are not labeled as a specific client's job.</p>
</div>
<div class="gallery"><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/floors.jpg' ); ?>" alt="Clean gray carpet meeting a wood-look floor." width="1248" height="832"><figcaption>Clean gray carpet meeting a wood-look floor.</figcaption></figure><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/windows.jpg' ); ?>" alt="Clear windows looking onto a brick street." width="1248" height="832"><figcaption>Clear windows looking onto a brick street.</figcaption></figure><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/office.jpg' ); ?>" alt="A tidy open office with a glass meeting room." width="1248" height="832"><figcaption>A tidy open office with a glass meeting room.</figcaption></figure><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/school-hall.jpg' ); ?>" alt="A school hallway with cubbies and a polished floor." width="1248" height="832"><figcaption>A school hallway with cubbies and a polished floor.</figcaption></figure><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/clinic-hall.jpg' ); ?>" alt="A sunlit clinic hallway with a polished floor." width="1248" height="832"><figcaption>A sunlit clinic hallway with a polished floor.</figcaption></figure><figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/home-interior.jpg' ); ?>" alt="A bright living room opening into a kitchen." width="1248" height="832"><figcaption>A bright living room opening into a kitchen.</figcaption></figure></div>
</div>
</section>
<section class="section section-tight">
<div class="wrap"><div class="quote-panel" id="quote">
<form class="quote-form" id="quote-reviews" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-quote-form>
<h2 class="form-title">Book a free walkthrough</h2>
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="reviews">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">
<div class="hp" aria-hidden="true">
<label for="quote-reviews-hp">Company website</label>
<input id="quote-reviews-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
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

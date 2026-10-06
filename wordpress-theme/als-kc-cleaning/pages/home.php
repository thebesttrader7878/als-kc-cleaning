<?php
defined( 'ABSPATH' ) || exit;
?>
<main id="main">

<section class="hero">
<div class="hero-media" data-parallax>
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/hero-lobby.jpg' ); ?>" alt="A clean clinic lobby in morning light." width="1280" height="720" fetchpriority="high">
</div>
<div class="wrap hero-grid">
<div class="hero-copy">
<p class="eyebrow">Greater Kansas City Metro</p>
<h1>Clean spaces. Clear minds. Kansas City businesses we take personally.</h1>
<p class="lede">Family-rooted commercial cleaning for medical facilities, schools, daycares, and offices across the metro — with a free walkthrough and no pressure.</p>
<div class="hero-actions">
<a class="btn btn-primary" href="#quote">Book Free Walkthrough</a>
<a class="btn btn-secondary" href="tel:+18169452460">Call 816-945-2460</a>
</div>
</div>
<div class="hero-card" id="quote"><form class="quote-form" id="quote-hero" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-quote-form>
<h2 class="form-title">Book a free walkthrough</h2>
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="home">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">
<div class="hp" aria-hidden="true">
<label for="quote-hero-hp">Company website</label>
<input id="quote-hero-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
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
</form></div>
</div>
</section>
<section class="trust" id="trust" aria-label="Why people call">
<div class="wrap"><ul class="trust-list"><li class="trust-item"><h3>Satisfaction guarantee</h3><p>We stand behind the work. If something is off, tell us and we will make it right.</p></li><li class="trust-item"><h3>Trained team</h3><p>Trained professionals with industry-grade tools, not a different guess every visit.</p></li><li class="trust-item"><h3>Eco-safe products</h3><p>Environmentally responsible products, chosen to be safe for people and pets.</p></li><li class="trust-item"><h3>Free walkthrough</h3><p>We look at the space with you first. No pressure and no commitment.</p></li><li class="trust-item"><h3>On-time communication</h3><p>We show up when we say we will, and we tell you plainly if something changes.</p></li></ul></div>
</section>
<section class="section section-cream" id="audiences">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">Who we clean for</p>
<h2>Buildings that serve people</h2>
<p class="lede">Medical facilities, schools, daycares, and offices lead the work. Banks, gyms, restaurants, and churches fit the same kind of care.</p>
</div>
<div class="card-grid audience-grid"><article class="card card-media">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/clinic-hall.jpg' ); ?>" alt="A sunlit clinic hallway with a polished floor." width="1248" height="832">
<div class="card-body"><h3>Medical facilities &amp; clinics</h3><p>Waiting rooms, halls, restrooms, and the high-touch spots patients and staff share. Clean enough that people can focus on care.</p></div>
</article><article class="card card-media">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/school-hall.jpg' ); ?>" alt="A school hallway with cubbies and a polished floor." width="1248" height="832">
<div class="card-body"><h3>Schools &amp; daycares</h3><p>Hallways, classrooms, and the rooms little kids actually use. We work around the day so learning is not interrupted.</p></div>
</article><article class="card card-media">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/office.jpg' ); ?>" alt="A tidy open office with a glass meeting room." width="1248" height="832">
<div class="card-body"><h3>Offices &amp; commercial spaces</h3><p>Lobbies, desks, break rooms, and glass. A clean office is a clearer head and a better first impression.</p></div>
</article><article class="card card-media">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/community-room.jpg' ); ?>" alt="A neighborhood hall set with rows of wooden chairs." width="1248" height="832">
<div class="card-body"><h3>Banks, gyms, restaurants, churches</h3><p>Shared rooms that take a beating. We build a rhythm that fits the hours people actually walk through the door.</p></div>
</article></div>
</div>
</section>
<section class="section" id="services">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">Services</p>
<h2>Professional cleaning services for every space</h2>
<p class="lede">Start with the building you have. Residential cleaning is here too — the homepage just leads with the facilities.</p>
</div>
<div class="card-grid service-grid"><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/commercial-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/office.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h3>Commercial Cleaning</h3><p>Keep your business spotless and professional. A clean space means a clear mind and better first impressions.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/janitorial-services/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/school-hall.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h3>Janitorial Services</h3><p>Consistent, professional upkeep for workplaces, schools, and shared spaces, because a clean environment is a productive one.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/carpet-floor-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/floors.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h3>Carpet &amp; Floor Cleaning</h3><p>Revive tired floors and eliminate deep-set dirt with expert care for all carpet and flooring types.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/window-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/windows.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h3>Window Cleaning</h3><p>Let the light in. Interior and exterior streak-free windows that brighten every room and every view.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/deep-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/home-interior.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h3>Deep Cleaning / Move-In-Out</h3><p>Seasonal refreshes and move-in or move-out cleans. We tackle what regular cleaning misses.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/disinfecting/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/clinic-hall.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h3>Disinfecting / High-Touch</h3><p>The places hands land all day — switches, rails, handles, restrooms, and the desks people share.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/custom-packages/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/community-room.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h3>Custom / Recurring Packages</h3><p>Flexible cleaning solutions designed around your schedule, your space, and special requirements.</p><span class="text-link">See this service</span></div>
</a>
</article><article class="card service-card">
<a class="card-link" href="<?php echo esc_url( home_url( '/services/residential-cleaning/' ) ); ?>">
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/home-interior.jpg' ); ?>" alt="" width="1248" height="832">
<div class="card-body"><h3>Residential Cleaning</h3><p>Homes get the same care as the facilities. Recurring or a one-time reset, with products safe for people and pets.</p><span class="text-link">See this service</span></div>
</a>
</article></div>
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
<section class="story-scroll" id="why" data-story style="--chapters:6">
<div class="story-pin">
<div class="story-top">
<p class="eyebrow">Why Al's</p>
<p class="sr" data-story-live aria-live="polite">Chapter 1. Jacob Louisus</p>
</div>
<div class="story-stage"><div class="story-slide">
<figure class="story-frame is-on" data-story-frame><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/founder.jpg' ); ?>" alt="Jacob Louisus, founder of Al's KC Cleaning, standing outdoors with a golf club." width="588" height="794"></figure>
<article class="story-card is-on" data-story-card>
<span class="story-watermark" aria-hidden="true">01</span>
<p class="story-kicker"><span>01</span> Founder</p>
<h2>Jacob Louisus</h2>
<p>It started on Saturday mornings with my grandmother — breakfast in the air, soul music on, the whole house cleaned together. That care is still how we show up for clinics, schools, daycares, and offices across Kansas City.</p>
<p class="story-more">What started as a passion has now grown into a company serving medical facilities, clinics, schools, daycares, and office spaces across the Kansas City area.</p>
</article>
</div><div class="story-slide">
<figure class="story-frame" data-story-frame><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/lead-academy.jpg' ); ?>" alt="Jacob Louisus with a teammate behind stacks of Krispy Kreme boxes for LEAD Academy staff." width="586" height="785"></figure>
<article class="story-card" data-story-card>
<span class="story-watermark" aria-hidden="true">02</span>
<p class="story-kicker"><span>02</span> LEAD Academy</p>
<h2>Before the students walked in</h2>
<p>ALS showed up for teachers, administrators, and staff across all four LEAD Public Schools campuses with coffee and Krispy Kreme, before the first day of school.</p>
<blockquote><p>While we build the new facility... I love the culture. It seems like everybody's helping each other.</p><footer>— Dr. Ricky Gibbs</footer></blockquote><p class="story-sign">The way you care for a building reflects the way you care for the people inside it.</p>
</article>
</div><div class="story-slide">
<figure class="story-frame" data-story-frame><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/university-academy.jpg' ); ?>" alt="Jacob Louisus with University Academy staff on the first day of school." width="792" height="785"></figure>
<article class="story-card" data-story-card>
<span class="story-watermark" aria-hidden="true">03</span>
<p class="story-kicker"><span>03</span> University Academy</p>
<h2>First day, for the people in the halls</h2>
<p>ALS Cleaning treated the University Academy staff to donuts and stood with the teachers and staff who walk those halls every day.</p>

</article>
</div><div class="story-slide">
<figure class="story-frame" data-story-frame><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/wonderscope.jpg' ); ?>" alt="Jacob Louisus with Wonderscope staff beside pizza boxes on the first day of summer camp." width="628" height="785"></figure>
<article class="story-card" data-story-card>
<span class="story-watermark" aria-hidden="true">04</span>
<p class="story-kicker"><span>04</span> Wonderscope</p>
<h2>Summer camp, first morning</h2>
<p>First day of summer camp at The Regnier Family Wonderscope Children's Museum. ALS teamed up with Atomic Cowboy for pizza, chicken tenders, and waffle fries.</p>

</article>
</div><div class="story-slide">
<figure class="story-frame" data-story-frame><video muted playsinline loop preload="metadata" poster="<?php echo esc_url( get_template_directory_uri() . '/assets/img/poster-floors.jpg' ); ?>" width="416" height="740" aria-label="A floor in progress"><source src="<?php echo esc_url( get_template_directory_uri() . '/assets/video/floors.mp4' ); ?>" type="video/mp4"></video><button type="button" class="sound-btn" data-sound aria-pressed="false">Play with sound</button></figure>
<article class="story-card" data-story-card>
<span class="story-watermark" aria-hidden="true">05</span>
<p class="story-kicker"><span>05</span> The work</p>
<h2>A floor in progress</h2>
<p>The clip also invites people who want to get paid while the crew cleans.</p>

</article>
</div><div class="story-slide">
<figure class="story-frame" data-story-frame><video muted playsinline preload="metadata" poster="<?php echo esc_url( get_template_directory_uri() . '/assets/img/poster-night.jpg' ); ?>" width="416" height="740" aria-label="From the front walk into the rooms"><source src="<?php echo esc_url( get_template_directory_uri() . '/assets/video/night-walk.mp4' ); ?>" type="video/mp4"></video><button type="button" class="sound-btn" data-sound aria-pressed="false">Play with sound</button></figure>
<article class="story-card" data-story-card>
<span class="story-watermark" aria-hidden="true">06</span>
<p class="story-kicker"><span>06</span> After hours</p>
<h2>From the front walk into the rooms</h2>
<p>A night walk from the path outside into the rooms inside.</p>

</article>
</div></div>
<nav class="story-rail" aria-label="Story chapters"><button type="button" data-story-jump="0" aria-current="step"><span>01</span> <span class="story-rail-label">Founder</span></button><button type="button" data-story-jump="1"><span>02</span> <span class="story-rail-label">LEAD Academy</span></button><button type="button" data-story-jump="2"><span>03</span> <span class="story-rail-label">University Academy</span></button><button type="button" data-story-jump="3"><span>04</span> <span class="story-rail-label">Wonderscope</span></button><button type="button" data-story-jump="4"><span>05</span> <span class="story-rail-label">The work</span></button><button type="button" data-story-jump="5"><span>06</span> <span class="story-rail-label">After hours</span></button></nav>
<div class="story-foot">
<div class="story-meter" aria-hidden="true"><span data-story-fill></span></div>
<a class="text-link" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Read the full story</a>
</div>
</div>
</section>
<section class="section section-cream promise-band">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">Why Al's</p>
<h2>Built on family, tradition, and pride in a job well done.</h2>
</div>
<div class="promise-list promise-row"><article class="promise"><p class="step-no">01</p><h3>Care</h3><p>You matter most. This work is personal, and we treat your people that way — with pride, and a little love and positivity.</p></article><article class="promise"><p class="step-no">02</p><h3>Consistency</h3><p>The same standard every visit, so the building does not depend on who happened to remember.</p></article><article class="promise"><p class="step-no">03</p><h3>Communication</h3><p>On time, clear updates, and follow-through. Every single time.</p></article></div>
</div>
</section>
<section class="reel-scroll" id="proof" data-reel>
<div class="reel-pin">
<div class="reel-copy">
<p class="eyebrow">Results</p>
<h2>Places we've shown up for</h2>
<p>LEAD Academy, University Academy, and Wonderscope, plus Dialysis Clinic Inc. Google reviews will live on the reviews page once that listing is connected.</p>
<ul class="clients"><li><span>LEAD Academy</span><small>Community visit</small></li><li><span>Wonderscope</span><small>Custom packages</small></li><li><span>University Academy</span><small>Janitorial services</small></li><li><span>Dialysis Clinic Inc.</span><small>Commercial cleaning</small></li></ul>
<p class="reel-hint">Keep scrolling. The film keeps moving.</p>
<a class="text-link" href="<?php echo esc_url( home_url( '/reviews/' ) ); ?>">See the reviews page</a>
</div>
<div class="reel-window">
<div class="reel-track" data-reel-track><figure class="reel-card"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/founder.jpg' ); ?>" alt="Jacob Louisus, founder of Al's KC Cleaning, standing outdoors with a golf club." width="588" height="794"><figcaption>Jacob Louisus, founder of Al's KC Cleaning.</figcaption></figure><figure class="reel-card"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/lead-academy.jpg' ); ?>" alt="Jacob Louisus with a teammate behind stacks of Krispy Kreme boxes for LEAD Academy staff." width="586" height="785"><figcaption>LEAD Academy, before the first day of school. Coffee and Krispy Kreme for the staff.</figcaption></figure><figure class="reel-card"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/university-academy.jpg' ); ?>" alt="Jacob Louisus with University Academy staff on the first day of school." width="792" height="785"><figcaption>University Academy, first day of school.</figcaption></figure><figure class="reel-card"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/wonderscope.jpg' ); ?>" alt="Jacob Louisus with Wonderscope staff beside pizza boxes on the first day of summer camp." width="628" height="785"><figcaption>The Regnier Family Wonderscope Children's Museum, first day of summer camp.</figcaption></figure></div>
</div>
</div>
</section>
<section class="section section-cream" id="areas">
<div class="wrap">
<div class="section-head">
<p class="eyebrow">Service area</p>
<h2>Greater Kansas City, and nearby communities</h2>
</div>
<ul class="pills"><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Kansas City, MO</a></li><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Kansas City, KS</a></li><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Overland Park</a></li><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Independence</a></li><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Lee's Summit</a></li><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Olathe</a></li><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Shawnee</a></li><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">Lenexa</a></li><li><a href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>">and nearby communities</a></li></ul>
</div>
</section>
<section class="cta-band" id="final-cta">
<div class="wrap cta-grid">
<div>
<p class="eyebrow">Free walkthrough</p>
<h2>Tell us about your space and we'll handle the rest.</h2>
<p>Customer satisfaction is our top priority. Call now, or send the form and we will set the walkthrough.</p>
<a class="btn btn-secondary btn-on-dark" href="tel:+18169452460">Call 816-945-2460</a>
</div>
<form class="quote-form" id="quote-final" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-quote-form>
<h2 class="sr">Book a free walkthrough</h2>
<p class="form-note">No pressure and no commitment. Tell us about the space and we will follow up.</p>
<input type="hidden" name="action" value="als_quote">
<?php wp_nonce_field( 'als_quote', 'als_quote_nonce' ); ?>
<input type="hidden" name="als_source" value="home-footer">
<input type="hidden" name="als_redirect" value="<?php echo esc_url( als_current_url() ); ?>">
<div class="hp" aria-hidden="true">
<label for="quote-final-hp">Company website</label>
<input id="quote-final-hp" type="text" name="als_hp" tabindex="-1" autocomplete="off">
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
</div>
</section>
</main>

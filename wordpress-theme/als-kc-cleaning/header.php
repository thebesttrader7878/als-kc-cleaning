<?php
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
<div class="scroll-progress" aria-hidden="true"><span data-progress></span></div>
<div class="utility">
<div class="wrap utility-inner">
<p>Servicing the Greater Kansas City Metro</p>
<p class="utility-links"><a href="tel:+18169452460">816-945-2460</a><a href="mailto:info@als-cleaning.com">info@als-cleaning.com</a></p>
</div>
</div>
<header class="site-header">
<div class="wrap header-inner">
<?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?><a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<img class="logo-img" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="ALS Cleaning Service" width="900" height="620">
</a><?php } ?>
<nav class="nav" id="site-nav" data-nav aria-label="Primary">
<ul class="nav-list">
<li><a class="<?php echo esc_attr( als_nav_active( 'home' ) ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo als_is_nav( 'home' ) ? ' aria-current="page"' : ''; ?>>Home</a></li>
<li class="has-sub"><a class="<?php echo esc_attr( als_nav_active( 'services' ) ); ?>" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"<?php echo als_is_nav( 'services' ) ? ' aria-current="page"' : ''; ?>>Services</a>
<ul class="submenu"><li><a href="<?php echo esc_url( home_url( '/services/commercial-cleaning/' ) ); ?>"<?php echo is_page( 'commercial-cleaning' ) ? ' class="is-active"' : ''; ?>>Commercial Cleaning</a></li><li><a href="<?php echo esc_url( home_url( '/services/janitorial-services/' ) ); ?>"<?php echo is_page( 'janitorial-services' ) ? ' class="is-active"' : ''; ?>>Janitorial Services</a></li><li><a href="<?php echo esc_url( home_url( '/services/carpet-floor-cleaning/' ) ); ?>"<?php echo is_page( 'carpet-floor-cleaning' ) ? ' class="is-active"' : ''; ?>>Carpet &amp; Floor Cleaning</a></li><li><a href="<?php echo esc_url( home_url( '/services/window-cleaning/' ) ); ?>"<?php echo is_page( 'window-cleaning' ) ? ' class="is-active"' : ''; ?>>Window Cleaning</a></li><li><a href="<?php echo esc_url( home_url( '/services/deep-cleaning/' ) ); ?>"<?php echo is_page( 'deep-cleaning' ) ? ' class="is-active"' : ''; ?>>Deep Cleaning / Move-In-Out</a></li><li><a href="<?php echo esc_url( home_url( '/services/disinfecting/' ) ); ?>"<?php echo is_page( 'disinfecting' ) ? ' class="is-active"' : ''; ?>>Disinfecting / High-Touch</a></li><li><a href="<?php echo esc_url( home_url( '/services/custom-packages/' ) ); ?>"<?php echo is_page( 'custom-packages' ) ? ' class="is-active"' : ''; ?>>Custom / Recurring Packages</a></li><li><a href="<?php echo esc_url( home_url( '/services/residential-cleaning/' ) ); ?>"<?php echo is_page( 'residential-cleaning' ) ? ' class="is-active"' : ''; ?>>Residential Cleaning</a></li></ul></li>
<li><a class="<?php echo esc_attr( als_nav_active( 'about' ) ); ?>" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"<?php echo als_is_nav( 'about' ) ? ' aria-current="page"' : ''; ?>>About</a></li><li><a class="<?php echo esc_attr( als_nav_active( 'service-areas' ) ); ?>" href="<?php echo esc_url( home_url( '/service-areas/' ) ); ?>"<?php echo als_is_nav( 'service-areas' ) ? ' aria-current="page"' : ''; ?>>Areas</a></li><li><a class="<?php echo esc_attr( als_nav_active( 'reviews' ) ); ?>" href="<?php echo esc_url( home_url( '/reviews/' ) ); ?>"<?php echo als_is_nav( 'reviews' ) ? ' aria-current="page"' : ''; ?>>Reviews</a></li><li><a class="<?php echo esc_attr( als_nav_active( 'faq' ) ); ?>" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"<?php echo als_is_nav( 'faq' ) ? ' aria-current="page"' : ''; ?>>FAQ</a></li>
</ul>
</nav>
<div class="header-tools">
<a class="header-phone" href="tel:+18169452460"><span class="sr">Call </span>816-945-2460</a>
<a class="btn btn-primary btn-small" href="<?php echo als_book_href_attr(); ?>" aria-label="Book Free Walkthrough"><span class="btn-long">Book Free Walkthrough</span><span class="btn-short" aria-hidden="true">Book</span></a>
<button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="site-nav">Menu</button>
</div>
</div>
</header>
<?php als_quote_banner(); ?>

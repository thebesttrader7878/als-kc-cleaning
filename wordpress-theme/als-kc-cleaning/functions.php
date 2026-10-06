<?php
/**
 * Al's KC Cleaning theme setup, quote form, and settings.
 *
 * @package Als_KC_Cleaning
 */

defined( 'ABSPATH' ) || exit;

define( 'ALS_VERSION', '1.0.0' );

function als_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array(
		'primary' => "Primary (the theme draws its own menu; this is unused)",
	) );
}
add_action( 'after_setup_theme', 'als_setup' );

function als_assets() {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();
	wp_enqueue_style(
		'als-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'als-site', $uri . '/assets/css/site.css', array( 'als-fonts' ), filemtime( $dir . '/assets/css/site.css' ) );
	wp_enqueue_script( 'als-site', $uri . '/assets/js/site.js', array(), filemtime( $dir . '/assets/js/site.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'als_assets' );

function als_font_preconnect() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="icon" href="' . esc_url( get_template_directory_uri() . '/assets/favicon.png' ) . '" type="image/png">' . "\n";
	echo '<meta name="theme-color" content="#043e74">' . "\n";
	echo "<script>document.documentElement.classList.add('js');if(window.matchMedia('(prefers-reduced-motion: reduce)').matches)document.documentElement.classList.add('reduce');</script>\n";
}
add_action( 'wp_head', 'als_font_preconnect', 1 );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function als_settings() {
	$stored = get_option( 'als_kc_settings' );
	return is_array( $stored ) ? $stored : array();
}

function als_setting( $key, $default = '' ) {
	$stored = als_settings();
	if ( ! isset( $stored[ $key ] ) || '' === $stored[ $key ] ) {
		return $default;
	}
	return $stored[ $key ];
}

function als_map( $file ) {
	$path = get_template_directory() . '/inc/' . $file;
	if ( ! is_readable( $path ) ) {
		return array();
	}
	$data = include $path;
	return is_array( $data ) ? $data : array();
}

function als_current_url() {
	if ( is_singular() ) {
		$link = get_permalink();
		if ( $link ) {
			return $link;
		}
	}
	return home_url( '/' );
}

function als_nav_active( $slug ) {
	if ( 'home' === $slug ) {
		return is_front_page() ? 'is-active' : '';
	}
	if ( 'services' === $slug ) {
		if ( is_page( 'services' ) ) {
			return 'is-active';
		}
		$post = get_queried_object();
		if ( $post instanceof WP_Post && $post->post_parent ) {
			$parent = get_post( $post->post_parent );
			if ( $parent && 'services' === $parent->post_name ) {
				return 'is-active';
			}
		}
		return '';
	}
	return is_page( $slug ) ? 'is-active' : '';
}

function als_is_nav( $slug ) {
	return '' !== als_nav_active( $slug );
}

function als_book_url() {
	if ( is_404() || is_page( array( 'about', 'privacy-policy' ) ) ) {
		return home_url( '/get-a-quote/' );
	}
	if ( is_front_page() || is_page() ) {
		return '#quote';
	}
	return home_url( '/get-a-quote/' );
}

function als_book_href_attr() {
	$url = als_book_url();
	if ( isset( $url[0] ) && '#' === $url[0] ) {
		return esc_attr( $url );
	}
	return esc_url( $url );
}

function als_quote_banner() {
	if ( ! isset( $_GET['quote'] ) ) {
		return;
	}
	$code = sanitize_key( wp_unslash( $_GET['quote'] ) );
	if ( 'sent' === $code ) {
		echo '<div class="banner banner-ok" id="quote-banner" role="status">Thanks — we got it. Someone from Al\'s KC Cleaning will reach out shortly to schedule your free walkthrough.</div>';
	} elseif ( 'invalid' === $code ) {
		echo '<div class="banner banner-bad" id="quote-banner" role="alert">Please check your name, phone, email, and facility type, then send it again.</div>';
	}
}

function als_social_links() {
	$links = array(
		'Facebook'  => als_setting( 'facebook' ),
		'Instagram' => als_setting( 'instagram', 'https://www.instagram.com/alsfacilityservices/' ),
		'LinkedIn'  => als_setting( 'linkedin' ),
	);
	$visible = array_filter( $links );
	if ( ! $visible ) {
		return;
	}
	echo '<ul class="social">';
	foreach ( $visible as $label => $href ) {
		echo '<li><a href="' . esc_url( $href ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}

function als_reviews_slot() {
	$embed = als_setting( 'google_embed' );
	if ( $embed && false !== stripos( $embed, 'google.com' ) ) {
		$allowed = array(
			'iframe' => array(
				'src'             => true,
				'width'           => true,
				'height'          => true,
				'style'           => true,
				'loading'         => true,
				'referrerpolicy'  => true,
				'title'           => true,
				'frameborder'     => true,
				'allow'           => true,
				'allowfullscreen' => true,
			),
		);
		echo '<div class="embed">' . wp_kses( $embed, $allowed ) . '</div>';
		return;
	}
	echo '<div class="placeholder-box"><p class="eyebrow">Google reviews</p><p>Honest Google reviews will show here after the listing is confirmed. Nothing is invented in the meantime.</p>';
	if ( current_user_can( 'manage_options' ) ) {
		echo '<p class="fine">Admin: paste the embed under Settings → Al\'s KC Cleaning.</p>';
	}
	echo '</div>';
}

function als_badge_row() {
	if ( '1' !== als_setting( 'show_badges' ) ) {
		if ( current_user_can( 'manage_options' ) ) {
			echo '<p class="fine">Admin: insured, bonded, background-checked, and Google rating badges stay hidden until you confirm them in Al\'s KC Settings.</p>';
		}
		return;
	}
	echo '<ul class="badges">';
	foreach ( array( 'Insured', 'Bonded', 'Background-checked', 'Google rating' ) as $badge ) {
		echo '<li>' . esc_html( $badge ) . '</li>';
	}
	echo '</ul>';
}

function als_seo() {
	$map = als_map( 'seo.php' );
	if ( is_front_page() && isset( $map['home'] ) ) {
		return $map['home'];
	}
	if ( is_404() && isset( $map['not-found'] ) ) {
		return $map['not-found'];
	}
	$post = get_queried_object();
	if ( $post instanceof WP_Post && isset( $map[ $post->post_name ] ) ) {
		return $map[ $post->post_name ];
	}
	return null;
}

function als_document_title( $title ) {
	$seo = als_seo();
	if ( $seo && ! empty( $seo['title'] ) ) {
		return $seo['title'];
	}
	return $title;
}
add_filter( 'pre_get_document_title', 'als_document_title' );

function als_meta() {
	$seo = als_seo();
	if ( ! $seo ) {
		return;
	}
	echo '<meta name="description" content="' . esc_attr( $seo['description'] ) . '">' . "\n";
	$canonical = is_front_page() ? home_url( '/' ) : ( is_singular() ? get_permalink() : '' );
	if ( $canonical ) {
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
	}
	echo '<meta property="og:title" content="' . esc_attr( $seo['title'] ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $seo['description'] ) . '">' . "\n";
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:locale" content="en_US">' . "\n";
	if ( $canonical ) {
		echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . "\n";
	}
	if ( is_front_page() ) {
		$file = get_template_directory() . '/inc/schema.json';
		if ( is_readable( $file ) ) {
			$data = json_decode( file_get_contents( $file ), true );
			if ( is_array( $data ) ) {
				$same = array();
				foreach ( array( 'facebook', 'instagram', 'linkedin' ) as $key ) {
					$url = als_setting( $key );
					if ( $url ) {
						$same[] = $url;
					}
				}
				if ( $same ) {
					$data['sameAs'] = $same;
				}
				echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
			}
		}
	}
}
add_action( 'wp_head', 'als_meta', 2 );

function als_register_quotes() {
	register_post_type( 'als_quote', array(
		'labels' => array(
			'name'          => 'Quotes',
			'singular_name' => 'Quote',
		),
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-email-alt',
		'supports'     => array( 'title', 'editor' ),
		'capability_type' => 'post',
		'map_meta_cap' => true,
	) );
}
add_action( 'init', 'als_register_quotes' );

function als_quote_columns( $columns ) {
	$columns['als_phone']    = 'Phone';
	$columns['als_email']    = 'Email';
	$columns['als_facility'] = 'Facility';
	$columns['als_mail']     = 'Email sent';
	return $columns;
}
add_filter( 'manage_als_quote_posts_columns', 'als_quote_columns' );

function als_quote_column( $column, $post_id ) {
	if ( 'als_phone' === $column ) {
		echo esc_html( get_post_meta( $post_id, 'als_phone', true ) );
	} elseif ( 'als_email' === $column ) {
		echo esc_html( get_post_meta( $post_id, 'als_email', true ) );
	} elseif ( 'als_facility' === $column ) {
		echo esc_html( get_post_meta( $post_id, 'als_facility_label', true ) );
	} elseif ( 'als_mail' === $column ) {
		echo '1' === get_post_meta( $post_id, 'als_mail_sent', true ) ? 'Yes' : 'Saved, mail failed';
	}
}
add_action( 'manage_als_quote_posts_custom_column', 'als_quote_column', 10, 2 );

function als_clean_emails( $raw ) {
	$parts = preg_split( '/[\s,;]+/', is_string( $raw ) ? $raw : '' );
	$clean = array();
	if ( is_array( $parts ) ) {
		foreach ( $parts as $part ) {
			$email = sanitize_email( $part );
			if ( $email && is_email( $email ) ) {
				$clean[] = $email;
			}
		}
	}
	$clean = array_values( array_unique( $clean ) );
	if ( ! $clean ) {
		return 'info@als-cleaning.com, request@als-cleaning.com';
	}
	return implode( ', ', $clean );
}

function als_redirect_quote( $code ) {
	$target = isset( $_POST['als_redirect'] ) ? esc_url_raw( wp_unslash( $_POST['als_redirect'] ) ) : home_url( '/' );
	$target = remove_query_arg( 'quote', $target );
	wp_safe_redirect( add_query_arg( 'quote', $code, $target ) . '#quote-banner' );
	exit;
}

function als_handle_quote() {
	if ( 'POST' !== $_SERVER['REQUEST_METHOD'] ) {
		wp_safe_redirect( home_url( '/' ) );
		exit;
	}
	$nonce = isset( $_POST['als_quote_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['als_quote_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'als_quote' ) ) {
		als_redirect_quote( 'invalid' );
	}
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$key = 'als_q_' . md5( $ip );
	$count = (int) get_transient( $key );
	set_transient( $key, $count + 1, HOUR_IN_SECONDS );
	$honeypot = isset( $_POST['als_hp'] ) ? trim( wp_unslash( $_POST['als_hp'] ) ) : '';
	if ( $count > 12 || '' !== $honeypot ) {
		als_redirect_quote( 'sent' );
	}

	$name     = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone    = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$facility = isset( $_POST['facility'] ) ? sanitize_key( wp_unslash( $_POST['facility'] ) ) : '';
	$message  = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$source   = isset( $_POST['als_source'] ) ? sanitize_key( wp_unslash( $_POST['als_source'] ) ) : 'site';
	$name     = trim( preg_replace( '/[\r\n]+/', ' ', $name ) );
	$phone    = trim( preg_replace( '/[\r\n]+/', ' ', $phone ) );
	$digits   = preg_replace( '/\D+/', '', $phone );
	$labels   = als_map( 'facilities.php' );

	if ( strlen( $name ) < 2 || strlen( $name ) > 80 || strlen( $digits ) < 10 || strlen( $digits ) > 15 || ! is_email( $email ) || ! isset( $labels[ $facility ] ) || strlen( $message ) > 4000 ) {
		als_redirect_quote( 'invalid' );
	}

	$label   = $labels[ $facility ];
	$post_id = wp_insert_post( array(
		'post_type'    => 'als_quote',
		'post_status'  => 'private',
		'post_title'   => $name . ' — ' . $label,
		'post_content' => $message,
	), true );
	if ( is_wp_error( $post_id ) ) {
		als_redirect_quote( 'invalid' );
	}
	update_post_meta( $post_id, 'als_phone', $phone );
	update_post_meta( $post_id, 'als_email', $email );
	update_post_meta( $post_id, 'als_facility', $facility );
	update_post_meta( $post_id, 'als_facility_label', $label );
	update_post_meta( $post_id, 'als_source', $source );

	$sent_to = array_filter( array_map( 'trim', explode( ',', als_clean_emails( als_setting( 'notify_emails', '' ) ) ) ) );
	$safe_name = str_replace( array( "\r", "\n", '<', '>', ',', ';' ), '', $name );
	$body = "New free walkthrough request\n\n";
	$body .= 'Name: ' . $name . "\n";
	$body .= 'Phone: ' . $phone . "\n";
	$body .= 'Email: ' . $email . "\n";
	$body .= 'Facility: ' . $label . "\n";
	$body .= 'Page: ' . $source . "\n\n";
	$body .= $message . "\n";
	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $safe_name . ' <' . $email . '>',
	);
	add_filter( 'wp_mail_from', 'als_mail_from' );
	add_filter( 'wp_mail_from_name', 'als_mail_from_name' );
	$sent = wp_mail( $sent_to, 'New walkthrough request from ' . $safe_name, $body, $headers );
	remove_filter( 'wp_mail_from', 'als_mail_from' );
	remove_filter( 'wp_mail_from_name', 'als_mail_from_name' );
	update_post_meta( $post_id, 'als_mail_sent', $sent ? '1' : '0' );
	als_redirect_quote( 'sent' );
}
add_action( 'admin_post_nopriv_als_quote', 'als_handle_quote' );
add_action( 'admin_post_als_quote', 'als_handle_quote' );

function als_mail_from() {
	return 'info@als-cleaning.com';
}

function als_mail_from_name() {
	return "Al's KC Cleaning";
}

function als_sanitize_settings( $input ) {
	$input = is_array( $input ) ? $input : array();
	$out   = array();
	$out['notify_emails'] = als_clean_emails( isset( $input['notify_emails'] ) ? wp_unslash( $input['notify_emails'] ) : '' );
	$calendly = isset( $input['calendly'] ) ? esc_url_raw( wp_unslash( $input['calendly'] ) ) : '';
	$out['calendly'] = $calendly ? $calendly : 'https://calendly.com/alskccleaningllc/15min';
	foreach ( array( 'facebook', 'instagram', 'linkedin' ) as $key ) {
		$out[ $key ] = isset( $input[ $key ] ) ? esc_url_raw( wp_unslash( $input[ $key ] ) ) : '';
	}
	$out['show_badges'] = empty( $input['show_badges'] ) ? '0' : '1';
	$embed = isset( $input['google_embed'] ) ? wp_unslash( $input['google_embed'] ) : '';
	if ( ! is_string( $embed ) || false === stripos( $embed, 'google.com' ) ) {
		$embed = '';
	}
	$out['google_embed'] = wp_kses( $embed, array(
		'iframe' => array(
			'src'             => true,
			'width'           => true,
			'height'          => true,
			'style'           => true,
			'loading'         => true,
			'referrerpolicy'  => true,
			'title'           => true,
			'frameborder'     => true,
			'allow'           => true,
			'allowfullscreen' => true,
		),
	) );
	return $out;
}

function als_register_settings() {
	register_setting( 'als_kc', 'als_kc_settings', array(
		'type'              => 'array',
		'sanitize_callback' => 'als_sanitize_settings',
		'default'           => array(),
	) );
}
add_action( 'admin_init', 'als_register_settings' );

function als_settings_menu() {
	add_options_page( "Al's KC Cleaning", "Al's KC Cleaning", 'manage_options', 'als-kc', 'als_settings_page' );
}
add_action( 'admin_menu', 'als_settings_menu' );

function als_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$opts = als_settings();
	$get  = function ( $key, $default = '' ) use ( $opts ) {
		return isset( $opts[ $key ] ) ? $opts[ $key ] : $default;
	};
	?>
	<div class="wrap">
		<h1>Al's KC Cleaning</h1>
		<p>Quote emails, social links, and the spots that stay empty until you confirm them. To use your own job photos, replace the files in <code>wp-content/themes/als-kc-cleaning/assets/img/</code> and keep the same file names.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'als_kc' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="als-emails">Quote emails</label></th>
					<td><input class="regular-text" id="als-emails" name="als_kc_settings[notify_emails]" value="<?php echo esc_attr( $get( 'notify_emails', 'info@als-cleaning.com, request@als-cleaning.com' ) ); ?>">
					<p class="description">Comma-separated. Leads are always saved under Quotes, even if mail fails.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="als-calendly">15-minute call link</label></th>
					<td><input class="regular-text" type="url" id="als-calendly" name="als_kc_settings[calendly]" value="<?php echo esc_attr( $get( 'calendly', 'https://calendly.com/alskccleaningllc/15min' ) ); ?>"></td>
				</tr>
				<tr>
					<th scope="row">Social links</th>
					<td>
						<p><label>Facebook <input class="regular-text" type="url" name="als_kc_settings[facebook]" value="<?php echo esc_attr( $get( 'facebook' ) ); ?>"></label></p>
						<p><label>Instagram <input class="regular-text" type="url" name="als_kc_settings[instagram]" value="<?php echo esc_attr( $get( 'instagram', 'https://www.instagram.com/alsfacilityservices/' ) ); ?>"></label></p>
						<p><label>LinkedIn <input class="regular-text" type="url" name="als_kc_settings[linkedin]" value="<?php echo esc_attr( $get( 'linkedin' ) ); ?>"></label></p>
						<p class="description">Instagram is the alsfacilityservices account. Facebook and LinkedIn stay blank until you add them.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="als-embed">Google reviews embed</label></th>
					<td><textarea class="large-text" rows="5" id="als-embed" name="als_kc_settings[google_embed]"><?php echo esc_textarea( $get( 'google_embed' ) ); ?></textarea>
					<p class="description">Paste an iframe whose address is on google.com. Anything else is ignored.</p></td>
				</tr>
				<tr>
					<th scope="row">Certification badges</th>
					<td><label><input type="checkbox" name="als_kc_settings[show_badges]" value="1" <?php checked( $get( 'show_badges' ), '1' ); ?>> Show Insured, Bonded, Background-checked, and Google rating</label>
					<p class="description">Leave this off until you have confirmed each one. The theme will not invent them.</p></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function als_editor_note() {
	add_meta_box( 'als_note', "Al's KC Cleaning", 'als_editor_note_html', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'als_editor_note' );

function als_editor_note_html( $post ) {
	$slug = $post->post_name;
	$file = get_template_directory() . '/pages/' . $slug . '.php';
	if ( is_readable( $file ) ) {
		echo '<p>This page is drawn by the theme file <code>pages/' . esc_html( $slug ) . '.php</code>. Text you type in this editor does not appear on the site. Change the wording in that file, or edit <code>src/content.mjs</code> in the project and rebuild.</p>';
	} else {
		echo '<p>This page is not one of the designed Al\'s KC pages. The block editor content will show.</p>';
	}
}

function als_ensure_pages() {
	$defs = als_map( 'pages.php' );
	$ids  = array();
	foreach ( array( false, true ) as $want_child ) {
		foreach ( $defs as $def ) {
			if ( empty( $def['slug'] ) || empty( $def['title'] ) ) {
				continue;
			}
			$child = ! empty( $def['parent'] );
			if ( $child !== $want_child ) {
				continue;
			}
			$path     = $child ? $def['parent'] . '/' . $def['slug'] : $def['slug'];
			$existing = get_page_by_path( $path );
			if ( $existing instanceof WP_Post ) {
				$ids[ $def['slug'] ] = (int) $existing->ID;
				continue;
			}
			$insert = array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'post_title'     => $def['title'],
				'post_name'      => $def['slug'],
				'post_content'   => '',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			);
			if ( $child && ! empty( $ids[ $def['parent'] ] ) ) {
				$insert['post_parent'] = $ids[ $def['parent'] ];
			}
			$result = wp_insert_post( $insert, true );
			if ( ! is_wp_error( $result ) ) {
				$ids[ $def['slug'] ] = (int) $result;
			}
		}
	}
	return $ids;
}

function als_after_switch() {
	$ids = als_ensure_pages();
	if ( ! empty( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}
	if ( ! empty( $ids['privacy-policy'] ) ) {
		update_option( 'wp_page_for_privacy_policy', $ids['privacy-policy'] );
	}
	if ( '' === get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}
	flush_rewrite_rules();
	set_transient( 'als_kc_activated', '1', HOUR_IN_SECONDS );
}
add_action( 'after_switch_theme', 'als_after_switch' );

function als_activation_notice() {
	if ( ! current_user_can( 'manage_options' ) || ! get_transient( 'als_kc_activated' ) ) {
		return;
	}
	delete_transient( 'als_kc_activated' );
	echo '<div class="notice notice-success"><p>Al\'s KC Cleaning is the homepage now. Pages for services, about, areas, reviews, the quote form, FAQ, and privacy were created if they were missing. Delete old demo pages (Hello World, Sample Page, fake team or pricing pages) when you are ready. If a link 404s, open Settings → Permalinks and click Save. Confirm badges under Settings → Al\'s KC Cleaning. Swap files in the theme assets/img folder when you want your own job photos.</p></div>';
}
add_action( 'admin_notices', 'als_activation_notice' );

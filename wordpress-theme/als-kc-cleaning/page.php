<?php
defined( 'ABSPATH' ) || exit;
get_header();
$slug = get_post_field( 'post_name', get_queried_object_id() );
$file = '';
if ( is_string( $slug ) && preg_match( '/^[a-z0-9-]+$/', $slug ) ) {
	$candidate = get_template_directory() . '/pages/' . $slug . '.php';
	if ( is_readable( $candidate ) ) {
		$file = $candidate;
	}
}
if ( $file ) {
	include $file;
} else {
	?>
	<main id="main" class="page">
		<div class="wrap prose">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</main>
	<?php
}
get_footer();

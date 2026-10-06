<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main" class="page">
	<div class="wrap prose">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<h1>Al's KC Cleaning</h1>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to the homepage</a></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();

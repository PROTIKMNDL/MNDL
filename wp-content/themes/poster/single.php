<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package poster
 */

get_header(); ?>
 <div class="row">
  <div class="large-8 columns content-area">
	<div id="primary">
 <?php do_action('poster_before_single_post_title'); ?>
		<main id="main" class="site-main" role="main">
  <div class="row">
  <?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'template-parts/content', 'single' ); ?>
			<?php the_post_navigation(); ?>
</div>
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>
		
		</main><!-- #main -->
	</div><!-- #primary -->
	</div><!-- #column -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>

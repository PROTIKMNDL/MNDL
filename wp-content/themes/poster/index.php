<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package poster
 */

get_header(); ?>

<?php 
if (get_theme_mod('poster_featured_section')=='enable') {
if ( is_front_page() && is_home() ) {
get_template_part('template-parts/toplist');
}}
?>
<div class="row">
  <div id="primary" class="large-8 columns">
<main id="main" class="site-main" role="main">
<div class="row small-up-2 medium-up-3 large-up-4">
	
		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
 
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>
			<?php endwhile; ?>




		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
		</div>
		<?php echo paginate_links(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
		<?php get_sidebar(); ?>
		
<?php get_footer(); ?>

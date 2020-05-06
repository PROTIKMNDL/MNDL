<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package poster
 */

get_header(); ?>
<div class="row">
  <div id="primary" class="large-8 columns">
		<main id="main" class="site-main" role="main">
		<div class="row small-up-2 medium-up-3 large-up-4">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title titlepage"><i class="fa fa-list-alt"></i> ', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

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
		
	</div><!-- #primary -->
<?php get_footer(); ?>

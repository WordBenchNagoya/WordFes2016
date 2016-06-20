<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordFes Nagoya 2016
 */

get_header(); ?>

	<div id="primary" class="content-area clearfix">
		<main id="main" class="site-main col-md-9 col-xs-12" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
		
		<?php get_sidebar(); ?>
		
	</div><!-- #primary -->

<?php get_footer(); ?>

<?php
/**
 * The template for displaying search results pages.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package easydita_knowledge_portal
 */

get_header();
get_template_part("template-parts/breadcrumbs");
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<div class="header-title"><?php _e( "Search Results" , 'easydita_knowledge_portal'); ?></div>
    <?php get_template_part('template-parts/scroll-top-button'); ?>

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php /*get_sidebar();*/ ?>
<?php get_footer(); ?>

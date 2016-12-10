<?php
/**
 * Template Name: Portfolio View
 * Description: Displays cards featuring all of this page's children; perfect for portfolio's, case study pages, etc.
 *
 * @package graywhale
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

	<?php
		$child_pages = new WP_Query( array(
			'post_type'      => 'page',
			'orderby'        => 'menu_order date',
			'order'          => 'ASC',
			'post_parent'    => $post->ID,
			'posts_per_page' => -1,
		) );
	?>

	<?php if ( $child_pages->have_posts() ) : ?> <!-- Inspired by the Edin theme -->

			<div id="portfolio-view" class="portfolio-view clear">

			<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>

				<div class="portfolio-card">
					<?php get_template_part( 'content', 'card' ); ?>
				</div>

			<?php endwhile; ?>

			</div>

	<?php
		endif;
		wp_reset_postdata();
	?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package graywhale
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							echo '<span class="genericon genericon-category"></span>';
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( '<span class="genericon genericon-user"></span> %s', 'graywhale' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( '<span class="genericon genericon-day"></span> %s', 'graywhale' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( '<span class="genericon genericon-month"></span> %s', 'graywhale' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'graywhale' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( '<span class="genericon genericon-month"></span> %s', 'graywhale' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'graywhale' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'graywhale' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'graywhale' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'graywhale' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'graywhale' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'graywhale' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'graywhale' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'graywhale' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'graywhale' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'graywhale' );

						else :
							_e( 'Archives', 'graywhale' );

						endif;
					?>
				</h1>
			<?php if ( (is_author() ) && ( get_the_author_meta( 'description' ) ) ) {
				echo '<p class="taxonomy-description justified">' . get_the_author_meta('description') . '</p>';
			} elseif ( term_description() ) {
				printf( '<div class="taxonomy-description justified">%s</div>', term_description() );
			}?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
	<?php if ( !is_page() ) {
	 get_sidebar();
	} ?>

	<?php graywhale_paging_nav(); ?>

<?php get_footer(); ?>

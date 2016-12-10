<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package graywhale
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( !is_front_page() ) : ?>
	<header class="entry-header noborder">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content hyphens">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'graywhale' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer noborder">
		<?php edit_post_link( __( 'Edit', 'graywhale' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

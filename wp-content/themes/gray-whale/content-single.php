<?php
/**
 * @package graywhale
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header noborder">

		<div class="entry-posted-on">
			<?php graywhale_posted_on(); ?>
		</div><!-- .entry-meta -->

		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

		<div class="entry-meta">
			<?php graywhale_the_byline(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

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
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'graywhale' ) );
				if ( $categories_list && graywhale_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( '<span class="genericon genericon-category"></span> %1$s', 'graywhale' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'graywhale' ) );
				if ( $tags_list ) :
			?>
			&nbsp;&nbsp;&nbsp;<span class="tags-links">
				<?php printf( __( '<span class="genericon genericon-tag"></span> %1$s', 'graywhale' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'graywhale' ), '&nbsp;&nbsp;&nbsp;<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

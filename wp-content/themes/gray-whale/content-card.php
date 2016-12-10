<?php
/**
 * @package graywhale
 */
?>
<?php
	if (has_post_thumbnail()) {
		$pc = get_post_class('cardhasthumb');
	} else {
		$pc = get_post_class('cardnothumb');
	}
	$postclass = 'class="' . implode(" ", $pc) . '"';
?>
<article id="post-<?php the_ID(); ?>" <?php echo $postclass ?>>
	<span class="noborder"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></span>
	<header class="entry-header noborder">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content justified">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	<p class="noborder"><a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark">Read more <span class="meta-nav">&rarr;</span></a></p>
</article><!-- #post-## -->
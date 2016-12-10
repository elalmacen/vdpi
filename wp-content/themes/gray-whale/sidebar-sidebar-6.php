<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package graywhale
 */

if ( ! is_active_sidebar( 'sidebar-6' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area justified" role="complementary">
	<?php dynamic_sidebar( 'sidebar-6' ); ?>
</div><!-- #secondary -->

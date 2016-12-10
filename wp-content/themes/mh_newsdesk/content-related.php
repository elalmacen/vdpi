<?php /* Template for related posts based on tags. */ ?>
<?php $tags = wp_get_post_tags($post->ID); ?>
<?php if ($tags) { ?>
	<?php $tag_ids = array(); ?>
	<?php foreach ($tags as $tag) $tag_ids[] = $tag->term_id; ?>
		<?php $args = array('tag__in' => $tag_ids, 'post__not_in' => array($post->ID), 'posts_per_page' => 4, 'ignore_sticky_posts' => 1, 'orderby' => 'rand'); ?>
		<?php $related = new wp_query($args); ?>
		<?php if ($related->have_posts()) { ?>
			<h4 class="widget-title related-content-title"><span><?php _e('Related Articles', 'mh-newsdesk'); ?></span></h4>
			<div class="related-content clearfix">
				<?php while ($related->have_posts()) : $related->the_post(); ?>
					<?php get_template_part('content', 'grid'); ?>
				<?php endwhile; ?>
			</div>
		<?php } ?>
	<?php wp_reset_postdata(); ?>
<?php } ?>
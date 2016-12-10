<?php get_header(); ?>
<div class="mh-section mh-group">
	<div id="main-content" class="mh-loop">
		<?php mh_newsdesk_before_page_content(); ?>
		<?php mh_newsdesk_page_title(); ?>
		<?php if (have_posts()) : ?>
			<?php if (is_home() && $paged < 2 || is_category() && $paged < 2) { ?>
				<?php get_template_part('content', 'news'); ?>
			<?php } else { ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part('content'); ?>
				<?php endwhile; ?>
			<?php } ?>
			<?php mh_newsdesk_pagination(); ?>
		<?php else : ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
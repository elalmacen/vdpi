<?php $mh_newsdesk_options = mh_newsdesk_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-section mh-group">
	<div id="main-content" class="mh-content">
		<?php mh_newsdesk_before_post_content(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part('content', 'single'); ?>
			<?php mh_newsdesk_socialise(); ?>
			<?php mh_newsdesk_postnav(); ?>
			<?php if ($mh_newsdesk_options['author_box'] == 'enable') { ?>
				<?php get_template_part('template', 'authorbox'); ?>
			<?php } ?>
			<?php if ($mh_newsdesk_options['related_content'] == 'enable') { ?>
				<?php get_template_part('content', 'related'); ?>
			<?php } ?>
			<?php endwhile; ?>
			<?php comments_template(); ?>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
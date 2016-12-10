<?php /* Template Name: Full Width */ ?>
<?php get_header(); ?>
<div class="page-full-width">
	<?php mh_newsdesk_before_page_content(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part('content', 'page'); ?>
		<?php endwhile; ?>
		<?php get_template_part('comments', 'pages'); ?>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
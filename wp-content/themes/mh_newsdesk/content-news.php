<?php $counter = 1; ?>
<?php $max_posts = $wp_query->post_count; ?>
<?php while (have_posts()) : the_post(); ?>
	<?php if ($counter == 1) : ?>
		<?php get_template_part('content', 'lead'); ?>
		<hr class="mh-separator">
	<?php endif; ?>
	<?php if ($counter == 1 && $max_posts > 1) : ?>
		<div class="archive-grid mh-section mh-group">
	<?php endif; ?>
	<?php if (($counter > 1) && ($counter <= 9)) : ?>
		<?php get_template_part('content', 'grid'); ?>
	<?php endif; ?>
	<?php if ($counter == 5 && $max_posts > 5) : ?>
		</div>
		<hr class="mh-separator hidden-sm">
		<div class="archive-grid mh-section mh-group">
	<?php endif; ?>
	<?php if ($counter == 10) : ?>
		</div>
		<hr class="mh-separator hidden-sm">
		<div class="archive-list mh-section mh-group">
	<?php endif; ?>
	<?php if ($counter >= 10) : ?>
		<?php get_template_part('content'); ?>
	<?php endif; ?>
	<?php $counter++; ?>
<?php endwhile; ?>
<?php if ($max_posts > 1 && $max_posts < 10) : ?>
		</div>
		<hr class="mh-separator hidden-sm">
<?php endif; ?>
<?php if ($max_posts >= 10) : ?>
		</div>
<?php endif; ?>
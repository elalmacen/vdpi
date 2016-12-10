<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package graywhale
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php _e( 'Location Cannot be Found', 'graywhale' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<div class="search-404">
							<span><?php _e( 'Nothing was found at this location. Try one of these other options.', 'graywhale' ); ?></span>
							<?php get_search_form(); ?><br>
						</div>
						<div class="content-404">
							<div class="menu-column">
								<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
							</div>
							<div class="menu-column">
								<?php if ( graywhale_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
								<div class="widget widget_categories">
									<h2 class="widget-title"><?php _e( 'Most Used Categories', 'graywhale' ); ?></h2>
									<ul>
									<?php
										wp_list_categories( array(
											'orderby'    => 'count',
											'order'      => 'DESC',
											'show_count' => 1,
											'title_li'   => '',
											'number'     => 10,
										) );
									?>
									</ul>
								</div><!-- .widget -->
								<?php endif; ?>
							</div>
							<div class="menu-column">
								<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
							</div>
						</div>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

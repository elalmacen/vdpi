<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package graywhale
 */
?>
		</div><!--.inner-->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="main-footer hyphens clear">
			<div class="inner">
				<div class="footer-column">
					<div class="contact-info widget">
						<h1 class="widget-title">Contact</h1>
						<?php graywhale_contact_info('echo'); ?>
					</div>
					<?php graywhale_social_media(); ?>
					<div class="footer-search"><?php get_search_form(); ?></div>
				</div>
				<?php if (is_active_sidebar( 'sidebar-2' ) ) : ?>
					<div class="footer-aside footer-column noborder">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar( 'sidebar-3' ) ) : ?>
					<div class="footer-aside footer-column noborder">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar( 'sidebar-4' ) ) : ?>
					<div class="footer-aside footer-column noborder">
					<?php dynamic_sidebar( 'sidebar-4' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="site-info accentgradient noborder">
			<div class="inner">
				<?php printf( __( 'Theme: %1$s by %2$s.', 'graywhale' ), 'Gray Whale', '<a href="http://basilosaur.us" target="_blank">basilosaur.us</a>' ); ?>
				<span class="sep">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
				<span class="site-license"><?php graywhale_license_info('echo') ?></span>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<div id="tothetop" class="tothetop noborder"><a href="#"><span class="genericon genericon-collapse"></span></a></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

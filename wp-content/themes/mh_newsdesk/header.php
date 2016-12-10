<?php $mh_newsdesk_options = mh_newsdesk_theme_options(); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>

<!-- Facebook Instant Article -->
<meta property="fb:pages" content="201637559857959" />
<!-- Facebook Instant Article -->

<!-- Google Analytics: inicio -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4180720-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- Google Analytics: fin -->

<!-- Google Anuncios a nivel de págia: inicio -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-1604451008911947",
    enable_page_level_ads: true
  });
</script>
<!-- Google Anuncios a nivel de págia: fina -->
</head>
<body <?php body_class(); ?>>
<?php if (has_nav_menu('header_nav') || has_nav_menu('social_nav')) { ?>
	<div class="header-top">
		<div class="wrapper-inner clearfix">
			<?php if (has_nav_menu('header_nav')) { ?>
				<nav class="header-nav clearfix">
					<?php wp_nav_menu(array('theme_location' => 'header_nav', 'fallback_cb' => '')); ?>
				</nav>
			<?php } ?>
			<?php if (has_nav_menu('social_nav')) { ?>
				<nav class="social-nav clearfix">
					<?php wp_nav_menu(array('theme_location' => 'social_nav', 'link_before' => '<span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-mh-social fa-stack-1x"></i></span><span class="screen-reader-text">', 'link_after' => '</span>')); ?>
				</nav>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<div id="mh-wrapper">
<header class="mh-header">
	<div class="header-wrap clearfix">
		<?php is_active_sidebar('header-ad') ? $logo_class = ' header-logo' : $logo_class = ' header-logo-full'; ?>
		<div class="mh-col mh-1-3<?php echo $logo_class; ?>">
			<?php mh_newsdesk_logo(); ?>
		</div>
		<?php dynamic_sidebar('header-ad'); ?>
	</div>
	<div class="header-menu clearfix">
		<nav class="main-nav clearfix">
			<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
		</nav>
		<div class="header-sub clearfix">
			<?php if ($mh_newsdesk_options['show_ticker']) { ?>
				<?php get_template_part('template', 'news-ticker'); ?>
			<?php } ?>
			<aside class="mh-col mh-1-3 header-search">
				<?php get_search_form(); ?>
			</aside>
		</div>
	</div>
</header>
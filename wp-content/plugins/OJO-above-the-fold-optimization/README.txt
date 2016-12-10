=== Above The Fold Optimization ===
Contributors: optimalisatie
Donate link: https://pagespeed.pro/
Tags: optimization, above the fold, critical css, css, performance, localization, javascript, minification, minify, minify css, minify stylesheet, optimize, speed, stylesheet, pagespeed, google, web font, webfont
Requires at least: 3.0.1
Tested up to: 4.6.1
Stable tag: 4.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Above the fold optimization toolkit that enables to achieve a Google PageSpeed 100 Score. Supports most optimization, minification and full page cache plugins.

== Description ==

This plugin is a toolkit for Above The Fold Optimization that enables to achieve a [Google PageSpeed](https://developers.google.com/speed/docs/insights/about) 100 Score.

This plugin is compatible with most optimization, minification and full page cache plugins and can be made compatible with any plugin by creating a module extension.

Some of the supported plugins include:
[Autoptimize](https://wordpress.org/plugins/autoptimize/)
* [W3 Total Cache](https://wordpress.org/plugins/w3-total-cache/)
* [WP Super Cache](https://wordpress.org/plugins/wp-super-cache/)
* [WP Fastest Cache](https://wordpress.org/plugins/wp-fastest-cache/)
* [Cache Enabler (KeyCDN.com)](https://wordpress.org/plugins/cache-enabler/)
* [Better WordPress Minify](https://wordpress.org/plugins/bwp-minify/)
* [WP Super Minify](https://wordpress.org/plugins/wp-super-minify/)
* [Click here](https://github.com/optimalisatie/above-the-fold-optimization/tree/master/trunk/modules/plugins/) for a list with supported plugins. 

**Warning:** *This plugin is not a simple 'on/off' plugin. It is a tool for optimization professionals and advanced WordPress users to achieve a Google PageSpeed 100 Score.*

### Critical CSS Management

The plugin contains a tool to manage Critical Path CSS for inline placement in the `<head>` of the HTML document. Read more about Critical CSS in the [documentation by Google](https://developers.google.com/speed/docs/insights/PrioritizeVisibleContent). 

[This article](https://github.com/addyosmani/critical-path-css-tools) by a Google engineer provides information about the available methods for creating critical path CSS. 

### Conditional Critical CSS

The plugin contains a tool to configure tailored Critical Path CSS for individual posts, pages, page types and other conditions.

### CSS Delivery Optimization

The plugin contains several tools to optimize the delivery of CSS in the browser. The plugin offers async loading of CSS via [loadCSS](https://github.com/filamentgroup/loadCSS) and it offers an enhanced version of loadCSS that uses the `requestAnimationFrame` API following the [recommendations by Google](https://developers.google.com/speed/docs/insights/OptimizeCSSDelivery).

The plugin offers advanced options such as a render delay in milliseconds, the position to start CSS rendering (header or footer) and the removal of CSS files from the HTML. The plugin enables to capture and proxy external stylesheets for loading the files locally with optimized cache headers (see `External Resource Proxy`).

### Above The Fold Quality Tester

The plugin contains a tool to test the quality of the above the fold (critical path CSS) rendering and to detect a flash of unstyled content ([FOUC](https://en.wikipedia.org/wiki/Flash_of_unstyled_content)).

### Full CSS Extraction

The plugin enables the extraction of full CSS for use in Critical Path CSS generators.

### External Resource Proxy

The plugin contains a tool to localize (proxy) external javascript and CSS resources such as Google Analytics and Facebook SDK to load the files locally with optimized cache headers to pass the "[Leverage browser caching](https://developers.google.com/speed/docs/insights/LeverageBrowserCaching)" rule from Google PageSpeed Insights. The proxy is able to capture "script-injected" async scripts and stylesheets to solve the problem without further configuration.

### Lazy Loading Javascript

The plugin contains a tool based on [jQuery Lazy Load XT](https://github.com/ressio/lazy-load-xt#widgets) to lazy load scripts such as Facebook en Twitter social widgets.

### Web Font Optimization

The plugin contains a tool to optimize web fonts. The plugin automatically parses web font `@import` links in minified CSS files and `<link>` links in the HTML and loads the fonts via [Google Web Font Loader](https://github.com/typekit/webfontloader).


== Installation ==

### WordPress plugin installation

1. Upload the `above-the-fold-optimization/` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to the plugin settings page.
4. Configure Critical CSS and tune the options for a Google PageSpeed 100 Score.

== Screenshots ==

1. Critical CSS management
2. CSS delivery optimization
3. Google Web Font optimization
4. Above The Fold Quality Test
5. Javascript Render Optimization
6. Full CSS Extraction

== Changelog ==

= 2.5.11 =
* Improved: WebFontConfig fully loaded when using inline webfont.js.
* Improved: external resource proxy debug notices for ignored resources.
* Bugfix: CSS file ignore/remove list CRLF issue. (@masoudsafi)

= 2.5.10 =
* Bugfix: filters not applied in cache plugin modules.

= 2.5.9 =
* Bugfix: page related caches not cleared from settings page button.
* Added: option to disable Google Web Font Loader and remove all fonts.

= 2.5.8 =
* Added: external resource proxy CDN for cached resources.
* Bugfix: support for WordPress subdirectory installations (@mmdijkman)

= 2.5.7 =
* Added: Regular expression test for external resource proxy JSON config.

= 2.5.6 =
* Added: Google Webfont remove tool (Web Font Optimization) to be able to load fonts locally.

= 2.5.5 =
* Improved: external resource proxy regex translation of urls (JSON config).
* Improved: external resource proxy custom expire time per url (JSON config).
* Improved: external resource proxy "async script" injection capture debug information.

= 2.5.4 =
* Bugfix: `WebFontConfig` not loaded for Google Fonts when pre set config omitted.
* Bugfix: HTML entity encoded urls not handled correctly by proxy.
* Bugfix: **fonts.googleapis.com/css** added to default ignore list for external CSS proxy (user agent based font serving).
* Bugfix: proxy ignore / include list not applied on filters.
* Bugfix: critical CSS quality test not displaying matching url.
* Improved: crtical CSS quality test.
* Improved: admin panel layout.
* Added: external resource proxy preload urls for direct access to proxy cache files for captured "script injected" async resources.
* Added: external resource proxy custom url (e.g. nginx proxy).
* Added: Critical CSS conditions for WordPress taxonomy and WooCommerce.
* Added: optimization plugin module for [nginx-helper](https://wordpress.org/plugins/nginx-helper/) (Nginx fastcgi cache plugin).
* Disabled plugin for AMP pages. (@RebellionNT1)

= 2.5.3 =
* Improved: external resource proxy support for protocol relative urls.

= 2.5.2 =
* Improved: external resource proxy support for local files, mime type check for security and forward of unproxied requests.
* Added: write permission check for critical CSS storage file.

= 2.5.1 =
* Bugfix: bug in external resource proxy for external resources with query string in HTML.

= 2.5.0 =
* Bugfix: full CSS extraction for pages with query string.
* Bugfix: admin PageSpeed menu not disabled.
* Bugfix: removed stripslashes on conditional CSS.
* Improved Above the fold client javascript.
* Improved full CSS extraction.
* Improved cleanup on plugin removal.
* Debug javascript moved to seperate file to save data for non-debug requests.
* Removed `/* Above The Fold v...*/` comment tag in HTML (use debug mode for an enhanced tag)
* Removed depency for the plugin *Google Webfont Optimizer*.
* Removed Localize Javascript (replaced by *external file proxy*)
* Added conditional Critical CSS for individual posts, post types, pages, page types, categories, tags and more.
* Added Critical CSS quality tester to detect a flash of unstyled content ([FOUC](https://en.wikipedia.org/wiki/Flash_of_unstyled_content)).
* Added integrated Google Web Font Optimization.
* Added external file proxy for javascript and CSS files with script-injection capture to pass the `Eliminate render-blocking JavaScript and CSS in above-the-fold content` rule from Google PageSpeed Insights
* Added (admin only) warning in HTML when critical CSS is empty.
* Added *page related cache* (e.g. full page cache or minification cache) clear tool for [supported plugins](https://github.com/optimalisatie/above-the-fold-optimization/tree/master/trunk/modules/plugins/) with modular support for other plugins.
* Appended Google documentation links with `?hl=` query based on WordPress locale.
* Support for many optimization plugins with modular support to add compatibility with any existing optimization or minification plugin.
⋅⋅⋅Some of the supported plugins include:
⋅⋅* [Autoptimize](https://wordpress.org/plugins/autoptimize/)
⋅⋅* [W3 Total Cache](https://wordpress.org/plugins/w3-total-cache/)
..* [WP Super Cache](https://wordpress.org/plugins/wp-super-cache/)
..* [WP Fastest Cache](https://wordpress.org/plugins/wp-fastest-cache/)
..* [Cache Enabler (KeyCDN.com)](https://wordpress.org/plugins/cache-enabler/)
..* [Better WordPress Minify](https://wordpress.org/plugins/bwp-minify/)
..* [WP Super Minify](https://wordpress.org/plugins/wp-super-minify/)
... [Click here](https://github.com/optimalisatie/above-the-fold-optimization/tree/master/trunk/modules/plugins/) for a list with supported plugins.

= 2.4.4 =
* Improved Javascript localization modules.
* Fixed bug in Javascript localization modules. (@jghrgtyec)

= 2.4.3 =
* Repair of previous incomplete update.

= 2.4.2 =
* Improved Javascript localization.
* Fixed bug in Javascript localization module for Facebook sdk.js.
* Added Javascript localization module for Facebook Tag API. (fbevents.js)
* Added lazy loading for inline scripts. (e.g. Facebook like and Twitter follow buttons)

= 2.4.1 =
* Added Content Security Policy (CSP) test in admin toolbar. ([SmashingMagazine](https://www.smashingmagazine.com/2016/09/content-security-policy-your-future-best-friend/))

= 2.4 =
* Removed server-side critical path CSS generator.
* Improved admin toolbar.
* Updated [loadCSS](https://github.com/filamentgroup/loadCSS) to v1.2.0
* Bugfix Localize Javascript module for old Google Analytics ga.js. (@RebellionNT1)

= 2.3.14 =
* Minor improvements.

= 2.3.13 =
* Buf fix. (@drazon)

= 2.3.12 =
* Repair of previous incomplete update.

= 2.3.11 =
* Added support for old PHP versions.

= 2.3.10 =
* Automatic cache reset of W3 Total Cache & WP Super Cache after plugin update.
* Advanced CSS editor with [CSS Lint](http://csslint.net/).

= 2.3.9 =
* Caching bug fix.

= 2.3.8 =
* Bug fix (re-order of plugin execution for ob_start stack).

= 2.3.7 =
* Added CSS render delay option.

= 2.3.6 =
* Added javascript header comments for version/cache related debugging.

= 2.3.5 =
* Bug fixes.
* Settings link moved to Appearance menu.
* Added demo code for Grunt.js + Penthouse.js Critical Path CSS generation.

= 2.3.4 =
* Removed Node modules. (Penthouse.js) to reduce plugin size (install via ``npm install``, see instructions)
* Bugfix LocalizeJS module. (@poundnine)

= 2.3.3 =
* Bug fixes & improvements. (@superpoincare)
* Added javascript localization modules.

= 2.3.2 =
* Repair of previous incomplete update.

= 2.3.1 =
* Added javascript localization modules.

= 2.3 =
* Added option to include Google fonts from ``@import`` within the CSS-code in [Google Webfont Optimizer](https://nl.wordpress.org/plugins/google-webfont-optimizer/).
* Added option to localize external javascript files.
* Enhanced full-CSS extraction.

= 2.2.1 =
* Added option to remove CSS files.
* CSS extraction bug (old PHP versions).

= 2.2 =
* Improved admin.
* Online generator instructions.
* Full CSS extraction.

= 2.1.1 =
* Addslashes bug.

= 2.1 =
* Code improvements.

= 2.0 =
* Automated Critical Path CSS generation via [Penthouse.js](https://github.com/pocketjoso/penthouse).
* Automated inline CSS optimization via [Clean-CSS](https://github.com/jakubpawlowicz/clean-css).
* Improved CSS delivery optimization.
* Improved configuration.
* Sourcecode published on [Github](https://github.com/optimalisatie/above-the-fold-optimization).

= 1.0 =
* The first version.

== Upgrade Notice ==

= 2.4 =
The server side critical path CSS generator has been removed.

= 2.0 =
The upgrade requires a new configuration of Critical Path CSS. The configuration from version 1.0 will not be preserved.




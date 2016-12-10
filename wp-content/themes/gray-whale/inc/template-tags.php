<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package graywhale
 */

if ( ! function_exists( 'graywhale_license_info' ) ) :
/**
 * Blog License Information
 */
function graywhale_license_info($output='return') {
	$options = get_option('graywhale_theme_settings');
	if ( (isset ($options['site_license']) ) && ($options['site_license'] != '') ) {
		$license_info = $options['site_license'];
	} else {
		$license_info = '&#169; ' . date("Y") . ' ' . get_bloginfo('name');
	}

	if ($output == 'echo') {
		echo $license_info;
	} else {
		return $license_info;
	}
}
endif;
if ( ! function_exists( 'graywhale_contact_info' ) ) :
/**
 * Contact Information
 */
function graywhale_contact_info($output='return') {
	$options = get_option('graywhale_theme_settings');
	if ( !empty($options['contact_info']) ) {
		$license_info = $options['contact_info'];
	} else {
		return;
	}

	if ($output == 'echo') {
		echo $license_info;
	} else {
		return $license_info;
	}
}
endif;

if ( ! function_exists( 'graywhale_social_media' ) ) :
/**
 * Contact Information
 */
function graywhale_social_media() {
	$options = get_option('graywhale_theme_settings');
	$s = array(	'facebook'		=>	$options['facebook'],
					'twitter'		=>	$options['twitter'],
					'googleplus'	=>	$options['google_plus'],
					'linkedin'		=>	$options['linkedin'],
					'youtube'		=>	$options['youtube'],
					'pinterest'		=>	$options['pinterest'],
					'instagram'		=>	$options['instagram'],
				);

	?> <div class="social-links widget noborder clear">
			<ul> <?php
			if ( $options['rss'] == 1) {
				echo '<li class="social-item rss"><a href="' . get_bloginfo('rss_url') . '" target="_blank"><span class="genericon genericon-feed"></span></a></li>';
			}
			foreach ($s as $kout => $sout) {
				if ( !empty($sout) ) {
					echo '<li class="social-item ' . $kout . '"><a href="' . $sout . '" target="_blank"><span class="genericon genericon-' . $kout . '"></span></a></li>';
				}
			}

	?>		</ul>
		</div> <?php
}
endif;

if ( ! function_exists( 'graywhale_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function graywhale_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation noborder" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'graywhale' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'graywhale' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'graywhale' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'graywhale_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function graywhale_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation noborder" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'graywhale' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'graywhale' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'graywhale' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'graywhale_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function graywhale_posted_on() {

	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'graywhale' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';
}
endif;

if ( ! function_exists( 'graywhale_the_byline' ) ) :
/**
 * Prints HTML with meta information for the current post's author.
 */
function graywhale_the_byline() {

	$byline = sprintf(
		_x( '<span class="genericon genericon-user"></span> %s', 'post author', 'graywhale' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>';
	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
	?>&nbsp;&nbsp;&nbsp;<span class="comments-link"><?php comments_popup_link( __( '<span class="genericon genericon-comment"></span> Leave a comment', 'graywhale' ), __( '<span class="genericon genericon-comment"></span> 1 Comment', 'graywhale' ), __( '<span class="genericon genericon-comment"></span> % Comments', 'graywhale' ) ); ?></span><?php
	endif;
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function graywhale_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'graywhale_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'graywhale_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so graywhale_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so graywhale_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in graywhale_categorized_blog.
 */
function graywhale_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'graywhale_categories' );
}
add_action( 'edit_category', 'graywhale_category_transient_flusher' );
add_action( 'save_post',     'graywhale_category_transient_flusher' );

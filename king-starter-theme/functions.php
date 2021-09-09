<?php

/**
 * Essential theme supports
 * */
add_action('after_setup_theme', 'theme_setup');
function theme_setup()
{
	/** automatic feed link*/
	add_theme_support('automatic-feed-links');

	/** tag-title **/
	add_theme_support('title-tag');

	/** post formats */
	// $post_formats = array('aside', 'image', 'gallery', 'video', 'audio', 'link', 'quote', 'status');
	// add_theme_support('post-formats', $post_formats);

	/** post thumbnail **/
	add_theme_support('post-thumbnails');

	/** HTML5 support **/
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'navigation-widgets'));

	/** refresh widgest **/
	add_theme_support('customize-selective-refresh-widgets');

	/** custom background **/
	$bg_defaults = array(
		'default-image'          => '',
		'default-preset'         => 'default',
		'default-size'           => 'cover',
		'default-repeat'         => 'no-repeat',
		'default-attachment'     => 'scroll',
	);
	//add_theme_support('custom-background', $bg_defaults);

	/** custom header **/
	$header_defaults = array(
		'default-image'          => '',
		'width'                  => 300,
		'height'                 => 60,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '',
		'header-text'            => true,
		'uploads'                => true,
	);
	//add_theme_support('custom-header', $header_defaults);

	/** custom log **/
	add_theme_support('custom-logo', array(
		'height'      => 60,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array('site-title', 'site-description'),
	));
}

add_action('wp_enqueue_scripts', 'themeslug_enqueue_style');
//add_action('wp_enqueue_scripts', 'themeslug_enqueue_script');
function themeslug_enqueue_style()
{
	wp_enqueue_style('king-starter-theme-style', get_template_directory_uri() . '/style.css', false);
}

function themeslug_enqueue_script()
{
	wp_enqueue_script('my-js', 'filename.js', false);
}


add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
	add_theme_support('woocommerce');
}
// link all Post Thumbnails to the Post Permalink
// add_filter('post_thumbnail_html', 'my_post_image_html', 10, 3);
// function my_post_image_html($html, $post_id, $post_image_id)
// {
// 	$html = '<a href="' . get_permalink($post_id) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . $html . '</a>';
// 	return $html;
// }


// Clean up the <head>
function removeHeadLinks()
{
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');



// Declare sidebar widget zone
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Sidebar Widgets',
		//'id'   => 'sidebar-widgets',
		//'description'   => 'These are widgets for the sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
	register_sidebar(array(
		'name' => 'Footer Widgets',
		//'id'   => 'sidebar-widgets',
		//'description'   => 'These are widgets for the sidebar.',
		'before_widget' => '<div id="%1$s" class="widget_f %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	));
}
//reg nav
//if (function_exists('register_nav_menus')) {
//	register_nav_menus(array('main_nav' => 'Main Navigation' ));	
//}
// Register custom navigation walker
// require_once('wp_bootstrap_navwalker.php');
add_action('after_setup_theme', 'wpgnik_setup');
if (!function_exists('wpgnik_setup')) :
	function wpgnik_setup()
	{
		register_nav_menu('main_nav', __('Main Navigation', 'wpgnik'));
	}
endif;

function replace_content($text)
{
	$alt = get_the_author_meta('display_name');
	$text = str_replace('alt=\'\'', 'alt=\'Avatar for ' . $alt . '\' title=\'Gravatar for ' . $alt . '\'', $text);
	return $text;
}
add_filter('get_avatar', 'replace_content');

// function custom_excerpt_length($length)
// {
// 	return 20;
// }
// add_filter('excerpt_length', 'custom_excerpt_length', 999);

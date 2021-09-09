<?php

/**
 * Theme functions and definitions
 */

/**
 * Load child theme css and optional scripts
 *
 * 
 */
function king_starter_theme_child_enqueue_scripts()
{
	wp_enqueue_style(
		'king-starter-theme-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'king-starter-theme-style',
		],
		'1'
	);
}
add_action('wp_enqueue_scripts', 'king_starter_theme_child_enqueue_scripts', 20);

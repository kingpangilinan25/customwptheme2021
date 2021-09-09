<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" />
	<?php } ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.png">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php #if (is_singular()) wp_enqueue_script('comment-reply');	
	?>
	<?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header>
	</header>
	<nav>
		<ul>
			<li><a href="#">Menu Option 1</a></li>
			<li><a href="#">Menu Option 2</a></li>
		</ul>
	</nav>
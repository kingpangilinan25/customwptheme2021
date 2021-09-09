<?php

//add_action('init', 'browser_ie_remove_func');
function browser_ie_remove_func()
{
  $user_agent = $_SERVER['HTTP_USER_AGENT'];
  if (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident')) {
    #header( 'Location: http://www.domain.com' );
    #exit;
    $html = "<h1>Hi there, it looks like you're using an old browser.</h1>";
    $html .= "<p>The ButcherBox website leverages newer web technologies, so you'll need to upgrade or switch to a browser that receives regular updates like Chrome, Edge, Firefox, or Safari.</p>";
    $html .= "<p>You can find more information about upgrading your browser at <a href='https://browsehappy.com/' target='_blank'>BrowseHappy</a>!</p>";
    $html = "<div style='width:100vw;height:100vh;display: flex; align-items: center; justify-content: center; flex-flow: column wrap;'>" . $html . "</div>";
    echo $html;
  }
}

// function mind_defer_scripts($tag, $handle, $src)
// {
// 	$defer = array(
// 		'jq-slickjs',
// 		'custom-gnikjs',
// 		//    'samesizr',
// 		//    'samesizr',
// 		//    'samesizr',
// 		//    'samesizr',
// 		//    'samesizr',
// 	);
// 	if (in_array($handle, $defer)) {
// 		return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
// 	}
// 	return $tag;
// }
// add_filter('script_loader_tag', 'mind_defer_scripts', 999, 3);

function no_wordpress_errors()
{
  return 'Something is wrong!';
}
add_filter('login_errors', 'no_wordpress_errors');


// Disallow file edit
define('DISALLOW_FILE_EDIT', true);
// ******************** Clean up WordPress Header START ********************** //
function king_remove_version()
{
  return '';
}
add_filter('the_generator', 'king_remove_version');

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

//add_filter('xmlrpc_enabled', '__return_false');
 
// function king_cleanup_query_string( $src ){ 
// 	$parts = explode( '?', $src ); 
// 	return $parts[0]; 
// } 
// add_filter( 'script_loader_src', 'king_cleanup_query_string', 15, 1 ); 
// add_filter( 'style_loader_src', 'king_cleanup_query_string', 15, 1 );
// ******************** Clean up WordPress Header END ********************** //

/*
Protect Your WordPress Admin (wp-admin) Directory via CPanel "Password Protect Directories" browse to wp-admin
-= Manual Method =- 
AuthName "Admins Only"
AuthUserFile /home/yourdirectory/.htpasswds/public_html/wp-admin/passwd
AuthGroupFile /dev/null
AuthType basic
require user putyourusernamehere
-= Update: Here is how to fix the Admin Ajax Issue =-
<Files admin-ajax.php>
    Order allow,deny
    Allow from all
    Satisfy any 
</Files>

<Files *.php>
deny from all
</Files>

-= Note: Do not edit your Root .htaccess file, don’t paste these codes in there. It must be /wp-admin/.htaccess if you don’t see that file then create a blank file, name it .htaccess in your wp-admin folder. =-
AuthUserFile /dev/null
AuthGroupFile /dev/null
AuthName "WordPress Admin Access Control"
AuthType Basic
<LIMIT GET>
order deny,allow
deny from all
# whitelist Syed's IP address
allow from xx.xx.xx.xxx
# whitelist David's IP address
allow from xx.xx.xx.xxx
# whitelist Amanda's IP address
allow from xx.xx.xx.xxx
# whitelist Muhammad's IP address
allow from xx.xx.xx.xxx
# whitelist Work IP address
allow from xx.xx.xx.xxx
</LIMIT>

-= Disable Directory Indexing and Browsing =-
Options -Indexes
*/
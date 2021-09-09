<?php

/**
 * Add async or defer attributes to script enqueues
 */
// only on the front-end
// usage wp_enqueue_script('SCRIPTNAME-defer', get_stylesheet_directory_uri() . '/em/js/custom-gnik.js', array('jquery'), false, false);
if (!is_admin()) {
  function add_asyncdefer_attribute($tag, $handle)
  {
    // if the unique handle/name of the registered script has 'async' in it
    if (strpos($handle, 'async') !== false) {
      // return the tag with the async attribute
      return str_replace('<script ', '<script async ', $tag);
    }
    // if the unique handle/name of the registered script has 'defer' in it
    else if (strpos($handle, 'defer') !== false) {
      // return the tag with the defer attribute
      return str_replace('<script ', '<script defer ', $tag);
    }
    // otherwise skip
    else {
      return $tag;
    }
  }
  add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}
// function get_enqueued_scripts()
// {
//   $scripts = wp_scripts();
//   var_dump(array_keys($scripts->groups));
// }
// add_action('wp_head', 'get_enqueued_scripts');

add_filter('script_loader_tag', 'async_parsing_of_js', 10, 2);
function async_parsing_of_js($url, $handle)
{
  if (is_user_logged_in()) return $url; //don't break WP Admin
  if (FALSE === strpos($url, '.js')) return $url;
  //if (strpos($url, 'elementor')) return str_replace('<script', '<script defer', $url);
  if (strpos($url, 'jquery/jquery')) return $url; // make sure jquery and jquery migrate doesn't break
  // if (strpos($url, 'defer-js')) return $url; //do not async custom defer
  if (strpos($handle, 'defer') !== false) return $url; //do not async custom defer
  // return str_replace(' src', ' async src', $url);
  return str_replace('<script', '<script async', $url);
}


remove_image_size('2048x2048');
remove_image_size('medium');


add_image_size('rsmall', 320, 0, false);
add_image_size('rxlarge', 1920, 0, false);
// add_image_size('rmedium', 600, 9999, false);
// add_image_size('rlarge', 1200, 9999, false);



//* Enqueue scripts and styles
#add_action('wp_enqueue_scripts', 'em_disable_woocommerce_loading_css_js');
// function em_disable_woocommerce_loading_css_js()
// {
//   // Check if WooCommerce plugin is active
//   if (function_exists('is_woocommerce')) {
//     // Check if it's any of WooCommerce page
//     //if (!is_woocommerce() && !is_cart() && !is_checkout()) {
//     if (is_singular('post')) {
//       ## Dequeue WooCommerce styles
//       wp_dequeue_style('woocommerce-layout');
//       wp_dequeue_style('woocommerce-general');
//       wp_dequeue_style('woocommerce-smallscreen');
//       wp_dequeue_style('wc-block-vendors-style');
//       wp_dequeue_style('wc-block-style');
//       #wp_dequeue_style('woocommerce-inline-inline'); // not working for inline
//       ## Dequeue WooCommerce scripts
//       wp_dequeue_script('wc-cart-fragments');
//       wp_dequeue_script('woocommerce');
//       wp_dequeue_script('wc-add-to-cart');
//       wp_deregister_script('js-cookie');
//       wp_dequeue_script('js-cookie');
//     }
//   }
// }
add_action('wp_head', 'em_stylesheet', 999);
function em_stylesheet()
{
?>
  <?php
  if (is_user_logged_in()) :
  ?>
    <link rel="stylesheet" id='em-style-pages-css' href='<?php echo esc_url(get_stylesheet_directory_uri()); ?>/css/style-pages.css' media="all">
  <?php
  else :
  ?>
    <link rel="stylesheet" id='em-style-pages-css' href='<?php echo esc_url(get_stylesheet_directory_uri()); ?>/css/style-pages.css' media="print" onload="this.media='all'; this.onload=null;">
  <?php
  endif;
  /*
  <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/02/H2H-Logo.png"); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://www.googletagmanager.com" />
    <link rel="preconnect" href="https://www.gstatic.com" />
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.gstatic.com">
    <!-- <link rel="preload" as="font" crossorigin="anonymous" href="<?php echo esc_url(get_template_directory_uri()); ?>/fonts/glyphicons-halflings-regular.woff2"> -->
    <!-- <link rel="preload" as="script" href="https://www.googletagmanager.com/gtm.js?id=GTM-N2CT5XT"> -->
    <link rel="preload" as="script" href="https://www.gstatic.com/recaptcha/releases/5mNs27FP3uLBP3KBPib88r1g/recaptcha__en.js">
    <link rel="preload" as="style" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.min.css">
    */
}



add_action('wp_head', 'em_stylesheet1', 1);
function em_stylesheet1()
{
  // font-family: 'Bebas Neue', cursive;
  // font-family: 'Roboto', sans-serif;
  ?>
  <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet"> -->
  <link href="<?php echo get_template_directory_uri(); ?>/fonts/fontawesome-free-5.15.3-web/css/all.min.css" rel="stylesheet">
  <!-- CSS only -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
<?php
}

add_filter('acf/settings/show_admin', 'my_acf_show_admin');
function my_acf_show_admin($show)
{
  $is_show = false;
  if (is_user_logged_in()) {
    $user = wp_get_current_user();
    if (
      $user->user_email == "king_pangilinan@rocketmail.com"
      || $user->user_email == "king.pangilinan25@gmail.com"
      //|| $user->user_email *= "@epidemic-marketing.com"
    ) {
      $is_show = true;
    }
  }
  return $is_show;
}


require_once('custom-gnik-security.php');
// require_once('custom-sc.php');
// require_once('custom-sc-post.php');
// require_once('custom-sc-woo.php');

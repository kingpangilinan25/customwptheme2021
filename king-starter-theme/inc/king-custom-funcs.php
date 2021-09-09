<?php
require_once("lazy-load-bg-images.php");
require_once("function-acf.php");
require_once("em-seo.php");

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
  if (strpos($url, 'elementor')) return str_replace('<script', '<script defer', $url);
  if (strpos($url, 'jquery/jquery')) return $url; // make sure jquery and jquery migrate doesn't break
  // if (strpos($url, 'defer-js')) return $url; //do not async custom defer
  if (strpos($handle, 'defer') !== false) return $url; //do not async custom defer
  // return str_replace(' src', ' async src', $url);
  return str_replace('<script', '<script async', $url);
}


add_filter('elementor/frontend/print_google_fonts', '__return_false');

remove_image_size('2048x2048');

add_image_size('rsmall', 320, 0, false);
add_image_size('rxlarge', 1920, 0, false);
// add_image_size('rmedium', 600, 9999, false);
// add_image_size('rlarge', 1200, 9999, false);

/**
 * Never worry about cache again!
 */
function my_load_scripts($hook)
{

  // create my own version codes
  //$my_js_ver  = date("ymd-Gis", filemtime(plugin_dir_path(__FILE__) . 'js/custom.js'));
  //$my_css_ver = date("ymd-Gis", filemtime(plugin_dir_path(__FILE__) . 'style.css'));

  // 
  //wp_enqueue_script('custom_js', plugins_url('js/custom.js', __FILE__), array(), $my_js_ver);
  // wp_register_style('my_css',    plugins_url('style.css',    __FILE__), false,   $my_css_ver);
  // wp_enqueue_style('my_css');
  if (!is_front_page())
    wp_enqueue_script('slick-defer', get_stylesheet_directory_uri() . '/em/fw/slick/slick.min.js', array('jquery'), false, false);
  wp_enqueue_script('custom-gnik-defer', get_stylesheet_directory_uri() . '/em/js/custom-gnik.js', array('jquery'), false, false);
}
add_action('wp_enqueue_scripts', 'my_load_scripts');

#add_filter('elementor/frontend/print_google_fonts', '__return_false');
add_action('wp_head', 'em_stylesheet_king', 1);
function em_stylesheet_king()
{
?>
  <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/04/MovaLegal.png"); ?>">
  <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/04/movalaw-black-64.png"); ?>">
  <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/04/hro-bg.jpg"); ?>">


  <link rel="dns-prefetch" href="https://www.googletagmanager.com">
  <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>

  <link rel="preload" as="script" href="https://www.googletagmanager.com/gtag/js?id=G-MZLHNR95B2">

  <link rel="preload" as="style" href="https://www.movalegal.com/wp-content/uploads/elementor/css/global.css">
  <link rel="preload" as="style" href="https://www.movalegal.com/wp-content/plugins/elementor/assets/css/frontend.min.css">
  <link rel="preload" as="style" href="https://www.movalegal.com/wp-content/plugins/elementor-pro/assets/css/frontend.min.css">

  <?php if (is_front_page()) : ?>
    <?php if (wp_is_mobile()) : ?>
      <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/04/CHRIS-MOVA-320x384.png"); ?>">
    <?php else : ?>
      <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/04/CHRIS-MOVA.png"); ?>">
      <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/04/you-dont-pay-til-your-case-is-won-white-border.png"); ?>">
      <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/04/ass-seen-on.png"); ?>">
      <link rel="preload" as="image" href="<?php echo get_home_url(null, "/wp-content/uploads/2021/04/our-accolades.png"); ?>">
    <?php endif; ?>
  <?php endif; ?>
  <?php if (!is_front_page()) : ?>
    <link rel="stylesheet" id='slick-css' href='<?php echo esc_url(get_stylesheet_directory_uri()); ?>/em/fw/slick/slick.css' media="print" onload="this.media='all'; this.onload=null;">
  <?php endif; ?>
  <link rel="stylesheet" id='em-style-css' href='<?php echo esc_url(get_stylesheet_directory_uri()); ?>/em/css/em-style-all.css' media="print" onload="this.media='all'; this.onload=null;">
  <?php
  /*
  <link rel="dns-prefetch" href="https://www.gstatic.com">
  <link rel="preconnect" href="https://www.gstatic.com" crossorigin>
  <link rel="preload" as="font" type="font/woff2" href="https://www.movalegal.com/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css" crossorigin="anonymous">


  <link rel="preload" as="script" href="https://www.gstatic.com/recaptcha/releases/FDTCuNjXhn1sV0lk31aK53uB/recaptcha__en.js">

  <link rel="preload" as="font" type="font/woff2" href="https://fonts.googleapis.com/css?family=Work+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CLibre+Baskerville%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&display=swap" crossorigin="anonymous">

  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  
  /wp-content/uploads/2021/03/home-hero-bg.jpg

  <link rel="preload" as="font" type="font/woff2" href="<?php echo esc_url(get_template_directory_uri()); ?>/fonts/SavoyeLetPlain/SavoyeLetPlain.woff2"> crossorigin="anonymous"
  <link rel="preload" as="script" href="https://www.googletagmanager.com/gtm.js?id=GTM-N2CT5XT">
  <link rel="stylesheet" id='site-reviews-css'  href='<?php echo get_home_url(null,"/wp-content/plugins/site-reviews/assets/styles/default.css"); ?>' media="print" onload="this.media='all'; this.onload=null;">
  <link rel="stylesheet" id='litycss-css'  href='<?php echo esc_url( get_template_directory_uri() ); ?>/css/lity.min.css' media="print" onload="this.media='all'; this.onload=null;">

  <link rel="preload" as="script" href="https://www.gstatic.com/recaptcha/releases/5mNs27FP3uLBP3KBPib88r1g/recaptcha__en.js">
    <link rel="preload" as="style" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.min.css">
  */
}



// Add Google Tag code which is supposed to be placed after opening body tag.
// add_action( 'wp_body_open', 'wpdoc_add_custom_body_open_code' ); 
// function wpdoc_add_custom_body_open_code() {
//     echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PX3MRBL" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
// }


add_action('wp_head', 'em_tracking_scripts', 102);
function em_tracking_scripts()
{
  if (!is_user_logged_in()) {
  ?>
    <!-- Google Tag Manager -->
    <script>
      (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-N9DTW4V');
    </script>
    <!-- End Google Tag Manager -->
  <?php
  } //if (!is_user_logged_in())

  /*
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MZLHNR95B2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-MZLHNR95B2');
</script>
 */
}

add_action('wp_footer', 'em_tracking_scripts_footer', 102);
function em_tracking_scripts_footer()
{
  if (!is_user_logged_in()) {
  ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N9DTW4V" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php
    /*  
    <!-- Start Of NGage -->
    <div id="nGageLH" style="visibility:hidden; display: block; padding: 0; position: fixed; right: 0px; bottom: 0px; z-index: 5000;"></div>
    <script type="text/javascript" src="https://messenger.ngageics.com/ilnksrvr.aspx?websiteid=24-217-17-208-36-32-40-134" async="async"></script>
    <!-- End Of NGage -->
  */
  } //if (!is_user_logged_in())
}



add_action('wp_before_admin_bar_render', 'em_dashboard_logo');
function em_dashboard_logo()
{
  $home_url = get_home_url();
  $logo_dashboard_url = get_home_url(null, '/wp-content/uploads/2021/04/Mova-Legal-white.png');
  $dashboard_style = <<<EOD
  <style type="text/css">
    #wpadminbar #wp-admin-bar-wp-logo>.ab-item {
      padding: 0 7px;
      background-image: url({$logo_dashboard_url}) !important;
      background-size: 70%;
      background-position: center;
      background-repeat: no-repeat;
      opacity: 0.8;
    }
    #wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before {
      content: " ";
      top: 2px;
    }
    #wpadminbar #wp-admin-bar-wp-logo.menupop .ab-sub-wrapper,
    #wpadminbar #wp-admin-bar-wp-logo>.ab-item .screen-reader-text {
      display: none !important;
    }
  </style>
  EOD;
  $dashboard_script = <<<EOD
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
      let updatedLogoWrap = document.querySelector("#wp-admin-bar-wp-logo");
      let logoLink = updatedLogoWrap.querySelectorAll(".ab-item")[0];
      logoLink.removeAttribute("href");
    });
  </script>
  EOD;
  echo $dashboard_style;
  echo $dashboard_script;
}


add_action('login_head', 'em_login_style');
function em_login_style()
{
  $logo_64_black = get_home_url(null, '/wp-content/uploads/2021/04/movalaw-black-64.png');
  $login_bg_url = get_home_url(null, '/wp-content/uploads/2021/04/hro-bg.jpg');
  $dashboard_style = <<<EOD
  <style type="text/css">
    .login h1 a {
      background-image: url({$logo_64_black});
      width: 64px;
      height: 64px;
      background-size: cover;
    }
    
    .wp-core-ui .button-primary {
      border-color: #162230;
      background: #162230;
      color: #D8AB4E;
    }
    .wp-core-ui .button-primary:hover {
      border-color: #D8AB4E;
      background: #D8AB4E;
      color: #fff;
    }
    body #login {
      z-index: 10;
      position: relative;
    }
    body #login #backtoblog a,
    body #login #nav a,
    body #login #nav {
    }
    body::before {
      content: " ";
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      background: url($login_bg_url) no-repeat scroll center center;
      background-size: cover;
      z-index: 1;
      
      opacity: .45;
    }
  </style>
  EOD;
  echo $dashboard_style;
}

/**
 * Add custom data attribute to every image element
 */
add_filter('wp_get_attachment_image_attributes', 'add_custom_image_data_attributes', 10, 3);
function add_custom_image_data_attributes($attr, $attachment, $size)
{
  $img_id = $attachment->ID;
  $img_src_default = wp_get_attachment_image_src($img_id, $size, false);
  $img_src_default_url =  $img_src_default[0];
  $img_src_default_width = $img_src_default[1];
  $img_src_default_height = $img_src_default[2];

  $img_url_lg = "";
  $img_url_sm = wp_get_attachment_image_src($img_id, "medium", false);
  $img_url_sm_url = $img_url_sm[0];
  $img_size = $size;

  //var_dump($attr);
  // Ensure that the <img> doesn't have the data attribute already
  if (!array_key_exists('data-hqbg', $attr) && $img_src_default_width >= 300 && wp_is_mobile()) {
    $attr['data-hqbg'] = $img_src_default_url;
    unset($attr['src']); // remove src
    unset($attr['srcset']); // remove srcset
    $attr['src'] = $img_url_sm_url;
    // make sure that class only applied to the larger images
    if (!array_key_exists('class', $attr)) {
      $attr['class'] = "hqimg-asyc";
    } else {
      $attr['class'] .= " hqimg-asyc";
    } //if(!array_key_exists('class', $attr) ) {
  }

  return $attr;
}

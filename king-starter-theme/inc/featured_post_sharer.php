<?php 
	$s_link = get_permalink($post->ID);
	$s_title = get_the_title($post->ID);
	$s_summary = get_the_excerpt();
	$fb_link = esc_url("https://www.facebook.com/sharer/sharer.php?u={$s_link}"); 
	$tweeter_link = esc_url("http://twitter.com/share?url={$s_link}&text={$s_title}"); 
	$gplus_link = esc_url("https://plus.google.com/share?url={$s_link}"); 
?>
<div class="share_wrap_fpost">
    <span class="title_sfpost">Share this post:</span>
    <a target="_blank" href="<?php echo $fb_link; ?>" class="sfp_item fb"> &nbsp; </a>
    <a target="_blank" href="<?php echo $tweeter_link; ?>" class="sfp_item tweet"> &nbsp; </a>
    <a target="_blank" href="<?php echo $gplus_link; ?>" class="sfp_item gplus"> &nbsp; </a>
</div>

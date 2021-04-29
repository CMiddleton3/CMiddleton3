<?php
/*
Plugin Name: wooCommerce Remove WP Junk Plugin
Plugin URI: http://www.clarencemiddleton.com
Description: Basic Woocommerce Optimizations for wordPress
Author: Clarence Middleton
Version: 1.03
Author URI: http://www.clarencemiddleton.com
Compatibility: WordPress 4.5
Text Domain: middleton-function
Domain Path: /lang

Copyright 2003 - 2030 Clarence Middleton

 * @package     wooCommerce Optimize Plugin
 * @author      Middleton LLC
 * @Category    Plugin
 * @copyright   Copyright (c) 2019 Middleton LLC
*/

// Stop Cache of Woocommerce Cart Hash
if( !defined( 'ABSPATH') ) exit();
isset( $_COOKIE['woocommerce_cart_hash'] ) && define( 'DONOTCACHEPAGE', true );

// Add Auto Updates
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );


// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );

// EditURI link
remove_action( 'wp_head', 'rsd_link' );

// Category feed links
remove_action( 'wp_head', 'feed_links_extra', 3 );

// Post and comment feed links
remove_action( 'wp_head', 'feed_links', 2 );

// Windows Live Writer
remove_action( 'wp_head', 'wlwmanifest_link' );

// Index link
remove_action( 'wp_head', 'index_rel_link' );

// Previous link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

// Start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

// Canonical
remove_action('wp_head', 'rel_canonical', 10, 0 );

// Shortlink
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// WP version
remove_action( 'wp_head', 'wp_generator' );

// Disable xmlrpc
add_filter('xmlrpc_enabled', '__return_false');


// Redirect to Check out
  function my_custom_add_to_cart_redirect( $url ) {
    $url = WC()->cart->get_checkout_url();
    return $url;
  }
    add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );

// Change Add to Cart Button Text
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
function woo_custom_cart_button_text() {

    return __( 'Buy It Now', 'woocommerce' );

}


//* Adding DNS Prefetching
function ism_dns_prefetch() {
    echo '<meta http-equiv="x-dns-prefetch-control" content="on">
<link rel="dns-prefetch" href="//www.google-analytics.com" />
<link rel="dns-prefetch" href="//connect.facebook.net" />
<link rel="dns-prefetch" href="//ajax.cloudflare.com" />
<link rel="dns-prefetch" href="//www.google-analytics.com" />
<link rel="dns-prefetch" href="//stats.g.doubleclick.net" />
';
}
add_action('wp_head', 'ism_dns_prefetch', 0);

// Don't show wordpress valid error on failed login.
function no_wordpress_errors(){
  return 'Error code: 0xc000000f';
  }
  add_filter( 'login_errors', 'no_wordpress_errors' );

// Remove WP embed script
function speed_stop_loading_wp_embed() {
  if (!is_admin()) {
      wp_deregister_script('wp-embed');
  }
}

add_action('init', 'speed_stop_loading_wp_embed');


}
?>

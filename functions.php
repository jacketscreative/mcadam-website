<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
	
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));

    if ( is_rtl() ) 
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
}

function tribe_events_map_apis() {
    if (tribe_is_event() || is_singular( 'tribe_events' ));
    wp_dequeue_script( 'tribe-events-pro-geoloc' );
}
add_action( 'wp_enqueue_scripts', 'tribe_events_map_apis' );

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_filter('woocommerce_product_related_posts_query', '__return_empty_array', 100);

?>
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

/**
 * On the wc-bookings-booking-form, change the word "day(s)" to "night(s)" 
 */
add_filter( 'booking_form_fields', 'change_booking_form_fields_text', 100);

function change_booking_form_fields_text($fields) {
    //$fields['wc_bookings_field_duration']['label'] = 'Night(s)';
    $fields['wc_bookings_field_duration']['after'] = 'Night(s)';
    error_log(__METHOD__ . "\n");
    error_log(__FUNCTION__ . "\n" . print_r($_POST, 1));
    ob_start();
    var_dump($fields);
    error_log(basename(__FILE__) . "\n" . ob_get_clean());
    return $fields;
}

add_filter( 'woocommerce_get_availability', 'booking_custom_get_availability', 1, 2);

function booking_custom_get_availability( $availability, $_product ) {
    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = __('Available!', 'woocommerce');
    }
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __('Unavailable', 'woocommerce');
    }
    error_log(__METHOD__ . "\n");
    error_log(__FUNCTION__ . "\n" . print_r($_POST, 1));
    ob_start();
    var_dump($availability);
    error_log(basename(__FILE__) . "\n" . ob_get_clean());
    return $availability;
}

?>
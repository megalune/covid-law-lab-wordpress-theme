<?php
add_filter('pre_get_posts', 'pre_get_posts_hook' );

function pre_get_posts_hook($wp_query) {
    if (is_category() || is_archive())
    {
        $wp_query->set( 'orderby', 'meta_value_num' );
        $wp_query->set( 'meta_key', 'wpcf-j-year' );
        $wp_query->set( 'order', 'DESC' );
        return $wp_query;
    }
}
?>
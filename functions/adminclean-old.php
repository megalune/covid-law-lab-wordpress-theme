<?php

add_action('admin_head', 'categories_list_height_jquery');
function categories_list_height_jquery() {
        echo'
        <script type="text/javascript">
                jQuery(function($){
                        $("#category-all.tabs-panel").height($("#categorychecklist").height());
                });
        </script>
        ';
}

function loginpage_custom_link() {
	return 'https://www.globalhealthrights.org';
}
add_filter('login_headerurl','loginpage_custom_link');
function change_title_on_logo() {
	return 'Global Health Rights';
}
add_filter('login_headertitle', 'change_title_on_logo');

add_action( 'admin_menu', 'wpse26980_remove_tools', 99 );
function wpse26980_remove_tools()
{
    remove_menu_page( 'tools.php' );
}


function wp_debranding_remove_wp_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'wp_debranding_remove_wp_logo');


function change_admin_footer_text() {
    return '';
}
add_filter('admin_footer_text', 'change_admin_footer_text');

remove_action('wp_head', 'wp_generator');

function wp_debranding_remove_dashboard_widgets(){
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // wordpress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // other wordpress news
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // plugins
remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // incoming links
remove_meta_box('dashboard_quick_press', 'dashboard', 'normal'); // quick press

}
add_action('admin_menu', 'wp_debranding_remove_dashboard_widgets');

function wp_debranding_admin_css_hide(){
    ?>
    <style type="text/css">
        #contextual-help-link-wrap,
        .wp-pointer{
            display: none !important;
        }
    </style>
    <?php
 
}
add_action('admin_print_styles', 'wp_debranding_admin_css_hide');

function remove_wp_update_notice() {
	if ( !current_user_can('manage_options') ) {
	  remove_action( 'admin_notices', 'update_nag', 3);
	  }
}
add_action('admin_init', 'remove_wp_update_notice');

add_filter('gettext', 'remove_admin_stuff', 20, 3);

function remove_admin_stuff( $translated_text, $untranslated_text, $domain ) {

    $custom_field_text = 'You are using <span class="b">WordPress %s</span>.';

    if ( is_admin() && $untranslated_text === $custom_field_text ) {
        return '';
    }

    return $translated_text;
}

add_action('do_meta_boxes', 'remove_thumbnail_box');

function remove_thumbnail_box() {
    remove_meta_box( 'postimagediv','post','side' );
}

?>
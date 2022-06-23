<?php

ini_set( 'upload_max_size' , '25M' );
ini_set( 'post_max_size', '25M');
ini_set( 'max_execution_time', '300' );




        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu'),
            'footer' => __('Footer Menu')
        ));






// Translations can be filed in the /lang/ directory
load_theme_textdomain( 'themejunkie', TEMPLATEPATH . '/lang' );	

// require_once(TEMPLATEPATH . '/includes/sidebar-init.php');
// require_once(TEMPLATEPATH . '/includes/custom-functions.php'); 
// require_once(TEMPLATEPATH . '/includes/post-thumbnails.php'); 

// require_once(TEMPLATEPATH . '/includes/theme-options.php');
// require_once(TEMPLATEPATH . '/includes/theme-comments.php');
// require_once(TEMPLATEPATH . '/includes/theme-widgets.php');
// require_once(TEMPLATEPATH . '/functions/adminclean.php');
require_once(TEMPLATEPATH . '/functions/theme_functions.php'); 
// require_once(TEMPLATEPATH . '/functions/admin_functions.php');

// require_once(TEMPLATEPATH . '/functions/jcatlinks.php');





function short_title($after = '', $length) {
	$mytitle = get_the_title();
	if ( strlen($mytitle) > $length ) {
	$mytitle = substr($mytitle,0,$length);
	echo $mytitle . $after;
	} else {
	echo $mytitle;
	}
}


add_filter('pre_get_posts', 'custom_pre_get_posts');
function custom_pre_get_posts($q) {
    if( $q->is_admin ) {
        return $q;
    }
    if( !$q->is_main_query() ) {
        //echo "DEBUG: !is_main_query() <pre>".print_r($q,true)."</pre>";
        return $q;
    }
    if( !$q->is_archive() ) {
        //echo "DEBUG: !is_archive() <pre>".print_r($q,true)."</pre>";
        return $q;
    }
   // if ($q->is_category() && !isset($_GET['sort'])) {       
           // if(!isset($_GET['orderby']) && $_GET['orderby'] != 'title'){
               // $q->set('meta_key', 'wpcf-j-year');
               // add_filter('posts_orderby', 'custom_posts_orderby');
           // }
// //       echo "DEBUG: is_category() <pre>".print_r($q,true)."</pre>";exit;
       // return $q;
   // }
    
    if ($q->is_tag()  ) {
        $q->set('meta_key', 'wpcf-j-year');
        add_filter('posts_orderby', 'custom_posts_orderby');
        //echo "DEBUG: is_category() <pre>".print_r($q,true)."</pre>";
        return $q;
    }

    if ($q->is_tax(instruments)   && !isset($_GET['sort']) ) {
        $q->set('meta_key', 'wpcf-iyoa');
        add_filter('posts_orderby', 'custom_posts_orderby');
        //echo "DEBUG: is_category() <pre>".print_r($q,true)."</pre>";
        return $q;
    }

    if ($q->is_tax(constitutions)  && !isset($_GET['sort'])  ) {
        $q->set('meta_key', 'wpcf-cyoa');
        add_filter('posts_orderby', 'custom_posts_orderby_c');
        //echo "DEBUG: is_category() <pre>".print_r($q,true)."</pre>";
        return $q;
    }
    
    $custom_field = ( $_GET['sort'] ) ? stripslashes( $_GET['sort'] ) : '';
    $custom_value = ( $_GET['sortorder'] ) ? stripslashes( $_GET['sortorder'] ) : '';
    if( $custom_field ) {
        if($custom_field!='title'){
          $q->set( 'meta_key', $custom_field );
        }
        $q->set( 'orderby', $custom_field );
        if( $custom_value ) {
            $q->set( 'order', $custom_value );
            //echo "DEBUG: custom_value <pre>".print_r($q,true)."</pre>";
            return $q;
        }
        //echo "DEBUG: custom_field <pre>".print_r($q,true)."</pre>";
        return $q;
    }
    //echo "DEBUG: else <pre>".print_r($q,true)."</pre>";
    return $q;
}


function custom_posts_orderby($orderby) {
    global $wpdb;
    return $wpdb->postmeta.".meta_value+0 DESC, ".$wpdb->posts .".post_title ASC";
}

//function custom_posts_orderby($orderby) {
//    global $wpdb;
//    return $wpdb->posts .".id DESC";
//}

function category_posts_orderby($orderby) {
    global $wpdb;
    return $wpdb->posts .".post_title ASC";
}

function custom_posts_orderby_c($orderby) {
    global $wpdb;
    return $wpdb->posts .".post_title ASC";
}

add_action('pre_get_posts', 'check_meta_sort_rank');
function check_meta_sort_rank($query) {
    if ($query->is_admin == 1) {
        return;
    }
    if (!$query->is_main_query()) {
        return;
    }
    if (!$query->is_archive == 1) {
        return;
    }
    $custom_field = ( $_GET['rank'] ) ? stripslashes($_GET['rank']) : '';
    $custom_value = ( $_GET['rankorder'] ) ? stripslashes($_GET['rankorder']) : '';
    if ($custom_field) {
        $query->set('meta_key', $custom_field);
        $query->set('orderby', $custom_field);
        if ($custom_value) {
            $query->set('order', $custom_value);
        }
    }
}

add_action('pre_get_posts', 'check_meta_sort_court');
function check_meta_sort_court($query) {
    if ($query->is_admin == 1) {
        return;
    }
    if (!$query->is_main_query()) {
        return;
    }
    if (!$query->is_archive == 1) {
        return;
    }
    $custom_field = ( $_GET['court'] ) ? stripslashes($_GET['court']) : '';
    $custom_value = ( $_GET['courtorder'] ) ? stripslashes($_GET['courtorder']) : '';
    if ($custom_field) {
        $query->set('meta_key', $custom_field);
        $query->set('orderby', $custom_field);
        if ($custom_value) {
            $query->set('order', $custom_value);
        }
    }
}

function new_excerpt_more( $more ) {
    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '"> ...Read more</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );



add_action('template_redirect', 'custom_redirect');

function custom_redirect()
{
  global $wp_query;

  if ($wp_query->is_404() )
  {
	  	//if($wp_query->is_category()){
		    $url = $_SERVER["REQUEST_URI"];
		    $redirect_url=explode('page', $url, 2);
			if($redirect_url[1]){
				$redirect_url1=explode('/', $redirect_url[1], 2);
				if($redirect_url1[1]){
					$wp_query->is_404 = false;
		            header('Location: ' . $redirect_url[0]);
				}
			}
			//print_r($redirect_url1);exit;    
	   //}
  }
}
function maintenance_mode() {
 
      if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {wp_die('Maintenance.');}
 
}
// add_action('get_header', 'maintenance_mode');






add_action( 'admin_bar_menu', 'show_template' );
function show_template() {
    global $template;
    echo "<!--";
    print_r( $template );
    echo "-->";
}















// hide posts by other authors for contributors
// https://www.wpbeginner.com/plugins/how-to-limit-authors-to-their-own-posts-in-wordpress-admin/
function posts_for_current_author($query) {
    global $pagenow;
 
    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;
 
    if( !current_user_can( 'edit_others_posts' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');





// Rename categories to legal topics
function revcon_change_cat_label() {
    global $submenu;
    $submenu['edit.php?post_type=item'][15][0] = 'Legal Topics'; 
}
add_action( 'admin_menu', 'revcon_change_cat_label' );

function revcon_change_cat_object() {
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['category']->labels;
    $labels->name = 'Legal Topic';
    $labels->singular_name = 'Legal Topic';
    $labels->add_new = 'Add Legal Topic';
    $labels->add_new_item = 'Add Legal Topic';
    $labels->edit_item = 'Edit Legal Topic';
    $labels->new_item = 'Legal Topic';
    $labels->view_item = 'View Legal Topic';
    $labels->search_items = 'Search Legal Topics';
    $labels->not_found = 'No Legal Topics found';
    $labels->not_found_in_trash = 'No Legal Topics found in Trash';
    $labels->all_items = 'All Legal Topics';
    $labels->menu_name = 'Legal Topic';
    $labels->name_admin_bar = 'Legal Topic';
}
add_action( 'init', 'revcon_change_cat_object' );


// remove Side Menu post link
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}
// remove +New Post in Admin Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
// remove Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}


// not sure what this is, but it prevents some users from seeing tags
// function example_wpadmin_show_all_tags( $args ) {
//     if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_POST['action'] ) && $_POST['action'] === 'get-tagcloud' )
//         unset( $args['number'] );
//         $args['hide_empty'] = 0;
//     return $args;
// }
// add_filter( 'get_terms_args', 'example_wpadmin_show_all_tags' );
// function example_wpadmin_custom_css() {
//     echo '<script>
//         jQuery(window).load(function() {
//             jQuery("body.wp-admin #tagsdiv-post_tag #link-post_tag").trigger("click");
//             jQuery("body.wp-admin #tagsdiv-post_tag #link-post_tag").hide();
//         });
//     </script>';
//     echo '<style>
//         body.wp-admin #tagsdiv-post_tag #link-post_tag{visibility:hidden;}
//         body.wp-admin #tagsdiv-post_tag #post_tag .jaxtag{display:none;} //this line hides the manual add tag box - delete if not required
//         body.wp-admin #tagsdiv-post_tag #tagcloud-post_tag a{display:block;} //this line puts each displayed tag on a new line - delete if not required
//         #tagcloud-post_tag a.tag-cloud-link { font-size:20px !important; }
//     </style>';
// }
// add_action('admin_head', 'example_wpadmin_custom_css');


// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

?>

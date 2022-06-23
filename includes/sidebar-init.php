<?php

// Register Widgets
function tj_widgets_init() {

	// Home Sidebar
	register_sidebar( array (
		'name' => __( 'Home Sidebar', 'themejunkie' ),
		'id' => 'home-sidebar',
		'description' => __( 'Sidebar', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// General Sidebar
	register_sidebar( array (
		'name' => __( 'General Sidebar', 'themejunkie' ),
		'id' => 'general-sidebar',
		'description' => __( 'Sidebar', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'init', 'tj_widgets_init' );

?>
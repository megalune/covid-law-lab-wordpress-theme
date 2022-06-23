<?php

/* sets predefined Post Thumbnail dimensions */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	
	//default thumbnail size
	add_image_size( 'home-featured-thumb', 930, 350, true );
	add_image_size( 'home-column1-thumb', 90, 90, true );				
	add_image_size( 'home-column2-thumb', 300, 215, true );
	add_image_size( 'archive-thumb', 100, 100, true );
	add_image_size( 'tabber-thumb', 42, 42, true );
	
};

?>
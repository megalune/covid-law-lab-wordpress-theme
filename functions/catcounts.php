<?php







function my_list_categories( $args ) {

	

	// get category objects

	$categories = get_categories($args);



	// set vars

	$odd_or_even = 'odd';

	$output = '';

	

	// loop objects

	foreach($categories as $category) {



		// build output

		$output .= '<li class="' . $odd_or_even . '">';



$output .= '<span id="spanleft"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></span><span id="spanright">' . $category->category_count . '</span>';



		$output .= '</li>';

		

		$odd_or_even = ('odd'==$odd_or_even) ? 'even' : 'odd';

		

	} 

	

	// return output

	return $output;

	

}





 ?>
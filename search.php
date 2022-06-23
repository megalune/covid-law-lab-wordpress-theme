<?php get_header(); ?>
<?php

	function get_meta_values( $key = '' ) {
		global $wpdb;    
		$result = $wpdb->get_results( "SELECT pm.meta_value FROM wp_postmeta pm JOIN wp_posts p ON p.ID = pm.post_id WHERE pm.meta_key = '".$key."' AND p.post_status = 'publish' AND p.post_type = 'item' GROUP BY pm.meta_value" );
		return $result;
	}
?>
<main>



				<?php
				// set variables to null if undefined
				$category_name = isset($_GET["topic"]) ? $_GET["topic"] : '';
				$search_tag = isset($_GET["search_tag"]) ? $_GET["search_tag"] : '';
				$region = isset($_GET["region"]) ? $_GET["region"] : '';
				$country = isset($_GET["country"]) ? $_GET["country"] : '';
				$type = isset($_GET["type"]) ? $_GET["type"] : '';
				$sorting = isset($_GET["sorting"]) ? $_GET["sorting"] : '';
				if ($sorting == 'title') { $orderby = 'title'; $meta_key = ''; $order = 'ASC'; }
				else if ($sorting == 'date_issued') { $orderby = 'meta_value_num'; $meta_key = 'date_issued'; $order = 'DESC'; }
				else { $orderby = 'meta_value'; $meta_key = $sorting; $order = 'ASC'; }
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				?>
				<!-- if search by country put analysis first -->
				<?php
					if($country != "") {
						?><article class="search-item" style="margin: 3rem 0 4rem; padding: 2rem 2.5rem 1.5rem;">

								<h2><?php echo $country; ?></h2>

<div class="row">
	<!-- <div class="one-half column">					 -->




						<?php

						$query = "SELECT iso2 FROM country_master WHERE name LIKE '%".$country."%' OR name_un LIKE '%".$country."%' LIMIT 1";
    					$countries = $wpdb->get_results($query, ARRAY_A);
	    				// print_r($countries);
						if( !empty($countries) ){
	    					echo "<!-- ISO2 = ".$countries[0]["iso2"]." -->";
							$iso2 = $countries[0]["iso2"];
							// include("country-reports/get-who-data.php?iso2=".$iso2);
							$who_data = file_get_contents("https://covidlawlab.org/wp-content/themes/covid/country-reports/get-who-data.php?iso2=".$iso2);
							echo $who_data;
						} else { echo "<!-- iso2 error -->"; }

						?>


	<!-- </div>
	<div class="one-half column"> -->

						
						<?php
						// args
						$args = array(
							'posts_per_page' => 1,
							'post_type'		=> 'countries',
							'meta_query'	=> array(
								'relation'		=> 'AND',
								array(
									'key'	 	=> 'country',
									'value'	  	=> $country,
									'compare' 	=> 'LIKE',
								)
							)
						);
						
						// query
						$the_query = new WP_Query( $args );
						?>

						<?php if( $the_query->have_posts() ): ?>
							<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<?php get_template_part( 'country-display' ); ?>
							<?php endwhile; ?>
						<?php endif; ?>
						<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>



	<!-- </div> -->
</div>	



						</article>
				<?php
					} // end country if
				?>








	<div class="row">
		<div class="one-third column">
			<form method="get" action="/?">
				<input type="hidden" name="s">
				<label>By Legal Topic</label>
				<select name="topic" id="topic">
					<option value="">All Legal Topics</option>
					<?php
						# this is the category taxonomy
						$categories = get_categories( array('orderby' => 'name', 'order'   => 'ASC') );
						foreach($categories as $c){
							$selected = $c->slug == $category_name ? ' selected="selected"' : '';
							echo '<option value="'.$c->slug.'"'.$selected.'>'.$c->name.'</option>';
						}
					?>
				</select>
				<br>
				<label>By Region</label>
				<select name="region" id="region">
					<option value="">All Regions</option>
					<?php
						foreach(get_meta_values('region') as $r){
							if($r->meta_value != ""){
								$selected = $r->meta_value == $region ? ' selected="selected"' : '';
								echo '<option value="'.$r->meta_value.'"'.$selected.'>'.$r->meta_value.'</option>';
							}
						}
					?>
				</select>
				<br>
				<label>By Country</label>
				<select name="country" id="country">
					<option value="">All Countries</option>
					<?php
						foreach(get_meta_values('country') as $c){
							$selected = $c->meta_value == $country ? ' selected="selected"' : '';
							echo '<option value="'.$c->meta_value.'"'.$selected.'>'.$c->meta_value.'</option>';
						}
					?>
				</select>
				<br>
				<label>Type</label>
				<select name="type" id="type">
					<option value="">All Types</option>
					<?php
						foreach(get_meta_values('type') as $t){
							$selected = $t->meta_value == $type ? ' selected="selected"' : '';
							if($t->meta_value != "" && $t->meta_value != "Report"){
								echo '<option value="'.$t->meta_value.'"'.$selected.'>'.$t->meta_value.'</option>';
							}
						}
					?>
				</select>
				<br>
				<label>Sort</label>
				<select name="sorting" id="sorting">
					<option value="date_issued" <?php echo $sorting == 'date_issued' ? ' selected="selected"' : ''; ?>>Date Issued</option>
					<option value="country" <?php echo $sorting == 'country' ? ' selected="selected"' : ''; ?>>Country</option>
					<option value="title" <?php echo $sorting == 'title' ? ' selected="selected"' : ''; ?>>Title</option>
				</select>
				<br>
				<label>By Tag</label>
				<select name="search_tag" id="search_tag">
					<option value="">All Tags</option>
					<?php
						# this is the tag taxonomy
						$terms = get_terms('post_tag',array('hide_empty'=>false));
						foreach($terms as $t) {
							$selected = $t->slug == $search_tag ? ' selected="selected"' : '';
							echo '<option value="'.$t->slug.'"'.$selected.'>'.$t->name.'</option>';
						}
					?>
				</select>
				<br>
				<button type="submit" class="u-full-width">Update Results</button>
			</form>
			<?php get_sidebar(); ?>
		</div>
		<div class="two-thirds column">
			<div id="content" class="archive">
				<!-- if search by topic put toolkit first -->
				<?php 
					// args
					$args = array(
						'posts_per_page' => 20,
						'post_type'		=> 'item',
						'category_name' => $category_name,
						'tag' 			=> $search_tag,
						'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'	  	=> 'region',
								'value'	  	=> $region,
								'compare' 	=> 'LIKE',
							),
							array(
								'key'	 	=> 'country',
								'value'	  	=> $country,
								'compare' 	=> 'LIKE',
							),
							array(
								'key'	  	=> 'type',
								'value'	  	=> $type,
								'compare' 	=> 'LIKE',
							),
							array(
								'key'	  	=> 'type',
								'value'	  	=> 'Report',
								'compare' 	=> '!=',
							)
						),
						'paged' 		=> ( get_query_var('paged') ? get_query_var('paged') : 1),
						'orderby'		=> $orderby,
						'meta_key'  	=> $meta_key,
						'order'			=> $order
					);
					
					
					// query
					$the_query = new WP_Query( $args );
					
					?>

				<?php
					if($type == "Toolkit") {
						echo "<p>Coming Soon</p>";
					} else {
						echo '<p><strong>'.$the_query->found_posts.' Results Found:</strong></p>';
					}
				?>

				<?php if( $the_query->have_posts() ): ?>

				<!-- pagination -->
				<?php wp_pagenavi( array( 'query' => $the_query ) ); ?>

				<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<article class="search-item">
					<h5><a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a>
					</h5>
					<?php get_template_part( 'item-display' ); ?>
				</article>
				<?php endwhile; ?>

				<!-- pagination -->
				<?php wp_pagenavi( array( 'query' => $the_query ) ); ?>

				<?php endif; ?>
				<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
			</div>
			<!--end #content-->
		</div>
	</div>
</main>
<?php get_footer(); ?>
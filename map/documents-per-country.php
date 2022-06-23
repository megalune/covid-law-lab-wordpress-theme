<pre>
<?php
	require("../../../../wp-config.php");

	    $query = "SELECT cm.name, COUNT(*) as judgements FROM wp_postmeta pm JOIN wp_posts p ON p.ID = pm.post_id JOIN country_master cm ON pm.meta_value = cm.name_un WHERE pm.meta_key = 'country' AND p.post_status = 'publish' AND p.post_type = 'item' GROUP BY pm.meta_value";
	    $countries = $wpdb->get_results($query);

	// print_r($countries);
	foreach ($countries as $c) {
		// print_r($c);
		echo $c->name.', '.$c->judgements.PHP_EOL;
	}
?>
</pre>
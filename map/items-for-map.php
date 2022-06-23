<?php

require("../../../../wp-config.php");


$query = "SELECT
    cm.iso2,
    cm.name,
    cm.name_un AS country_slug,
    COUNT(*) AS count_total,
    cm.color,
    cm.region
FROM
    wp_postmeta pm
JOIN wp_posts p ON
    p.ID = pm.post_id
JOIN country_master cm ON
    pm.meta_value = cm.name_un
WHERE
    pm.meta_key = 'country' AND p.post_status = 'publish' AND p.post_type = 'item'
GROUP BY
    pm.meta_value";
    $countries = $wpdb->get_results($query);


echo json_encode($countries);



/*
191




SELECT
   cm.iso2,
   cm.name,
   cm.name_un as country_slug,
   COUNT(*) as count_total,
   cm.color,
   cm.region
FROM
   wp_postmeta pm 
   JOIN
      wp_posts p 
      ON p.ID = pm.post_id 
    JOIN
      country_master cm
      ON pm.meta_value = cm.name
WHERE
   pm.meta_key = 'country' 
   AND p.post_status = 'publish' 
   AND p.post_type = 'item' 
GROUP BY
   pm.meta_value
   */
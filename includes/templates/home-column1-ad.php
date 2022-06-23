<?php /* Column #1 Ad */
if( get_option('newspaper_column1_ad_enable') == 'on'){
	echo "<div class='home-column1-ad'>";
	echo get_option('newspaper_column1_ad_code');
	echo "</div>";
} ?>
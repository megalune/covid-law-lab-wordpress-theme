<?php get_header(); ?>
<?php
  function get_meta_values( $key = '' ) {
    global $wpdb;    
    $result = $wpdb->get_results( "SELECT pm.meta_value, COUNT(*) as c FROM wp_postmeta pm JOIN wp_posts p ON p.ID = pm.post_id WHERE pm.meta_key = '".$key."' AND p.post_status = 'publish' AND p.post_type = 'item' GROUP BY pm.meta_value" );
    return $result;
  }
?>
<main>







<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>

<script>
// start the map
function initMap() {}

/* ? */
  (function() {
      var cx = '007808283441635124887:ov1bzhrxbac';
      var gcse = document.createElement('script');
      gcse.type = 'text/javascript';
      gcse.async = true;
      gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//www.google.com/cse/cse.js?cx=' + cx;
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(gcse, s);
  })();

/* ? */
  $(document).ready(function () {
    applicationMAP.getjudgements('', '', '');
  });
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmfdhVdvTblpff4EOz2Kve9RIEPQNtifE&callback=initMap"></script>
<script src="/wp-content/themes/covid/map/leaflet/leaflet.js"></script>
<link rel="stylesheet" href="/wp-content/themes/covid/map/leaflet/leaflet.css" type="text/css" media="screen">
<script src="/wp-content/themes/covid/map/Google.js"></script>
<script src="/wp-content/themes/covid/map/taffy-min.js"></script> <!-- js database used for ? -->
<script src="/wp-content/themes/covid/map/map.js"></script> <!-- fetches map data and builds map -->

<!-- plugin for adding labels to markers & shapes on leaflet powered maps -->
<script src="/wp-content/themes/covid/map/leaflet/plugins/label/leaflet.label.js"></script>
<link rel="stylesheet" href="/wp-content/themes/covid/map/leaflet/plugins/label/leaflet.label.css" type="text/css" media="screen">

<div id="map" style="width:100%; height:500px; border: solid 1px black; margin: 4rem auto 3rem;" class="map rounded"/></div>


  <div class="row">
    <div class="twelve columns" id="map-disclaimer">
    	<?php echo get_post_field('post_content', 17931); ?>
    </div>
</div>






















  <div class="row">
    <div class="six columns">
      <form method="get" action="/?">
        <input type="hidden" name="s">
        <label>By Legal Topic</label>
        <select name="topic" id="topic" onchange="this.form.submit()">
          <option value="">All Legal Topics</option>
            <?php
              # this is the category taxonomy
              $categories = get_categories( array('orderby' => 'name', 'order'   => 'ASC') );
              foreach($categories as $c){
                echo '<option value="'.$c->slug.'">'.$c->name.' ('.$c->count.')</option>';
              }
            ?>
        </select>
        <br>
        <label>By Region</label>
        <select name="region" id="region" onchange="this.form.submit()">
          <option value="">All Regions</option>
          <?php
            foreach(get_meta_values('region') as $r){
              echo '<option value="'.$r->meta_value.'">'.$r->meta_value.' ('.$r->c.')</option>';
            }
            ?>
        </select>
        <br>
        <label>By Country</label>
        <select name="country" id="country" onchange="this.form.submit()">
          <option value="">All Countries</option>
          <?php
            $country_dd = get_meta_values('country');
            // print_r($country_dd);
            $dd_alpha = array_column($country_dd, 'c', 'meta_value');
            ksort($dd_alpha);
            // print_r($dd_alpha);
            foreach($dd_alpha as $name => $count){
              echo '<option value="'.$name.'">'.$name.' ('.$count.')</option>';
            }
            ?>
        </select>
      </form>
    </div>
    <div class="six columns" style="padding-top: 23px; line-height: 52px;">
      <a href="/?s=&sorting=date_issued" class="button button-primary u-full-width">Explore Full Database</a><br>
      <a href="/about-the-database/" class="button button-primary u-full-width">About the Database</a><br>
      <a href="/?s=&type=Analysis" class="button button-primary u-full-width">Analysis</a><br>
      <a href="/international-legal-instruments/" class="button button-primary u-full-width">International Legal Instruments</a>
      <!-- <a href="/?s=&type=Toolkit" class="button button-primary u-full-width">Toolkits</a> -->
    </div>
  </div>






  <div class="row text-center" style="padding-top: 2rem;border-top: solid 1px #eee;">
    <div class="twelve columns"><img src="/wp-content/uploads/2020/07/partners.png" alt="Partners: UNDP; UNAIDS; WHO; O'Neill Institute; Georgetown University"></div>
    <div class="two columns">&nbsp</div>
    <div class="four columns"><img src="/wp-content/uploads/2020/12/logo-ipu.png" alt="IPU" width="150" style="    margin-left: -80px;"></div>
    <div class="four columns"><img src="/wp-content/uploads/2020/12/logo-idlo.png" alt="IDLO" width="150" style="margin-top: -25px;"></div>
  </div>
</main>



<?php get_footer(); ?>
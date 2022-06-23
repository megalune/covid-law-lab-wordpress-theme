<?php

// grab data from https://covid19.who.int/info/

$cache_file = 'cached-who-data.php';
$url = "https://covid19.who.int/WHO-COVID-19-global-data.csv";
$age = 60 * 60 * 12; // in seconds == 12 hours

if (file_exists($cache_file) && (filemtime($cache_file) > (time() - $age ))) {
   // Cache file is less than age limit. 
   // Don't bother refreshing, just use the file as-is.
   // $file = file_get_contents($cache_file);
   $data_source = $cache_file;
} else {
   // Our cache is out-of-date, so load the data from our remote server,
   // and also save it over our cache for next time.
   $file = file_get_contents($url);
   file_put_contents($cache_file, $file, LOCK_EX);
   $data_source = $url;
}

$file = fopen($data_source,"r");



$data = array();
$i = 0;

while(!feof($file)) {
   $row = fgetcsv($file);
   if($row[1] == $_GET["iso2"]){
      // print_r($row);
      $cases = $row[5];
      $deaths = $row[7];
      $date = $row[0];
      // echo $row[5];
      // echo $row[7];
      // echo "<p><strong>Cases:</strong> ".$cases."</p>";
      // echo "<p><strong>Deaths:</strong> ".$deaths."</p>";
      $data[$i]['cases_n'] = $row[4];
      $data[$i]['cases_c'] = $row[5];
      $data[$i]['deaths_n'] = $row[6];
      $data[$i]['deaths_c'] = $row[7];
      $data[$i]['date'] = $row[0];
      $i++;
   }
}
fclose($file);



$last_seven = array_slice($data, $i-14);

// echo "<!--";
// print_r($last_seven);
// echo "-->";

$new_deaths = array();
$new_cases = array();
$dates = array();
foreach ($last_seven as &$day) {
    // array_push($new_deaths, number_format($day['deaths_n']));
    array_push($new_deaths, $day['deaths_n']);
    // array_push($new_cases, number_format($day['cases_n']));
    array_push($new_cases, $day['cases_n']);
    // array_push($dates, date_format(strtotime($day['date']),'F jS Y'));
    array_push($dates, $day['date']);
}
// print_r($new_deaths);
// print_r($new_cases);
// print_r($dates);
?>

<div class="row text-center">
   <div class="one-half column"><?php echo "<p style='font-size:4rem;margin-bottom: -1rem;margin-top: 2rem;'>".number_format($cases)."</p><p>Cumulative Cases</p>"; ?><?php echo "<p style='font-size:4rem;margin-bottom: -1rem;margin-top: 2rem;'>".number_format($deaths)."</p><p>Cumulative Deaths</p>"; ?></div>
   <div class="one-half column"><canvas id="myChart"></canvas></div>
</div>

<!-- https://www.chartjs.org/docs/latest/charts/line.html -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
var ctx = document.getElementById('myChart');

const data = {
  labels: [ '<?php echo implode("','", $dates); ?>' ],
  // datasets: [{
  //   label: 'New Deaths',
  //   data: [ <?php echo implode(",", $new_deaths); ?> ],
  //   fill: false,
  //   borderColor: 'red',
  //   tension: 0
  // },{
  //   label: 'New Cases',
  //   data: [ <?php echo implode(",", $new_cases); ?> ],
  //   fill: false,
  //   borderColor: 'orange',
  //   tension: 0
  // }]
  datasets: [{
    label: 'New Cases (Last 14 Days)',
    data: [ <?php echo implode(",", $new_cases); ?> ],
    fill: false,
    borderColor: '#e93f33',
    tension: 0
  }]
};

var myChart = new Chart(ctx, {
   type: 'line',
   data: data,
});
</script>


<p class="text-center" style="margin-top: 1rem;"><small>WHO COVID-19 Dashboard. Geneva: World Health Organization, 2020. Available online: <a href="https://covid19.who.int/" target="_blank">https://covid19.who.int/</a> (last cited: <?php echo $date; ?>).</small></p>
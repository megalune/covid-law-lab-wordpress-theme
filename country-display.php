<?php
 if(get_field('document')){
    echo "<p><a href=\"".get_field('document')."\" class=\"button\">Country Report</a></p>";
 }
 if(get_field('legal_system')){
    echo "<p><strong>Legal System:</strong> ".get_field('legal_system')."</p>";
 }
 if(get_field('economy_type')){
    echo "<p><strong>Economy Type:</strong> ".get_field('economy_type')."</p>";
 }
 if(get_field('health_current_expenditure_of_gdp')){
    echo "<p><strong>Current Health Expenditure:</strong> ".get_field('health_current_expenditure_of_gdp')."% of GDP</p>";
 }
 if(get_field('health_physicians_per_1000pop')){
    echo "<p><strong>Physicians:</strong> ".get_field('health_physicians_per_1000pop')." per 1,000/pop</p>";
 }
 if(get_field('international_treaties')){
    echo "<p><strong>International Treaties:</strong></p><ul style='margin: 0 2rem;'>";
    // <br> ".implode("<br>",get_field('international_treaties'))."</p>";
   foreach (get_field('international_treaties') as &$value) {
      echo '<li>'.$value.'</li>';
   }
   echo "</ul>";
 }
 if(get_field('childhood_vaccine_uptake')){
    echo "<p><strong>Childhood Vaccine Uptake (measles coverage by nationally recommended age):</strong> ".get_field('childhood_vaccine_uptake')."%</p>";
 }
 if(get_field('previous_outbreaks')){
    echo "<p><strong>Previous Outbreaks:</strong> ";
    // .implode(", ",get_field('previous_outbreaks'))."</p>";
   foreach (get_field('previous_outbreaks') as &$value) {
      echo '<span class="tag-label">'.$value.'</span>';
   }
   echo "</p>";
 }
?>
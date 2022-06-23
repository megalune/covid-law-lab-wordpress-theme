<?php get_header(); ?>



<div id="home-featured">
<div class="mapwrap">
<ul class="filtermenumap">
<li><a href="#" title="Filter Map based on Health Topics" style="cursor:default;background-color:white;"><b>Filter Map &raquo;</b></a></li>
  <li><a href="javascript:void(0);"  id="id_ht"  onMouseOut="mouseOutHander();" onMouseover="fadeIn('id_healthtopics');" title="View all categories of Health Topics"><span><b>Health Topics</b></span></a>


    <ul class='filtermenumapm' id="id_healthtopics" style="width:850px;display:none;" onMouseOut="mouseOutHander('id_healthtopics');">

<li><a href="javascript:void(0);" onClick="loadmap('Abortion');">Abortion</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Access to health care');">Access to health care</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Access to health information');">Access to health information</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Access to medicines');">Access to medicines</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Alternative medicine');">Alternative medicine</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Child and adolescent health');">Child and adolescent health</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Chronic diseases');">Chronic diseases</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Disability');">Disability</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Disasters');">Disasters</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Drug safety');">Drug safety</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Environmental health');">Environmental health</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Food and nutrition');">Food and nutrition</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Health information privacy');">Health information privacy</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Health systems and financing');">Health systems and financing</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('HIV/AIDS');">HIV/AIDS</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Hospitals');">Hospitals</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Hygiene and sanitation');">Hygiene and sanitation</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Illegal drugs and alcohol');">Illegal drugs and alcohol</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Infectious diseases');">Infectious diseases</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Informed consent');">Informed consent</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Involuntary commitment');">Involuntary commitment</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Medical malpractice');">Medical malpractice</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Mental health');">Mental health</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Non-consensual testing and treatment');">Non-consensual testing and treatment</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Occupational health');">Occupational health</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Older persons');">Older persons</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Poverty');">Poverty</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Prisons');">Prisons</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Public Safety');">Public Safety</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Sexual and reproductive health');">Sexual and reproductive health</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Sexual orientation and gender identity');">Sexual orientation and gender identity</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Sexual violence');">Sexual violence</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Sterilization');">Sterilization</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Tobacco');">Tobacco</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Torture');">Torture</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Water');">Water</a></li>



    </ul>
</li>

  <li><a href="javascript:void(0);" onClick="loadmap(null);"  id="id_hr" onMouseOut="mouseOutHander();"  onMouseover="fadeIn('id_humanrights');" title="View all categories of Human Rights"><span><b>Human Rights</b></span></a>
<ul class='filtermenumapm' id="id_humanrights" style="width:850px;display:none;" onMouseOut="mouseOutHander('id_humanrights');">
<li><a href="javascript:void(0);" onClick="loadmap('Freedom from discrimination');">Freedom from discrimination</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Freedom from torture');">Freedom from torture</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Freedom of association');">Freedom of association</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Freedom of expression');">Freedom of expression</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Freedom of movement and residence');">Freedom of movement and residence</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Freedom of religion');">Freedom of religion</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right of access to information');">Right of access to information</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to acquire nationality');">Right to acquire nationality</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to bodily integrity');">Right to bodily integrity</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to development');">Right to development</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to due process/fair trial');">Right to due process/fair trial</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to education');">Right to education</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to favorable working conditions');">Right to favorable working conditions</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to family life');">Right to family life</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to food');">Right to food</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to health');">Right to health</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to housing');">Right to housing</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to liberty and security of person');">Right to liberty and security of person</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to life');">Right to life</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to participation');">Right to participation</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to privacy');">Right to privacy</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to property');">Right to property</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to social security');">Right to social security</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to water');">Right to water</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to work');">Right to work</a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Right to a clean environment');">Right to a clean environment </a></li>
<li><a href="javascript:void(0);" onClick="loadmap('Rights to the benefits of culture');">Rights to the benefits of culture</a></li>

    </ul>

</li>

<div id="category_label" ></div>

</ul>

</div>
<div class="clear"></div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://www.duretechnologies.com/samples/global/wp-content/themes/global/includes/js/tooltip.js"></script>
<script type="text/javascript">
   var latitude = 9;
   var longitude = 20;
   var continent = 'Africa';
   var zoomValue=3;
</script>
<script type="text/javascript" src="http://www.duretechnologies.com/samples/global/wp-content/themes/global/includes/js/HealthMap.js"></script>
<div id="map_canvas" style="width:935px; height:360px;" class="map rounded"/></div>


</div><!--end #home-featured-->

<div id="columns">

<ul id="column1">


<li id="category-box1-1" class="category-box">

<h3>Africa Judgments by Country</h3>


<ul>
<li><span id="spanleft"><a href="#">Egypt</a></span>  <span id="spanright">10</span></li>
<li><span id="spanleft"><a href="#">Libya</a></span>   <span id="spanright">09</span></li>
<li><span id="spanleft"><a href="#">Sudan</a></span>   <span id="spanright">07</span></li>
<li><span id="spanleft"><a href="#">Nigeria</a></span>   <span id="spanright">05</span></li>
<li><span id="spanleft"><a href="#">Zambia</a></span>	<span id="spanright">03</span></li>
<li><span id="spanleft"><a href="#">Angola</a></span>  <span id="spanright">02</span></li>
<li><span id="spanleft"><a href="#">Namibia</a></span>   <span id="spanright">01</span></li>
<li><span id="spanleft"><a href="#">Chad</a></span>   <span id="spanright">01</span></li>
<li><span id="spanleft"><a href="#">Somalia</a></span>   <span id="spanright">01</span></li>
<li><span id="spanleft"><a href="#">New Mali</a></span>	<span id="spanright">01</span></li>
<li><span id="spanleft"><a href="#">New Chad</a></span>   <span id="spanright">01</span></li>
<li><span id="spanleft"><a href="#">Somalia</a></span>   <span id="spanright">01</span></li>
<li><span id="spanleft"><a href="#">Mali</a></span>	<span id="spanright">01</span></li>
<li><span id="spanleft"><a href="#">Angolda</a></span>	<span id="spanright">01</span></li>
<li><a href="http://www.duretechnologies.com/samples/global/category/africa/">List All Africa Judgments</a></li>
</ul>
</li>






    </ul><!--end #column1-->

  <ul id="column7">

<li id="category-box1-1" class="category-box">

<h3>Judgments by Human Rights</h3>


<ul>
<li><span id="spanleft"><a href="#">Freedom of Association</a></span>  <span id="spanright">20</span></li>
<li><span id="spanleft"><a href="#">Freedom of Expression</a></span>  <span id="spanright">16</span></li>
<li><span id="spanleft"><a href="#">Freedom of Religion</a></span>  <span id="spanright">12</span></li>
<li><span id="spanleft"><a href="#">Right to Bodily Integrity</a></span>  <span id="spanright">08</span></li>
<li><span id="spanleft"><a href="#">Right to Development</a></span>  <span id="spanright">07</span></li>
<li><a href="#">List All Rights</a></li>
</ul>
</li>

<li id="category-box1-1" class="category-box">
<h3>Judgments by Health Topics</h3>


<ul>
<li><span id="spanleft"><a href="#">Adolescent Health</a></span>  <span id="spanright">15</span></li>
<li><span id="spanleft"><a href="#">Child Health and Development</a></span>  <span id="spanright"> 10</span></li>
<li><span id="spanleft"><a href="#">Chronic Diseases</a> </span>  <span id="spanright"> 22</span></li>
<li><span id="spanleft"><a href="#">Environmental Health</a> </span>  <span id="spanright"> 25</span></li>
<li><span id="spanleft"><a href="#">Health Promotion</a> </span>  <span id="spanright"> 25</span></li>
<li>List All Health Topics</li>
</ul>
</li>




 </ul><!--end column2-->


<div id="sidebarhome">



<div id="category-box1-1" class="category-box"><h3>MDG Indicators - 2010</h3>
<ul>
<li><span id="spanleftw">Poverty gap ratio</span>  <span id="spanright">0.4</span></li>
<li><span id="spanleftw">Proportion of population below $1</span>  <span id="spanright">6.8</span></li>
<li><span id="spanleftw">Under-five mortality rate (Per 1000)</span>  <span id="spanright">29</span></li>
<li><span id="spanleftw">Infant mortality rate (Per 1000)</span>  <span id="spanright">20</span></li>
<li><span id="spanleftw">Maternal mortality ratio per 100000</span>  <span id="spanright">58</span></li>
<li><span id="spanleftw">Adolescent birth rate per 1000</span>  <span id="spanright">06</span></li>
</ul>


</div>


<div id="category-box1-1" class="category-box">
<h3>Recent Judgments</h3>
<div class="widget-content">
<ul>
<li><a href="http://www.duretechnologies.com/samples/global/africa/comoros/amnesty-international-ors-v-sudan/" title="Amnesty International &amp; Ors. v. Sudan">Amnesty International &#038; Ors. v. Sudan</a></li>
<li><a href="http://www.duretechnologies.com/samples/global/africa/ethiopia/aminu-kazeem-v-nigeria/" title="Aminu, Kazeem v. Nigeria">Aminu, Kazeem v. Nigeria</a></li>
<li><a href="http://www.duretechnologies.com/samples/global/africa/djibouti/alhaji-dikko-setto-v-motsibbe-anor/" title="Alhaji Dikko Setto v. Motsibbe &amp; Anor">Alhaji Dikko Setto v. Motsibbe &#038; Anor</a></li><li><a href="http://www.duretechnologies.com/samples/global/africa/comoros/amnesty-international-ors-v-sudan/" title="Amnesty International &amp; Ors. v. Sudan">Amnesty International &#038; Ors. v. Sudan</a></li>
<li><a href="http://www.duretechnologies.com/samples/global/africa/ethiopia/aminu-kazeem-v-nigeria/" title="Aminu, Kazeem v. Nigeria">Aminu, Kazeem v. Nigeria</a></li>
<li><a href="http://www.duretechnologies.com/samples/global/africa/djibouti/alhaji-dikko-setto-v-motsibbe-anor/" title="Alhaji Dikko Setto v. Motsibbe &amp; Anor">Alhaji Dikko Setto v. Motsibbe &#038; Anor</a></li>
</ul>
</div>









	<div class="clear"></div>

</div><!--end #columns-->


<?php get_footer(); ?>

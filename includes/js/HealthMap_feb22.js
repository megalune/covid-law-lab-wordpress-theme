
function mouseOutHander(id){

if ($('#'+id).is(':hover')) {
	document.getElementById(id).style.display="";
    }
}

function mouseOutHander(){


var browserName=navigator.appName; 
if (browserName!="Microsoft Internet Explorer"){

if ( !($('#id_ht:hover').length != 0) && !($('#id_hr:hover').length != 0)  && !($('#id_healthtopics:hover').length != 0) && !($('#id_humanrights:hover').length != 0) ) {
	document.getElementById('id_healthtopics').style.display="";
	document.getElementById('id_humanrights').style.display="";
    }
}
}


$(".id_ht").mouseout(function(e)
    {
	document.getElementById('id_healthtopics').style.display="";
	document.getElementById('id_humanrights').style.display="";

    });
    
$(".id_hr").mouseout(function(e)
    {
	document.getElementById('id_healthtopics').style.display="";
	document.getElementById('id_humanrights').style.display="";
    });



function fadeIn(id){

$("#"+id).fadeIn(0);
//$("#"+id).show();
//document.getElementById(id).style.opacity="1";


//document.getElementById(id).style.display="block !important";
//document.getElementById(id).style.visibility="visible !important";

}

function fadeOut(id){
$("#"+id).fadeOut(0);
document.getElementById(id).style.display="none";

//$("#"+id).hide();
//document.getElementById(id).style.visibility="hidden !important";
//document.getElementById(id).style.opacity="0 !important";
//document.getElementById(id).style.display="none !important";

}


/* Declare Variables here*/
var map;
var Color ;
var countries = [];
var categoryId ;
var myOptions = {
	zoom:zoomValue,
	minZoom:2,
	maxZoom:5,
	streetViewControl: false,
	center: new google.maps.LatLng(latitude, longitude),
	mapTypeControl: false,
	mapTypeIds: 'ROADMAP'
  };

var styles = [
	  {
	    "featureType": "landscape",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "administrative",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "poi",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "road",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "landscape",
	    "elementType": "labels",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "water",
	    "stylers": [
	      { "color": "#ffffff" }
	    ]
	  }
	];


/*initilize function*/
      function initialize() {
      loadmap(null,null);
      }


      function loadmap(category,catId){
 	categoryId = catId;
      fadeOut('id_healthtopics');
      fadeOut('id_humanrights');
//alert(document.getElementById('id_healthtopics').className);

 map = new google.maps.Map(document.getElementById('map_canvas'),myOptions);

 var styledMapOptions  = new google.maps.StyledMapType(styles,{name: "Styled Map"});

 var jayzMapType = new google.maps.StyledMapType(styles, styledMapOptions);

 map.mapTypes.set('custom_map_style', jayzMapType);

 map.setMapTypeId('custom_map_style');


        if(continent !=''){
        var query = "SELECT Name,geometry,Judgements,Color,Region FROM 1TLfxbCPGfWw6aDQUcM0aLDrXyx6-j23navURwSM where Region ='"+continent+"'";
        } else {
        var query = 'SELECT Name,geometry,Judgements,Color,Region FROM 1TLfxbCPGfWw6aDQUcM0aLDrXyx6-j23navURwSM';
        }
        
	document.getElementById("category_label").innerHTML = "";

	if(category !=null && continent !=''){
	query = "SELECT Name,geometry,Count as Judgements,Color,Region FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI WHERE Category = '"+ category +"' AND Region ='"+continent+"'";
	document.getElementById("category_label").innerHTML = "<li style='float:right;'><a href='#' onclick='loadmap(null,null);'><b>Clear Filter</b></a></li><li style='float:right;'><a href='#' style='cursor:default;background-color:white;color:#900;'><b>"+category+"</b></a></li>";
	} else if(category !=null && continent ==''){
	query = "SELECT Name,geometry,Count as Judgements,Color,Region FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI WHERE Category = '"+ category +"'";
	document.getElementById("category_label").innerHTML = "<li style='float:right;'><a href='#' onclick='loadmap(null,null);'><b>Clear Filter</b></a></li><li style='float:right;'><a href='#' style='cursor:default;background-color:white;color:#900;'><b>"+category+"</b></a></li>";
	}

        
        if(category !=null || continent!=''){

	if(continent=='' && category !=null){
	var query1 = "SELECT Name,geometry FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI";
	} else if ( continent!='' && category !=null ) {
	var query1 = "SELECT Name,geometry FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI";// WHERE ISO2 NOT IN (SELECT ISO2 FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI WHERE Category equal to '"+ category +"' and Region equal to '"+continent+"')";
	} else if (continent!='' && category ==null ){
	var query1 = "SELECT Name,geometry FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI";// WHERE Region not equal to '"+continent+"'";
	}
	}
      	


	$.getJSON('https://www.googleapis.com/fusiontables/v1/query?sql='+query+'&key=AIzaSyAmfdhVdvTblpff4EOz2Kve9RIEPQNtifE', function(data) {
        drawMap(data);
        
        if(query1!=null){
		$.getJSON('https://www.googleapis.com/fusiontables/v1/query?sql='+query1+'&key=AIzaSyAmfdhVdvTblpff4EOz2Kve9RIEPQNtifE', function(data) {
		drawMap2(data);
		      });
	      }

      });
      
      	
      
      }

      function drawMap(data) {
      countries = [];
        var rows = data['rows'];
        for (var i in rows) {
          countries[i] = rows[i][0];
          if (rows[i][0] != 'Antarctica') {
            var newCoordinates = [];

            var geometries = rows[i][1]['geometries'];
            if (geometries) {
              for (var j in geometries) {
                newCoordinates.push(constructNewCoordinates(geometries[j]));
				  Country = rows[i][0];
				  Judgements = rows[i][2];
				  Color = rows[i][3];
				  Region = rows[i][4];

              }
            } else {
              newCoordinates = constructNewCoordinates(rows[i][1]['geometry']);
              Country = rows[i][0];
              Judgements = rows[i][2];
              Color = rows[i][3];
              Region = rows[i][4];

            }

			var Country ;
			var Judgements;
			var Region;
			
            var country = new google.maps.Polygon({
              paths: newCoordinates,
              strokeColor: Color,
              judgements: Judgements,
              region:Region,
              country: Country,
              strokeOpacity: 1,
              strokeWeight: .25,
              strokeColor: '#FFFFFF',
              fillColor: Color,
              fillOpacity: 1
            });

            google.maps.event.addListener(country, 'mouseover', function() {
            Country = this.country;
            Region = this.region;
            Judgements = this.judgements;

 	      tooltip.show(this.country+"<p>"+this.judgements + " Judgment(s)");

              this.setOptions({fillOpacity: 0.5});
            });
            google.maps.event.addListener(country, 'mouseout', function() {
              tooltip.hide();
              this.setOptions({fillOpacity: 1});
            });

                  	google.maps.event.addListener(country, 'dbclick', function(event) {
				        
				        //if(categoryId !=null){
				        if(Judgements !=0){
				        window.location.href = "http://https://www.globalhealthrights.org/category/"+Region.toLowerCase()+"/"+Country.toLowerCase().replace(' ','-').replace(' ','-').replace(' ','-')+"/?cat="+categoryId+"&sort=wpcf-j-year&order=DESC&label="+categoryId;
				  	}
				  	//} else {
				  	//window.location.href = "http://https://www.globalhealthrights.org/category/"+Region.toLowerCase()+"/"+Country.toLowerCase()+"/?sort=wpcf-j-year&order=DESC";
				  	//}
				  	return false;
				  	  });
				  	  google.maps.event.addListener(country, 'click', function(event) {
						
					//if(categoryId !=null){
				        if(Judgements !=0){
				        window.location.href = "/category/"+Region.toLowerCase()+"/"+Country.toLowerCase().replace(' ','-').replace(' ','-').replace(' ','-')+"/?cat="+categoryId+"&sort=wpcf-j-year&order=DESC&label="+categoryId;
				  	}
				  	//} else {
				  	//window.location.href = "/category/"+Region.toLowerCase()+"/"+Country.toLowerCase()+"/?sort=wpcf-j-year&order=DESC";
				  	//}
				  	
				  	return false;
				  	  });

            country.setMap(map);
          }
        }

      }


            function drawMap2(data) {
	    var paintedCountries = [];      
                
	          var rows = data['rows'];
	          for (var i in rows) {
	          if (countries.indexOf(rows[i][0]) == -1 && paintedCountries.indexOf(rows[i][0]) == -1){
	          if (rows[i][0] != 'Antarctica') {
	              var newCoordinates = [];

	              var geometries = rows[i][1]['geometries'];
	              if (geometries) {
	                for (var j in geometries) {
	                  newCoordinates.push(constructNewCoordinates(geometries[j]));
	                }
	              } else {
	                newCoordinates = constructNewCoordinates(rows[i][1]['geometry']);
	              }

	              var country = new google.maps.Polygon({
	                paths: newCoordinates,
	                strokeOpacity: 1,
	                strokeWeight: .09,
	                strokeColor: "black",
	                fillColor: '#E8E8E8',
	                fillOpacity: 1
	              });
              country.setMap(map);
	            }
	          }
	      paintedCountries[i] = rows[i][0];
		    }
	        }




      function constructNewCoordinates(polygon) {
        var newCoordinates = [];
        var coordinates = polygon['coordinates'][0];
        for (var i in coordinates) {
          newCoordinates.push(
              new google.maps.LatLng(coordinates[i][1], coordinates[i][0]));
        }
        return newCoordinates;
      }

      google.maps.event.addDomListener(window, 'load', initialize);
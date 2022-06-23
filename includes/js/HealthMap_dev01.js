
function handleMenuDisplay(id){
/*
document.getElementById(id).style.display= "none";

document.getElementById('id_healthtopics').style.display= "none";
document.getElementById('id_humanrights').style.display= "none";

if(document.getElementById(id).style.display!="block"){

	document.getElementById(id).style.display= "block";
}

*/

}

/* Declare Variables here*/
var map;
var Color ;


/*initilize function*/
      function initialize() {
      loadmap(null);
      }


      function loadmap(category){
          var myOptions = {
		zoom:2,
		minZoom:2,
		maxZoom:5,
		streetViewControl: false,
		center: new google.maps.LatLng(19, 17),
		mapTypeControl: false,
		mapTypeIds: 'ROADMAP'
		  };


        var styles = [
		  {
		    "featureType": "landscape.natural.landcover",
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


 map = new google.maps.Map(document.getElementById('map_canvas'),myOptions);

 var styledMapOptions  = new google.maps.StyledMapType(styles,{name: "Styled Map"});

 var jayzMapType = new google.maps.StyledMapType(styles, styledMapOptions);

 map.mapTypes.set('custom_map_style', jayzMapType);

 map.setMapTypeId('custom_map_style');


        // Initialize JSONP request
        var script = document.createElement('script');
        var url = ['https://www.googleapis.com/fusiontables/v1/query?'];
        url.push('sql=');
        var query = 'SELECT Name, geometry,Judgements,Color,Region FROM 1FjW_hmlFoEkJgCaMkDgq0nJvjH2CfwiwrtfbLio';

	document.getElementById("category_label").innerHTML = "";

	if(category !=null){
	query = query + " where Category = '"+ category +"'";
	document.getElementById("category_label").innerHTML = "<li style='float:right;'><a href='#' onclick='loadmap(null);'><b>Clear Filter</b></a></li><li style='float:right;'><a href='#' ><b>"+category+"</b></a></li>";
	
	}

        var encodedQuery = encodeURIComponent(query);
        url.push(encodedQuery);
        url.push('&callback=drawMap');
        url.push('&key=AIzaSyAmfdhVdvTblpff4EOz2Kve9RIEPQNtifE');
        script.src = url.join('');
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(script);
        
/*	//part 2
	var script_2 = document.createElement('script');
	var url_2 = ['https://www.googleapis.com/fusiontables/v1/query?'];
	url_2.push('sql=');
	var query = "SELECT Name, geometry,Judgements,Color,Region FROM 1FjW_hmlFoEkJgCaMkDgq0nJvjH2CfwiwrtfbLio";

	if(category !=null){
	query = query + " where Category NOT EQUAL TO '"+ category +"'";
	}

	var encodedQuery_2 = encodeURIComponent(query);
	url.push(encodedQuery_2);
	url.push('&callback=drawMap');
	url.push('&key=AIzaSyAmfdhVdvTblpff4EOz2Kve9RIEPQNtifE');
	script_2.src = url.join('');
	var body_2 = document.getElementsByTagName('body')[0];
	body_2.appendChild(script_2);
*/
        
        
        
        
        
        
        
      }

      function drawMap(data) {
        var rows = data['rows'];
        for (var i in rows) {
          if (rows[i][0] != 'Antarctica') {
            var newCoordinates = [];

            var geometries = rows[i][1]['geometries'];
            if (geometries) {
              for (var j in geometries) {
                newCoordinates.push(constructNewCoordinates(geometries[j]));
				  Color = rows[i][3];
				  Judgements = rows[i][2];
				  Country = rows[i][0];
				  Region = rows[i][4];

              }
            } else {
              newCoordinates = constructNewCoordinates(rows[i][1]['geometry']);
              Color = rows[i][3];
              Judgements = rows[i][2];
              Country = rows[i][0];
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
              strokeOpacity: 0,
              strokeWeight: 0,
              fillColor: Color,
              fillOpacity: 1
            });
            google.maps.event.addListener(country, 'mouseover', function() {
            Country = this.country;
            Region = this.region;

 	      tooltip.show(this.country+"<p>"+this.judgements + " Judgments");

              this.setOptions({fillOpacity: 0.5});
            });
            google.maps.event.addListener(country, 'mouseout', function() {
              tooltip.hide();
              this.setOptions({fillOpacity: 1});
            });

                  	google.maps.event.addListener(country, 'dbclick', function(event) {
				        window.location.href = "http://www.duretechnologies.com/samples/global/category/"+Region.toLowerCase()+"/"+Country.toLowerCase()+"/?sort=wpcf-j-year&order=DESC";
				  	return false;
				  	  });
				  	  google.maps.event.addListener(country, 'click', function(event) {
						window.location.href = "http://www.duretechnologies.com/samples/global/category/"+Region.toLowerCase()+"/"+Country.toLowerCase()+"/?sort=wpcf-j-year&order=DESC";
				  	return false;
				  	  });

            country.setMap(map);
          }
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

function fadeIn(id){
$("#"+id).fadeIn(0);
}

function fadeOut(id){
$("#"+id).fadeOut(0);
}


/* Declare Variables here*/
var map;
var Color ;

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
      loadmap(null);
      }


      function loadmap(category){
      fadeOut('id_healthtopics');
      fadeOut('id_humanrights');

 map = new google.maps.Map(document.getElementById('map_canvas'),myOptions);

 var styledMapOptions  = new google.maps.StyledMapType(styles,{name: "Styled Map"});

 var jayzMapType = new google.maps.StyledMapType(styles, styledMapOptions);

 map.mapTypes.set('custom_map_style', jayzMapType);

 map.setMapTypeId('custom_map_style');


        // Initialize JSONP request
        var script = document.createElement('script');
        var url = ['https://www.googleapis.com/fusiontables/v1/query?'];
        url.push('sql=');
        if(continent !=''){
        var query = "SELECT Name,geometry,Judgements,Color,Region FROM 1TLfxbCPGfWw6aDQUcM0aLDrXyx6-j23navURwSM where Region ='"+continent+"' ";
        } else {
        var query = 'SELECT Name,geometry,Judgements,Color,Region FROM 1TLfxbCPGfWw6aDQUcM0aLDrXyx6-j23navURwSM';
        }
        
	document.getElementById("category_label").innerHTML = "";

	if(category !=null && continent !=''){
	//query = query + " and Category = '"+ category +"'";
	query = "SELECT Name,geometry,Judgements,Color,Region FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI WHERE Category = '"+ category +"' AND Region ='"+continent+"'";
	document.getElementById("category_label").innerHTML = "<li style='float:right;'><a href='#' onclick='loadmap(null);'><b>Clear Filter</b></a></li><li style='float:right;'><a href='#' style='cursor:default;background-color:white;color:#900;'><b>"+category+"</b></a></li>";
	} else if(category !=null && continent ==''){
	//query = query + " where Category = '"+ category +"'";
	query = "SELECT Name,geometry,Judgements,Color,Region FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI WHERE Category = '"+ category +"'";
	document.getElementById("category_label").innerHTML = "<li style='float:right;'><a href='#' onclick='loadmap(null);'><b>Clear Filter</b></a></li><li style='float:right;'><a href='#' style='cursor:default;background-color:white;color:#900;'><b>"+category+"</b></a></li>";
	}
	alert(query);

        var encodedQuery = encodeURIComponent(query);
        url.push(encodedQuery);
        url.push('&callback=drawMap');
        url.push('&key=AIzaSyAmfdhVdvTblpff4EOz2Kve9RIEPQNtifE');
        script.src = url.join('');
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(script);
        
        if(category !=null || continent!=''){

	var script1 = document.createElement('script');
	var url1 = ['https://www.googleapis.com/fusiontables/v1/query?'];
	url1.push('sql=');
	
	if(continent=='' && category !=null){
	//var query1 = "SELECT Name,geometry FROM 1FjW_hmlFoEkJgCaMkDgq0nJvjH2CfwiwrtfbLio where Category not equal to '"+ category +"'";
	var query1 = "SELECT Name,geometry FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI WHERE Category not equal to '"+ category +"'";
	} else if ( continent!='' && category !=null ) {
	//var query1 = "SELECT Name,geometry FROM 1FjW_hmlFoEkJgCaMkDgq0nJvjH2CfwiwrtfbLio where Category not equal to '"+ category +"' and Region not equal to '"+continent+"'";
	var query1 = "SELECT Name,geometry FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI WHERE Category not equal to '"+ category +"' and Region not equal to '"+continent+"'";
	} else if (continent!='' && category ==null ){
//	var query1 = "SELECT Name,geometry FROM 1FjW_hmlFoEkJgCaMkDgq0nJvjH2CfwiwrtfbLio where Region not equal to '"+continent+"'";
	var query1 = "SELECT Name,geometry FROM 1hD7xFenRJhW2ayuruPHsS56L3R-SsOuNnhwAVCI WHERE Region not equal to '"+continent+"'";
	}
	
	var encodedQuery1 = encodeURIComponent(query1);
	url1.push(encodedQuery1);
	url1.push('&callback=drawMap2');
	url1.push('&key=AIzaSyAmfdhVdvTblpff4EOz2Kve9RIEPQNtifE');
	script1.src = url1.join('');
	var body = document.getElementsByTagName('body')[0];
	body.appendChild(script1);
      	}
      
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

 	      tooltip.show(this.country+"<p>"+this.judgements + " Judgment(s)");

              this.setOptions({fillOpacity: 0.5});
            });
            google.maps.event.addListener(country, 'mouseout', function() {
              tooltip.hide();
              this.setOptions({fillOpacity: 1});
            });

                  	google.maps.event.addListener(country, 'dbclick', function(event) {
				        window.location.href = "http://https://www.globalhealthrights.org/category/"+Region.toLowerCase()+"/"+Country.toLowerCase()+"/?sort=wpcf-j-year&order=DESC";
				  	return false;
				  	  });
				  	  google.maps.event.addListener(country, 'click', function(event) {
						window.location.href = "/category/"+Region.toLowerCase()+"/"+Country.toLowerCase()+"/?sort=wpcf-j-year&order=DESC";
				  	return false;
				  	  });

            country.setMap(map);
          }
        }

      }


            function drawMap2(data) {
	          var rows = data['rows'];
	          for (var i in rows) {
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
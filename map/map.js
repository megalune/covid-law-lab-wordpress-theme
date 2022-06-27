var applicationMAP = {};
applicationMAP.data = '';

applicationMAP.initialise = function () {

    /* Constants */
    applicationMAP.map = null;
    applicationMAP._lat = 19;
    applicationMAP._lng = 17;

//    applicationMAP._lat = -6.664;
//    applicationMAP._lng = -14.765;

    applicationMAP._zoom = 2;
    applicationMAP._minZoom = 2;
    applicationMAP._maxZoom = 5;
    applicationMAP.ggl;
    applicationMAP.check = true;
    applicationMAP.geoJsonLayer = null;
    applicationMAP.geoJsonHolder = null;

    applicationMAP.initialiseMap(); // Initialise the map
    applicationMAP.loadWorldGeoJson(); // Load world shape file
};

// Initialise the map
applicationMAP.initialiseMap = function () {
    applicationMAP.map = new L.Map('map', {
        center: new L.LatLng(applicationMAP._lat, applicationMAP._lng),
        zoom: applicationMAP._zoom,
        minZoom: applicationMAP._minZoom,
        maxZoom: applicationMAP._maxZoom

        /*,
        doubleClickZoom: false,
        scrollWheelZoom: false,
        zoomControl: false,
        boxZoom: false,
        keyboard: false,
        touchZoom: false,
        dragging: false*/
    });

    applicationMAP.loadMapTiles(); // Load map tiles
//    applicationMAP.initialiseMapMenuControl(); // Re-initialise map controls after adding on map
    // new L.Control.Zoom({position: 'bottomright'}).addTo(applicationMAP.map);
};

// Load map tiles
applicationMAP.loadMapTiles = function () {
    // Google Layer
    applicationMAP.ggl = new L.Google();

    applicationMAP.baseMaps = {
        "Google Maps": applicationMAP.ggl
    };

    // applicationMAP.map.addLayer(applicationMAP.ggl);
    applicationMAP.map.invalidateSize();
};

// Get World GEOJSON shape file
applicationMAP.loadWorldGeoJson = function () {

    if (applicationMAP.geoJsonHolder == undefined) {
        $.getJSON('/wp-content/themes/covid/map/world.json', function (geoJsondata) {
            if (geoJsondata != undefined) {
                applicationMAP.geoJsonHolder = geoJsondata;
                if (applicationMAP.map == undefined) {
                    applicationMAP.initialiseMap();
                }
                applicationMAP.showIndicatorDataOnMap();
                $('#loading').hide();
            }
        }).error(function (jqXHR, textStatus, errorThrown) {

            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    } else {
        applicationMAP.showIndicatorDataOnMap();
        $('#loading').hide();
    }
};

applicationMAP.showIndicatorDataOnMap = function () {
    var layerFilter = applicationMAP.filterAttr('iso_a2', false, []);
    applicationMAP.loadlayer(layerFilter);
};

applicationMAP.filterAttr = function (baseKey, apply, container) {
    var layerFilter = {};
    layerFilter.baseKey = baseKey
    layerFilter.apply = apply;
    layerFilter.container = container;
    return layerFilter;
};


applicationMAP.loadlayer = function (layerFilter) {

    applicationMAP.geoJsonLayer = L.geoJson(applicationMAP.geoJsonHolder, {
        filter: function (feature) {
            return applicationMAP.filterLayer(feature, layerFilter);
        },
        style: applicationMAP.setLayerStyle,
        onEachFeature: applicationMAP.setLayerFeature
    });
    applicationMAP.map.addLayer(applicationMAP.geoJsonLayer);
};

applicationMAP.filterLayer = function (feature, layerFilter) {
    var returnFilter = true;
    if (layerFilter.apply) {
        var id = feature.properties[layerFilter.baseKey];
        returnFilter = applicationMAP.idParser(layerFilter.container, id);
    }
    return returnFilter;
};

applicationMAP.idParser = function (container, id) {
    var retCheck = false;
    for (var i in container) {
        if (container.hasOwnProperty(i)) {
            if (container[i] === id) {
                retCheck = true;
                break;
            }
        }
    }
    return retCheck;
};

applicationMAP.setLayerStyle = function (feature) {

    var countryID = feature.properties.iso_a2;

    var fillclr = applicationMAP.getFeatureFillClr(applicationMAP.getFeatureVal(countryID));

    var classNam = 'highlight-' + fillclr.replace(new RegExp('#', 'g'), "");

    if (applicationMAP.filterCatApp) {
        applicationMAP.setFilterCat(classNam, countryID);
    }
    ;
    return {
        color: '#FFF',
        weight: 0.8,
        opacity: 1,
        fillColor: fillclr,
        fillOpacity: 1,
        className: classNam
    };
};

applicationMAP.getFeatureVal = function (id) {
    var returnVal = -1;
    var data = applicationMAP.data({iso2: id}).first();
    // console.log(data);
    if (data.count_total == 0) {
        returnVal = "#999999ff";
    } /* this does the heatmap... else if (data.count_total < 15){
        returnVal = data.color+"77";
    } else if (data.count_total < 40){
        returnVal = data.color+"bb";
    } else {
        returnVal = data.color+"ff";
    }*/
    else {
        returnVal = "#6794DCff";
    }
    if(returnVal == "undefinedff") {
        returnVal = "#999999ff";
    }
    // returnVal = data.color;
    return returnVal;
};

applicationMAP.getFeatureFillClr = function (value) {

    var returnColor = '';
    returnColor = value;
    if (typeof returnColor == 'undefined') {
        returnColor = '#EEEEEE';
    }
    return returnColor;
};

applicationMAP.setFilterCat = function (classNam, id) {
    if (!applicationMAP.filterCat.hasOwnProperty(classNam)) {
        applicationMAP.filterCat[classNam] = [];
    }
    applicationMAP.filterCat[classNam].push(id);
};

applicationMAP.removeLayer = function () {
    if (applicationMAP.geoJsonLayer != undefined) {
        applicationMAP.map.removeLayer(applicationMAP.geoJsonLayer);
    }
};

applicationMAP.setLayerFeature = function (feature, layer) {

    layer.on({
        mouseover: applicationMAP.highlightFeature,
        mouseout: applicationMAP.resetFeature
    });

    $(layer).click(function (e) {
        e.target.unbindLabel();
        var iso2 = e.target.feature.properties.iso_a2;

        var data = applicationMAP.data({iso2: iso2}).first();

        if (data != false) {
            var url = '';

            var region = data.region;
            region = region.toLowerCase();
            region = region.replace(/\s/g, "-");

            // var country = data.country_slug;
            var country = data.name;

            // if (typeof data.category_slug != 'undefined') {
            //     var category = data.category_slug;
            //     url = "/?s=&topic=&country=" + country;
            // } else {
                url = "/?s=&topic=&country=" + country;
            // }

            if (data.count_total > 0) {
                window.location.href = url;
            }

        }

    }).dblclick(function (e) {
       
    });
    
    layer.bindLabel(applicationMAP.getLabelContent(layer), {
        dynamicBorderColor: 'rgba(240, 243, 246, 0.58)',
        direction: 'right',
        //offset:[6, -6],
        opacity: 0.8
        //noHide: true
    });
};

applicationMAP.highlightFeature = function (e) {
    var layer = e.target;

    layer.setStyle({
        weight: 2,
        color: 'white',
        dashArray: '',
        fillOpacity: 0.8
    });

};

applicationMAP.getLabelContent = function (layer) {

    var layerStyle = applicationMAP.getLayerStyle(layer);
    //applicationMAP.legendControlObj.highLightScale(layerStyle.className, layerStyle.fillColor, 'bold', '10px');
    applicationMAP.labelBorderClr = layerStyle.fillColor;
    var countryId2 = layer.feature.properties.iso_a2;


    var data = applicationMAP.data({iso2: countryId2}).first();

    var countryName = data.country_slug;

    var count = data.count_total;

    var documents = data.count_documents;
    var documents_s = "s";
    if(documents == 1){ documents_s = ""; }

    var reports = data.count_reports;
    var report_text = "";
    if(reports == 1){ 
        report_text = '<br>' + reports + ' Country Report';
    } else if(reports > 1){
        report_text = '<br>' + reports + ' Country Reports';
    }

    var returnContent;

    var metaContent = documents + ' Legal Document' + documents_s + report_text;

    var extContent = '';

    if ($.isEmptyObject(data) == false) {
        return returnContent = applicationMAP.buildHoverPopupHtml(countryName, extContent, metaContent);
    }

};



applicationMAP.buildHoverPopupHtml = function (header, data, metaContent) {
    var html = '<div class="panel panel-info" style="z-index:9999 !important;">' +
            '<div class="panel-heading" style="background-color: #000; color:#fff; padding:10px 12px; line-height: 125%;"><span style="font-size:18px !important;">' + header + '</span><br/>' + metaContent + '</div>' +
            '</div>';

    return html;
};


applicationMAP.resetFeature = function (e) {
    var layerStyle = applicationMAP.getLayerStyle(e.target);
    applicationMAP.geoJsonLayer.resetStyle(e.target);
};


applicationMAP.getLayerStyle = function (layer) {
    var layerStyleObj = {};
    if (layer.options != undefined) {
        layerStyleObj.className = layer.options.className;
        layerStyleObj.fillColor = layer.options.fillColor;
    } else {
        var getLeafletId = layer._leaflet_id;
        var ftrlayer = layer._layers;
        layerStyleObj.className = ftrlayer[getLeafletId - 1].options.className;
        layerStyleObj.fillColor = ftrlayer[getLeafletId - 1].options.fillColor;
    }
    return layerStyleObj;
};

applicationMAP.resetMap = function () {
    applicationMAP.removeLayer();
    applicationMAP.map.setView(new L.LatLng(applicationMAP._lat, applicationMAP._lng), applicationMAP._zoom);
    applicationMAP.loadWorldGeoJson();
};

applicationMAP.getjudgements = function (type, id, name) {
    var data = {};
    if (type != '') {
        data = {'term_id': id};
        $("#category_label").html(name);
        $("#clearfilter").css('display', 'block');
    }

    // applicationMAP.fadeOut('id_healthtopics');
    // applicationMAP.fadeOut('id_humanrights');

    var requestEnvelope = {
        url: '/wp-content/themes/covid/map/items-for-map-reports.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (r) {

            applicationMAP.data = TAFFY(JSON.parse(r));
            
            //console.log(applicationMAP.data().get());
            
            if (type != '') {
                applicationMAP.resetMap();
            } else {
                applicationMAP.initialise();
            }

        },
        error: function (e) {
            failureCallback(e);
        }
    };

    $.ajax(requestEnvelope);
};


applicationMAP.fadeOut = function (id) {
    $("#"+id).fadeOut(0);
    document.getElementById(id).style.display="none";
};

// applicationMAP.clearfilters = function () {
//     $("#category_label").html('');
//     $("#clearfilter").css('display', 'none');
//     applicationMAP.removeLayer();
//     applicationMAP.map.remove();
//     applicationMAP.getjudgements('', '', '');
// };
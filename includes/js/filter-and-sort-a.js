var selectedCategories=[];
var selectedCategoriesLabel="";

/****


*/

if(document.URL.indexOf("/?court=")!=-1){

var tempUrl = document.URL.substring(0,document.URL.indexOf("/?court="));

selectedCategories[0]= tempUrl.substring(tempUrl.lastIndexOf("/")+1,tempUrl.length);


} else if (document.URL.indexOf("/?sort=")!=-1){

var tempUrl = document.URL.substring(0,document.URL.indexOf("/?sort="));

selectedCategories[0]= tempUrl.substring(tempUrl.lastIndexOf("/")+1,tempUrl.length);


}



if(document.URL.indexOf("?category_name=")!=-1){

var tempUrl = document.URL.substring(document.URL.indexOf("?category_name=")+15,document.URL.length );

if(tempUrl.indexOf("&")!=-1){

tempUrl = tempUrl.substring(0,tempUrl.indexOf("&"));

}

selectedCategories = tempUrl.split('+');
} else {

var n = document.URL.charAt(document.URL.length-1);
	if(n=="/"){
	var tempURL = document.URL.substring(0,document.URL.length-1);
	var lastIndex = tempURL.lastIndexOf("/");
	selectedCategories[0] = new Array();
	selectedCategories[0]= tempURL.substring(tempURL.lastIndexOf("/")+1,tempURL.length);
	}

}

$(document).ready(function() {




for(var j =1; j<selectedCategories.length;j++){
	if(selectedCategories.length>j+1){
	selectedCategoriesLabel = selectedCategoriesLabel + "<div style='float:left;'><a href='javascript:void(0);' style='cursor:default;background-color:white;color:#000;'><b>&nbsp;"+ReverseSlugArray[selectedCategories[j]]+",</b></a></div>";
	} else {
	selectedCategoriesLabel = selectedCategoriesLabel + "<div style='float:left;'><a href='javascript:void(0);' style='cursor:default;background-color:white;color:#000;'><b>&nbsp;"+ReverseSlugArray[selectedCategories[j]]+"</b></a></div>";
	}
}


if(selectedCategoriesLabel!=""){
	document.getElementById("clear_label").innerHTML = "<li style='float:left;'><a href='javascript:void(0);' onclick='reload();'><b>Clear Filter</b></a></li>" ;
	
	document.getElementById("category_label").innerHTML = selectedCategoriesLabel ;
}


});


function fadeIn(id){

$("#"+id).fadeIn(0);

}

function mouseOutHander(){

if ( !($('#id_ht:hover').length != 0) && !($('#id_hr:hover').length != 0)  && !($('#id_healthtopics:hover').length != 0) && !($('#id_humanrights:hover').length != 0) ) {
	document.getElementById('id_healthtopics').style.display="";
	document.getElementById('id_humanrights').style.display="";
    }
}



function fadeOut(id){

$("#"+id).fadeOut(0);

}








function reload(){

window.location.href = "/category/?category_name="+selectedCategories[0];

}

function setCatUrl(id){

      fadeOut('id_healthtopics');

      fadeOut('id_humanrights');
var order="";

if(document.URL.indexOf("sort=wpcf-j-year&sortorder=") !=-1){
order = document.URL.substring(document.URL.indexOf("sort=wpcf-j-year&sortorder=")+27,document.URL.indexOf("sort=wpcf-j-year&sortorder=")+30)
if(order=="DES"){
order = "DESC";
}
order  = "&sort=wpcf-j-year&sortorder="+order;
}

if(document.URL.indexOf("court=wpcf-j-court&courtorder=") !=-1){
order = document.URL.substring(document.URL.indexOf("court=wpcf-j-court&courtorder=")+30,document.URL.indexOf("court=wpcf-j-court&courtorder=")+33)
if(order=="DES"){
order = "DESC";
}
order  = "&court=wpcf-j-court&courtorder="+order;
}


var tempURL="";
for(var j =0; j<selectedCategories.length;j++){
	if(tempURL  !=""){
		tempURL = tempURL +"+"+ selectedCategories[j];
	} else {
		tempURL = selectedCategories[j];
	}
}
	if(tempURL.indexOf(SlugArray[CatArray[id]])!=-1){
	window.location.href = "/category/?category_name="+tempURL + order;

	} else	if(tempURL!=""){
	window.location.href = "/category/?category_name="+tempURL+"+"+ SlugArray[CatArray[id]] + order;
	} else {
	window.location.href = "/category/?category_name="+ SlugArray[CatArray[id]] + order;
	}


}



function setHRUrl(id){

      fadeOut('id_healthtopics');

      fadeOut('id_humanrights');
var order="";


if(document.URL.indexOf("sort=wpcf-j-year&sortorder=") !=-1){
order = document.URL.substring(document.URL.indexOf("sort=wpcf-j-year&sortorder=")+27,document.URL.indexOf("sort=wpcf-j-year&sortorder=")+30)
if(order=="DES"){
order = "DESC";
}
order  = "&sort=wpcf-j-year&order="+order;
}

if(document.URL.indexOf("court=wpcf-j-court&courtorder=") !=-1){
order = document.URL.substring(document.URL.indexOf("court=wpcf-j-court&courtorder=")+30,document.URL.indexOf("court=wpcf-j-court&courtorder=")+33)
if(order=="DES"){
order = "DESC";
}
order  = "&court=wpcf-j-court&courtorder="+order;
}


var tempURL="";
for(var j =0; j<selectedCategories.length;j++){
	if(tempURL  !=""){
		tempURL = tempURL +"+"+ selectedCategories[j];
	} else {
		tempURL = selectedCategories[j];
	}

}
	if(tempURL.indexOf(SlugArray[CatArray[id]])!=-1){
	window.location.href = "/category/?category_name="+tempURL + order;

	} else 	if(tempURL!=""){
	window.location.href = "/category/?category_name="+tempURL+"+"+ SlugArray[CatArray[id]] + order;
	} else {
	window.location.href = "/category/?category_name="+ SlugArray[CatArray[id]] + order;
	}

}



function sort(sortBy,orderBy){

fadeOut('id_sort');


if(document.URL.indexOf("sort=")!=-1 && document.URL.indexOf("court=")==-1){


var part1 = document.URL.substring(0,document.URL.indexOf("sort="));
window.location.href = part1 + sortBy+orderBy ;


} else if (document.URL.indexOf("court=")!=-1 && document.URL.indexOf("sort=")==-1){

var part1 = document.URL.substring(0,document.URL.indexOf("court="));
window.location.href = part1 + sortBy+orderBy ;



} else if(document.URL.indexOf("sort=")==-1 && document.URL.indexOf("court=")==-1){
		if(document.URL.indexOf("?")!=-1){
		window.location.href = document.URL+"&"+sortBy+orderBy;
		} else {
		window.location.href = document.URL+"?"+sortBy+orderBy;
		}

}

}

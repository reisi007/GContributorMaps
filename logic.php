<?php
header("Content-Type: text/javascript");
include_once "skills.php";
?>
//GMap
var map;
//Marker[]
var markerArray = new Array();
//Skills[]
var skillArray = new Array();
//Checkbox[]
var checkboxes;
//GeoCoder
var geocoder;
function initialize() {
    //Get all the checkboxes in an array
    checkboxes = {
<?php
foreach($js as $v)
	echo("$v: document.getElementsByName(\"$v\")[0],\n")
?>
    };
    /*//Get map options
    var mapOptions = {
        zoom: 6,
        center: new google.maps.LatLng(50.2612094, 10.962695)
    };
    //Make map
    map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);*/
       map = L.map('map-canvas').setView([50.2612094, 10.962695],6);
       L.tileLayer('https://a.tiles.mapbox.com/v3/mapbox.world-bright/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18
}).addTo(map);
    //Create geocoder
    geocoder = new google.maps.Geocoder();
    //Create markers
    data.forEach(function (entry) {
        // console.log(entry);
        var html = [];
        html.push("<div id='gpopup'><h2><a href='mailto:" + entry.email + "'>" + entry.name + "</a></h2><div id='desc'><ul>");
        var skills = entry.skills;
        <?php
        foreach($js as $v){
        	$txt=str_replace("_"," ",$v);
			echo("if(skills.$v)\n".
        	"\thtml.push('<li>','$txt', '</li>')\n");
		}
        	
        ?>
        html.push("</ul></div></div>");
        geocoder.geocode({ address: entry.location }, function (result, status) {
            if (status == google.maps.GeocoderStatus.OK){
				var marker = L.marker([result[0].geometry.location.lat(),result[0].geometry.location.lng()]).addTo(map).bindPopup(html.join(""));
                markerArray.push(marker);
                skillArray.push(skills);
            } else {
                //Geocode state not OK
                console.log("Geocode status for " + entry.name + " is not valid. Location=" + entry.location);
            }
        });
    });
    //Update markers
    updateMarkers();
} // end initialize
function checkAll() {
	<?php
foreach($js as $v)
echo("checkboxes.$v.checked=true\n");
	?>
    updateMarkers();
}
function unCheckAll() {
    <?php
foreach($js as $v)
echo("checkboxes.$v.checked=false\n");
	?>
    updateMarkers()
}

function isThisShown(skills) {
    var b = <?php
    $first = array_values($js)[0];
     echo("(checkboxes.$first.checked && skills.$first)");
     for($i = 1; $i < count($js); $i++){
	 	$elem = array_values($js)[$i];
	 	echo("\n|| (checkboxes.$elem.checked && skills.$elem)");
	 }?>;
	     b = Boolean(b);
    //console.log("isThisShown:Return " + b)
    return b;
}
function updateMarkers() {
    for (var i = 0; i < markerArray.length; i++) {
        if (isThisShown(skillArray[i]))
            map.addLayer(markerArray[i])
        else
             map.removeLayer(markerArray[i])
    }
}
google.maps.event.addDomListener(window, 'load', initialize);
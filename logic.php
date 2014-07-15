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
    //Get map options
    var mapOptions = {
        zoom: 6,
        center: new google.maps.LatLng(50.2612094, 10.962695)
    };
    //Make map
    map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);
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
        var infowindow = new google.maps.InfoWindow({
            content: html.join("")
        });
        geocoder.geocode({ address: entry.location }, function (result, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var marker = new google.maps.Marker({
                    position: result[0].geometry.location,
                    map: map,
                    title: entry.name
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
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
            markerArray[i].setMap(map);
        else
            markerArray[i].setMap(null);
    }
}
google.maps.event.addDomListener(window, 'load', initialize);
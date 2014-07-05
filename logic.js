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
        base: document.getElementsByName("Base")[0],
        calc: document.getElementsByName("Calc")[0],
        design: document.getElementsByName("Design")[0],
        dev: document.getElementsByName("Development")[0],
        doc: document.getElementsByName("Documentation")[0],
        draw: document.getElementsByName("Draw")[0],
        impress: document.getElementsByName("Impress")[0],
        infra: document.getElementsByName("Infrastructure")[0],
        l10n: document.getElementsByName("Localisation")[0],
        marketing: document.getElementsByName("Marketing")[0],
        math: document.getElementsByName("Math")[0],
        qa: document.getElementsByName("Quality Assurance")[0],
        writer: document.getElementsByName("Writer")[0]
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
        if (skills.base)
            html.push("<li>", "Base", "</li>")
        if (skills.calc)
            html.push("<li>", "Calc", "</li>")
        if (skills.design)
            html.push("<li>", "Design", "</li>")
        if (skills.dev)
            html.push("<li>", "Development", "</li>")
        if (skills.doc)
            html.push("<li>", "Documentation", "</li>")
        if (skills.draw)
            html.push("<li>", "Draw", "</li>")
        if (skills.impress)
            html.push("<li>", "Impress", "</li>")
        if (skills.infra)
            html.push("<li>", "Infrastructure", "</li>")
        if (skills.l10n)
            html.push("<li>", "Localisation", "</li>")
        if (skills.marketing)
            html.push("<li>", "Marketing", "</li>")
        if (skills.math)
            html.push("<li>", "Math", "</li>")
        if (skills.qa)
            html.push("<li>", "Quality Assurance", "</li>")
        if (skills.writer)
            html.push("<li>", "Writer", "</li>")
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
    checkboxes.base.checked = true;
    checkboxes.calc.checked = true;
    checkboxes.design.checked = true;
    checkboxes.dev.checked = true;
    checkboxes.doc.checked = true;
    checkboxes.draw.checked = true;
    checkboxes.impress.checked = true;
    checkboxes.infra.checked = true;
    checkboxes.l10n.checked = true;
    checkboxes.marketing.checked = true;
    checkboxes.math.checked = true;
    checkboxes.qa.checked = true;
    checkboxes.writer.checked = true;
    updateMarkers();
}
function unCheckAll() {
    checkboxes.base.checked = false;
    checkboxes.calc.checked = false;
    checkboxes.design.checked = false;
    checkboxes.dev.checked = false;
    checkboxes.doc.checked = false;
    checkboxes.draw.checked = false;
    checkboxes.impress.checked = false;
    checkboxes.infra.checked = false;
    checkboxes.l10n.checked = false;
    checkboxes.marketing.checked = false;
    checkboxes.math.checked = false;
    checkboxes.qa.checked = false;
    checkboxes.writer.checked = false;
    updateMarkers()
}

function isThisShown(skills) {
    var b = (checkboxes.base.checked && skills.base) ||
        (checkboxes.calc.checked && skills.calc) ||
        (checkboxes.design.checked && skills.design) ||
        (checkboxes.dev.checked && skills.dev) ||
        (checkboxes.doc.checked && skills.doc) ||
        (checkboxes.draw.checked && skills.draw) ||
        (checkboxes.impress.checked && skills.impress) ||
        (checkboxes.infra.checked && skills.infra) ||
        (checkboxes.l10n.checked && skills.l10n) ||
        (checkboxes.marketing.checked && skills.marketing) ||
        (checkboxes.math.checked && skills.math) ||
        (checkboxes.qa.checked && skills.qa) ||
        (checkboxes.writer.checked && skills.writer);

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
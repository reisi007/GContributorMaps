<!DOCTYPE html>
<html>
<head>
    <title>LibreOffice Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="obj.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script src="data.js"></script>
    <script src="logic.js">  </script>
</head>
<body>
    <span class="flex-container">
        <div id="toc"><h1>LibreOffice Contributor Map</h1>
        <table border="0" style="width: 100%"><tr><td>
        <a href="javascript:checkAll()">Show everyone</a></td>
       <td><a href="javascript:unCheckAll()">Hide everyone</a></td></table>
        <br/><div style="padding-left: 20px">
                <?php
                $array = array("Design","Development","Documentation","Infrastructure","Localisation","Marketing","Quality Assurance","Writer","Calc","Impress","Draw","Base","Math");
                asort($array);
                foreach($array as $v)
       echo("<input type='checkbox' name='$v' checked='true' onclick='updateMarkers()'/><label for='$v'>$v</label></br>");
                ?>
                </div>
        </div>
        <div id="map-canvas">  </div>
    </span>
</body>
</html>
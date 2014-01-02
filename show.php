<?php
include("connect.php");
$lat = "";
$long = "";

if(isset($_REQUEST['EMAIL']))
{
    $sql = "SELECT `lat`, `long`, `lastUpdated` FROM `locate`.`userlocation` WHERE `email` = '".$_REQUEST['EMAIL']."'";
    $row = mysql_fetch_array(mysql_query($sql));

    $lat = $row['lat'];
    $long = $row['long'];
    $lastUpdated = $row['lastUpdated'];
    $email = $_REQUEST['EMAIL'];
}
else
{
    header("location:/index.php");
}

?>
<!DOCTYPE xhtml PUBLIC "-//W3C//DTD XHTML 4.01//EN">
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<?php
  # Set some defaults.
  $email = "UNKNOWN";

  if(isset($_REQUEST['EMAIL']))
  {
    $email = $_REQUEST['EMAIL'];
    echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"300; url=/show.php?EMAIL=$email\">\n";
  }

  echo "<title>Following: $email</title>\n";
?>
<script type="text/javascript"
  src="http://maps.google.com/maps/api/js?sensor=true"></script>
<link rel="stylesheet" href="css/map.css" />

<script type="text/javascript">
  var map;
  function initialise() {
<?php

  if((strlen($lat)==0) OR (strlen($long)==0))
  {
    # Bad GPS data in the DB
    echo "document.getElementById(\"map_canvas\").innerHTML=\"<br><br><br><br><center><h1>No GPS DATA found...</h1>\"; \n";
    echo "}\n";
    echo "function doNOTInit() {\n";

    #   dummy data to avoid js errors.
    $lat = 1;
    $long = 1;
  }
  echo "    var latlng = new google.maps.LatLng($lat,$long);\n";
?>
    var myOptions = {
      zoom: 8,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      disableDefaultUI: false
    }

    var showWaterStyles=
    [
      {
        featureType: "water",
        stylers: [
          { visibility: "on" },
          { invert_lightness: true }
        ]
      },{
        featureType: "poi",
        stylers: [
          { visibility: "off" }
        ]
      },{
        featureType: "poi.park",
        stylers: [
          { visibility: "on" }
        ]
      },{
        featureType: "transit.line",
        stylers: [
          { visibility: "off" }
        ]
      }
    ]

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    map.setOptions({styles: showWaterStyles});

    TestMarker();
  }

  function positionError(err) {
    var msg;
    switch(err.code) {
      case err.UNKNOWN_ERROR:
        msg = "Unable to find your location";
        break;
      case err.PERMISSION_DENINED:
        msg = "Permission denied in finding your location";
        break;
      case err.POSITION_UNAVAILABLE:
        msg = "Your location is currently unknown";
        break;
      case err.BREAK:
        msg = "Attempt to find location took too long";
        break;
      default:
        msg = "Location detection not supported in browser";
    }
    document.getElementById('info').innerHTML = msg;
  }

  function contains(array, item) {
      for (var i = 0, I = array.length; i < I; ++i) {
          if (array[i] == item) return true;
        }
        return false;
  }

  // Function for adding a marker to the page.
  function addMarker(location) {
    marker = new google.maps.Marker({
        position: location,
        map: map
    });
  }

  // Testing the addMarker function
  function TestMarker() {
<?php
   #myMarker = new google.maps.LatLng(37.7699298, -122.4469157);
   echo "   myMarker = new google.maps.LatLng($lat, $long);";
?>
       addMarker(myMarker);
  }

</script>
</head>
<body onload="initialise()">
  <div id="map_canvas"></div>
<?php
  echo "  <div id=\"updatedTime\" class=\"lightbox\">Following: $email [Last Updated: $lastUpdated]</div>\n";
?>
</body>
</html>


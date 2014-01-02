<?php
$SESSION_TIMEOUT = 86400; # 24 hours

if(!isset($_SESSION)) { session_start(); }

if(strlen($_SESSION['EMAIL'])<1) {
    header("location:/login.php");

    #   Other ways to do this:
    #header("location:login.php");
    #echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=/login.php?EXPIRED=".time()."\">";
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $SESSION_TIMEOUT)) {
    // last request was more than 24hrs ago
    #echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=/login.php?EXPIRED=".time()."\">";
    header("location:/login.php?EXPIRED=".time());
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
<!DOCTYPE xhtml PUBLIC "-//W3C//DTD XHTML 4.01//EN">
<html>
<head>
<?php
$email = $_SESSION['EMAIL'];
echo "<!-- email: $email --> \n";
echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"300; url=/update.php\">\n";

include("html5head.php");
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Report My Location</title>

<script type="text/javascript"
  src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="geometa.js"></script>
<link rel="stylesheet" href="css/map.css" />


<script type="text/javascript">
  var map;
  function initialise() {
    var latlng = new google.maps.LatLng(-25.363882,131.044922);
    var myOptions = {
      zoom: 4,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      disableDefaultUI: true
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    prepareGeolocation();
    doGeolocation();
  }

  function doGeolocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(positionSuccess, positionError);
    } else {
      positionError(-1);
    }
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

  function positionSuccess(position) {
    // Centre the map on the new location
    var coords = position.coords || position.coordinate || position;
    var latLng = new google.maps.LatLng(coords.latitude, coords.longitude);
    map.setCenter(latLng);
    map.setZoom(12);
    var marker = new google.maps.Marker({
        map: map,
        position: latLng,
        title: 'Why, there you are!'
    });
    document.getElementById('info').innerHTML = 'Looking for <b>' +
        coords.latitude + ', ' + coords.longitude + '</b>...';

    // And reverse geocode.
    (new google.maps.Geocoder()).geocode({latLng: latLng}, function(resp) {
          var place = "You're around here somewhere!";
          if (resp[0]) {
              var bits = [];
              for (var i = 0, I = resp[0].address_components.length; i < I; ++i) {
                  var component = resp[0].address_components[i];
                  if (contains(component.types, 'political')) {
                      bits.push('<b>' + component.long_name + '</b>');
                    }
                }
                if (bits.length) {
                    place = bits.join(' > ');
                }
                marker.setTitle(resp[0].formatted_address);
            }
            document.getElementById('info').innerHTML = place;
      });
    <?php
        echo "     updateGPS('$email', coords.latitude, coords.longitude); \n";
    ?>
  }

  function contains(array, item) {
      for (var i = 0, I = array.length; i < I; ++i) {
          if (array[i] == item) return true;
        }
        return false;
  }

  function updateGPS(email, lat, lng)
  {
    if (email=="")
    {
      document.getElementById("updatedTime").innerHTML="";
      return;
    } 
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("updatedTime").innerHTML=xmlhttp.responseText;
      }
    }
    // u.php?EMAIL=jay@jaynez.com&LAT=48.8567&LONG=2.3508
    xmlhttp.open("GET","u.php?EMAIL="+email+"&LAT="+lat+"&LONG="+lng,true);
    xmlhttp.send();
  }

</script>
</head>
<body onload="initialise()">
<?php
include("menu.php");
?>
  <div id="map_canvas"></div>
  <div id="info" class="lightbox">Detecting your location...</div>
  <div id="updatedTime" class="lightbox"></div>
</body>
</html>


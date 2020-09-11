<?php
// Google Maps Geocoding Example
define("MAPS_HOST", "maps.google.com");
define("KEY", "AIzaSyD7UHLbvkvihwHIQz9dbWuQmtjz4mWxfl0"); // Place your API Key here...
// Get our address (from a database query or POST
$address = "100+Flinders+Street+Melbourne+VIC+3000";
// Build our URL from the above...
$base_url = "http://" . MAPS_HOST . "/maps/geo?q=" . $address . "&output=csv" . "&key=" . KEY;

https://maps.google.com/maps/place/100+Flinders+Street+Melbourne+VIC+3000&output=csv&key=AIzaSyD7UHLbvkvihwHIQz9dbWuQmtjz4mWxfl0
// Initalise CURL
$c = curl_init();
// Get the URL and save the Data
curl_setopt($c, CURLOPT_URL, $base_url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
// Save location data
$csvPosition = trim(curl_exec($c));
// Close the connection
curl_close($c);
// Split pieces of data by the comma that separates them
list($httpcode,$elev, $lat, $long) = split(",", $csvPosition);
?>
<html>
<head>
<title>Google Maps Geocoding PHP Sample - Winsysadminblog.com</title>
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
  function initialize() {
    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>);
    var addressMarker = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>);
    var myOptions = {
      zoom: 16,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);

	marker = new google.maps.Marker({ map:map, position: addressMarker });
  }
</script>
</head>
<body onload="initialize()">
<?php echo $lat; ?>, <?php echo $long; ?>
</body>
</html>
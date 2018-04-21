<?php
require('db_conn.php');

if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    header('location:./Home-Pagee.php');
    exit();
}
?>
<html>
  <head>
    <title>Cookie & Coffee | Set Location</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOVIu6knUo346QUDSIIvte2LNumrER8Jw&callback=initMap">
    </script>
    <script src="js/jquery-3.3.1.min.js"></script>
        
   
    
    
  </head>
  <body>
    
    
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow, pos, marker = null;
      
function placeMarker(location) {
    pos = {
              lat: location.lat(),
              lng: location.lng()
            };
  
    infoWindow.setPosition(pos);
}
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat:  37.4419, lng: 150.644},
          zoom: 10
        });
        
        google.maps.event.addListener(map, 'click', function(event) {
           placeMarker(event.latLng);
        });
        
        var html = "<input type='submit' onclick='loadDoc()' value='Send Location' style='background-color:white;border:none;'/>";
        
        infoWindow = new google.maps.InfoWindow({
        content: html
        });

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent(html);
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }
      
  function loadDoc() {
    $.post("locationPagePHP.php",{
      
      lat: pos.lat,
      lng: pos.lng
      
    },function(result){
      if(result == "1"){
         window.location.href = '/cartDB/Pay-Page.php';
      }else{
        alert("Server ERROR: " + result);
      }
      
    }).fail(function(){
        alert("Connection lost!");
    })
}

    
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
  </body>
</html>


    /*
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(xhttp.responseText == "1"){
        window.location.href = '/cartDB/Pay-Page.html';
      }else{
        alert(xhttp.responseText);
      }
    }
  };
  xhttp.open("POST", "locationPagePHP.php", true);
  xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhttp.send("lat=" + encodeURIComponent(pos.lat) + "&lng=" + encodeURIComponent(pos.lng));
  */
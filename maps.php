<!DOCTYPE html>
<html>
  <head>
    <title>Simple Markers</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCGdG9DWYHvzKCQG8ZuOXhYwNY2Gby04E&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      "use strict";

      function initMap() {
        const myLatLng = {
          lat: NaN,
          lng: NaN
        };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: NaN,
          center: myLatLng,
          fullscreenControl: true,
          zoomControl: true,
          streetViewControl: true
        });
        new google.maps.Marker({
          position: myLatLng,
          map,
          title: "Hello World!"
        });
      }
    </script>
  </head>
  <body>
    <div id="map"></div>
  </body>
</html>
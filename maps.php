<html>
<!-- Mirrored from maxartkiller.com/website/Lemux/lemux-HTML/framworkElements/modal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:57:02 GMT -->
<head>

    <title>EC Tecnologia</title>
	
	
</head>

<body>



<div id="mapa"> </div>
    <!-- Roboto fonts CSS -->
	
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&libraries=&v=weekly"
      defer
    ></script>

        <!-- Arquivo de inicialização do mapa -->
	
<script>
  function init() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: new google.maps.LatLng(51.509865, -0.118092)
    });
    var icon = {
        path: "M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0z", //SVG path of awesomefont marker
        fillColor: '#333333', //color of the marker
        fillOpacity: 1,
        strokeWeight: 0,
        scale: 0.09, //size of the marker, careful! this scale also affects anchor and labelOrigin
        anchor: new google.maps.Point(200,510), //position of the icon, careful! this is affected by scale
        labelOrigin: new google.maps.Point(205,190) //position of the label, careful! this is affected by scale
    }

    var marker = new google.maps.Marker({
      position: map.getCenter(),
      map: map,
      icon: icon,
      label: {
        fontFamily: "'Font Awesome 5 Free'",
        text: '\uf0f9', //icon code
        fontWeight: '900', //careful! some icons in FA5 only exist for specific font weights
        color: '#FFFFFF', //color of the text inside marker
      },
    });
  }
  google.maps.event.addDomListener(window, 'load', init);
</script>	
</body>


<!-- Mirrored from maxartkiller.com/website/Lemux/lemux-HTML/framworkElements/modal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:57:05 GMT -->
</html>

<?

ob_start();

session_start();

require_once("./load/load.php");

//echo $_SESSION['sistema'];
?>
<!doctype html>
<html>
<!-- Mirrored from maxartkiller.com/website/Lemux/lemux-HTML/framworkElements/modal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:57:02 GMT -->
<head>

    <title>EC Tecnologia</title>
	
	
</head>

<body>



<div id="mapa"> </div>

    <link rel="stylesheet" href="template/css/estilos.css">

    <!-- Roboto fonts CSS -->
	
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


    <!-- page level script -->
 
    <!-- Maps API Javascript -->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBppUaO6bff64aKcuZv-CUTUPWOBFW200s&callback=initMap&libraries=&v=weekly" defer></script>

        <!-- Caixa de informação -->
    <script src="template/js/infobox.js"></script>
		
        <!-- Agrupamento dos marcadores -->
	<script src="template/js/markerclusterer.js"></script>
 
        <!-- Arquivo de inicialização do mapa -->
	<script src="template/js/mapa.js"></script>
	
</body>


<!-- Mirrored from maxartkiller.com/website/Lemux/lemux-HTML/framworkElements/modal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:57:05 GMT -->
</html>

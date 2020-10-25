<?

ob_start();

session_start();

require_once("./load/load.php");

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

date_default_timezone_set('America/Cuiaba');
$data = date('Y-m-d');
$hora = date('H:i:s');

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}


if($_SERVER['SERVER_NAME'] == "svsistema.app")
{
	$_SESSION['tipo'] = 1;
}
else if($_SERVER['SERVER_NAME'] == "sistema.sge")
{
	$_SESSION['tipo'] = 2;
}
else if($_SERVER['SERVER_NAME'] == "sistema.sl")
{
	$_SESSION['tipo'] = 3;
}

//echo $_SESSION['sistema'];
?>
<!doctype html>
<html lang="pt-br" class="color-theme-blue">


<!-- Mirrored from maxartkiller.com/website/Lemux/lemux-HTML/introduction.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:56:31 GMT -->
<head>
    <meta charset="iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">

    <title>EC TECNOLOGIA - Equipe cuiabana de Tecnologia da informação</title>
	  <meta name="codelab" content="your-first-pwa-v3">
  <!-- CODELAB: Add iOS meta tags and icons -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="EC Tecnologia">
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
  <!-- CODELAB: Add description here -->
  <meta name="description" content="Equipe cuiabana de Tecnologia da informação">
  <!-- CODELAB: Add meta theme-color -->
  <meta name="theme-color" content="#2F3BA2" />
  
    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="template/vendor/materializeicon/material-icons.css">

    <!-- Roboto fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="template/vendor/bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link href="template/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="template/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Loader -->
    <div class="row no-gutters vh-100 loader-screen">
        <div class="bg-template background-overlay"></div>
        <div class="col align-self-center text-white text-center">
            <img style="height:70px" src="template/images/logo.png" alt="logo">
            <h1 class="mb-0 mt-3">EC </h1>
            <p class="text-mute subtitle"> Tecnologia</p>
            <div class="loader-ractangls">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Loader ends -->

    <!-- wrapper starts -->
    <div class="wrapper bg-template">
        <!-- header -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                </div>
                <div class="col text-center"></div>
                <div class="col-auto">
                    <!--<a href="register.html" class="btn btn-link">Register</a>-->
                </div>
            </div>
        </div>
        <!-- header ends -->
        
        <div class="swiper-container introduction vh-100">
            <div class="swiper-wrapper">
                <div class="swiper-slide overflow-hidden bg-gradient-cyan text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/turtle.png" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">Discover life underwater</h2>
                            <p class="text-mute">Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide overflow-hidden bg-gradient-purple text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/weightless.png" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">Get into the sky far away so far</h2>
                            <p class="text-mute">Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide overflow-hidden bg-gradient-red text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/fruits.png" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">Health is wealth! your presence</h2>
                            <p class="text-mute">Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination bullets-white text-left"></div>
        </div>
        <a href="login.php" class="btn btn-light btn-lg button-fab right-bottom text-uppercase">Login <i class="material-icons vm">arrow_forward</i></a>
    </div>
    <!-- wrapper ends -->


    <!-- jquery, popper and bootstrap js -->
    <script src="template/js/jquery-3.3.1.min.js"></script>
    <script src="template/js/popper.min.js"></script>
    <script src="template/vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="template/vendor/cookie/jquery.cookie.js"></script>

    <!-- swiper js -->
    <script src="template/vendor/swiper/js/swiper.min.js"></script>

    <!-- template custom js -->
    <script src="template/js/main.js"></script>

    <!-- page level script -->
    <script>
        $(window).on('load', function() {
            var swiper = new Swiper('.introduction', {
                pagination: {
                    el: '.swiper-pagination',
                },
            });
        })

    </script>
    <script src="/scripts/luxon-1.11.4.js"></script>
  <script src="/scripts/app.js"></script>
  <!-- CODELAB: Add the install script here -->
  <script src="/scripts/install.js"></script>

  <script>
    // CODELAB: Register service worker.
	if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/service-worker.js')
        .then((reg) => {
          console.log('Service worker registered.', reg);
        });
  });
}
  </script>

</body>


<!-- Mirrored from maxartkiller.com/website/Lemux/lemux-HTML/introduction.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:56:32 GMT -->
</html>

<?

ob_start();

session_start();

//require_once("./load/load.php");

if(Empty($_GET['sistema']))
{
	//if(Empty($_SESSION['nosistema']))
	//{
	?>
	<script>
	$(window).on('load', function() 
	{
    var sistema = localStorage.getItem('sistema');if(sistema === null){}else{ window.location.href="index.php?sistema=" + sistema;}
    });
	</script>
	<?//}
}
else
{
	$_SESSION['nosistema'] = $_GET['sistema'];
}

if(@$_SESSION['nosistema'] == "app")
{
	$_SESSION['nosistema'] = "agsl";
	$_SESSION['nomesoft'] = "Gerenciamento de Sistema";
	$_SESSION['tipo'] = 1;
	
	$sistema = "sistema";
	print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "sge.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.sge")
{
	$_SESSION['nosistema'] = "sge.ectecnologia.com.br/index.php";
	$_SESSION['nomesoft'] = "Sg Escolar";
	$_SESSION['tipo'] = 2;
	
	$sistema = "agsge";
	print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "sl.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.sl")
{
	$_SESSION['nosistema'] = "sl.ectecnologia.com.br/index.php";
	$_SESSION['nomesoft'] = "Sg Hair & Spa";
	$_SESSION['tipo'] = 3;
	
	$sistema = "agsl";
	print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else
{
	header('Location: servicos.php');
}

//echo $_SESSION['sistema'];
?>
<!doctype html>
<html lang="pt-br" class="color-theme-blue">

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
        <?if($_SESSION['tipo'] == 3){?>
        <div class="swiper-container introduction vh-100">
            <div class="swiper-wrapper">
                <!--<div class="swiper-slide overflow-hidden bg-gradient-red text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/cabelos.png" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">O que você procura?</h2>
                             <p class="text-mute">
							 <div style="marigin: 0px">
			                   <input type="text" style="width: 300px; position: absolute; left: 50%; right: 50%;" name="cnome" id="cnome" placeholder="Digite sua cidade" value="" class="form-control" required="required">
		                     </div>
							</p>
                        </div>
                    </div>
                </div>-->
                <div class="swiper-slide overflow-hidden bg-gradient-purple text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/hair.png" height="350px" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">Beleza e seu bem estar em suas mãos.</h2>
                            <p class="text-mute"></p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide overflow-hidden bg-gradient-purple text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/cabelos.png" height="350px" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">Uma experiencia unica!</h2>
                            <p class="text-mute">Encontre os melhores Spa & Cabelereiros.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination bullets-white text-left">teste</div>
        </div>		
		
		<?} else if($_SESSION['tipo'] == 3){?>
        <div class="swiper-container introduction vh-100">
            <div class="swiper-wrapper">
                <div class="swiper-slide overflow-hidden bg-gradient-cyan text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/escolar_01.png" height="350px" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">Descubra como é bom estudar online.</h2>
                            <p class="text-mute"></p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide overflow-hidden bg-gradient-purple text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/escolar_02.png" height="350px" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">Uma experiencia unica!</h2>
                            <p class="text-mute">Estudar online nunca ficou tão facil.</p>
                        </div>
                    </div>
                </div>
                <!--<div class="swiper-slide overflow-hidden bg-gradient-red text-white">
                    <div class="row no-gutters h-100">
                        <div class="col align-self-center text-center">
                            <img src="template/images/fruits.png" alt="" class="mw-100 mx-auto mb-4">
                            <br><br>
                            <h2 class="text-uppercase font-weight-light">Health is wealth! your presence</h2>
                            <p class="text-mute">Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                        </div>
                    </div>
                </div>-->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination bullets-white text-left"></div>
        </div>
		<?}?>
        <a href="login.php" class="btn btn-light btn-lg button-fab right-bottom text-uppercase">Logar <i class="material-icons vm">arrow_forward</i></a>
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
        });

    </script>
</body>
</html>

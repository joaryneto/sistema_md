<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="Bootstrap UI UX, Bootstrap theme, Bootstrap HTML, Bootstrap template, Bootstrap mobile app, multipurpose mobile app template. get bootstrap template, mobile app">
    <meta name="author" content="EC Tecnologia">
    <link rel=icon href="template/layout/demo/assets/img/logo-small.png" sizes="any">

    <title>CERRADUS Peneus</title>


<!-- CODELAB: Add iOS meta tags and icons -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="EC Tecnologia">
	<link rel="apple-touch-icon" sizes="57x57" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/icons/<?=$_SESSION['img'];?>/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/images/icons/<?=$_SESSION['img'];?>/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/icons/<?=$_SESSION['img'];?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/images/icons/<?=$_SESSION['img'];?>/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/icons/<?=$_SESSION['img'];?>/favicon-16x16.png">
	<link rel="manifest" href="/manifest6.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/images/icons/<?=$_SESSION['img'];?>/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- CODELAB: Add description here -->
	<meta name="description" content="Equipe cuiabana de Tecnologia da informação">
	<!-- CODELAB: Add meta theme-color -->
	<meta name="theme-color" content="#2F3BA2" />
	
    <!-- material icons stylesheet -->
    <link href="template/layout/demo/assets/vendor/materializeicon/material-icons.css" rel="stylesheet">

    <!-- bootstrap stylesheet -->
    <link href="template/layout/demo/assets/vendor/bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- swiper stylesheet -->
    <link href="template/layout/demo/assets/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- template stylesheet -->
    <link href="template/layout/demo/assets/css/style.css" rel="stylesheet" id="style">

</head>

<body class="ui-rounded" data-page="homepage">
    <div class="container-fluid h-100 pageloader">
        <div class="row h-100">
            <div class="col-12 align-self-center">
                <figure class=" logo-landing mb-4 mx-auto">
                </figure>
                <h2 class="text-uppercase font-weight-medium text-white"></h2>
                <p class="text-white text-mute"></p>
                <br>
                <div class="spinner-border text-light" role="status">
                    <span class="sr-only">Aguarde...</span>
                </div>
            </div>
        </div>
    </div>

    <div class="background reveal-background">
        <img src="template/layout/demo/assets/img/image7.jpg" alt="">
    </div>

    <!-- sidebar left -->
    <div class="sidebar sidebar-left overlay-sidebar">
        <div class="content">
            <figure class="avatar avatar-100 rounded-circle has-background mx-auto username">
                <div class="background">
                    <img src="template/layout/demo/assets/img/image4.jpg" alt="">
                </div>
            </figure>
            <h5 class="text-center mb-0 username-text">EC Tecnologia</h5>
            <p class="text-center small text-mute username-text">Cuiabá, Brasil</p>

            <div class="list-group list-group-flush nav-list">
                <a href="index.html" class="list-group-item list-group-item-action active"><i class="material-icons">store</i> <span class="text-link">Home</span></a>
                <a href="#" class="list-group-item text-danger"><i class="material-icons">exit_to_app</i> <span class="text-link">Deslogar</span></a>
            </div>
        </div>

    </div>
    <!-- sidebar left -->

    <!-- main container -->
    <div class="main-container">
        <header class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn btn-link menu-btn-left"><i class="material-icons">menu</i></button>
                </div>
                <div class="col">
                    <div class="logo-header">
                        <img src="template/layout/demo/assets/img/logo-small.svg" alt="" class="logo-img">
                        <h5 class="logo-header-text"><span class="text-uppercase">Loja móvel</span><br><small>Modelo para celular</small></h5>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-link"><i class="material-icons">favorite_border</i></a>
                    <a href="#" class="btn btn-link">
                        <i class="material-icons">notifications_none</i>
                        <span class="notification-point"></span>
                    </a>
                </div>
            </div>
        </header>
        <div class="content container-fluid">
            <!-- page content start -->

            <div class="tab-content" id="maintabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<div class="row my-3">
                        <div class="container">
                            <div class="card bg-default-light">
                                <div class="card-body p-1">
                                    <div class="media">
                                        <input type="text" class="form-control form-control-lg search bottom-25 position-relative border-0" placeholder="Busca Rápida de produtos">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="container px-0">
                            <!-- Swiper --
                            <div class="swiper-container offerslidetab1 my-3">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-default">
                                            <div class="background opacity-30">
                                                <img src="template/layout/demo/assets/img/image8.jpg" alt="">
                                            </div>
                                            <div class="card-body">
                                                <h3 class="font-weight-normal">50% off<br>Coleção de inverno</h3>
                                                <p class="text-mute">Melhor produto e coleções</p>
                                                <div class="text-right">
                                                    <a href="" class="btn btn-sm btn-white text-uppercase">Mostre agora</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-primary text-white">
                                            <div class="background opacity-30">
                                                <img src="template/layout/demo/assets/img/image9.jpg" alt="">
                                            </div>
                                            <div class="card-body">
                                                <h3 class="font-weight-normal">10% Instant<br>em cartões</h3>
                                                <p class="text-mute">Melhor produto e coleções</p>
                                                <div class="text-right">
                                                    <a href="" class="btn btn-sm btn-white text-uppercase">Mostre agora</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-default text-white">
                                            <div class="background opacity-30">
                                                <img src="template/layout/demo/assets/img/image8.jpg" alt="">
                                            </div>
                                            <div class="card-body">
                                                <h3 class="font-weight-normal">40% plano<br>Off on Adidas </h3>
                                                <p class="text-mute">Melhor produto e coleções</p>
                                                <div class="text-right">
                                                    <a href="" class="btn btn-sm btn-white text-uppercase">Mostre agora</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Pagination --
                                <div class="swiper-pagination white-pagination text-left mb-3"></div>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="container px-0">
                            <!-- Swiper -->
                            <div class="swiper-container categoriestab1 text-center">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/162.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">Passeio</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/180.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">Utilitário</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/171.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">Pick UPs e SUVs</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/178.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">OFF-ROAD</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/178.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">Caminhões</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/163.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">Agrícola</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/173.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">Industrial</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/155.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">Rodas</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="avatar avatar-80 has-background mb-2 rounded">
                                            <div class="background">
                                                <img src="template/layout/demo/assets/images/16.jpg" alt="">
                                            </div>
                                        </div>
                                        <p class="text-uppercase small">Nossos Serviços</p>
                                    </div>
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination white-pagination text-left mb-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container-fluid bg-purple-light">
                            <div class="row no-gutters">
                                <div class="col-7 py-4">
                                    <h3 class="font-weight-normal">Use temporadas inteligentes</h3>
                                    <p class="text-mute"></p>
                                    <a href="" class="btn btn-sm btn-default text-uppercase">Mostre agora</a>
                                </div>
                                <div class="col-5 align-self-end text-center">
                                    <img src="template/layout/demo/assets/img/offerimage1.png" alt="" class="mw-100">
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="row my-3">
                        <div class="container px-0">
                            <!-- Swiper -->
                            <div class="swiper-container offerslide2tab1 text-center">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-default">
                                            <div class="background opacity-40">
                                                <img src="template/layout/demo/assets/images/155.jpg" alt="">
                                            </div>
                                            <div class="card-body py-5">
                                                <h3 class="font-weight-normal">Pneus <br> Passeio</h3>
                                                <p class="text-mute">Até 70% off</p>
                                                <a href="" class="btn btn-sm btn-default text-uppercase mt-3">Mostre agora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-primary text-white">
                                            <div class="background opacity-40">
                                                <img src="template/layout/demo/assets/images/171.jpg" alt="">
                                            </div>
                                            <div class="card-body py-5">
                                                <h3 class="font-weight-normal">Pneus <br>Pick UPs e SUVs</h3>
                                                <p class="text-mute">Até 70% off</p>
                                                <a href="" class="btn btn-sm btn-default text-uppercase mt-3">Mostre agora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-default text-white">
                                            <div class="background opacity-40">
                                                <img src="template/layout/demo/assets/images/180.jpg" alt="">
                                            </div>
                                            <div class="card-body py-5">
                                                <h3 class="font-weight-normal">Pneus <br>Agrícola </h3>
                                                <p class="text-mute">Até 70% off</p>
                                                <a href="" class="btn btn-sm btn-default text-uppercase mt-3">Mostre agora</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination white-pagination text-left mb-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container bg-default-light py-3">
                            <!-- Swiper -->
                            <div class="swiper-container categories2tab1 text-center">
                                <div class="swiper-wrapper">
                                    <!--<div class="swiper-slide">
                                        <button class="btn btn-sm btn-white active">Everything</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white">Bottom Wear</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white">Top Wear</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white">Trouser</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white">Shoes</button>
                                    </div>-->
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination white-pagination text-left mb-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons">favorite_border</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <a href="product.html" class="background">
                                                    <img src="template/layout/demo/assets/images/77.jpg" alt="">
                                                </a>
                                            </div>
                                            <small class="text-mute">Pick UPs e SUVs</small>
                                            <a href="product.html">
                                                <p class="mb-0">Pneu 295/75 Aro 16 123P ALL TERRAIN BFGoodrich</p>
                                            </a>
                                            <p class="small">R$ 39.99</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded text-danger"><i class="material-icons ">favorite</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/62.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Pick UPs e SUVs</small>
                                            <p class="mb-0">Pneu 245/70 R16 107H R620 Ling Long</p>
                                            <p class="small">R$ 49.99</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded text-danger"><i class="material-icons">favorite</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/47.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Pick UPs e SUVs</small>
                                            <p class="mb-0">Pneu 265/50 R20 111W A Dvan ST Yokohama</p>
                                            <p class="small">R$ 28.99</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons ">favorite_border</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/39.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Passeio</small>
                                            <p class="mb-0">Pneu 175/70 R13 82T Green-Max Ecotouring Ling Long</p>
                                            <p class="small">R$ 35.99</p>
                                        </div>
                                    </div>
                                </div>
								<div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons ">favorite_border</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/39.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Passeio</small>
                                            <p class="mb-0">Pneu 175/70 R13 82T Green-Max Ecotouring Ling Long</p>
                                            <p class="small">R$ 35.99</p>
                                        </div>
                                    </div>
                                </div>
								<div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons ">favorite_border</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/39.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Passeio</small>
                                            <p class="mb-0">Pneu 175/70 R13 82T Green-Max Ecotouring Ling Long</p>
                                            <p class="small">R$ 35.99</p>
                                        </div>
                                    </div>
                                </div>
								<div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons ">favorite_border</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/39.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Passeio</small>
                                            <p class="mb-0">Pneu 175/70 R13 82T Green-Max Ecotouring Ling Long</p>
                                            <p class="small">R$ 35.99</p>
                                        </div>
                                    </div>
                                </div>
								<div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons ">favorite_border</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/39.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Passeio</small>
                                            <p class="mb-0">Pneu 175/70 R13 82T Green-Max Ecotouring Ling Long</p>
                                            <p class="small">R$ 35.99</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center my-3">
                        <div class="col-6 col-md-4 col-lg-3 mx-auto">
                            <button class="btn btn-sm btn-light btn-block">Mostre tudo</button>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container">
                            <div class="card bg-default-light">
                                <div class="card-body p-1">
                                    <div class="media">
                                        <div class="icon icon-50 bg-white text-default mr-2"><i class="material-icons">local_offer</i></div>
                                        <div class="media-inner">
                                            <h5 class="mb-0 font-weight-normal">Desconto instantâneo de <b>10%</b></h5>
                                            <p><small class="text-mute">em todos os cartões de crédito e débito</small></p>
                                        </div>
                                        <div class="align-self-center ml-auto ">
                                            <div class="btn text-default"><i class="material-icons">arrow_forward</i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
                    <div class="row">
                        <div class="container">
                            <div class="form-group float-label position-relative">
                                <div class="bottom-right ">
                                    <a href="" class="btn btn-sm btn-link text-dark btn-rounded text-mute"><i class="material-icons">mic</i></a>
                                    <a href="" class="btn btn-sm btn-link text-dark btn-rounded text-mute"><i class="material-icons">camera_alt</i></a>
                                </div>
                                <input type="text" class="form-control ">
                                <label class="form-control-label">Procurar</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <h5 class="page-title">Ofertas de atendimento</h5>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container px-0">
                            <!-- Swiper -->
                            <div class="swiper-container offerslide2tab2 text-center">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-default">
                                            <div class="background opacity-40">
                                                <img src="template/layout/demo/assets/images/image6.jpg" alt="">
                                            </div>
                                            <div class="card-body py-5">
                                                <h3 class="font-weight-normal">Pneus<br> Passeio</h3>
                                                <p class="text-mute">Até 70% de desconto</p>
                                                <a href="" class="btn btn-sm btn-default text-uppercase mt-3">Mostre agora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-primary text-white">
                                            <div class="background opacity-40">
                                                <img src="template/layout/demo/assets/images/image4.jpg" alt="">
                                            </div>
                                            <div class="card-body py-5">
                                                <h3 class="font-weight-normal">Pneus<br> Pick UPs e SUVs</h3>
                                                <p class="text-mute">Até 70% de desconto</p>
                                                <a href="" class="btn btn-sm btn-default text-uppercase mt-3">Mostre agora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card has-background border-0 bg-default text-white">
                                            <div class="background opacity-40">
                                                <img src="template/layout/demo/assets/images/image1.jpg" alt="">
                                            </div>
                                            <div class="card-body py-5">
                                                <h3 class="font-weight-normal">Pneus<br> Agrícola</h3>
                                                <p class="text-mute">Até 70% de desconto</p>
                                                <a href="" class="btn btn-sm btn-default text-uppercase mt-3">Mostre agora</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination white-pagination text-left mb-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <h5 class="page-title">Ofertas de atendimento</h5>
                                </div>
                                <div class="col-auto align-self-end">
                                    <button class="btn btn-sm btn-link text-dark btn-rounded text-mute menu-btn-right"><i class="material-icons">tune</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="row my-3">
                        <div class="container bg-default-light py-3">
                            <!-- Swiper --
                            <div class="swiper-container categories2tab2 text-center">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white active">Tudo</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white">Desgaste inferior</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white">Top Wear</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white">Calça</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button class="btn btn-sm btn-white">Sapato</button>
                                    </div>
                                </div>
                                <!-- Add Pagination --
                                <div class="swiper-pagination white-pagination text-left mb-3"></div>
                            </div>
                        </div>
                    </div>-->
                    <div class="row my-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons">favorite_border</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <a href="product.html" class="background">
                                                    <img src="template/layout/demo/assets/images/162.jpg" alt="">
                                                </a>
                                            </div>
                                            <small class="text-mute">Passeio</small>
                                            <a href="product.html">
                                                <p class="mb-0">Pneu 295/75 Aro 16 123P ALL TERRAIN BFGoodrich</p>
                                            </a>
                                            <p class="small">R$ 39.99</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded text-danger"><i class="material-icons ">favorite</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/161.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Pick UPs e SUVs</small>
                                            <p class="mb-0">Pneu 295/75 Aro 16 123P ALL TERRAIN BFGoodrich</p>
                                            <p class="small">R$ 49.99</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded text-danger"><i class="material-icons">favorite</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/160.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Pick UPs e SUVs</small>
                                            <p class="mb-0">Pneu 295/75 Aro 16 123P ALL TERRAIN BFGoodrich</p>
                                            <p class="small">R$ 28.99</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body p-0">
                                            <div class="h-150px has-background rounded mb-2">
                                                <div class="top-right m-2">
                                                    <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons ">favorite_border</i></button>
                                                </div>
                                                <div class="bottom-left m-2">
                                                    <button class="btn btn-sm btn-white">Novo</button>
                                                </div>
                                                <figure class="background">
                                                    <img src="template/layout/demo/assets/images/155.jpg" alt="">
                                                </figure>
                                            </div>
                                            <small class="text-mute">Pick UPs e SUVs</small>
                                            <p class="mb-0">Pneu 295/75 Aro 16 123P ALL TERRAIN BFGoodrich</p>
                                            <p class="small">$ 35.99</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center my-3">
                        <div class="col-6 mx-auto">
                            <button class="btn btn-sm btn-light btn-block">Mostrar Tudo</button>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="container">
                            <h5 class="page-title">Top News</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="media my-3 w-100">
                                <div class="avatar avatar-80 mr-3 has-background rounded">
                                    <figure class="background">
                                        <img src="template/layout/demo/assets/img/image9.jpg" class="" alt="">
                                    </figure>
                                </div>
                                <div class="media-body">
                                    <small class="text-mute">11-1-2020 | 24:00 am</small>
                                    <p class="mb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <p class="small text-mute">Published by Maxartkiller</p>
                                </div>
                            </div>
                            <div class="media my-3 w-100">
                                <div class="avatar avatar-80 mr-3 has-background rounded">
                                    <figure class="background">
                                        <img src="template/layout/demo/assets/img/image1.jpg" class="" alt="">
                                    </figure>
                                </div>
                                <div class="media-body">
                                    <small class="text-mute">11-1-2020 | 24:00 am</small>
                                    <p class="mb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <p class="small text-mute">Published by Maxartkiller</p>
                                </div>
                            </div>
                            <div class="media my-3 w-100">
                                <div class="avatar avatar-80 mr-3 has-background rounded">
                                    <figure class="background">
                                        <img src="template/layout/demo/assets/img/image8.jpg" class="" alt="">
                                    </figure>
                                </div>
                                <div class="media-body">
                                    <small class="text-mute">11-1-2020 | 24:00 am</small>
                                    <p class="mb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <p class="small text-mute">Published by Maxartkiller</p>
                                </div>
                            </div>
                            <div class="media my-3 w-100">
                                <div class="avatar avatar-80 mr-3 has-background rounded">
                                    <figure class="background">
                                        <img src="template/layout/demo/assets/img/image10.jpg" class="" alt="">
                                    </figure>
                                </div>
                                <div class="media-body">
                                    <small class="text-mute">11-1-2020 | 24:00 am</small>
                                    <p class="mb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <p class="small text-mute">Published by Maxartkiller</p>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="tab-pane fade" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <h5 class="page-title">Meu carrinho</h5>
                                </div>
                                <div class="col-auto align-self-end">
                                    <h5 class="page-title small text-success">R$ 109.97</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="media my-3 w-100">
                                <div class="avatar avatar-60 mr-3 has-background rounded">
                                    <div class="bottom-left m-1">
                                        <button class="btn btn-white btn-rounded text-danger btn-20"><i class="material-icons ">favorite</i></button>
                                    </div>
                                    <a href="product.html" class="background">
                                        <img src="template/layout/demo/assets/images/160.jpg" class="" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <small class="text-mute">Passeio</small>
                                    <a href="product.html">
                                        <p class="mb-1">Pneu 185/65 R15 88H BluEarth AE-01 Yokohama</p>
                                    </a>
                                    <p><span class="text-success">R$ 39.99</span> <span class="text-mute small">Marca: Yokohama Modelo: Blue Arth AE-01 Largura: 185 Perfil: 70 Aro: 14</span></p>
                                </div>
                                <div class="align-self-center">
                                    <div class="input-group cart-count">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">-</button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="" value="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media my-3 w-100">
                                <div class="avatar avatar-60 mr-3 has-background rounded">
                                    <div class="bottom-left m-1">
                                        <button class="btn btn-white btn-rounded text-danger btn-20"><i class="material-icons ">favorite</i></button>
                                    </div>
                                    <figure class="background">
                                        <img src="template/layout/demo/assets/images/161.jpg" class="" alt="">
                                    </figure>
                                </div>
                                <div class="media-body">
                                    <small class="text-mute">Passeio</small>
                                    <p class="mb-1">Pneu 185/70 R14 88H BluEarth AE-01 Yokohama</p>
                                    <p><span class="text-success">R$ 29.99</span> <span class="text-mute small">Marca: Yokohama Modelo: Blue Arth AE-01 Largura: 185 Perfil: 70 Aro: 14</span></p>
                                </div>
                                <div class="align-self-center">
                                    <div class="input-group cart-count">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">-</button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="" value="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media my-3 w-100">
                                <div class="avatar avatar-60 mr-3 has-background rounded">
                                    <div class="bottom-left m-1">
                                        <button class="btn btn-white btn-rounded btn-20"><i class="material-icons ">favorite_border</i></button>
                                    </div>
                                    <figure class="background">
                                        <img src="template/layout/demo/assets/images/162.jpg" class="" alt="">
                                    </figure>
                                </div>
                                <div class="media-body">
                                    <small class="text-mute">Passeio</small>
                                    <p class="mb-1">Pneu 175/70 R14 84H BluEarth AE-01 Yokohama</p>
                                    <p><span class="text-success">R$ 39.99</span> <span class="text-mute small">Marca: Yokohama Modelo: Blue Arth AE-01 Largura: 185 Perfil: 70 Aro: 14</span></p>
                                </div>
                                <div class="align-self-center">
                                    <div class="input-group cart-count">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">-</button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="" value="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container">
                            <div class="form-group float-label position-relative active mb-0">
                                <div class="bottom-right mb-1">
                                    <button class="btn btn-sm btn-success">Aplicar</button>
                                </div>
                                <input type="text" class="form-control" value="KGIDF000120">
                                <label class="form-control-label">Aplicar código promocional</label>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container">
                            <div class="card alert-success">
                                <div class="card-body p-1">
                                    <div class="media">
                                        <div class="icon icon-50 bg-white text-success mr-2"><i class="material-icons">local_offer</i></div>
                                        <div class="media-inner">
                                            <h5 class="mb-0 font-weight-normal">
                                                <b>10%</b>Desconto <br>
                                                <small class="text-mute">Offer aplicado você salvou <b>R$ 10.9</b></small>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container">
                            <div class="row my-3 h6 font-weight-normal">
                                <div class="col">Subtotal</div>
                                <div class="col text-right text-mute">R$ 109.97</div>
                            </div>
                            <div class="row my-3 h6 font-weight-normal">
                                <div class="col">Desconto</div>
                                <div class="col text-right text-mute">-R$ 10.99</div>
                            </div>
                            <hr>
                            <div class="row h6 font-weight-bold">
                                <div class="col">Total</div>
                                <div class="col text-right text-mute">R$ 98.98</div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="container">
                            <a href="#" class="btn btn-lg btn-default btn-block my-4">Confirmar</a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <h5 class="page-title">Meus Favoritos</h5>
                                </div>
                                <div class="col-auto align-self-end">
                                    <ul class="nav nav-pills tabs-small" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="listview-tab" data-toggle="tab" href="#listview" role="tab" aria-controls="listview" aria-selected="false"><i class="material-icons">view_list</i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="thumbnails-tab" data-toggle="tab" href="#thumbnails" role="tab" aria-controls="thumbnails" aria-selected="true"><i class="material-icons">view_module</i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="tabproductd">
                        <div class="tab-pane fade" id="listview" role="tabpanel" aria-labelledby="listview-tab">
                            <div class="row">
                                <div class="container">
                                    <div class="media my-3 w-100">
                                        <a href="#" class="avatar avatar-60 mr-3 has-background rounded">
                                            <figure class="background">
                                                <img src="template/layout/demo/assets/images/161.jpg" class="" alt="">
                                            </figure>
                                        </a>
                                        <div class="media-body">
                                            <small class="text-mute">Passeio</small>
                                            <a href="product.html">
                                                <p class="mb-1">Pneu 175/70 R14 84H BluEarth AE-01 Yokohama</p>
                                            </a>
                                            <p class="small">R$ 39.99</p>
                                        </div>
                                        <div class="align-self-center">
                                            <button class="btn btn-white btn-rounded btn-40"><i class="material-icons ">delete</i></button>
                                            <button class="btn btn-white btn-rounded btn-40"><i class="material-icons ">local_mall</i></button>
                                        </div>
                                    </div>
                                    <div class="media my-3 w-100">
                                        <div class="avatar avatar-60 mr-3 has-background rounded">
                                            <figure class="background">
                                                <img src="template/layout/demo/assets/images/160.jpg" class="" alt="">
                                            </figure>
                                        </div>
                                        <div class="media-body">
                                            <small class="text-mute">Passeio</small>
                                            <p class="mb-1">Pneu 185/70 R14 88H BluEarth AE-01 Yokohama</p>
                                            <p class="small">R$ 29.99</p>
                                        </div>
                                        <div class="align-self-center">
                                            <button class="btn btn-white btn-rounded btn-40"><i class="material-icons ">delete</i></button>
                                            <button class="btn btn-white text-danger btn-rounded btn-40"><i class="material-icons ">local_mall</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="thumbnails" role="tabpanel" aria-labelledby="thumbnails-tab">
                            <div class="row my-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="card border-0 mb-4">
                                                <div class="card-body p-0">
                                                    <a href="#" class="h-150px has-background rounded mb-2">
                                                        <div class="top-right m-2">
                                                            <button class="btn btn-sm btn-white btn-rounded"><i class="material-icons">local_mall</i></button>
                                                        </div>
                                                        <figure class="background" style="background-image: url(&quot;template/layout/demo/assets/img/image4.jpg&quot;);">
                                                            <img src="template/layout/demo/assets/images/161.jpg" alt="" style="display: none;">
                                                        </figure>
                                                    </a>
                                                    <small class="text-mute">Passeio</small>
                                                    <a href="#">
                                                        <p class="mb-0">Pneu 175/70 R14 84H BluEarth AE-01 Yokohama</p>
                                                    </a>
                                                    <p class="small">R$ 39.99</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="card border-0 mb-4">
                                                <div class="card-body p-0">
                                                    <div class="h-150px has-background rounded mb-2">
                                                        <div class="top-right m-2">
                                                            <button class="btn btn-sm btn-white btn-rounded text-danger"><i class="material-icons ">local_mall</i></button>
                                                        </div>
                                                        <figure class="background" style="background-image: url(&quot;template/layout/demo/assets/img/image2.jpg&quot;);">
                                                            <img src="template/layout/demo/assets/images/160.jpg" alt="" style="display: none;">
                                                        </figure>
                                                    </div>
                                                    <small class="text-mute">Passeio</small>
                                                    <p class="mb-0">Pneu 185/70 R14 88H BluEarth AE-01 Yokohama</p>
                                                    <p class="small">R$ 49.99</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="container-fluid px-0">
                            <div class="has-background h-200px">
                                <div class="background">
                                    <img src="template/layout/demo/assets/img/image8.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11 col-md-6 col-lg-4 mx-auto">
                            <figure class="avatar avatar-150 rounded-circle has-background mx-auto username top-75">
                                <div class="background">
                                    <img src="template/layout/demo/assets/img/image4.jpg" alt="">
                                </div>
                            </figure>
                            <h5 class="text-center mb-0 username-text">EC Tecnologia</h5>
                            <p class="text-center small text-mute username-text">Cuiabá, Brasil</p>

                            <div class="list-group my-3">
                                <a href="#" class="list-group-item list-group-item-action">Minha Conta <i class="material-icons float-right text-mute h6 my-0">keyboard_arrow_right</i></a>
                                <a href="#" class="list-group-item list-group-item-action">Gerenciar endereços <i class="material-icons float-right text-mute h6 my-0">keyboard_arrow_right</i></a>
                                <a href="#" class="list-group-item list-group-item-action">Notificações <i class="material-icons float-right text-mute h6 my-0">keyboard_arrow_right</i></a>
                                <a href="#" class="list-group-item list-group-item-action">Senhas <i class="material-icons float-right text-mute h6 my-0">keyboard_arrow_right</i></a>
                                <a href="#" class="list-group-item list-group-item-action">Languages <i class="material-icons float-right text-mute h6 my-0">keyboard_arrow_right</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- page content ends -->
        </div>
        <footer class="tabs-footer">
            <ul class="nav nav-tabs justify-content-center" id="maintab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        <i class="material-icons">store</i>
                        <small class="sr-only">Store</small>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false">
                        <i class="material-icons">find_in_page</i>
                        <small class="sr-only">Search</small>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="false">
                        <i class="material-icons">local_mall</i>
                        <span class="notification-point"></span>
                        <small class="sr-only">Local Mall</small>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="favorite-tab" data-toggle="tab" href="#favorite" role="tab" aria-controls="favorite" aria-selected="false">
                        <i class="material-icons">bookmark</i>
                        <small class="sr-only">Bookmarks</small>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        <i class="material-icons">account_circle</i>
                        <small class="sr-only">Account</small>
                    </a>
                </li>
            </ul>
        </footer>
    </div>
    <!-- main container -->

    <!-- sidebar right -->
    <div class="sidebar sidebar-right overlay-sidebar">
        <div class="container filters-container">
            <h5>Critérios de Filtro</h5>
            <p class="text-mute"> produtos</p>
            <hr>
            <div class="form-group float-label pt-0 active">
                <div class="row">
                    <div class="col">
                        <input type="number" min="0" max="500" value="100" step="1" id="input-select" class="form-control">
                    </div>
                    <div class="col-auto pt-2"> to </div>
                    <div class="col">
                        <input type="number" min="0" max="500" value="100" step="1" id="input-number" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group float-label active">
                <select class="form-control">
                    <optgroup label="Cloths">
                        <option>OFF-ROAD</option>
                        <option>SUVs</option>
                        <option>Passeio</option>
                    </optgroup>
                    <optgroup label="Assosories">
                        <option>Chave</option>
                        <option>Parafuso</option>
                        <option>Tripe</option>
                    </optgroup>
                </select>
                <label class="form-control-label">Selecione as categorias</label>
            </div>
            <div class="form-group float-label">
                <input type="text" class="form-control">
                <label class="form-control-label">Keyword</label>
            </div>
            <div class="form-group float-label active">
                <select class="form-control">
                    <option>10% </option>
                    <option>30%</option>
                    <option>50%</option>
                    <option>80%</option>
                </select>
                <label class="form-control-label">Offer Desconto</label>
            </div>
            <button class="btn btn-default btn-block">Aplicar</button>
        </div>
    </div>
    <!-- sidebar right -->

    <!-- scroll to top button -->
    <button type="button" class="btn btn-default shadow scrollup bottom-right position-fixed btn-40"><i class="material-icons">expand_less</i></button>
    <!-- scroll to top button ends-->
	
    <!-- color settings ends -->

    <!-- Template js files -->
    <script src="template/layout/demo/assets/js/jquery-3.3.1.min.js"></script>
    <script src="template/layout/demo/assets/js/popper.min.js"></script>
    <script src="template/layout/demo/assets/vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <!-- Swiper javascript -->
    <script src="template/layout/demo/assets/vendor/swiper/js/swiper.min.js"></script>

    <!-- Custom javascript -->
    <script src="template/layout/demo/assets/js/main.js"></script>
    
    <!-- Cookie for color scheme -->
    <script src="template/layout/demo/assets/vendor/cookie/jquery.cookie.js"></script>
    
    <!-- Color scheme js -->
    <script src="template/layout/demo/assets/js/color-scheme-demo.js"></script>

    <!-- App js page level initialization functions -->
    <script src="template/layout/demo/assets/js/app.js"></script>
	
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

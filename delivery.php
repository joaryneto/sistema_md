<?

ob_start();

session_start();

require_once("./load/load.php");

if(@$_GET['deslogar']==1)
{
	unset($_SESSION['usuario']);
	print('<script> localStorage.removeItem("token"); </script>');
	print "<script> window.location='login.php';  </script>";
}
?>
<!doctype html>
<html lang="pt-br" class="color-theme-blue">

<head>
<? include('css.php');?>
<style>
.tableFixHead          { 
  overflow-y: auto; 
  height: auto;
  border: 1px solid;
  border-color: lightgray;
  }
.tableFixHead thead th { position: sticky; top: 0; }
.tableFixHead thead th { background:#fff; }

.form-control 
{
    height: calc(2.5em + .75rem + 2px) !important;
}

.logo {
	background-color: transparent !important;
}

.btnadd-ad
{
	position: absolute;
	left: 92%;
	top: 28px;
	height: 55px;
	width: 50px;
	font-size: 18px;
}

.btnadd-sh {
    position: absolute;
    left: 76.6%;
    top: 256px;
    height: 60px;
    width: 50px;
    font-size: 18px;
}

.btnadd-us
{
	position: absolute;
	left: 77%;
    top: 31px;
	height: 55px;
	width: 50px;
	font-size: 18px;
}

.btnadd-lg {
    position: absolute;
    left: 90.5%;
    top: 31px;
    height: 55px;
    width: 50px;
    font-size: 18px;
}

@media screen and (max-width:575.98px) {
  .modal-dialog {
    margin: -0.1rem !important;
  }
  
  .btnadd-lg {
    position: absolute;
    left: 90.5%;
    top: 31px;
    height: 55px;
    width: 50px;
    font-size: 18px;
  }
  
  .btnadd-ad
  {
	position: absolute;
	left: 89.5%;
	top: 27px;
	height: 55px;
	width: 50px;
	font-size: 18px;
  }
  .btnadd-us
  {
	position: absolute;
	left: 89.5%;
	top: 27px;
	height: 55px;
	width: 50px;
	font-size: 18px;
  }
  .btnadd-sh {
    position: absolute;
    left: 81.8%;
    top: 256px;
    height: 60px;
    width: 50px;
    font-size: 18px;
  }
}

@media screen and (max-width:767.98px) {
  
  .btnadd-lg {
    position: absolute;
    left: 90.5%;
    top: 31px;
    height: 55px;
    width: 50px;
    font-size: 18px;
  }
  .btnadd-ad
  {
	position: absolute;
	left: 86.5%;
	top: 27px;
	height: 55px;
	width: 50px;
	font-size: 18px;
  }
  .btnadd-us
  {
	position: absolute;
	left: 89.5%;
	top: 27px;
	height: 55px;
	width: 50px;
	font-size: 18px;
  }
  .btnadd-sh {
    position: absolute;
    left: 81.8%;
    top: 256px;
    height: 60px;
    width: 50px;
    font-size: 18px;
  }
}

@media screen and (max-width:991.98px) {

  .btnadd-lg {
    position: absolute;
    left: 90.5%;
    top: 31px;
    height: 55px;
    width: 50px;
    font-size: 18px;
  }
  .btnadd-ad
  {
	position: absolute;
	left: 88.5%;
	top: 27px;
	height: 55px;
	width: 50px;
	font-size: 18px;
  }
  .btnadd-us
  {
	position: absolute;
	left: 85%;
    top: 31px;
	height: 55px;
	width: 50px;
	font-size: 18px;
  }
  .btnadd-sh {
    position: absolute;
    left: 81.8%;
    top: 256px;
    height: 60px;
    width: 50px;
    font-size: 18px;
  }
}

</style>
</head>

<body class="ui-rounded">
    <!-- Page laoder -->
    <div class="container-fluid pageloader">
        <div class="row h-100">
            <div class="col-12 align-self-start text-center">
            </div>
            <div class="col-12 align-self-center text-center">
			<img style="height:70px" src="template/images/delivery.png" alt="logo">
            <h1 class="mb-0 mt-3">EC </h1>
            <p class="text-mute subtitle"> Tecnologia</p>
            <div class="loader-roller">
                <div></div>
                <div></div>
                <div></div>
            </div>
            </div>
            <div class="col-12 align-self-end text-center">
                <p class="my-5">Por favor, espere<br><small class="text-mute">Um mundo de maravilhas está carregando...</small></p>
            </div>
        </div>
    </div>
    <!-- Page laoder ends -->

    <!-- Fixed navbar -->
    <header class="header fixed-top">
        <nav class="navbar">
            <div>
                <button class="menu-btn btn btn-link btn-44">
                    <span class="icon material-icons">menu</span>
                </button>
            </div>
            <div>
                <a class="navbar-brand" href="delivery.php">
                    <div class="logo"><img style="height:40px" src="template/images/delivery2.png" alt="" class="header-logo"></div>
                </a>
            </div>
            <div>
                <form class="form-inline search">
                    <input class="form-control w-100" type="text" placeholder="Buscar por item ou loja..." aria-label="Buscar">
                    <button class="btn btn-link btn-44" type="submit"><span class="icon_search"></span></button>
                </form>
                <button class="btn btn-link search-btn" type="button"><span class="icon_search"></span></button>
                <a href="profile.html" class=""><span class="avatar avatar-30"><img src="template/images/user1.png" alt=""></span></a>
            </div>
        </nav>
    </header>
    <!-- Fixed navbar ends -->

    <!-- sidebar -->
    <div class="sidebar">
        <div class="row no-gutters">
            <div class="col-auto align-self-center">
                <figure class="avatar avatar-50">
                    <img src="template/images/user1.png" alt="">
                </figure>
            </div>
            <div class="col pl-3 align-self-center">
                <p class="my-0"><?=$_SESSION['nome']?></p>
                <p class="text-mute my-0 small"><?
				switch($_SESSION['permissao'])
			    {
					case 1:
					{
						echo "Atendente";
					}
					break;
					case 2:
					{
						echo "Profissional";
					}
					break;
					case 3:
					{
						echo "Administrador";
					}
					break;
					default:
				    {
						echo "Não definido";
					}
					break;
				}
				
				?></p>
            </div>
            <div class="col-auto align-self-center">
                <a href="login.html" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
            </div>
        </div>
        <div class="list-group main-menu my-4">
            <a href="index.html" class="list-group-item list-group-item-action active"><i class="material-icons">home</i>Home</a>
            <a href="productdetails.html" class="list-group-item list-group-item-action"><i class="material-icons">view_day</i>Product Detail</a>
            <a href="orders.html" class="list-group-item list-group-item-action"><i class="material-icons">insert_emoticon</i>Orders</a>
            <a href="notification.html" class="list-group-item list-group-item-action"><i class="material-icons">notifications</i>Notification <span class="badge badge-dark text-white">2</span></a>
            <a href="elements.html" class="list-group-item list-group-item-action"><i class="material-icons">account_circle</i>Pages & Elements</a>
            <a href="setting.html" class="list-group-item list-group-item-action"><i class="material-icons">account_circle</i>Setting</a>
            <a href="aboutus.html" class="list-group-item list-group-item-action"><i class="material-icons">business</i>About</a>
        </div>
    </div>
    <!-- sidebar ends -->

    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container pb-0">
        <!-- page content goes here -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="container-fluid py-2 mb-4">
                    <!-- Swiper -->
                    <div class="swiper-container swiper-categories text-center">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">local_cafe</i>
                                </a>
                                <p class="small mt-2 text-mute">Café</p>
                            </div>
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">local_bar</i>
                                </a>
                                <p class="small mt-2 text-mute">Bebidas</p>
                            </div>
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">local_dining</i>
                                </a>
                                <p class="small mt-2 text-mute">Jantar</p>
                            </div>
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">restaurant</i>
                                </a>
                                <p class="small mt-2 text-mute">Iniciante</p>
                            </div>
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">local_pizza</i>
                                </a>
                                <p class="small mt-2 text-mute">Pizza</p>
                            </div>
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">local_offer</i>
                                </a>
                                <p class="small mt-2 text-mute">Oferta</p>
                            </div>
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">local_cafe</i>
                                </a>
                                <p class="small mt-2 text-mute">Chá</p>
                            </div>
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">local_bar</i>
                                </a>
                                <p class="small mt-2 text-mute">Drinque suave</p>
                            </div>
                            <div class="swiper-slide w-auto p-2">
                                <a class="icons icon-60 shadow-sm bg-white">
                                    <i class="material-icons text-default">restaurant</i>
                                </a>
                                <p class="small mt-2 text-mute">Almoço</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mb-4">
                    <input type="text" class="form-control border-0 shadow-light" placeholder="Search here...">
                </div>
                <div class="container mb-4">
                    <div class="swiper-container swiper-offers">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide w-auto">
                                <div class="card w-250 position-relative overflow-hidden bg-default text-white border-0">
                                    <div class="background opacity-60">
                                        <img src="template/images/login.jpg" alt="" s>
                                    </div>
                                    <div class="card-body text-center z-1 h-50"></div>
                                    <div class="card-footer border-0 z-1">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="my-0 font-weight-bold">50% Off</h4>
                                                <h6 class="mb-1">Dominooz</h6>
                                                <p>Code: <span class="badge badge-success">OfferTX01</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide w-auto">
                                <div class="card w-250 position-relative overflow-hidden bg-dark text-white border-0">
                                    <div class="background opacity-60">
                                        <img src="template/images/food1.jpg" alt="" s>
                                    </div>
                                    <div class="card-body text-center z-1 h-50"></div>
                                    <div class="card-footer border-0 z-1">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="my-0 font-weight-bold">20% Off</h4>
                                                <h6 class="mb-1">MarcDs</h6>
                                                <p>Code: <span class="badge badge-success">OfferTC09</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide w-auto">
                                <div class="card w-250 position-relative overflow-hidden bg-primary text-white border-0">
                                    <div class="background opacity-60">
                                        <img src="template/images/food2.jpg" alt="" s>
                                    </div>
                                    <div class="card-body text-center z-1 h-50"></div>
                                    <div class="card-footer border-0 z-1">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="my-0 font-weight-bold">50% Off</h4>
                                                <h6 class="mb-1">Pizza</h6>
                                                <p>Code: <span class="badge badge-success">OfferPZZ1</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h6 class="page-subtitle">Popular food <a href="#" class="btn btn-sm float-right px-0">View all</a></h6>
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-light text-center mb-4">
                                <div class="card-body position-relative">
                                    <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                    <div class="h-100px position-relative overflow-hidden">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner.png" alt="">
                                        </div>
                                    </div>
                                    <h6 class="text-default">Kings Burger</h6>
                                    <p class="small">Delicious Taste <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 28<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card  border-0 shadow-light text-center mb-4">
                                <div class="card-body position-relative">
                                    <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                    <div class="h-100px position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner2.png" alt="">
                                        </div>
                                    </div>
                                    <h6 class="text-default">Pizza Special</h6>
                                    <p class="small">Hand Tosted <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 47<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-light text-center mb-4">
                                <div class="card-body position-relative">
                                    <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                    <div class="h-100px position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner1.png" alt="">
                                        </div>
                                    </div>
                                    <h6 class="text-default">Kings Meal</h6>
                                    <p class="small">Amzaing Spices <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 36<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-light text-center mb-4">
                                <div class="card-body position-relative">
                                    <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                    <div class="h-100px position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner.png" alt="">
                                        </div>
                                    </div>
                                    <h6 class="text-default">Kings Burger</h6>
                                    <p class="small">Delicious Taste <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 12<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h6 class="page-subtitle">Último pedido</h6>
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col-auto w-100px pr-0 align-self-center">
                                    <div class="h-80 position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner1.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="mb-1"><a href="#" class="text-default">Food Meal</a></p>
                                    <p class="mb-2 small"><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span> <span class="text-mute">128 reviews </span> </p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 48<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col-auto w-100px pr-0 align-self-center">
                                    <div class="h-80 position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="mb-1"><a href="#" class="text-default">King Large burger</a></p>
                                    <p class="mb-2 small"><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span> <span class="text-mute">128 reviews </span> </p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 28<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col-auto w-100px pr-0 align-self-center">
                                    <div class="h-80 position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="mb-1"><a href="#" class="text-default">Large Pizaa</a></p>
                                    <p class="mb-2 small"><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span> <span class="text-mute">120 reviews</span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 28<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h6 class="page-subtitle">Melhor comida</h6>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="card mb-4 shadow-light border-0">
                                <div class="card-header text-center h-150 position-relative overflow-hidden">
                                    <div class="background">
                                        <img src="template/images/food1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="card-footer border-0 z-1">
                                    <div class="media">
                                        <figure class="avatar avatar-40 mr-2">
                                            <img src="template/images/user5.png" alt="Generic placeholder image">
                                        </figure>
                                        <div class="media-body">
                                            <h6 class="mb-1">Dieting food stakes</h6>
                                            <p class="mb-0 text-mute small">By Maxartkiller, 7-11-2018 | Public</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="card mb-4 shadow-light border-0">
                                <div class="card-header text-center z-1 h-150 position-relative overflow-hidden ">
                                    <div class="background">
                                        <img src="template/images/food2.jpg" alt="">
                                    </div>
                                </div>
                                <div class="card-footer border-0 z-1">
                                    <div class="media">
                                        <figure class="avatar avatar-40 mr-2">
                                            <img src="template/images/user5.png" alt="Generic placeholder image">
                                        </figure>
                                        <div class="media-body">
                                            <h6 class="mb-1">Maxican style food shop</h6>
                                            <p class="mb-0 text-mute small">By Maxartkiller, 7-11-2018 | Public</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
                <div class="container my-4">
                    <h5 class="page-subtitle">What you are looking for?<br>
                        <span class="text-mute small mt-2">Start search now</span>
                    </h5>
                    <div class="row mt-4">
                        <div class="col">
                            <input type="text" class="form-control shadow-light border-0" placeholder="Search here...">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-default default-shadow btn-40" data-toggle="collapse" data-target="#filtercollapse" aria-expanded="true"><i class="material-icons">filter_list</i></button>
                        </div>
                    </div>
                </div>
                <div class="container mb-4 collapse show" id="filtercollapse">
                    <button class="btn mb-2 btn-default">All</button>
                    <button class="btn mb-2 btn-outline-default">Breakfast</button>
                    <button class="btn mb-2 btn-outline-default">Lunch</button>
                    <button class="btn mb-2 btn-outline-default">Dinner</button>
                    <button class="btn mb-2 btn-outline-default">Pizza</button>
                    <button class="btn mb-2 btn-outline-default">Drinks</button>
                    <button class="btn mb-2 btn-outline-default">Chinese</button>

                    <div class="row mt-4">
                        <div class="col">
                            <label class="text-mute small">From Price</label>
                            <input type="text" class="form-control" placeholder="From Price" value="0">
                        </div>
                        <div class="col">
                            <label class="text-mute small">To Price</label>
                            <input type="text" class="form-control" placeholder="To Price" value="500">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <label class="text-mute small">City</label>
                            <input type="text" class="form-control" placeholder="Enter City">
                        </div>
                        <div class="col">
                            <label class="text-mute small">Store</label>
                            <select class="form-control">
                                <option>PizzaHutt</option>
                                <option>Dominoza</option>
                                <option>Dastalic</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="container mb-4">
                    <h6 class="page-subtitle">Recent Items</h6>
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-light text-center mb-4">
                                <div class="card-body position-relative">
                                    <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                    <div class="h-100px position-relative overflow-hidden">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner.png" alt="">
                                        </div>
                                    </div>
                                    <h6 class="text-default">Kings Burger</h6>
                                    <p class="small">Delicious Taste <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 28<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card  border-0 shadow-light text-center mb-4">
                                <div class="card-body position-relative">
                                    <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                    <div class="h-100px position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner2.png" alt="">
                                        </div>
                                    </div>
                                    <h6 class="text-default">Pizza Special</h6>
                                    <p class="small">Hand Tosted <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 47<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col-auto w-100px pr-0 align-self-center">
                                    <div class="h-80 position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner1.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="mb-1"><a href="#" class="text-default">Food Meal</a></p>
                                    <p class="mb-2 small"><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span> <span class="text-mute">128 reviews </span> </p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 48<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col-auto w-100px pr-0 align-self-center">
                                    <div class="h-80 position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="mb-1"><a href="#" class="text-default">King Large burger</a></p>
                                    <p class="mb-2 small"><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span> <span class="text-mute">128 reviews </span> </p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 28<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col-auto w-100px pr-0 align-self-center">
                                    <div class="h-80 position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="mb-1"><a href="#" class="text-default">Large Pizaa</a></p>
                                    <p class="mb-2 small"><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span> <span class="text-mute">120 reviews</span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0">$ 28<sup>.00</sup></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                <div class="container my-4">
                    <h5 class="page-subtitle">Thats great your cart is ready!<br>
                        <span class="text-mute small mt-2">Checkout now</span>
                    </h5>
                </div>
                <div class="container">
                    <div class="card border-0 shadow-light mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto w-100px pr-0 align-self-center">
                                    <div class="h-80 position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner1.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="mb-1"><a href="#" class="text-default">Food Meal</a></p>
                                    <p class="text-success my-0">$ 48<sup>.00</sup></p>
                                    <div class="input-group mt-2 text-center increasenumber">
                                        <div class="input-group-prepend ">
                                            <button class="btn btn-sm btn-outline-default px-3 remove" type="button">-</button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center w-50px" placeholder="" value="2">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-outline-default px-3 add" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-right">
                                    <button class="btn btn-sm btn-link text-danger p-0"><i class="material-icons">delete</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-light mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto w-100px pr-0 align-self-center">
                                    <div class="h-80 position-relative">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="mb-1"><a href="#" class="text-default">Pizza manias</a></p>
                                    <p class="text-success my-0">$ 48<sup>.00</sup></p>
                                    <div class="input-group mt-2 text-center increasenumber">
                                        <div class="input-group-prepend ">
                                            <button class="btn btn-sm btn-outline-default px-3 remove" type="button">-</button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center w-50px" placeholder="" value="2">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-outline-default px-3 add" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-right">
                                    <button class="btn btn-sm btn-link text-danger p-0"><i class="material-icons">delete</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mb-4">
                    <div class="input-group text-center">
                        <input type="text" class="form-control" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-success px-3" type="button"><i class="material-icons h6 my-0">done</i> Apply</button>
                        </div>
                    </div>
                </div>
                <div class="container mb-4">
                    <div class="alert alert-success mb-4" role="alert">
                        Your coupon code applied successfully!
                    </div>
                    <div class="card border-0 shadow-light mb-4">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><span>Total</span> <span class="float-right font-weight-bold">$ 192</span></li>
                                <li class="list-group-item"><span>Tax</span> <span class="float-right font-weight-bold">$ 18</span></li>
                                <li class="list-group-item"><span>Delivery Charge</span> <span class="float-right font-weight-bold">$ 2</span></li>
                                <li class="list-group-item"><span>Discount</span> <span class="float-right font-weight-bold text-success">$ 50</span></li>
                                <li class="list-group-item"><span class=" font-weight-bold">Total</span> <span class="float-right font-weight-bold">$ 152</span></li>
                            </ul>
                        </div>
                    </div>
                    <a href="payment.html" class=" btn btn-lg btn-default default-shadow btn-block">Checkout <span class="ml-2 icon arrow_right"></span></a>
                </div>

            </div>
            <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
                <div class="container">
                    <h5 class="page-subtitle">Activity</h5>
                </div>
                <div class="container-fluid px-0">
                    <div class="list-group list-group-flush my-0 w-100 border-top border-bottom">
                        <div class="list-group-item">
                            <div class="row">
                                <a class="col-auto" data-toggle="modal" data-target="#statusmodal">
                                    <figure class="avatar avatar-40">
                                        <img src="template/images/user4.png" alt="">
                                    </figure>
                                </a>
                                <div class="col pl-0 align-self-center">
                                    <h6 class="mb-1 font-weight-normal"><b>Ankit Trivedi</b>, <b>John MAcMillan</b> and <b>36 others</b> are started following you </h6>
                                    <p class="small text-mute">2 Days ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-light text-center py-2 text-mute">This month</div>
                        <a class="list-group-item" data-toggle="modal" data-target="#statusmodal">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40">
                                        <img src="template/images/user3.png" alt="">
                                    </figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h6 class="mb-1 font-weight-normal"><b>Williums</b> Liked your picture you posted</h6>
                                    <p class="small text-mute">last week</p>
                                </div>
                            </div>
                        </a>
                        <a class="list-group-item" data-toggle="modal" data-target="#statusmodal">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40">
                                        <img src="template/images/user4.png" alt="">
                                    </figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h6 class="mb-1 font-weight-normal"><b>johnson</b> Followed you and he also folled many of your groups and community</h6>
                                    <p class="small text-mute">2 Week ago</p>
                                </div>
                            </div>
                        </a>
                        <a class="list-group-item" data-toggle="modal" data-target="#statusmodal">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40">
                                        <img src="template/images/user1.png" alt="">
                                    </figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h6 class="mb-1 font-weight-normal"><b>Maxartkillers</b> Liked your picture you posted</h6>
                                    <p class="small text-mute">2 Week ago</p>
                                </div>
                            </div>
                        </a>
                        <a class="list-group-item" data-toggle="modal" data-target="#statusmodal">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40">
                                        <img src="template/images/user2.png" alt="">
                                    </figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h6 class="mb-1 font-weight-normal"><b>Silvasaa </b> is now your follower please feel free to follow back</h6>
                                    <p class="small text-mute">3 Week ago</p>
                                </div>
                            </div>
                        </a>
                        <div class="list-group-item bg-light text-center py-2 text-mute">Earlier</div>
                        <a class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40">
                                        <img src="template/images/user4.png" alt="">
                                    </figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h6 class="mb-1 font-weight-normal"><b>Alic Boddy</b> Liked your picture you posted</h6>
                                    <p class="small text-mute">1 month ago</p>
                                </div>
                            </div>
                        </a>
                        <a class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40">
                                        <img src="template/images/user3.png" alt="">
                                    </figure>
                                </div>
                                <div class="col pl-0 align-self-center">
                                    <h6 class="mb-1 font-weight-normal"><b>John</b> Liked your picture you posted</h6>
                                    <p class="small text-mute">2 month ago</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="position-relative overflow-hidden h-200">
                    <div class="background">
                        <img src="template/images/food1.jpg" alt="">
                    </div>
                </div>
                <div class="container top-100 text-center mb-4">
                    <figure class="avatar avatar-180 rounded-circle shadow  mx-auto">
                        <img src="template/images/user1.png" alt="">
                    </figure>
                </div>
                <div class="container-fluid text-center mb-4">
                    <h4>Maxartkiller</h4>
                    <p class="text-mute">Vennanya, USA.</p>
                </div>
                <div class="container mb-4">
                    <ul class="nav nav-pills nav-fill justift-content-center mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  active" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="myorders-tab" data-toggle="tab" href="#myorders" role="tab" aria-controls="myorders" aria-selected="true">My Orders</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <h6 class="page-subtitle">Personal Details</h6>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="text-mute">Birth Date</label>
                                        <p>25/10/1981</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="text-mute">Gender</label>
                                        <p>Male</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="text-mute">Email Address</label>
                                        <p>info@maxartkiller.com</p>
                                    </div>
                                </div>
                            </div>
                            <h6 class="page-subtitle"><span>About</span></h6>
                            <p class="text-mute">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut labore et dolore magna aliqua.</p>                            
                        </div>
                        <div class="tab-pane fade " id="myorders" role="tabpanel" aria-labelledby="myorders-tab">
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="card border-0 shadow-light text-center mb-4">
                                        <div class="card-body position-relative">
                                            <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                            <div class="h-100px position-relative overflow-hidden">
                                                <div class="background background-h-100">
                                                    <img src="template/images/banner.png" alt="">
                                                </div>
                                            </div>
                                            <h6 class="text-default">Kings Burger</h6>
                                            <p class="small">Delicious Taste <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                            <div class="row">
                                                <div class="col text-left">
                                                    <p class="text-success my-0">$ 28<sup>.00</sup></p>
                                                </div>
                                                <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="card  border-0 shadow-light text-center mb-4">
                                        <div class="card-body position-relative">
                                            <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                            <div class="h-100px position-relative">
                                                <div class="background background-h-100">
                                                    <img src="template/images/banner2.png" alt="">
                                                </div>
                                            </div>
                                            <h6 class="text-default">Pizza Special</h6>
                                            <p class="small">Hand Tosted <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                            <div class="row">
                                                <div class="col text-left">
                                                    <p class="text-success my-0">$ 47<sup>.00</sup></p>
                                                </div>
                                                <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="card border-0 shadow-light text-center mb-4">
                                        <div class="card-body position-relative">
                                            <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                            <div class="h-100px position-relative">
                                                <div class="background background-h-100">
                                                    <img src="template/images/banner1.png" alt="">
                                                </div>
                                            </div>
                                            <h6 class="text-default">Kings Meal</h6>
                                            <p class="small">Amzaing Spices <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                            <div class="row">
                                                <div class="col text-left">
                                                    <p class="text-success my-0">$ 36<sup>.00</sup></p>
                                                </div>
                                                <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="card border-0 shadow-light text-center mb-4">
                                        <div class="card-body position-relative">
                                            <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                            <div class="h-100px position-relative">
                                                <div class="background background-h-100">
                                                    <img src="template/images/banner.png" alt="">
                                                </div>
                                            </div>
                                            <h6 class="text-default">Kings Burger</h6>
                                            <p class="small">Delicious Taste <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                            <div class="row">
                                                <div class="col text-left">
                                                    <p class="text-success my-0">$ 12<sup>.00</sup></p>
                                                </div>
                                                <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="toast bottom-right position-fixed mb-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-header">
                <div class="avatar avatar-20 mr-2">
                    <div class="background">
                        <img src="template/images/team3.jpg" class="rounded mr-2" alt="...">
                    </div>
                </div>
                <strong class="mr-auto">Maxartkiller</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Hello, Welcome to our website.
            </div>
        </div>
    </main>
    <!-- End of page content -->

    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container section-100">
        </div>
        <hr class="mt-0">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-auto  text-center">
                    <a href="#" target="_blank" class="btn btn-link px-2"><span class="social_facebook"></span></a>
                    <a href="#" class="btn btn-link px-2" target="_blank"><span class="social_twitter"></span></a>
                    <a href="#" class="btn btn-link px-2" target="_blank"><span class="social_linkedin"></span></a>
                    <a href="#" class="btn btn-link px-2" target="_blank"><span class="social_instagram"></span></a>
                    <a href="#" class="btn btn-link px-2" target="_blank"><span class="social_dribbble"></span></a>
                </div>
            </div>
            <hr>
        </div>
    </footer>
    <!-- Footer ends -->

    <!-- sticky footer tabs -->
    <div class="footer-tabs border-top text-center">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    <i class="material-icons">home</i>
                    <small class="sr-only">Home</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false">
                    <i class="material-icons">room</i>
                    <small class="sr-only">search</small>
                </a>
            </li>
            <li class="nav-item centerlarge">
                <a class="nav-link bg-default" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="false">
                    <i class="material-icons">shopping_basket</i>
                    <small class="sr-only">chat</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="favorite-tab" data-toggle="tab" href="#favorite" role="tab" aria-controls="favorite" aria-selected="false">
                    <i class="material-icons">star</i>
                    <small class="sr-only">Best</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="material-icons">person</i>
                    <small class="sr-only">Account</small>
                </a>
            </li>
        </ul>
    </div>
    <!-- sticky footer tabs ends -->


    <!-- scroll to top button -->
    <button type="button" class="btn btn-default default-shadow scrollup bottom-right position-fixed btn-44"><span class="arrow_carrot-up"></span></button>
    <!-- scroll to top button ends-->

    <!-- final do invólucro -->
<? include('scripts.php');?>
 <script>
        "use strict"
        $(document).ready(function() {
            /* Swiper slider */
            var swiper = new Swiper('.swiper-categories', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                pagination: false,
            });
            var swiper = new Swiper('.swiper-offers', {
                slidesPerView: 'auto',
                spaceBetween: 20,
                pagination: false,
            });

            /* masonry js */
            /* $('#search-tab[data-toggle="tab"]').on('shown.bs.tab', function(e) {

            })*/

            /* toast message */
            setTimeout(function() {
                $('.toast').toast('show')
            }, 2000);

            /* increasenumber */
            $('.add').on('click', function() {
                var current = parseInt($(this).closest('.increasenumber').find('input').val());
                $(this).closest('.increasenumber').find('input').val(current + 1);
            });
            $('.remove').on('click', function() {
                if ($(this).closest('.increasenumber').find('input').val() > 0) {
                    var current = parseInt($(this).closest('.increasenumber').find('input').val());
                    $(this).closest('.increasenumber').find('input').val(current - 1);
                }
            });

        });

    </script>
</body>
</html>

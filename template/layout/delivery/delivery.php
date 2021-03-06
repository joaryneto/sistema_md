<!doctype html>
<html lang="pt-br" class="color-theme-blue">

<head>
<? include('template/layout/delivery/css.php');?>
</head>

<body class="ui-rounded">
    <!-- Page laoder -->
    <div class="container-fluid pageloader">
        <div class="row h-100">
            <div class="col-12 align-self-start text-center">
            </div>
            <div class="col-12 align-self-center text-center">
			<img style="height:70px" src="template/images/delivery.png" alt="logo">
            <h1 class="mb-0 mt-3"></h1>
            <p class="text-mute subtitle"></p>
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
                <a class="navbar-brand" href="?dl=produtos">
                    <div class="logo"><img style="height:40px" src="template/images/delivery2.png" alt="" class="header-logo"></div>
                </a>
            </div>
            <div>
                <form class="form-inline search">
                    <input class="form-control w-100" type="text" placeholder="Buscar por itens..." aria-label="Buscar">
                    <button class="btn btn-link btn-44" type="submit"><span class="icon_search"></span></button>
                </form>
                <button class="btn btn-link search-btn" type="button"><span class="icon_search"></span></button>
                <a href="#" class=""><span class="avatar avatar-30"><img src="template/images/user1.png" alt=""></span></a>
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
			    <? if(isset($_SESSION['usuario'])){?>
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
				<?}else{?>
				<a href="?dl=login" style="color: #fff;"><i class="material-icons">input</i> <span style="position: relative;top: -5px;">Entrar</span></a>
				<?}?>
            </div>
			<? if(isset($_SESSION['usuario'])){?>
            <div class="col-auto align-self-center">
                <a href="delivery.php?deslogar=1" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
            </div>
			<?}?>
        </div>
        <? include('template/layout/delivery/menu.php');?>
    </div>
    <!-- sidebar ends -->

    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container pb-0">
        <!-- page content goes here -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                
				
				<? include('template/layout/delivery/categoria.php');?>
				
                <div class="container mb-4">
                    <input type="text" class="form-control border-0 shadow-light" placeholder="Buscar por itens...">
                </div>
                
				<!-- Menu de descontos Inicio -->
				
				<? include('template/layout/delivery/offs.php');?>
				
				<!-- Menu de descontos Final -->
                
				<!-- Menu de Produtos Inicio -->
				
				<? include('template/layout/delivery/produtos.php');?>
				
				<!-- Menu de Produtos Final -->
				
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
                    <h5 class="page-subtitle">Que bom que seu carrinho está pronto!<br>
                        <span class="text-mute small mt-2">Checkout agora</span>
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
                    <h4><?=$_SESSION['nome'];?></h4>
                    <p class="text-mute"><?=$_SESSION['nome'];?></p>
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
            <li class="nav-item centerlarge">
                <a class="nav-link bg-default" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="false">
                    <i class="material-icons">shopping_basket</i>
                    <small class="sr-only">chat</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" <?if(isset($_SESSION['usuario'])){?> href="#profile" <? } ?> role="tab" aria-controls="profile" aria-selected="false">
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
<? include('template/layout/delivery/scripts.php');?>
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

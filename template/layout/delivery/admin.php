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
        <script>
		window.onload = function ()
		{
			requestPage('?br=cad_produtos','myTabContent','GET');
		}
		</script>
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

     <div id="modalap" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="modals">
<!-- /.modal-content -->

</div>

<!-- /.modal-dialog -->
</div>
</div>
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

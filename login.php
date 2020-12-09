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
<html lang="pt-br" class="color-theme-<?=$_SESSION['tema'];?>">

<head>
<? include('css.php');?>
<style>
.logo {
	background-color: transparent !important;
}
</style>
</head>

<body>
    <!-- Loader -->
	<?if($_SESSION['tipo'] == 1 or $_SESSION['tipo'] == 2 or $_SESSION['tipo'] == 3){?>
    <div class="row no-gutters vh-100 loader-screen">
        <div class="bg-template background-overlay"></div>
        <div class="col align-self-center text-white text-center">
            <img style="height:50px" src="template/images/logo.png" alt="logo">
            <h1 class="mb-0 mt-3">EC</h1><p class="text-mute subtitle">Tecnologia</p>
            <div class="loader-ractangls">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Fim do carregador -->

    <!-- wrapper começa -->
    <div class="wrapper">
        <!-- Cabeçalho -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn btn-link" onclick="window.history.go(-1); return false;"><i class="material-icons">chevron_left</i><span class="new-notification"></span></button>
                </div>
                <div class="col text-left">
                    <div class="header-logo">
                        <img style="height:50px" src="template/images/logo.png" alt="" class="header-logo">
                        <h4>EC<br><small class="text-mute">Tecnologia</small></h4>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="register.html" class="btn btn-link">Register</a>
                </div>
            </div>
        </div>
        <!-- Cabeçalho termina -->
        
        <div class="container">
            <!-- Conteúdo da página aqui -->
            <div class="row flex-colum">
                <div class="col-12 col-md-6 col-lg-5 mx-auto login-row">
                    <div class="row h-100">
                        <div class="col-12 align-self-center">
                            <h1 class="font-weight-light mb-5 text-center"><small class="font-weight-light">Bem-vindo</small>,<br><span class="text-mute">Faça login para continuar</span></h1>
                            <form class="form-signin" method="post" action="login.php">
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        <i class="material-icons text-mute mt-2">account_circle</i>
                                    </div>
                                    <div class="col pl-0">
                                        <div class="form-group float-label active">
                                            <input type="text" id="inputEmail" autocomplete="off" name="login" class="form-control" required autofocus >
                                            <label for="inputEmail" autocomplete="off" class="form-control-label">Nome do usuário</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        <i class="material-icons text-mute mt-1">lock</i>
                                    </div>
                                    <div class="col pl-0">
                                        <div class="form-group float-label">
                                            <input type="password" autocomplete="off" id="inputPassword" name="senha" class="form-control" required>
                                            <label for="inputPassword" class="form-control-label">Senha</label>
                                        </div>
                                    </div>
                                </div>
								<div id="load"></div>
                        </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-12 mt-auto pb-4 col-md-6 col-lg-5 mx-auto login-footer">
                    <a href="javascript: Web(0);" Onclick="logar();" class="btn btn-lg btn-block btn-default text-uppercase position-relative"><span>Logar</span><i class="material-icons right-absoute">arrow_forward</i></a>
					<a href="javascript: Web(0);" Onclick="recovery();" class="btn btn-lg btn-block btn-link text-secondary text-uppercase">Esqueceu a senha?</a>
                    <br></form>
                </div>
            </div>
            <!-- Onde o conteúdo da página termina -->
        </div>

    </div>
	<?}else if($_SESSION['tipo'] == 4){?>
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



    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container">
        <!-- page content goes here -->
        <div class="banner-hero vh-100 scroll-y bg-dark">
            <div class="background opac">
                <img src="template/images/food1.jpg" alt="">
            </div>
            <div class="container h-100 text-white">
                <div class="row h-100 h-sm-auto">
                    <div class="col-12 col-md-8 col-lg-5 col-xl-4 mx-auto align-self-center text-center">
                        <div class="loader-logo">
                            <div class="logo"><img style="height:100px" src="template/images/delivery.png" alt="" class="header-logo"></div>
                        </div>
                        <br>
                        <br>
                        <h5 class="font-weight-light mb-1 text-mute">Bem-vindo,</h5>
                        <h3 class="font-weight-normal mb-4">Faça login para continuar</h3>

                        <div class="form-group">
                            <label for="inputEmail" class="sr-only">Nome do usuário</label>
                            <input type="email" id="inputEmail" class="form-control form-control-lg border-0" placeholder="Nome de Usuário" required="" autofocus="">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="sr-only">Senha</label>
                            <input type="password" id="inputPassword" class="form-control form-control-lg border-0" placeholder="Sua senha" required="">
                        </div>

                        <div class="my-3 row">
                            <div class="col-6 col-md py-1 text-left">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                                    <label class="custom-control-label" for="customCheck1">Continuar logado</label>
                                </div>
                            </div>
                            <div class="col-6 col-md py-1 text-right text-md-right">
                                <a href="javascript: void(0);" Onclick="recovery();" class="text-white">Esqueceu a senha?</a>
                            </div>
                        </div>
						<div id="load"></div>
                        <div class="mb-4">
                            <a href="javascript:void(0);"  Onclick="logar();" class=" btn btn-lg btn-default default-shadow btn-block" style="color: #000;">Logar <span class="ml-2 icon arrow_right"></span></a>
                        </div>
                        <div class="mb-4">
                            <p>Ainda não tem conta?<br>Por favor <a href="register.php" class="text-white">Registrar-se</a> aqui.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End of page content -->


    <!-- scroll to top button -->
    <button type="button" class="btn btn-default default-shadow scrollup bottom-right position-fixed btn-44"><span class="arrow_carrot-up"></span></button>
    <!-- scroll to top button ends-->
	<? } ?>
    <!-- final do invólucro -->
<div id="modalform" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="modals">
</div>
</div>
</div>
<? include('scripts.php');?>
<script>
        $(window).on('load', function() {
            $('body').addClass('header-dark');
        })

</script>
</body>
</html>

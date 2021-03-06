<?

ob_start();

session_start();

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
    <div class="row no-gutters vh-100 loader-screen">
        <div class="bg-template background-overlay"></div>
        <div class="col align-self-center text-white text-center">
            <img style="height:50px" src="template/images/logo.png" alt="logo">
            <h1 class="mb-0 mt-3"></h1><p class="text-mute subtitle"></p>
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
                        <h4><br><small class="text-mute"></small></h4>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="registrar.php" class="btn btn-link">Registrar</a>
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
                            <form class="form-signin" method="post" action="login.php" autocomplete="off">
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        <i class="material-icons text-mute mt-2">account_circle</i>
                                    </div>
                                    <div class="col pl-0">
                                        <div class="form-group float-label active">
                                            <input type="text" id="inputEmail" name="login" class="form-control" required autofocus >
                                            <label for="inputEmail" class="form-control-label">Nome do usuário</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        <i class="material-icons text-mute mt-1">lock</i>
                                    </div>
                                    <div class="col pl-0">
                                        <div class="form-group float-label">
                                            <input type="password" autocomplete="off" id="inputPassword" name="senha" class="form-control" onkeypress="if (event.keyCode === 13) {logar();}" required>
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
    <!-- final do invólucro -->
<div id="modalform" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="modals">
</div>
</div>
</div>
<? include('scripts.php');?>
<script>
 $(window).on('load', function() 
 {
       $('body').addClass('header-dark');
 });
</script>
</body>
</html>

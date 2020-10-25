<?

$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu0'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

?>             
<div class="container-fluid bg-template mb-4">
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Agenda";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                    <input type="text" Onclick="" class="form-control form-control-lg search bottom-25 position-relative border-0" placeholder="Search">
                </div>
            </div>
        </div>   
<div class="container pt-5">
            <div class="row">
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background">
                            <img src="template/images/escova-inteligente.jpg" alt="">
                        </div>
                        <div>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1" style="font-size: 95%;">Joary Taques Figueiredo Neto</h6>
					<p><span>Hora: 14:30hs</span></p>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">Marcado no dia: 19/10/2020</span></p>
                </div>
				<div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background">
                            <img src="images/weightless-60632_640%402x.png" alt="">
                        </div>
                        <div>
                            <button class="btn btn-rounded-34 btn-info button-fab-right-bottom">
                                <i class="material-icons md-16">share</i>
                            </button>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1">Arts and Science</h6>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">3 Updates</span></p>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background">
                            <img src="images/fruit-2305192_640%402x.png" alt="">
                        </div>
                        <div>
                            <button class="btn btn-rounded-34 btn-info button-fab-right-bottom">
                                <i class="material-icons md-16">share</i>
                            </button>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1">Agriculture Farming</h6>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">3 Updates</span></p>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background">
                            <img src="images/ipad-820272_640%402x.png" alt="">
                        </div>
                        <div>
                            <button class="btn btn-rounded-34 btn-info button-fab-right-bottom">
                                <i class="material-icons md-16">share</i>
                            </button>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1">Information Technology</h6>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">3 Updates</span></p>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background">
                            <img src="images/weightless-60632_640%402x.png" alt="">
                        </div>
                        <div>
                            <button class="btn btn-rounded-34 btn-info button-fab-right-bottom">
                                <i class="material-icons md-16">share</i>
                            </button>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1">Arts and Science</h6>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">3 Updates</span></p>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background">
                            <img src="images/fruit-2305192_640%402x.png" alt="">
                        </div>
                        <div>
                            <button class="btn btn-rounded-34 btn-info button-fab-right-bottom">
                                <i class="material-icons md-16">share</i>
                            </button>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1">Agriculture Farming</h6>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">3 Updates</span></p>
                </div>
            </div>

        </div>
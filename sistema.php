<?

ob_start();

session_start();

require_once("./load/load.php");

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

function formatohora($horas){
    return date("H:i", strtotime($horas));
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

//echo $_SESSION['sistema'];

?>
<!doctype html>
<html lang="pt-br" class="color-theme-blue">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">

    <title>EC Tecnologia</title>

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="template/vendor/materializeicon/material-icons.css">

    <!-- Roboto fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="template/vendor/bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- page CSS -->
    <link href="template/vendor/switchery/dist/switchery.min.css" rel="stylesheet" />
	
	<!-- autocomplete CSS -->
    <link rel="stylesheet" href="template/vendor/EasyAutocomplete-1.3.5/easy-autocomplete.css" >
	
    <!-- Swiper CSS -->
    <link href="template/vendor/swiper/css/swiper.min.css" rel="stylesheet">
	
    <link href="template/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Page plugins css -->
    <link href="template/vendor/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="template/vendor/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="template/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="template/vendor/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="template/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	
    <!-- Custom styles for this template -->
    <link href="template/css/style.css" rel="stylesheet">
	
	<!--alerts CSS -->
    <link href="template/vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	
	<!-- Calendar CSS -->
    <link href="template/vendor/calendar/dist/fullcalendar.css" rel="stylesheet" />
	
	<script type="text/javascript" src="template/js/AjaxScript.js.php"></script>
	
<style>
.tableFixHead          { 
  overflow-y: auto; 
  height: auto;
  border: 1px solid;
  border-color: lightgray;
  border-radius: 14px 14px 14px 14px;
  }
.tableFixHead thead th { position: sticky; top: 0; }
.tableFixHead thead th { background:#fff; }

.form-control 
{
    height: calc(2.5em + .75rem + 2px) !important;
}
</style>
</head>

<body>
    <!-- Loader -->
    <div class="row no-gutters vh-100 loader-screen">
        <div class="bg-template background-overlay"></div>
        <div class="col align-self-center text-white text-center">
            <img style="height:50px" src="template/images/logo.png" alt="logo">
            <h1 class="mb-0 mt-3">EC</h1><p class="text-mute subtitle"> Tecnologia</p>
            <div class="loader-ractangls">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Loader ends -->

    <!-- sidebar -->
    <div class="sidebar">
        <div class="row no-gutters">
            <div class="col-auto align-self-center">
                <figure class="avatar avatar-40">
                    <img src="images/man-930397_640%402x.png" alt="">
                </figure>
            </div>
            <div class="col pl-3 align-self-center">
                <p class="my-0"><?=$_SESSION['nome']?></p>
                <p class="text-mute my-0 small">
				<?
				
				switch($_SESSION['tipo'])
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
                <a href="login.php" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
            </div>
        </div>
		
        <div class="list-group main-menu my-5">
			<nav class="navbar" style="padding: .1rem 0rem;">
                <ul class="navbar-nav">
				    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="sistema.php?url=inicio" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action active">
                                <i class="material-icons">perm_contact_calendar</i> Agenda
                            </div>
                        </a>
					</li>
                    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">home</i> Caixa
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <a href="javascript:void(0)" id="catual" class="sidebar-close dropdown-item menu-right">
							 Caixa Atual
                            </a>
                            <a href="sistema.php?url=cad_caixaalteriores" id="canteriores" class="sidebar-close dropdown-item menu-right">
                             Caixa Anteriores
                            </a>
                            <a href="sistema.php?url=cad_cmeiodepagamento" id="cmpagamento" class="sidebar-close dropdown-item popup-open" >
                             Meios de Pagamento
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- sidebar ends -->

    <!-- wrapper starts -->
    <div class="wrapper">

        <!-- header -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn btn-link menu-btn" id="btnshow"><i class="material-icons menu">menu</i><i class="material-icons closeicon">close</i><span class="new-notification"></span></button>
                </div>
                <div class="col text-left">
                    <div class="header-logo">
                        <img style="height:50px" src="template/images/logo.png" alt="" class="header-logo">
                        <h4>EC<br><small class="text-mute">Tecnologia</small></h4>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="notification.html" class="btn btn-link"><i class="material-icons">notifications_none</i><span class="counts">9+</span></a>
                </div>
            </div>
        </div>
        <!-- header ends -->


        <!-- page content here -->
        
        <div id="conteudo">
		<?php
		if(Empty($_SESSION['manutencao']))
		{
			$_SESSION['manutencao'] = 0;
		}
				   
		if($_SESSION['manutencao']!=1)
		{
			include("url.php");
		}
		else
		{
			include("url2.php");
		} 
		?>
        <!-- page content ends -->
        </div>

        <!-- footer -->
        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="sistema.php?url=inicio" class="btn btn-link-default active">
                                <span class="icon-text"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="text-name">Agenda</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="caixa.php" class="btn btn-link-default">
                                <span class="icon-text"><i class="material-icons">store_mall_directory</i></span>
                                <span class="text-name">Vendas</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- footer ends -->
</div>
<? if($_GET['url'] == "inicio"){?>
 <div class="menu pmd-floating-action" role="navigation"> 
        <button class="pmd-floating-action-btn btn btn-lg pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" id="aagenda"> 
            <span class="pmd-floating-hidden">Primary</span>
            <i class="material-icons pmd-sm">perm_contact_calendar</i> 
        </button> 
    </div>
<script>

function alteradata()
{
	$('#nome').val('');
}

function buscarcliente(nome)
{
	if(event.key === 'Enter') 
	{
	   $('#codigo').val('');
	   requestPage2('?br=atu_pesquisa&pesquisa='+ nome +'&ap=1','pesquisacliente','GET');
	}
}

function codigo(codigo)
{	
   // if(event.key === 'Enter') 
	//{
	   var datav = document.getElementById('dataagenda').value;
	   //var codigo = document.getElementById('codigo').value;
	
	   if(datav == "")
	   {
		  swal('Atenção', 'Selecione uma data.');
	   }
	   else if(codigo == "")
	   {
		  swal('Atenção', 'Selecione um cliente.');
	   }
	   else
   	   {
	      //$('#codigo').val(codigo);
	      requestPage2('?br=atu_pesquisa&codigo='+ codigo +'&data='+ datav +'&ap=2','horario','GET');
	   }
	//}
}

function auto()
{
	document.getElementById('pcliente').style.display = 'none';
}

</script>
<div id="agenda" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel"><b>Agendar Horario </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                    <div class="modal-body">
									
									<div class="row">
									<div class="col-12">
									<div class="form-group col-md-12 m-t-20" id="inputcliente"><label>Data:</label>
									    <input name="dataagenda" id="dataagenda" OnChange="alteradata();" type="text" autocomplete="off" class="form-control" required="required" />
									</div>
									<div class="form-group col-md-12 m-t-20" id="inputcliente"><label>Pesquisar Cliente:</label>
										<input name="codigo" id="codigo" onchange="codigo(this.value)" type="hidden" autocomplete="off" class="form-control" required="required" />
									    <input name="nome" id="example-ajax-post" type="text" style="width:300px" autocomplete="off" class="form-control" required="required" />
									<div id="pesquisacliente"></div>
									
									</div>
									<div class="form-group col-md-4 m-t-20" id="horario">
									    <input name="hora" id="hora" type="hidden" autocomplete="off" class="form-control" required="required" />
									</div>
									
							</div>
						</div>
                    
                    <div class="modal-footer">
						<div class="row">
                         <div class="col">
						 <button type="button" onclick="agendar();"  class="btn btn-outline-primary rounded mb-2">Gravar</button>
                         <button type="button" class="btn btn-outline-danger rounded mb-2" data-dismiss="modal">Sair</button>
					   </div></div>
                    </div>
					</div>
                 </div>
										
                <!-- /.modal-content -->
            </div>						
        <!-- /.modal-dialog -->
    </div>	
   <div id="editaagenda" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
			
			
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel"><b>Reagendar </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                    <div class="modal-body">
									 
									<div id="loadagenda">
									<div class="row">
									<div class="col-12">
									</div>
							</div>
						</div>
                    
                    <div class="modal-footer">
						<div class="row">
                         <div class="col">
						 <button type="button" id="reagendarr" class="btn btn-outline-primary rounded mb-2">Gravar</button>
                         <button type="button" class="btn btn-outline-danger rounded mb-2" data-dismiss="modal">Sair</button>
					   </div></div>
                    </div>
					</div>
                 </div>
										
                <!-- /.modal-content -->
            </div>						
        <!-- /.modal-dialog -->
    </div>	
    <!-- wrapper ends -->
	<? } ?>
	<? if($_GET['url'] == "cad_caixaalteriores"){?>
	<div id="extratocaixaanteriores" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Extrato </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div id="loadanteriores">											 
											</div>
											</div>
											</div>
                                            </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
                            </div>
                    </div>
										
                 <!-- /.modal-content -->
              </div>
									
           <!-- /.modal-dialog -->
      </div>
    <? } ?>

    <!-- jquery, popper and bootstrap js -->
    <script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/js/popper.min.js"></script>
    <script src="template/vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <script src="template/vendor/switchery/dist/switchery.min.js"></script>

    <!-- swiper js -->
    <script src="template/vendor/swiper/js/swiper.min.js"></script>

    <!-- cookie js -->
    <script src="template/vendor/cookie/jquery.cookie.js"></script>


    <!-- template custom js -->
    <script src="template/js/main.js"></script>

	<script src="template/js/perso.js"></script>

	<!-- Plugin JavaScript -->
    <script src="template/vendor/moment/moment.js"></script>
    <script src="template/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="template/vendor/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="template/vendor/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="template/vendor/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="template/vendor/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="template/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="template/vendor/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="template/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="template/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script>
	jQuery('#dataagenda').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
		language: "pt-BR",
		orientation: "bottom left"
    });
    </script>
    <!-- Sweet-Alert  -->
    <script src="template/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="template/vendor/sweetalert/jquery.sweet-alert.custom.js"></script>
	
	<!-- MASK INPUT -->
    <script src="template/vendor/mask.money/jquery.maskMoney.js"></script>
    <script>
        $("#dinheiro").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ctdebito").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ctcredito").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ted").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#desc").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    </script>
	
	<!-- autocomplete js--> 
    <script src="template/vendor/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script> 

    <!-- page specific script -->
    <script src="template/js/autocomplete.js"></script>
</body>

</html>

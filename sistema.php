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

?>
<!doctype html>
<html lang="pt-br" class="color-theme-blue">

<head>
<? include 'css.php';?>
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
            <? if($_SESSION['tipo'] == 2){?>
			<div class="col pl-3 align-self-center">
                <p class="my-0"><?=$_SESSION['nome']?></p>
                <p class="text-mute my-0 small">
				<?
				
				switch($_SESSION['permissao'])
			    {
					case 1:
					{
						echo "Aluno";
					}
					break;
					case 2:
					{
						echo "Professor";
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
			<?}?>
			<? if($_SESSION['tipo'] == 3){?>
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
			<?}?>
            <div class="col-auto align-self-center">
                <a href="login.php" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
            </div>
        </div>
		<? if($_SESSION['tipo'] == 2){?>
        <div class="list-group main-menu my-5">
			<nav class="navbar" style="padding: .1rem 0rem;">
                <ul class="navbar-nav">
				    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="sistema.php?url=linhadotempo" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action active">
                                <i class="material-icons">perm_contact_calendar</i> Linha do tempo
                            </div>
                        </a>
					</li>
					<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="sistema.php?url=cad_alunos" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">perm_contact_calendar</i> Alunos
                            </div>
                        </a>
					</li>
					<? } ?>
					<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">home</i> Aulas
                            </div>
                        </a>
						
                        <div class="dropdown-menu">
						    <?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="sistema.php?url=cad_diario" class="sidebar-close dropdown-item menu-right">
							 Conteúdo Lecionado
                            </a>
                            <? } ?>
							<?if($_SESSION['permissao'] == 3){?>
							<a href="sistema.php?url=cad_fechar" class="sidebar-close dropdown-item menu-right">
                             Fechar Bimestre
                            </a>
                            <a href="sistema.php?url=cad_abrir" class="sidebar-close dropdown-item popup-open" >
                             Abrir Bimestre
                            </a>
		                    <?}?>
                        </div>
						<? } ?>
                    </li>
					<?if($_SESSION['permissao'] == 3){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="sistema.php?url=cad_usuarios" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">perm_contact_calendar</i> Usuarios
                            </div>
                        </a>
					</li>
					<? } ?>
                </ul>
            </nav>
        </div>
		<?}?>
		<? if($_SESSION['tipo'] == 3){?>
        <div class="list-group main-menu my-5">
			<nav class="navbar" style="padding: .1rem 0rem;">
                <ul class="navbar-nav">
				    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="sistema.php?url=inicio" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action active">
                                <i class="material-icons">perm_contact_calendar</i> Agenda - <?=$_SESSION['tipo'];?>
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
                            <a href="javascript:void(0)" id="canteriores" class="sidebar-close dropdown-item menu-right">
                             Caixa Anteriores
                            </a>
                            <a href="javascript:void(0)" id="cmpagamento" class="sidebar-close dropdown-item popup-open" >
                             Meios de Pagamento
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
		<?}?>
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

<? if($_SESSION['tipo'] == 2){?>
        <!-- footer -->
        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="javascript:void(0)" id="ldotempo" class="btn btn-link-default active">
                                <span class="icon-text"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="text-name">Linha do tempo</span>
                            </a>
                        </div>
						<div class="col-auto">
                            <a href="sistema.php?url=cad_diario" class="btn btn-link-default">
                                <span class="icon-text"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="text-name">Diario</span>
                            </a>
                        </div>
						<!--<div class="col-auto">
                            <a href="javascript:void(0)" class="btn btn-link-default ">
                                <span class="icon-text"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="text-name">Finalizado</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="caixa.php" class="btn btn-link-default">
                                <span class="icon-text"><i class="material-icons">store_mall_directory</i></span>
                                <span class="text-name">Vendas</span>
                            </a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
<? } ?>
<? if($_SESSION['tipo'] == 3){?>
        <!-- footer -->
        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="javascript:void(0)" id="ldata" class="btn btn-link-default active">
                                <span class="icon-text"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="text-name">Data</span>
                            </a>
                        </div>
						<div class="col-auto">
                            <a href="javascript:void(0)" class="btn btn-link-default">
                                <span class="icon-text"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="text-name">Agendado</span>
                            </a>
                        </div>
						<div class="col-auto">
                            <a href="javascript:void(0)" class="btn btn-link-default ">
                                <span class="icon-text"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="text-name">Finalizado</span>
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
		<div class="menu pmd-floating-action" role="navigation" style="bottom: 80px;"> 
        <button class="pmd-floating-action-btn btn btn-lg pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" id="aagenda" data-title="Concluir"> 
            <span class="pmd-floating-hidden">Primary</span>
            <i class="material-icons pmd-sm">perm_contact_calendar</i> 
        </button> 
</div>
<!-- footer ends -->
<? } ?>
</div>

<? if($_SESSION['tipo'] == 3){?>
<script>

function data(valor)
{
	if(event.key === 'Enter') 
	{
	  if(valor == "")
	  {
	    swal('Atenção', 'Selecione uma data.');
	  }
	  else
   	  {
	      //$('#codigo').val(codigo);
		$( "dataagenda" ).datepicker( "hide" );
	    requestPage2('?br=atu_pesquisa&codigo=<?=$_SESSION['codcliente'];?>&data='+ valor +'&tipo=2&ap=2','loadfagenda','GET');
	  }
	}
}

function bcliente(nome)
{
	if(event.key === 'Enter') 
	{
	   $('#codigo').val('');
	   requestPage2('?br=atu_pesquisa&pesquisa='+ nome +'&tipo=2&ap=1','pesquisacliente','GET');
	}
}

function cliente(codigo,nome)
{	
	if(codigo == "")
	{
	    swal('Atenção', 'Selecione um cliente.');
	}
	else
   	{
	      //$('#codigo').val(codigo);
	    requestPage2('?br=atu_pesquisa&codigo='+ codigo +'&nome='+ nome +'&tipo=1&ap=2','loadfagenda','GET');
	}
}

</script>
<div id="agenda" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                            <div class="modal-header">
								<h2 class="pmd-card-title-text">Agendar Horario</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                    <div class="modal-body">
									
									<div class="row">
									<div class="col-12" id="loadfagenda">
									
									<!--<div class="form-group col-md-12 m-t-20" id="inputcliente"><label>Data:</label>
									    <input name="dataagenda" id="dataagenda" OnChange="alteradata();" type="text" autocomplete="off" class="form-control" required="required" />
									</div>
									<div class="form-group col-md-12 m-t-20" id="inputcliente"><label>Pesquisar Cliente:</label>
										<input name="codigo" id="codigo" onchange="codigo(this.value)" type="hidden" autocomplete="off" class="form-control" required="required" />
									    <input name="nome" id="nome" type="text" style="width:300px" autocomplete="off" class="form-control" required="required" />
									<div id="pesquisacliente"></div>
									
									</div>
									<div class="form-group col-md-4 m-t-20" id="horario">
									    <input name="hora" id="hora" type="hidden" autocomplete="off" class="form-control" required="required" />
									</div>-->
									
							        </div>
						</div>
                    
                    <div class="modal-footer">
						<div class="row">
                         <div class="col">
						 <button type="button" onclick="agendar();"  class="btn pmd-btn-outline pmd-ripple-effect btn-primary">Gravar</button>
                         <button type="button" class="btn pmd-btn-outline pmd-ripple-effect btn-danger" data-dismiss="modal">Sair</button>
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
						 <button type="button" id="reagendarr" class="btn pmd-btn-outline pmd-ripple-effect btn-primary">Gravar</button>
                         <button type="button" class="btn pmd-btn-outline pmd-ripple-effect btn-danger" data-dismiss="modal">Sair</button>
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
	<? if($_GET['url'] == "cad_caixaalteriores" and $_SESSION['tipo'] == 3){?>
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
                                <button type="button" class="btn pmd-btn-outline pmd-ripple-effect btn-danger" data-dismiss="modal">Fechar</button>
                            </div>
                    </div>
										
                 <!-- /.modal-content -->
              </div>
									
           <!-- /.modal-dialog -->
      </div>
    <? } ?>
	<? if($_GET['url'] == "cad_usuarios" and $_SESSION['permissao'] == 3){?>
<div id="modalusuario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="modals">
<!-- /.modal-content -->
</div>

<!-- /.modal-dialog -->
</div>
</div>
      <? } ?>
<? include 'scripts.php'?>

</body>

</html>

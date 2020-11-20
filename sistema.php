<?

ob_start();

session_start();

date_default_timezone_set('America/Cuiaba');

if($_SESSION['usuario'] == "")
{
	print("<script>window.location.href='index.php';</script>");
}
else
{

require_once("./load/load.php");

function isMobile() 
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
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

@media screen and (max-width: 480px) {
.modal-dialog {
    margin: -0.1rem !important;
}
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
                    <img src="template/images/usuario.png" alt="">
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
                <a href="login.php?deslogar=1" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
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
                        <a class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">perm_contact_calendar</i> Alunos
                            </div>
                        </a>
						<div class="dropdown-menu">
						    <?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="sistema.php?url=cad_alunos&cadastro=1" class="sidebar-close dropdown-item menu-right">
							 Cadastrar
                            </a>
                            <? } ?>
							<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="sistema.php?url=cad_alunos" class="sidebar-close dropdown-item menu-right">
							 Lista de Alunos
                            </a>
                            <? } ?>
                        </div>
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
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">perm_contact_calendar</i> Relatorio
                            </div>
                        </a>
						<div class="dropdown-menu">
						    <?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" id="relatorio_diario" class="sidebar-close dropdown-item menu-right" class="btn btn-info" data-toggle="modal" data-target="#modalusuario">
							 Diario de Classe
                            </a>
							<?}?>
                        </div>
					</li>
					<? } ?>
					<?if($_SESSION['permissao'] == 3){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="sistema.php?url=cad_usuarios" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">supervisor_account</i> Usuarios
                            </div>
                        </a>
					</li>
					<? } ?>
					<? if(isMobile()){?>
					<li class="nav-item dropdown" style="width: 230px;" id="btninstall">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">get_app</i> Instalar App
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
				    <?if(@$_SESSION['permissao'] == 2 or @$_SESSION['permissao'] == 2 or @$_SESSION['permissao'] == 3  or @$_SESSION['permissao'] == 4){?>
				    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="sistema.php?url=inicio" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action active">
                                <i class="material-icons">perm_contact_calendar</i> Agenda
                            </div>
                        </a>
					</li>
					<? } ?>
					<?if(@$_SESSION['permissao'] == 2 or @$_SESSION['permissao'] == 4){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="caixa.php" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">perm_contact_calendar</i> Vendas
                            </div>
                        </a>
					</li>
					<? } ?>
					<?if(@$_SESSION['permissao'] == 3 or @$_SESSION['permissao'] == 4){?>
                    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">home</i> Caixa
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <a href="sistema.php?url=cad_caixaatual" class="sidebar-close dropdown-item menu-right">
							 Caixa Atual
                            </a>
                            <a href="sistema.php?url=cad_caixaalteriores" class="sidebar-close dropdown-item menu-right">
                             Caixa Anteriores
                            </a>
                            <a href="sistema.php?url=cad_cmeiodepagamento" class="sidebar-close dropdown-item popup-open" >
                             Meios de Pagamento
                            </a>
                        </div>
                    </li>
					<? } ?>
					<?if(@$_SESSION['permissao'] == 4){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">card_giftcard</i> Produtos
                            </div>
                        </a>
						<div class="dropdown-menu">
                            <a href="sistema.php?url=cad_produtos&cadastro=1" id="catual" class="sidebar-close dropdown-item menu-right">
							 Cadastrar
                            </a>
                            <a href="sistema.php?url=cad_produtos" id="canteriores" class="sidebar-close dropdown-item menu-right">
                             Lista de Produtos
                            </a>
                        </div>
					</li>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="sistema.php?url=cad_usuarios" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">supervisor_account</i> Usuarios
                            </div>
                        </a>
					</li>
					<? } ?>
					<? if(isMobile()){?>
					<li class="nav-item dropdown" style="width: 230px;" id="btninstall">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">get_app</i> Instalar App
                            </div>
                        </a>
					</li>
		           <? } ?>
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
                                <span class="text-name">Agenda</span>
                            </a>
                        </div>
						<!--<div class="col-auto">
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
                        </div>-->
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
		<?if($_GET['url'] == "inicio"){?>
		 <div class="menu pmd-floating-action" role="navigation" style="bottom: 80px;"> 
        <a href="javascript:void(0);" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-default" data-title="Clientes"> 
            <span class="pmd-floating-hidden">Clientes</span> 
            <i class="material-icons">supervisor_account</i> 
        </a> 
        <a href="javascript:void(0);" id="aagenda" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-default" data-title="Agenda"> 
            <span class="pmd-floating-hidden">Agendar</span> 
            <i class="material-icons">perm_contact_calendar</i> 
        </a> 
        <button type="button" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" data-title="Add"> 
            <span class="pmd-floating-hidden">Primary</span>
            <i class="material-icons pmd-sm">add</i> 
        </button> 
        </div>
		<?}?>
<!-- footer ends -->
<? } ?>
</div>

<? if($_SESSION['tipo'] == 3){?>
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
<div id="modalusuario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="modals">
<!-- /.modal-content -->
</div>

<!-- /.modal-dialog -->
</div>
</div>
<? include 'scripts.php'?>
</body>

</html>
<? } ?>
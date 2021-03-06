<?


date_default_timezone_set('America/Cuiaba');

if(!isset($_SESSION['usuario']))
{
	print("<script>window.location.href='login.php';</script>");
}
else
{

function isMobile() 
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

?>
<!doctype html>
<html lang="pt-br" class="color-theme-<?=$_SESSION['tema'];?>">

<head>
<? include 'template/layout/spa/css.php';?>
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
                <a href="/?sl=login" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
            </div>
        </div>
    <? include 'menu.php';?>
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
                    <a href="#" class="btn btn-link"><i class="material-icons">notifications_none</i><span class="counts">0+</span></a>
                </div>
            </div>
        </div>
        <!-- header ends -->


        <!-- page content here -->
	    <script>
		window.onload = function ()
		{
			requestPage('?br=agenda','conteudo','GET');
		}
		</script>
		
        <div id="conteudo">
		<? if($_SESSION['tipo'] == 2){
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
		}
		?>
        <!-- page content ends -->
        </div>
		
        <? if($_SESSION['tipo'] == 3){?>
        <!-- footer -->
        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">
					   <? if(@$_SESSION['permissao'] == 2 or @$_SESSION['permissao'] == 3 or @$_SESSION['permissao'] == 4){?>
                        <div class="col-auto">
                            <a href="javascript: void(0);" class="btn btn-link-default t-menu t-agenda">
                                <span class="icon-text"><i class="material-icons">perm_contact_calendar</i></span>
                                <span class="text-name">Agenda</span>
                            </a>
                        </div>
						<? } ?>
						<? if(@$_SESSION['permissao'] == 3 or @$_SESSION['permissao'] == 4){?>
						<div class="col-auto">
                            <a href="javascript: void(0);" class="btn btn-link-default t-menu t-produtos">
                                <span class="icon-text"><i class="material-icons">card_giftcard</i></span>
                                <span class="text-name">Produtos</span>
                            </a>
                        </div>
						<? } ?>
						<? if(@$_SESSION['permissao'] == 3 or @$_SESSION['permissao'] == 4){?>
                        <div class="col-auto">
                            <a href="javascript: void(0);" class="btn btn-link-default t-menu t-vendas">
                                <span class="icon-text"><i class="material-icons">store_mall_directory</i></span>
                                <span class="text-name">Vendas</span>
                            </a>
                        </div>
						<? } ?>
                    </div>
                </div>
            </div>
        </div>
		<div class="menu pmd-floating-action menu1" role="navigation" style="bottom: 80px; display: none;"> 
        <a href="javascript:void(0);" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-default a-cliente" data-title="Clientes"> 
            <span class="pmd-floating-hidden">Clientes</span> 
            <i class="material-icons">supervisor_account</i> 
        </a> 
        <a href="javascript:void(0);" class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-default a-agenda" data-title="Agendar"> 
            <span class="pmd-floating-hidden">Agendar</span> 
            <i class="material-icons">perm_contact_calendar</i> 
        </a> 
        <button type="button" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" data-title="Add"> 
            <span class="pmd-floating-hidden">Primary</span>
            <i class="material-icons pmd-sm">add</i> 
        </button> 
        </div>
		
		<div class="menu pmd-floating-action menu2" role="navigation" style="bottom: 80px; display: none;">
		<button class="pmd-floating-action-btn btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" type="button" onclick="c_desconto();" data-title="[%] Desconto">
		<span class="pmd-floating-hidden">[%] Desconto</span> 
		<i class="material-icons pmd-sm">trending_down</i>
		</button> 
		<button type="button" class="pmd-floating-action-btn btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-info" data-title="Menu"> 
		<span class="pmd-floating-hidden">Primary</span>
		<i class="material-icons pmd-sm">extension</i> 
		</button> 
		</div>
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
	<? if($_SESSION['tipo'] == 3){?>
	<div id="extrato" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Extrato </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div id="loadextrato">											 
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
<? if($_SESSION['tipo'] == 3){?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel1">Atenção!</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div id="loading"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<a href="iniciado.php?url=cad_diario&fechar=1" class="btn btn-primary">Continuar</a>
			</div>
		</div>
	</div>
</div>
<div id="itens" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="pmd-card-title-text">Lista de Produtos </h2>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
			<div class="row">
			
			<div class="form-group col-md-12 m-t-20"><label>Busca:</label>
			 <input name="user" type="text" class="form-control" onkeyup="javascript: ajaxLoader('?br=atu_produtos&pesquisa='+ this.value +'&ap=1','list_produtos','GET');" />
			</div>
			<div class="col-md-12">
			<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
			<table class="table pmd-table">
			<thead>
			  <tr>
			<th>Codigo</th>
			<th>Descrição</th>
			<th>Preço R$</th>
			<th>Estoque</th>
			</tr>
			 </thead>
			   <tbody id="list_produtos">
			   <?
			   $data = date('Y');
			   $sql = "select * from produtos where sistema='".$_SESSION['sistema']."'";
			   $res = mysqli_query($db3,$sql); 
			   $x = 0;
			   while($row = mysqli_fetch_array($res))
			   {
			   ?>
			   <tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="itens('<? echo $row['descricao'];?>',<? echo $row['codigo'];?>,'<? echo number_format($row['preco'],2,",",".");?>');">
			   <td data-title="Codigo"><? echo $row['codigo'];?></td>
			   <td data-title="Descrição"><? echo $row['descricao'];?></td>
			   <td data-title="Preço R$"><? echo $row['preco'];?></td>
			   <td data-title="Estoque"><? echo $row['estoque'];?></td>
			   </tr>
			   <? $x = 1;
			   }

				if($x == 0)
				{
				 echo "<tr><td colspan='4'>Nenhum resultado encontrado.</td></tr>";
			   
			   }
			   ?>
			 </tbody>
			
			</table>											 
			</div>
			</div>
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-danger rounded mb-2" data-dismiss="modal">Fechar</button>
			</div>
		</div>
		
		<!-- /.modal-content -->
	</div>
	
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="pagamento" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel1"><b>Receber </b></h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
			<div class="row">
			<div class="col-12">
			<form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>">
			<div class="input-group col-md-12 m-t-20">
			<h1 class="pmd-display1" style="color: green; font-weight: bold;">Total: R$ <span id="vtotalp"></span></h1></div>
			<div class="input-group col-md-12 m-t-20">
			<div id="gravar"></div>
			</div>
			<div class="input-group col-md-12 m-t-20">
			<div class="form-group col-md-12 m-t-20 pmd-textfield pmd-textfield-floating-label"><label for="first-name">Dinheiro</label>
			<input type="text" name="dinheiro" id="dinheiro" placeholder="0" onchange="loadpg();" class="form-control mat-input form-control">
			</div>
			<div class="form-group col-md-12 m-t-20 pmd-textfield pmd-textfield-floating-label"><label for="first-name">Cartão de Débito</label>
			<input type="text" name="cdebito" id="ctdebito" placeholder="0" onchange="loadpg();" class="form-control mat-input form-control">
			</div>
			<div class="form-group col-md-12 m-t-20 pmd-textfield pmd-textfield-floating-label"><label for="first-name">Cartão de Crédito</label>
			<input type="text" name="ccredito" id="ctcredito" placeholder="0" onchange="loadpg();" class="form-control mat-input form-control">
			</div>
			<div class="form-group col-md-12 m-t-20 pmd-textfield pmd-textfield-floating-label"><label for="first-name">Transferencia ( Ted, doc, tev, Pix)</label>
			<input type="text" name="ted" id="ted" placeholder="0" onchange="loadpg();" class="form-control mat-input form-control">
			</div>
			</div>
			<div class="form-group col-md-12 m-t-20" id="recebpagamento">
			
			</div>
			<div class="input-group col-md-1 m-t-20">
</div>
			<div class="form-group col-md-12 m-t-20">
			<table id="formpagamento">
			</table>
			</div>
			<div class="input-group col-md-12 m-t-20">
			<h1 class="pmd-display1" style="font-weight: bold;" id="vtroco"></h1>
			</div>
			</form>
			</div>
			</div>
			</div>
			<div class="modal-footer">
			<div class="row">
				 <div class="col">
				<button type="button" onclick="pagar();"  class="btn pmd-btn-outline pmd-ripple-effect btn-primary">Concluir</button>
				<button type="button" class="btn pmd-btn-outline pmd-ripple-effect btn-danger" data-dismiss="modal">Sair</button>
				</div></div>
			</div>
		</div>
	</div>
</div>
<script>
function slow()
{
  if($('#dtable').css('display') == 'none' )
  {
	 $("#forcaixa" ).hide( "slow" );
	 $("#dtable" ).show( "slow" );
	 $("#btncarrinho").attr("data-title","Add Produtos");
  }
  else
  {
	 $("#forcaixa" ).show( "slow" );
	 $("#dtable" ).hide( "slow" );
	 $("#btncarrinho").attr("data-title","Itens do Carrinho");
  }
}

</script>
<? } ?>
<div id="modalap" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="modals">
<!-- /.modal-content -->

</div>

<!-- /.modal-dialog -->
</div>
</div>
<div id="modalbusca" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="modalss">
<!-- /.modal-content -->
</div>

<!-- /.modal-dialog -->
</div>
</div>
<? include 'template/layout/spa/scripts.php'?>
</body>

</html>
<? } ?>
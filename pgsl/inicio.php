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
                    <input type="text" Onkeyup="pesquisar(this.value);" class="form-control form-control-lg search bottom-25 position-relative border-0" placeholder="Pesquisa">
                </div>
            </div>
        </div>   
				  
<div class="container pt-5">
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
			<!--Tabs with Icon example -->
<!--Tabs with Icons and Bottom Labels example -->
<div class="card pmd-card"> 
	<div class="pmd-tabs pmd-tabs-icons-bottom-label">
		<ul class="nav nav-tabs nav-fill" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" href="#icon-with-bottom-label-home" aria-controls="home" role="tab" data-toggle="tab" style="color: rgba(0,0,0,.54);">
					<i class="material-icons pmd-icon-sm">mood</i> 
					Agendados
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#icon-with-bottom-label-about" aria-controls="about" role="tab" data-toggle="tab" style="color: rgba(0,0,0,.54);">
					<i class="material-icons pmd-icon-sm">settings</i>
					Iniciado
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#icon-with-bottom-label-work" aria-controls="work" role="tab" data-toggle="tab" style="color: rgba(0,0,0,.54);">
					<i class="material-icons pmd-icon-sm mr-2">call</i>
					Finalizado
				</a>
			</li>
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="icon-with-bottom-label-home">
			    <div class="row" id="load">
				<?
				$SQL = "SELECT agendamento.codigo,agendamento.cliente,clientes.nome, clientes.celular,agendamento.data,agendamento.hora FROM agendamento inner join clientes on clientes.codigo=agendamento.cliente where agendamento.sistema='".$_SESSION['sistema']."' ORDER BY agendamento.codigo desc";
				$RES = mysqli_query($db3,$SQL);
				while($row = mysqli_fetch_array($RES))
				{
				?>
				
				<div class="col-12 col-md-6 mb-4">
                    <div class="row">
                        <div class="col-4">
                            <figure class="m-0 h-150 w-100 rounded overflow-hidden">
                                <div class="background" style='background-image: url("template/images/escova-inteligente.jpg");height: 105px;'>
                                    
                                </div>
                            </figure>
                        </div>
                        <div class="col pl-0">
                            <h3><? echo $row['nome'];?></h3>
                            <p class="large text-mute" style="font-size: initial;">Dia: <? echo formatodatahora($row['data']);?> às Hora: <? echo formatohora($row['hora']);?>hs</p>
							<button type="button" onclick="whats('<? echo str_replace("(","", str_replace(")","", str_replace("-","",$row['celular'])));?>','Bom dia *<? echo $row['nome'];?>*! %0APassando para lembrar que você tem horário agendado hoje às *<? echo formatohora($row['hora']);?>hs*.%0A%0A *Studio KA*');" class="btn pmd-btn-outline pmd-ripple-effect btn-success">Whats <i class="fa fa-whatsapp" aria-hidden="true"></i></button>
                            <button type="button" onclick="agenda(2,'<? echo $row['codigo'];?>','<? echo $row['cliente'];?>','<? echo $row['data'];?>','<? echo $row['hora'];?>','<? echo $row['nome'];?>');" class="btn pmd-btn-outline pmd-ripple-effect btn-primary">Editar</button>
							<button type="button" onclick="agendaex('<? echo $row['codigo'];?>');" class="btn pmd-btn-outline pmd-ripple-effect btn-danger">Excluir</button>
							
                        </div>
                    </div>
					
                </div>
				
			  <?}?>
			  </div>
			</div>
			<div role="tabpanel" class="tab-pane" id="icon-with-bottom-label-about">Fixed tabs have equal width, calculated either as the view width divided by the number of tabs, or based on the widest tab label. To navigate between fixed tabs, touch the tab or swipe the content area left or right.</div>
			<div role="tabpanel" class="tab-pane" id="icon-with-bottom-label-work">To navigate between scrollable tabs, touch the tab or swipe the content area left or right. To scroll the tabs without navigating, swipe the tabs left or right.</div>
		</div>
	</div>
</div>
<!--Tabs with Icons and Bottom Labels example end -->
<!--Tabs with Icons and Bottom Labels example end -->
<!--Tabs with Icon example end -->
	</div>
</div>
               
				
            </div>

</div>
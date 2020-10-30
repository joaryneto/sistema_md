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
            <div class="row" id="load">
			
                <?
				
				$SQL = "SELECT agendamento.codigo,agendamento.cliente,clientes.nome,agendamento.data,agendamento.hora FROM agendamento inner join clientes on clientes.codigo=agendamento.cliente where agendamento.sistema='".$_SESSION['sistema']."' ORDER BY agendamento.codigo desc";
				$RES = mysqli_query($db3,$SQL);
				while($row = mysqli_fetch_array($RES))
				{
				?>
				
				<div class="col-12 col-md-6 mb-4">
                    <div class="row">
                        <div class="col-4">
                            <figure class="m-0 h-150 w-100 rounded overflow-hidden">
                                <div class="background" style='background-image: url("template/images/escova-inteligente.jpg");'>
                                    
                                </div>
                            </figure>
                        </div>
                        <div class="col pl-0">
                            <b class="h4 mb-3 font-weight-normal"><? echo $row['nome'];?></b>
                            <p class="large text-mute" style="font-size: initial;">Dia: <? echo formatodatahora($row['data']);?> às Hora: <? echo $row['hora'];?>hs</p>
							<button type="button" onclick="agenda(1);" class="mb-2 btn btn-outline-success  rounded-0">Atender</button>
                            <button type="button" onclick="agenda(2,'<? echo $row['codigo'];?>','<? echo $row['cliente'];?>','<? echo $row['data'];?>','<? echo $row['hora'];?>','<? echo $row['nome'];?>');" class="mb-2 btn btn-outline-primary rounded-0">Reagendar</button>
							<button type="button" id="" class="mb-2 btn btn-outline-danger rounded-0">Excluir</button>
                        </div>
                    </div>
                </div>
			  <?}?>
				
            </div>

</div>
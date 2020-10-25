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
                    <input type="text" Onclick="" class="form-control form-control-lg search bottom-25 position-relative border-0" placeholder="Pesquisa">
                </div>
            </div>
        </div>   
<div class="container pt-5">
            <div class="row">
                <?
				$SQL = "SELECT clientes.nome,agendamento.inicio FROM agendamento inner join clientes on clientes.codigo=agendamento.cliente;";
				$RES = mysqli_query($db3,$SQL);
				while($row = mysqli_fetch_array($RES))
				{
				?><div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background">
                            <img src="template/images/escova-inteligente.jpg" alt="">
                        </div>
                        <div>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1" style="font-size: 95%;"><? echo $row['nome'];?></h6>
					<p><span>Hora: 15:00hs</span></p>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">Marcado no dia: <? echo formatodatahora($row['inicio']);?></span></p>
                </div>
			  <?}?>
				
            </div>

        </div>
<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu3'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}
//require_once("../load/class/mysql.php");

$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

if($_SESSION["donoSessao"]  != $tokenUser){
    header("location:login.php");
}

/*if($_GET['load'] == 1)
{
	
$data = array();
$SQL = "SELECT * FROM agendamento ORDER by codigo";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
 $data[] = array(
  'id'   => $row["codigo"],
  'title'   => $row["titulo"],
  'start'   => $row["inicio"],
  'end'   => $row["termino"]
 );
}

echo json_encode($data);

}*/
$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$inputb['ap'] == 1)
{
	$cliente = $inputb['cliente'];
	$nome = $inputb['nome'];
	
	if($cliente == "")
	{
		print('<script>
               swal({   
            title: "Atenção",   
            text: "Escolha um cliente por favor.",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
		print("<script> requestPage2('?br=atu_pesquisa&ap=1','modals','GET');</script> ");
		
	}
	else if($nome == "")
	{
		print('<script>
               swal({   
            title: "Atenção",   
            text: "Escolha um cliente por favor.",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
		print("<script> requestPage2('?br=atu_pesquisa&ap=1','modals','GET');</script> ");
		
	}
	else
	{
		print('<script>
               swal({   
            title: "Atenção",   
            text: "Serviços Agendado com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
		
		$SQL = "UPDATE agendamento SET status=1, cliente='".$cliente."', nome='".$nome."' where sistema='".$_SESSION['sistema']."' and codigo='".$_SESSION['agendamento']."'";
		mysqli_query($db3,$SQL);
	}
}
else if($inputb['ap'] == 2)
{

   $SQL = "UPDATE agendamento SET data='".revertedata($inputb['data'])."', hora='".$inputb['hora']."' WHERE sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'";
   mysqli_query($db3,$SQL);
 ?>
 
  <script> 
  $('#editaagenda').modal('hide');
   swal({   
            title: "Atenção",   
            text: "Reagendado com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
  </script>
 
 <?
}
else if($inputb['ap'] == 3)
{
   $codigo = $inputb['codigo'];
   
   $SQL = "DELETE from agendamento WHERE sistema='".$_SESSION['sistema']."' and codigo='".$codigo."';";
   mysqli_query($db3,$SQL);
   
   $SQL = "DELETE from agendamento_servicos WHERE sistema='".$_SESSION['sistema']."' and agendamento='".$codigo."';";
   mysqli_query($db3,$SQL);
   
 ?>
 
  <script>
  swal({   
            title: "Atenção",   
            text: "Excluido com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
  </script>
 
 <?
}
else if($inputb['ap'] == 3)
{
   $codigo = $inputb['codigo'];
   
   $SQL = "DELETE from agendamento WHERE sistema='".$_SESSION['sistema']."' and codigo='".$codigo."';";
   mysqli_query($db3,$SQL);
   
   $SQL = "DELETE from agendamento_servicos WHERE sistema='".$_SESSION['sistema']."' and agendamento='".$codigo."';";
   mysqli_query($db3,$SQL);
   
 ?>
 
  <script>
  swal({   
            title: "Atenção",   
            text: "Excluido com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
  </script>
 
 <?
}

if($inputb['load'] == 1)
{
	            $pesquisa = @$inputb['pesquisa'];
	
				$SQL = "SELECT agendamento.codigo,agendamento_servicos.codigo as codservico,agendamento.cliente,clientes.nome, clientes.celular,agendamento_servicos.data,agendamento_servicos.hora,agendamento_servicos.profissional FROM agendamento 
				inner join clientes on clientes.codigo=agendamento.cliente 
				inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
				where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.status=0 ORDER BY agendamento.codigo desc";
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
                            <h3><p class="large text-mute" style="font-size: initial;"><? echo $row['nome'];?></p></h3>
                            <p class="large text-mute" style="font-size: initial;">Dia: <? echo formatodata($row['data']);?> às Hora: <? echo formatohora($row['hora']);?>hs</p>
                            <button type="button" onclick="agenda('<? echo $row['profissional'];?>','<? echo $row['codservico'];?>','<? echo $row['cliente'];?>','<? echo $row['data'];?>','<? echo $row['hora'];?>','<? echo $row['nome'];?>');" class="btn pmd-btn-outline pmd-ripple-effect btn-primary">Editar</button>
							<button type="button" onclick="agendaex('<? echo $row['codigo'];?>');" class="btn pmd-btn-outline pmd-ripple-effect btn-danger">Excluir</button>
							<div class="pmd-card-actions">
								<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button" onclick="whats('<? echo str_replace("(","", str_replace(")","", str_replace("-","",$row['celular'])));?>','Bom dia *<? echo $row['nome'];?>*! %0APassando para lembrar que você tem horário agendado hoje às *<? echo formatohora($row['hora']);?>hs*.%0A%0A *Studio KA*');"><i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 210%; color: green;"></i></button>
								<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">thumb_up</i></button>
								<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">drafts</i></button>
							</div>
                        </div>
                    </div>
					
                </div>
				<?
}


?>


















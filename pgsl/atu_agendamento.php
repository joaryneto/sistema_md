<?
ob_start();
session_start();

?>
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

if(isset($_GET["codigo"]) and $_GET['ap'] == 1)
{

 //$hora = date('H:i:s');
 $query = "INSERT INTO agendamento (sistema,cliente, data, hora, nome) VALUES ('".$_SESSION['sistema']."','".$_GET['codigo']."', '".revertedata($_GET['data'])."','".$_GET['hora']."','".$_GET['nome']."')";
 $sucesso = mysqli_query($db3,$query);
 
 if($sucesso == true)
 {
 ?>
 
 <script> 
 swal({   
            title: "Atenção",   
            text: "Agendado com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
 $('#agenda').modal('hide');
 </script>
 
 <?
 }
 else
 {
	?>
 <script> 
 swal("Atenção", "Não foi agendado, verifique os campos.");  
 </script>
<?	
 }
}
else if($_GET['ap'] == 2)
{

   $SQL = "UPDATE agendamento SET data='".revertedata($_GET['data'])."', hora='".$_GET['hora']."' WHERE codigo='".$_GET['codigo']."'";
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
else if($_GET['ap'] == 3)
{
   $SQL = "DELETE from agendamento WHERE codigo='".$_GET['codigo']."'";
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

if($_GET['load'] == 1)
{
	            
	$SQL = "SELECT agendamento.codigo,agendamento.cliente,clientes.nome, clientes.celular,agendamento.data,agendamento.hora FROM agendamento inner join clientes on clientes.codigo=agendamento.cliente where agendamento.sistema='".$_SESSION['sistema']."' and clientes.nome like '%".$_GET['pesquisa']."%' ORDER BY agendamento.codigo asc";
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
                            <p class="large text-mute" style="font-size: initial;">Dia: <? echo formatodatahora($row['data']);?> às Hora: <? echo formatohora($row['hora']);?>hs</p>
							<button type="button" onclick="whats('<? echo str_replace("(","", str_replace(")","", str_replace("-","",$row['celular'])));?>','Bom dia *<? echo $row['nome'];?>*! %0APassando para lembrar que você tem horário agendado hoje às *<? echo formatohora($row['hora']);?>hs*.%0A%0A *Studio KA*');" class="mb-2 btn btn-outline-success  rounded-0">Whats <i class="fa fa-whatsapp" aria-hidden="true"></i></button>
                            <button type="button" onclick="agenda(2,'<? echo $row['codigo'];?>','<? echo $row['cliente'];?>','<? echo $row['data'];?>','<? echo $row['hora'];?>','<? echo $row['nome'];?>');" class="mb-2 btn btn-outline-primary rounded-0">Editar</button>
							<button type="button" onclick="agendaex('<? echo $row['codigo'];?>');" class="mb-2 btn btn-outline-danger rounded-0">Excluir</button>
                        </div>
                    </div>
                </div>
			  <?
			  
	}
}


?>


















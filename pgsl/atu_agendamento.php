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
$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(isset($inputb["codigo"]) and $inputb['ap'] == 1)
{
  
 //$hora = date('H:i:s');
 $query = "INSERT INTO agendamento (sistema,cliente, profissional, data, hora, nome,status) VALUES ('".$_SESSION['sistema']."','".$inputb['codigo']."','".$inputb['pcodigo']."', '".revertedata($inputb['data'])."','".$inputb['hora']."','".$inputb['nome']."','1')";
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
 window.location.href='sistema.php?url=inicio';
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
   $SQL = "DELETE from agendamento WHERE sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'";
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
	
	$SQL = "SELECT agendamento.codigo,agendamento.cliente,clientes.nome, clientes.celular,agendamento.data,agendamento.hora FROM agendamento inner join clientes on clientes.codigo=agendamento.cliente where agendamento.sistema='".$_SESSION['sistema']."' and clientes.nome like '%".$pesquisa."%' ORDER BY agendamento.codigo asc";
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
                            <button type="button" onclick="agenda(2,'<? echo $row['codigo'];?>','<? echo $row['cliente'];?>','<? echo $row['data'];?>','<? echo $row['hora'];?>','<? echo $row['nome'];?>');" class="btn pmd-btn-outline pmd-ripple-effect btn-primary">Editar</button>
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
}


?>


















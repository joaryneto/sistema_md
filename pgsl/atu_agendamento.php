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

if($_GET['load'] == 1)
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

}

if(isset($_GET["cliente"]) and $_GET['ap'] == 1)
{

 $hora = date('H:i:s');
 $query = "INSERT INTO agendamento (cliente,produto, inicio, termino, descricao) VALUES ('".$_GET['cliente']."','".$_GET['produto']."', '".$_GET['start']."', '".$_GET['end']."','".$_GET['descricao']."')";
 $sucesso = mysqli_query($db3,$query);
 
 if($sucesso == true)
 {
 ?>
 
 <script> 
 
 swal("Atenção", "Agendado com sucesso."); 
 $("#calendar").fullCalendar("refetchEvents");
 $('#ModalAdd').modal('hide');   
 </script>
 
 <?
 }
 else
 {
	?>
 <script> 
 
 swal("Atenção", "Não foi agendado, verifique os campos."); 
 $("#calendar").fullCalendar("refetchEvents");
 $('#ModalAdd').modal('hide');   
 </script>
<?	
 }
}
else if(isset($_POST["id"]) and $_GET['ap'] == 2)
{

   $SQL = "UPDATE agendamento SET titulo='".$_POST['title']."', inicio='".$_POST['start']."', termino='".$_POST['end']."' WHERE codigo='".$_POST['id']."'";
   mysqli_query($db3,$SQL);

}
else if(isset($_POST["id"]) and $_GET['ap'] == 3)
{
   $SQL = "DELETE from agendamento WHERE codigo='".$_POST['id']."'";
   mysqli_query($db3,$SQL);
}



?>


















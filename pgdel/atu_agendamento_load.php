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

require_once("../load/class/mysql.php");

if($_GET['load'] == 1)
{
	
$data = array();
$SQL = "SELECT agendamento.codigo,agendamento.inicio,agendamento.termino,agendamento.descricao,clientes.nome, produtos.descricao as desproduto FROM agendamento 
inner join clientes on clientes.codigo=agendamento.cliente 
inner join produtos on produtos.codigo=agendamento.produto
ORDER by agendamento.codigo";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
 $data[] = array(
  'id'   => $row["codigo"],
  'title'   => $row["nome"],
  'start'   => $row["inicio"],
  'end'   => $row["termino"],
  'color'   => '#ff9041',
  'description' => $row["desproduto"]
 );
}

echo json_encode($data);

}

if(isset($_GET["title"]) and $_GET['ap'] == 1)
{
  
 $query = "INSERT INTO agendamento (titulo, inicio, termino) VALUES ('".$_GET['title']."', '".$_GET['start']."', '".$_GET['end']."')";
 //mysqli_query($db3,$query);
 
 print('<script> swal("Atenção", "Agendado com sucesso. '.$query.'"); $("#calendar").fullCalendar("refetchEvents");</script>');
 
 echo "Sucesso";
 
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


















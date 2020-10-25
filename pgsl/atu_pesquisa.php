<?
ob_start();
session_start();

?>
<?

//if($_SESSION['menu3'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}
//require_once("../load/class/mysql.php");

$pesquisa = $_GET['pesquisa'];

//$returns = array();
$SQL = "SELECT * FROM clientes where nome like '%".$pesquisa."%';";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
	//$returns[] =  $row['name'];
	
	//if($_GET['ap'] == "1")
	//{
		echo "<option value='".$row['name']."'>".$row['name']."</option>";
	//}
}

//echo json_encode($returns);

?>


















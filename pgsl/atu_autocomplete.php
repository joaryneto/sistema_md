<?
ob_start();
session_start();

require_once("../load/class/mysql.php");

//header('Content-Type: application/json');

$pesquisa = $_GET['pesquisa'];

$SQL = "SELECT nome,email FROM clientes where nome like '%".$pesquisa."%' LIMIT 10;";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
      $json[] = array('nome' => $row['nome'],'email' => $row['email']);
}

echo json_encode($json);


?>













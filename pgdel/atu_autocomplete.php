<?
ob_start();
session_start();

require_once("../load/class/mysql.php");

//header('Content-Type: application/json');

//$pesquisa = $_GET['pesquisa'];

$SQL = "SELECT nome,codigo FROM clientes where nome like '%".$_GET['nome']."%' limit 10;";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
      $json[] = array('nome' => $row['nome'],'codigo' => $row['codigo']);
}

echo json_encode($json);


?>













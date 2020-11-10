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


    //$nota = number_format((float)$_GET['nota'], 2, '.', '');
	$codigo = $_GET['codigo'];
	$nota = $_GET['nota'];
    $diario = $_GET['diario'];
    $matricula = $_GET['matricula'];
	$disciplina = $_GET['disciplina'];
	$periodo = $_GET['periodo'];
	$data = $_GET['data'];
	
	$count = 0;
	$x = 0;
	$SQL1 = "SELECT * FROM frequencia where codigo=$codigo";
	$sucesso = mysqli_query($db,$SQL1);
	
	while($row = mysqli_fetch_array($sucesso))
	{
		$x = 1;
		
		$count++;
	}
	
	if($x == 1)
	{
		//echo "<br>";
        $SQL = "UPDATE frequencia SET nota='".$nota."' where codigo=$codigo";
     	$sucesso = mysqli_query($db,$SQL);
	}
	else
	{
		print("<script>window.alert('Aluno não esteve presente!".$codigo."');</script>");
		//echo "<br>";
		//$SQL = "INSERT INTO frequencia(diario,matricula,data,falta) values('".$diario."','".$matricula."','".$data."','1');";
		//$sucesso = mysqli_query($db,$SQL);
	}
	
	$SQL = "SELECT sum(nota) as qtd FROM frequencia where codigo=$codigo";
	$RES = mysqli_query($db,$SQL);
	$rows2 = mysqli_fetch_array($RES);
	echo $rows2['qtd'];
	
	
?>	
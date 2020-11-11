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


    $codigo = $_GET['codigo'];
    $check = $_GET['check'];
    $turma = $_GET['turma'];
	
	//$count = 0;
	$x = 0;
	$SQL1 = "SELECT * FROM turmas_professor where usuario=".$codigo." and turma=".$turma."";
	$sucesso = mysqli_query($db,$SQL1);
	
	while($row = mysqli_fetch_array($sucesso))
	{
		$x = 1;
		
		//$count++;
	}
	
	if($x == 1)
	{
		//echo "<br>";
        $SQL = "DELETE FROM turmas_professor where usuario='".$codigo."' and turma=".$turma."";
     	$sucesso = mysqli_query($db,$SQL);
	}
	else
	{
		//print("<script>window.alert('Aluno não esteve presente!');</script>");
		//echo "<br>";
		$SQL = "INSERT INTO turmas_professor(usuario,turma) values('".$codigo."','".$turma."');";
		$sucesso = mysqli_query($db,$SQL);
	}	
	
?>	
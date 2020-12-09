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

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

    
    $codigo = security::input(@$_GET['codigo']);
    $check = security::input(@$_GET['check']);
    $materia = security::input(@$_GET['materia']);
	
	//$count = 0;
	$x = 0;
	$SQL1 = "SELECT * FROM materias_professor where usuario=".$codigo." and materia=".$materia."";
	$sucesso = mysqli_query($db,$SQL1);
	
	while($row = mysqli_fetch_array($sucesso))
	{
		$x = 1;
		
		//$count++;
	}
	
	if($x == 1)
	{
		//echo "<br>";
        $SQL = "DELETE FROM materias_professor where usuario='".$codigo."' and materia=".$materia."";
     	$sucesso = mysqli_query($db,$SQL);
	}
	else
	{
		//print("<script>window.alert('Aluno não esteve presente!');</script>");
		//echo "<br>";
		$SQL = "INSERT INTO materias_professor(usuario,materia,status) values('".$codigo."','".$materia."',1);";
		$sucesso = mysqli_query($db,$SQL);
	}	
	
?>	
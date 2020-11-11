<?

error_reporting(E_ALL);
ob_start();
session_start();

$login = $_GET['login'];
$senha = $_GET['senha'];

$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;

$x = 0;


$SQL = "select usuarios.sistema,usuarios.codigo,usuarios.nome,usuarios.tipo, usuarios.matricula,matriculas.turma from usuarios 
left join matriculas on matriculas.matricula=usuarios.matricula
where usuarios.cpf='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or usuarios.email='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or usuarios.login='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."'";

$ress = mysqli_query($db,$SQL);
  
while($res = mysqli_fetch_array($ress))
{
	echo 'Logado com sucesso...';
	
	$x = 1;
    $_SESSION['usuario'] = $res['codigo'];
	$_SESSION['sistema'] = $res['sistema'];
	$_SESSION['nome'] = $res['nome'];
	$_SESSION['permissao'] = $res['tipo'];
	$_SESSION['matricula'] = $res['matricula'];
	$_SESSION['turma'] = $res['turma'];
	
	//$_SESSION['menu'] = 3;
	//$_SESSION['pages'] = 3;
	
	//sprint "<script> window.location='sistema.php?url=inicio'; </script>";
}


//mysqli_close($db2);

if($x == 1)
{
	print "<script> window.location='sistema.php?url=linhadotempo'; </script>";
}
else
{
	print "<script> swal('Atenção', 'Login ou senha invalido.'); </script>";
    //print "<script> window.location='login.php'; </script>";
}
?>
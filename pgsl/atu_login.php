<?

error_reporting(E_ALL);
ob_start();
session_start();

$login = $_GET['login'];
$senha = $_GET['senha'];

$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;

$x = 0;


if($_SESSION['tipo'] == "1")
{
	
$SQL = "select usuarios.cliente,usuarios.codigo from usuarios inner join clientes on clientes.cnpj=usuarios.cliente where clientes.cpf='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or clientes.email='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or usuarios.login='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."'";

$ress = mysqli_query($db2,$SQL);

while($res = mysqli_fetch_array($ress))
{
    echo 'Logado com sucesso...';
	
	$x = 1;
    $_SESSION['usuario'] = $res['codigo'];
	$_SESSION['sistema'] = $res['cliente'];
	
	$_SESSION['menu'] = 1;
	$_SESSION['pages'] = 1;	
	
	
	print "<script> window.location='sistema.php'; </script>";
}
	
}
else if($_SESSION['tipo'] == "2")
{
	
$SQL = "select usuarios.cliente,usuarios.codigo from usuarios inner join clientes on clientes.cnpj=usuarios.cliente where clientes.cpf='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or clientes.email='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or usuarios.login='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."'";

$ress = mysqli_query($db2,$SQL);

while($res = mysqli_fetch_array($ress))
{
    echo 'Logado com sucesso...';
	
	$x = 1;
    $_SESSION['usuario'] = $res['codigo'];
	$_SESSION['sistema'] = $res['cliente'];
	
	$_SESSION['menu'] = 2;
	$_SESSION['pages'] = 2;	
	
	
	print "<script> window.location='sistema.php'; </script>";
}	

}
else
{

  $SQL = "select usuarios.sistema,usuarios.codigo,usuarios.nome,usuarios.tipo from usuarios where usuarios.cpf='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or usuarios.email='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or usuarios.login='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."'";

  $ress = mysqli_query($db3,$SQL);

  while($res = mysqli_fetch_array($ress))
  {
	echo 'Logado com sucesso...';
	
	$x = 1;
    $_SESSION['usuario'] = $res['codigo'];
	$_SESSION['sistema'] = $res['sistema'];
	$_SESSION['nome'] = $res['nome'];
	$_SESSION['tipo'] = $res['tipo'];
	
	$_SESSION['menu'] = 3;
	$_SESSION['pages'] = 3;
	

	//sprint "<script> window.location='sistema.php?url=inicio'; </script>";
  }

}

//mysqli_close($db2);

if($x == 1)
{
	print "<script> window.location='sistema.php?url=inicio'; </script>";
}
else
{
	print "<script> swal('Atenção', 'Login ou senha invalido.'); </script>";
    //print "<script> window.location='login.php'; </script>";
}
?>
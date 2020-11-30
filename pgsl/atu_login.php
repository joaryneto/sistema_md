<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$login = @$inputb['login'];
$senha = @$inputb['senha'];

$x = 0;
$SQL = "select usuarios.sistema,usuarios.codigo,usuarios.nome,usuarios.tipo from usuarios where usuarios.cpf='".$login."' and usuarios.senha='".$senha."' or usuarios.email='".$login."' and usuarios.senha='".$senha."' or usuarios.login='".$login."' and usuarios.senha='".$senha."'";
$ress = mysqli_query($db3,$SQL);

while($res = @mysqli_fetch_array($ress))
{
     	echo 'Logado com sucesso...';
	
	    $x = 1;
        $_SESSION['usuario'] = $res['codigo'];
		$_SESSION['login'] = $login;
	    $_SESSION['sistema'] = $res['sistema'];
	    $_SESSION['nome'] = $res['nome'];
	    $_SESSION['permissao'] = $res['tipo'];
	
	    $_SESSION['menu'] = 3;
	    $_SESSION['pages'] = 3;
		
}


if($x == 1)
{
	$_SESSION["donoSessao"] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
	
	print "<script> window.location='sistema.php?url=agenda'; </script>"; 
}
else
{
	  
	$_SESSION['usuario'] = "";
	$_SESSION['login'] = "";
	$_SESSION['sistema'] = "";
	$_SESSION['nome'] = "";
	$_SESSION['permissao'] = "";
		
	print "<script> swal('Atenção', 'Login ou senha invalido.'); </script>";
    //print "<script> window.location='login.php'; </script>";
}
?>
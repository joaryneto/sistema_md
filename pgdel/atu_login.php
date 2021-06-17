<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$login = security::input(@$inputb['login']);
$senha = security::input(@$inputb['senha']);

$pwe = password_hash($senha, PASSWORD_DEFAULT);

$x = 0;
$senhad = "";
$SQL = "select usuarios.sistema,usuarios.codigo,usuarios.nome,usuarios.tipo, usuarios.senha from usuarios 
where usuarios.cpf='".$login."' or usuarios.email='".$login."' or usuarios.login='".$login."'";
$ress = mysqli_query($db,$SQL);

while($res = @mysqli_fetch_array($ress))
{
     	//echo 'Logado com sucesso...';
	
	    //$x = 1;
        $_SESSION['usuario'] = $res['codigo'];
		$senhad = $res['senha'];
		$_SESSION['login'] = $login;
	    $_SESSION['sistema'] = $res['sistema'];
	    $_SESSION['nome'] = $res['nome'];
	    $_SESSION['permissao'] = $res['tipo'];
	
	    $_SESSION['menu'] = 3;
	    $_SESSION['pages'] = 3;
		
}

if(password_verify($inputb['senha'], $senhad))
{
	$x = 1;
}
else
{
	$x = 0;
}

if($x == 1)
{
	//$_SESSION["donoSessao"] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
	
	print '<script> swal({   
            title: "Atenção",   
            text: "Logado com Sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });</script>';

	print "<script> window.location='/?sl=sistema'; </script>"; 
}
else
{
	  
	$_SESSION['usuario'] = "";
	$_SESSION['login'] = "";
	$_SESSION['sistema'] = "";
	$_SESSION['nome'] = "";
	$_SESSION['permissao'] = "";
		
	print '<script> swal({   
            title: "Atenção",   
            text: "Login ou senha invalido.",   
            timer: 1000,   
            showConfirmButton: false 
        });</script>';
}
?>
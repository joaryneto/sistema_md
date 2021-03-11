<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$login = security::input(@$inputb['login']);
$senha = security::input(@$inputb['senha']);

$pwe = password_hash($senha, PASSWORD_DEFAULT);

$x = 0;


$SQL = "select usuarios.sistema,usuarios.codigo,usuarios.nome,usuarios.tipo, usuarios.matricula,matriculas.turma,usuarios.senha from usuarios 
left join matriculas on matriculas.matricula=usuarios.matricula
where usuarios.cpf='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or usuarios.email='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."' or usuarios.login='".$_SESSION['login']."' and usuarios.senha='".$_SESSION['senha']."'";

$ress = mysqli_query($db,$SQL);
  
while($res = mysqli_fetch_array($ress))
{
	echo 'Logado com sucesso...';
	
	$x = 1;
    $_SESSION['usuario'] = $res['codigo'];
	$_SESSION['sistema'] = $res['sistema'];
	$senhad = $res['senha'];
	$_SESSION['nome'] = $res['nome'];
	$_SESSION['permissao'] = $res['tipo'];
	$_SESSION['matricula'] = $res['matricula'];
	$_SESSION['turma'] = $res['turma'];
	
	//$_SESSION['menu'] = 3;
	//$_SESSION['pages'] = 3;

}


//mysqli_close($db2);

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
	$_SESSION["donoSessao"] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
	
	print "<script> window.location='sistema.php'; </script>"; 
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
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


if($_GET['tipo'] == 1)
{
$_SESSION['menu'] = 1;
$_SESSION['pages'] = 1;
}
else if($_GET['tipo'] == 2)
{
$_SESSION['menu'] = 2;
$_SESSION['pages'] = 2;
}
else
{
$_SESSION['menu'] = 0;
$_SESSION['pages'] = 0;	
}

print("<script>window.location.href='sistemas.php';</script>");

?>
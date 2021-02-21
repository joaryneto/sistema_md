<?

ob_start();

session_start();

require_once("./load/load.php");

if(@$_GET['deslogar']==1)
{
	unset($_SESSION['usuario']);
	print('<script> localStorage.removeItem("token"); </script>');
	print "<script> window.location='login.php';  </script>";
}


if($_SESSION['tipo'] == 1)
{
	  include ('template/layout/ecweb/login.php');
    }
	else if($_SESSION['tipo'] == 2)
	{
		
	}else if($_SESSION['tipo'] == 3)
	{
	  
	  include ('template/layout/spa/login.php');
	  
	}else if($_SESSION['tipo'] == 4)
	{
		
	}
	else if($_SESSION['tipo'] == 5)
	{
		

	}
	else if($_SESSION['tipo'] == 6)
	{
	   include ('template/layout/demo/login.php');
}

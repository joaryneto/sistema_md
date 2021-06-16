<?

ob_start();

session_start();

require_once("./load/load.php");

    if($_SESSION['tipo'] == 1)
    {
	    include ('template/layout/ecweb/index.php');
    }
	else if($_SESSION['tipo'] == 2)
	{
		include ('template/layout/escolar/index.php');
	}
	else if($_SESSION['tipo'] == 3)
	{
		if(@$_GET['sl'] == "login")
		{
	       include ('template/layout/spa/login.php');  
		}
		else if(@$_GET['sl'] == "sistema")
		{
	       include ('template/layout/spa/sistema.php');  
		}
		else
		{
		   include ('template/layout/spa/index.php');
		}
	}
	else if($_SESSION['tipo'] == 4)
	{
		if(@$_GET['dl'] == "login")
		{
	       include ('template/layout/delivery/login.php');  
		}
		else if(@$_GET['dl'] == "intruducao")
		{
	       include ('template/layout/delivery/index.php');  
		}
		else
		{
		   include ('template/layout/delivery/delivery.php');
		}
	}
	else if($_SESSION['tipo'] == 5)
	{
		
	}
	else if($_SESSION['tipo'] == 6)
	{
	   include ('template/layout/demo/index.php');
	}
	else if($_SESSION['tipo'] == 7)
	{
	   include ('template/layout/sites/01/index.php');
	}
?>


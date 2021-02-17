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
		
	}else if($_SESSION['tipo'] == 3)
	{
	  
	  include ('template/layout/spa/index.php');
	  
	}else if($_SESSION['tipo'] == 4)
	{
		
	}
	else if($_SESSION['tipo'] == 5)
	{
		

	}
	else if($_SESSION['tipo'] == 6)
	{
	   include ('template/layout/demo/index.php');
	}
?>
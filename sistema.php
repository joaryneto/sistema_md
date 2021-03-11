<?

ob_start();

session_start();

require_once("./load/load.php");


if($_SESSION['tipo'] == 1)
    {
	    include ('template/layout/ecweb/sistema.php');
    }
	else if($_SESSION['tipo'] == 2)
	{
		include ('template/layout/escolar/sistema.php');
	}
	else if($_SESSION['tipo'] == 3)
	{
		if(isset($_GET['empresa']))
        {
	      include ('template/layout/spa/agendamento.php');  
		}
		else
		{
		  
		}
	}
	else if($_SESSION['tipo'] == 4)
	{
	    include ('template/layout/delivery/sistema.php');
	}
	else if($_SESSION['tipo'] == 5)
	{
		
	}
	else if($_SESSION['tipo'] == 6)
	{
	   include ('template/layout/demo/sistema.php');
}	
?>
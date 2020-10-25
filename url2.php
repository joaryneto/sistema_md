<?

//echo "url2";

$url = $_GET['url'];

/*if($_SESSION['tipo'] == 1)
{
	$_SESSION['pg'] = "pages";
	if ($url == "") { $url = "inicio"; }
}
else if($_SESSION['tipo'] == 2)
{
	$_SESSION['pg'] = "pgsge";
	if ($url == "") { $url = "inicio"; }
}
else if($_SESSION['tipo'] == 3)
{
	$_SESSION['pg'] = "pgsl";
	if ($url == "") { $url = "inicio"; }
}
else
{
	//print("<script>window.location.href='index.php';</script>");
}*/

$_SESSION['pg'] = "pgsl";
if ($url == "") { $url = "inicio"; }

switch ($url) {

   		case "inicio":
       	include("".$_SESSION['pg']."/inicio.php");
       	break;
		
		default:
		include("".$_SESSION['pg']."/$url.php");
		break;	
}




?>
<?

//echo "url2";

$url = @$_GET['url'];

if($_SESSION['tipo'] == 1)
{
	$_SESSION['pg'] = "pages";
	if ($url == "") { $url = "agenda"; }
}
else if($_SESSION['tipo'] == 2)
{
	$_SESSION['pg'] = "pgsge";
	if ($url == "") { $url = "linhadotempo"; }
}
else if($_SESSION['tipo'] == 3)
{
	$_SESSION['pg'] = "pgsl";
	if ($url == "") { $url = "agenda"; }
}
else
{
	//print("<script>window.location.href='index.php';</script>");
}

//$_SESSION['pg'] = "pgsl";
//if ($url == "") { $url = "inicio"; }

switch ($url) {

   		//case "".$url."":
       	//    include("".$_SESSION['pg']."/$url.php");
        //break;
		
		default:
		    if (file_exists("".$_SESSION['pg']."/$url.php")) 
		    {
                include("".$_SESSION['pg']."/$url.php");
            } 
			else 
			{
                include("pages/404.php");
            }
		break;	
}




?>
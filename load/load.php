<?

require_once("./load/class/mysql.php");

/*if($_SESSION['tipo'] == 1)
{
	$_SESSION['pg'] = "pages";
}
else if($_SESSION['tipo'] == 2)
{
	$_SESSION['pg'] = "pgsge";
}
else if($_SESSION['tipo'] == 3)
{
	$_SESSION['pg'] = "pgsl";
}
else
{
	print("<script>window.location.href='index.php';</script>");
}*/

$_SESSION['pg'] = "pgsl";

if(isset($_GET['br']) == true) 
{
	if(empty($_SERVER['HTTP_REFERER']) == true)
	{
		exit();
	}
	
	$page = $_GET['br'];
	
	switch($page) 
	{
		default : $file = ''.$_SESSION['pg'].'/'.$page.'.php'; break;
	}
	
	if(file_exists($file) == false) 
	{ 
		$file = '404.php'; 
	}
	require ($file);
	exit();
}

?>
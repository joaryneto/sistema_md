<?

if(@$_SERVER['SERVER_NAME'] == "app.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.app")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/login.php";
	$_SESSION['nomesoft'] = "Gerenciamento de Sistema";
	$_SESSION['tipo'] = 1;
	$_SESSION['manifest'] = "manifest.json";
	
	$sistema = "sistema";
	//print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "sge.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.sge" or @$_SERVER['SERVER_NAME'] == "escolar.ectecnologia.com.br")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/login.php";
	$_SESSION['nomesoft'] = "Agencia Escolar";
	$_SESSION['tipo'] = 2;
	$_SESSION['manifest'] = "manifest1.json";
	
	$sistema = "agsge";
	//print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "sl.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.sl" or @$_SERVER['SERVER_NAME'] == "spa.ectecnologia.com.br")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/login.php";
	$_SESSION['nomesoft'] = "Agencia Spa & Hair";
	$_SESSION['tipo'] = 3;
	$_SESSION['manifest'] = "manifest2.json";
	
	$sistema = "agsl";
	//print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "delivery.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.delivery")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/delivery.php";
	$_SESSION['nomesoft'] = "Agencia Delivery";
	$_SESSION['tipo'] = 4;
	$_SESSION['manifest'] = "manifest3.json";
	
	$sistema = "agd";
	//print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else
{
	header('Location: servicos.php');
}

function formatodata($data){
    return date("d/m/Y", strtotime($data));
}

function formatodatahora($data){
    return date("d/m/Y H:i:s", strtotime($data));
}

function formatohora($horas){
    return date("H:i", strtotime($horas));
}

$data = date('Y-m-d');
$hora = date('H:i:s');
$datahora = date('Y-m-d H:i:s');

function revertedata($data){
	if($data != "")
	{
		$sep_data = explode("/",$data);
		$data = @$sep_data[2]."-".@$sep_data[1]."-".@$sep_data[0];
	}
	
	return $data;
}

require_once("./load/class/mysql.class.php");
require_once("./load/class/security.class.php");

$string = '{
  "name": "'.$_SESSION['nomesoft'].'",
  "short_name": "'.$_SESSION['nomesoft'].'",
  "icons": [{
    "src": "/images/icons/icon-128x128.png",
      "sizes": "128x128",
      "type": "image/png"
    }, {
      "src": "/images/icons/icon-144x144.png",
      "sizes": "144x144",
      "type": "image/png"
    }, {
      "src": "/images/icons/icon-152x152.png",
      "sizes": "152x152",
      "type": "image/png"
    }, {
      "src": "/images/icons/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    }, {
      "src": "/images/icons/icon-256x256.png",
      "sizes": "256x256",
      "type": "image/png"
    }, {
      "src": "/images/icons/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png"
    }, {
      "src": "/images/icons/icon-32x32.png",
      "sizes": "32x32",
      "type": "image/png"
    }],
  "start_url": "https://'.$_SESSION['nosistema'].'",
  "display": "standalone",
  "background_color": "#FFFFFF",
  "theme_color": "#FFFFFF"
}';

if(!Empty($_SESSION['manifest']))
{
$fp = fopen(''.$_SESSION['manifest'].'', 'w');
fwrite($fp, $string);
fclose($fp);
}

if($_SESSION['tipo'] == 1)
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
else if($_SESSION['tipo'] == 4)
{
	$_SESSION['pg'] = "pgdel";
}
else
{
	print("<script>window.location.href='index.php';</script>");
}

//$_SESSION['pg'] = "pgsl";

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
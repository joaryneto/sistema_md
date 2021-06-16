<?

if(@$_SERVER['SERVER_NAME'] == "www.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "app.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.ec")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/login.php";
	$_SESSION['nomesoft'] = "EC Tecnologia";
	$_SESSION['tipo'] = 1;
	$_SESSION['manifest'] = "manifest.json";
	$_SESSION['cor'] = "#FFFFFF";
	$_SESSION['img'] = "sistema";
	$_SESSION['tema'] = "blue";
	$_SESSION['pg'] = "pages";
	//print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "sge.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.sge" or @$_SERVER['SERVER_NAME'] == "escolar.ectecnologia.com.br")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/login.php";
	$_SESSION['nomesoft'] = "Agencia Escolar";
	$_SESSION['tipo'] = 2;
	$_SESSION['manifest'] = "manifest1.json";
	$_SESSION['cor'] = "#FFFFFF";
	$_SESSION['tema'] = "blue";
	$_SESSION['img'] = "agsge";
	$_SESSION['pg'] = "pgsge";
	//print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "sl.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.sl" or @$_SERVER['SERVER_NAME'] == "spa.ectecnologia.com.br")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/login.php";
	$_SESSION['nomesoft'] = "Agencia Spa & Hair";
	$_SESSION['tipo'] = 3;
	$_SESSION['manifest'] = "manifest2.json";
	$_SESSION['cor'] = "#FFFFFF";
	$_SESSION['tema'] = "deeppurple";
	$_SESSION['img'] = "agsl";
	$_SESSION['pg'] = "pgsl";
	//print('<script> localStorage.setItem("sistema", "'.$sistema.'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "delivery.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.delivery")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/delivery.php";
	$_SESSION['nomesoft'] = "Agencia Delivery";
	$_SESSION['tipo'] = 4;
	$_SESSION['manifest'] = "manifest3.json";
	$_SESSION['cor'] = "#F58634";
	$_SESSION['img'] = "agd";
	$_SESSION['pg'] = "pgdel";
}
else if(@$_SERVER['SERVER_NAME'] == "sociodbv.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.sociodbv")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/delivery.php";
	$_SESSION['nomesoft'] = "Socio DBV";
	$_SESSION['tipo'] = 5;
	$_SESSION['manifest'] = "manifest4.json";
	$_SESSION['cor'] = "#F58634";
	$_SESSION['img'] = "sdbv";
	$_SESSION['pg'] = "pgdbv";
	//print('<script> localStorage.setItem("sistema", "'.$_SESSION['img'].'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "demo.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.demo")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/index.php";
	$_SESSION['nomesoft'] = "Loja Demo";
	$_SESSION['tipo'] = 6;
	$_SESSION['manifest'] = "manifest6.json";
	$_SESSION['cor'] = "#00a451";
	$_SESSION['img'] = "agsge";
	$_SESSION['pg'] = "demo";
	//print('<script> localStorage.setItem("sistema", "'.$_SESSION['img'].'"); </script>');
}
else if(@$_SERVER['SERVER_NAME'] == "sites.ectecnologia.com.br" or @$_SERVER['SERVER_NAME'] == "sistema.site")
{
	$_SESSION['nosistema'] = "".$_SERVER['SERVER_NAME']."/index.php";
	$_SESSION['nomesoft'] = "Templates";
	$_SESSION['tipo'] = 7;
	$_SESSION['manifest'] = "manifest7.json";
	$_SESSION['cor'] = "#00a451";
	$_SESSION['img'] = "agsge";
	$_SESSION['pg'] = "site";
	//print('<script> localStorage.setItem("sistema", "'.$_SESSION['img'].'"); </script>');
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
$ano = date('Y');
$datahora = date('Y-m-d H:i:s');

function revertedata($data){
	if($data != "")
	{
		$sep_data = explode("/",$data);
		$data = @$sep_data[2]."-".@$sep_data[1]."-".@$sep_data[0];
	}
	
	return $data;
}

function revertemes($data){
	if($data != "")
	{
		$sep_data = explode("/",$data);
		$data = @$sep_data[1]."-".@$sep_data[0];
	}
	
	return $data;
}

function valor($numero)
{
   $numero = number_format($numero, 2, ',', '.');
   return $numero;
}
	
require_once("./load/class/mysql.class.php");
require_once("./load/class/security.class.php");

$string = '{
  "name": "'.$_SESSION['nomesoft'].'",
  "short_name": "'.$_SESSION['nomesoft'].'",
  "icons": [{
    "src": "/images/icons/'.$_SESSION['img'].'/icon-128x128.png",
      "sizes": "128x128",
      "type": "image/png"
    }, {
      "src": "/images/icons/'.$_SESSION['img'].'/icon-144x144.png",
      "sizes": "144x144",
      "type": "image/png"
    }, {
      "src": "/images/icons/'.$_SESSION['img'].'/icon-152x152.png",
      "sizes": "152x152",
      "type": "image/png"
    }, {
      "src": "/images/icons/'.$_SESSION['img'].'/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png",
	  "purpose": "maskable"
    }, {
      "src": "/images/icons/'.$_SESSION['img'].'/icon-256x256.png",
      "sizes": "256x256",
      "type": "image/png",
	  "purpose": "maskable"
    }, {
      "src": "/images/icons/'.$_SESSION['img'].'/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png",
	  "purpose": "maskable"
    }, {
      "src": "/images/icons/'.$_SESSION['img'].'/icon-32x32.png",
      "sizes": "32x32",
      "type": "image/png",
	  "purpose": "maskable"
    }],
  "start_url": "https://'.$_SESSION['nosistema'].'",
  "display": "standalone",
  "background_color": "'.$_SESSION['cor'].'",
  "theme_color": "'.$_SESSION['cor'].'"
}';

if(!Empty($_SESSION['manifest']))
{
   $fp = fopen(''.$_SESSION['manifest'].'', 'w');
   fwrite($fp, $string);
   fclose($fp);
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
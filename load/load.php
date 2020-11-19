<?

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

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

require_once("./load/class/mysql.php");

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
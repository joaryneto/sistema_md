<?

ob_start();

session_start();

require_once("./load/load.php");

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

function formatohora($horas){
    return date("H:i", strtotime($horas));
}

date_default_timezone_set('America/Cuiaba');
$data = date('Y-m-d');
$hora = date('H:i:s');

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

?>
<!doctype html>
<html lang="pt-br" class="color-theme-white">

<head>
<? include 'css.php';?>
</head>

<body>
    <!-- Loader -->

    <!-- Loader ends -->

    <!-- sidebar ends -->

    <!-- wrapper starts -->
    <div class="wrapper">

        <!-- header -->
        <!-- header ends -->


        <!-- page content here -->
        
        <div id="conteudo">
		<?php
		if(Empty($_SESSION['manutencao']))
		{
			$_SESSION['manutencao'] = 0;
		}
				   
		if($_SESSION['manutencao']!=1)
		{
			include("url.php");
		}
		else
		{
			include("url2.php");
		} 
		?>
		
        <!-- page content ends -->
        </div>
    </div>
<? include 'scripts.php'?>

</body>

</html>

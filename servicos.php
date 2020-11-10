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

    <!-- sidebar -->
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
 <a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="index.php?sistema=agsge"><i class="fa fa-plus-circle"></i> Sistema Escolar</a>
  <a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="index.php?sistema=agsl"><i class="fa fa-plus-circle"></i> Sistema de Salão</a>					
				</div>	</div>		</div>					    

<? include 'scripts.php'?>

</body>

</html>

<?php

$_SESSION['tipo'] = 2;

require_once("load/class/mysql.php");

// Include autoloader 
require_once 'template/vendor/dompdf/lib/html5lib/Parser.php';
require_once 'template/vendor/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'template/vendor/dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'template/vendor/dompdf/src/Autoloader.php';
 
// Reference the Dompdf namespace 
Dompdf\Autoloader::register();
use Dompdf\Dompdf; 
use Dompdf\Options;

//$options = new Options();
//$options->set('defaultFont', 'Courier');

// Instantiate and use the dompdf class 

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$limit = $_GET['limit'];
$cnpj = $_GET['cnpj'];
  
    $vb .='<html>';
    $vb .='<head>';
    $vb .='<style>
            @page {
                margin: 0cm 0cm;
            }

            body {
                margin-top: 3cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
                margin-bottom: 2cm;
				font-size: 10px;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0.1cm;
                left: 0.5cm;
                right: 0.5cm;
                height: 2.8cm;
				border: 1px;
				border: 1px solid black;
            }
			
			.logo{
				width:85px;
				padding:1px
			}

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1cm;
            }
        </style>';
  $vb .='</head>';
  $vb .='<body>';
  $vb .='<header>';
  $vb .='<img src="http://sistema.sge/template/images/logo.png" class="logo" width="100px"/>';
  $vb .='</header>';
  $vb .='<footer>';
  $vb .='<img src="footer.png" width="100%" height="100%"/>';
  $vb .='</footer>';
  $vb .='<main>';
  $vb .='<table style="width: 100% ;border: 1px solid #559fd2; border-collapse: collapse;">';
  $vb .='<tr>';
  $vb .='<td style="border: 1px solid black; border-collapse: collapse;width: 100px;background-color: #559fd2;"><b>Codigo</b></td>';
  $vb .='<td style="border: 1px solid black; border-collapse: collapse;width: 100px;background-color: #559fd2;"><b>Matricula</b></td>';
  $vb .='<td style="border: 1px solid black; border-collapse: collapse;width: 100px;background-color: #559fd2;"><b>Nome</b></td>';
  $vb .='<td style="border: 1px solid black; border-collapse: collapse;width: 100px;background-color: #559fd2;"><b>Data</b></td>';
  $vb .='</tr>';

  $ccount = 1;
  $flag = false;
  $SQL = "select * from matriculas";
  $result = mysqli_query($db,$SQL);
  while($row = mysqli_fetch_assoc($result)) 
  {
	$vb .='<tr>';
    $vb .='<td style="border: 1px solid black; border-collapse: collapse;">'.$ccount.'</td>';
	$vb .='<td style="border: 1px solid black; border-collapse: collapse;">'.$row['matricula'].'</td>';
	$vb .='<td style="border: 1px solid black; border-collapse: collapse;">'.$row['nome'].'</td>';
	$vb .='<td style="border: 1px solid black; border-collapse: collapse;">'.date("d/m/Y", strtotime($row['nascimento'])).'</td>';
	$vb .='</tr>';
	
	$ccount ++;
  }
   $vb .='</tr>';
   $vb .='</table>';	
   $vb .='</main>';
   $vb .='</body>';
   $vb .='</html>';
  
// Load content from html file 
//$vb = file_get_contents("pgsge/rel_producao.php"); 

$dompdf->loadHtml($vb); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'landscape'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF (1 = download and 0 = preview) 
$dompdf->stream("codexworld", array("Attachment" => 0));


?>

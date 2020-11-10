<?php

//$_SESSION['tipo'] = 2;

//require_once("../load/class/mysql.php");

// Include autoloader 
require_once 'template/vendor/dompdf/lib/html5lib/Parser.php';
require_once 'template/vendor/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'template/vendor/dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'template/vendor/dompdf/src/Autoloader.php';
 
// Reference the Dompdf namespace 
Dompdf\Autoloader::register();
use Dompdf\Dompdf; 
//use Dompdf\Options;

//$options = new Options();
//$options->set('defaultFont', 'Courier');

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

$limit = $_GET['limit'];
$cnpj = $_GET['cnpj'];
  
  
  /*$html .= '<table style="width: 100% ;border: 1px solid black; border-collapse: collapse;">';
  $html .= '<tr>';
  $html .= '<td style="border: 1px solid black; border-collapse: collapse;width: 100px;background-color: #fdb5b5;"><b>Codigo</b></td>';
  $html .= '<td style="border: 1px solid black; border-collapse: collapse;width: 100px;background-color: #fdb5b5;"><b>CPF</b></td>';
  $html .= '<td style="border: 1px solid black; border-collapse: collapse;width: 100px;background-color: #fdb5b5;"><b>Paciente</b></td>';
  $html .= '<td style="border: 1px solid black; border-collapse: collapse;width: 100px;background-color: #fdb5b5;"><b>Data</b></td>';
  $html .= '</tr>';

  $flag = false;
  $SQL = "select * from matriculas";
  $result = mysqli_query($db,$SQL);
  while($row = mysqli_fetch_assoc($result)) 
  {
	
	$html .= '<tr>';
    $html .= '<td style="border: 1px solid black; border-collapse: collapse;">'.$row['codigo'].'</td>';
	$html .= '<td style="border: 1px solid black; border-collapse: collapse;">'.$row['matricula'].'</td>';
	$html .= '<td style="border: 1px solid black; border-collapse: collapse;">'.$row['nome'].'</td>';
	$html .= '<td style="border: 1px solid black; border-collapse: collapse;">'.date("d/m/Y", strtotime($row['nascimento'])).'</td>';
	$html .= '</tr>';
  }
  
  $html .= '</tr>';
  $html .= '</table>';*/
  
// Load content from html file 
$html = file_get_contents("pgsge/rel_producao.php"); 

$dompdf->loadHtml($html); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'landscape'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF (1 = download and 0 = preview) 
$dompdf->stream("codexworld", array("Attachment" => 0));


?>

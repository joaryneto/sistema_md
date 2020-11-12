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


// Instantiate and use the dompdf class 

$options = new Options();
//$options->set('defaultFont', 'Courier');
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
                margin-top: 2.0cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
                margin-bottom: 2cm;
				font-size: 8px;
				color:#000;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0.5cm;
                left: 0.5cm;
                right: 0.5cm;
                height: 1.2cm;
				border: 1px;
				border: 1px solid black;
            }
			
			header table
			{
				border: 0px;
				border-collapse: collapse;
				margin-bottom:0px;
			}
			
			header table td
			{
				border: 0px;
				border-collapse: collapse;
				text-align: center;
			}
			
			header table td .logo{
				width:30px;
				padding:5px;
				position: absolute;
				left:10px;
			}
			
			header table td .tituloh
			{
				font-size: 16px;
				font-weight: bolder;
				position: absolute;
				left: 40%;
				right: 20%;
				padding:1.5%;
			}
			
			table
			{
				border: 1px solid black;
				border-collapse: collapse;
				width: 100%;
				margin-bottom:10px;
				font-family: Verdana, Arial, Helvetica, sans-serif;
			}
			
			table .titulo
			{
				font-size: 16px;
				padding:0px;
				font-weight: bolder;
				background-color: #FFF;
				
			}
			
			table td
			{
				border: 1px solid black;
				border-collapse: collapse;
				text-align: center;
			}
			table th
			{
				border: 1px solid black; 
				border-collapse: collapse;
				width: 100px;
				background-color: #559fd2;
				font-weight: bold;
				font-size: 10px;
				text-align: center;
			}

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0.5cm; 
                right: 0.5cm;
                height: 1cm;
            }
        </style>';
  $vb .='</head>';
  $vb .='<body>';
  $vb .='<header>';
  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<td><img src="http://sistema.sge/template/images/logo.png" class="logo"/></td>';
  $vb .='<td><div class="tituloh">Escola Mundo do Saber</div></td>';
  $vb .='</tr>';
  $vb .='</tbody>';
  $vb .='</table>';
  $vb .='</header>';
  $vb .='<footer>';
  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<th colspan="9" class="titulo">&nbsp;</td>';
  $vb .='</tr>';
  $vb .='</tbody>';
  $vb .='</table>';
  $vb .='</footer>';
  $vb .='<main>';
  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<td colspan="9" class="titulo">Diário de Classe</td>';
  $vb .='</tr>';
  $vb .='<tr>';
  $vb .='<th>Etapa</th>';
  $vb .='<th>Ano</th>';
  $vb .='<th>Cod.</th>';
  $vb .='<th>Disciplina</th>';
  $vb .='<th>Turno</th>';
  $vb .='<th>Curso</th>';
  $vb .='<th>Série</th>';
  $vb .='<th>Turma</th>';
  $vb .='<th>Professor</th>';
  $vb .='</tr>';
  $vb .='<tr>';
  
  $pSQL1 = "select data from diario where YEAR(data)=2020";
  $pRES1 = mysqli_query($db,$pSQL1);
  $prow = mysqli_fetch_assoc($pRES1);
	  
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='</tr>';
  $vb .='</tbody>';
  $vb .='</table>';

  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<td colspan="3">&nbsp;</td>';
  $vb .='<th><b>Mês</b></th>';
   
  $SQL1 = "select data from diario where YEAR(data)=2020 and materia=5";
  $RES1 = mysqli_query($db,$SQL1);
  while($row = mysqli_fetch_assoc($RES1)) 
  {
      $vb .='<td>'.date("m", strtotime($row['data'])).'</td>';
  }
  $RES1->close();
  $vb .='<th rowspan="2">T. F.</th>';
  $vb .='<th>&nbsp;</th>';
  $vb .='<th>&nbsp;</th>';
  $vb .='<th>&nbsp;</th>';
  $vb .='<th colspan="2">Total</th>';
  $vb .='</tr>';
  $vb .='<tr>';
  $vb .='<th>N°</th>';
  $vb .='<th>Matricula</th>';
  $vb .='<th>Aluno</th>';
  $vb .='<th>Dia</th>';
  $SQL2 = "select data from diario where YEAR(data)=2020 and materia=5";
  $RES2 = mysqli_query($db,$SQL2);
  while($row = mysqli_fetch_assoc($RES2)) 
  {
     $vb .='<td>'.date("d", strtotime($row['data'])).'</td>';
  }
  $RES2->close();
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>N</td>';
  $vb .='<td>F</td>';
  $vb .='</tr>';
  $vb .='<tr>';
   
  $count = 1;
  $SQL3 = "select codigo,matricula,nome from matriculas";
  $RES3 = mysqli_query($db,$SQL3);
  while($row = mysqli_fetch_assoc($RES3)) 
  {
	     
         $vb .='<td>'.str_pad($count, 4 , '0' , STR_PAD_LEFT).'</td>';
         $vb .='<td>'.$row['matricula'].'</td>';
         $vb .='<td colspan="2">'.$row['nome'].'</td>';
   
         $falta = 0;
		 $SQL1 = "select codigo,data from diario where YEAR(data)=2020 and materia=5";
		 $RES1 = mysqli_query($db,$SQL1);
		 while($rrow2 = mysqli_fetch_assoc($RES1)) 
		 {
              
              $DSQL1 = "select data from frequencia where data='".$rrow2['data']."'  and matricula=".$row['codigo']." and YEAR(data)=2020 and falta=0;";
              $DRES1 = mysqli_query($db,$DSQL1);
              $drow = mysqli_fetch_assoc($DRES1);
                 
	          if(!Empty($drow['data']))
			  {
                   $vb .='<td>P</td>';
				   
			  }
			  else
			  {
		         $vb .='<td>F</td>'; 
				 $falta ++;
			  }
			  
			  $DRES1->close();
		 }
		 
		 $RES1->close();
		 
         $vb .='<td>'.$falta.'</td>';
		 $vb .='<td></td>';
		 $vb .='<td></td>';
		 $vb .='<td></td>';
		 $vb .='<td>&nbsp;</td>';
		 $vb .='<td>&nbsp;</td>';
		 
         $vb .='</tr>';
		 
		 $count ++;
   }
   
   $RES3->close();
	
   $vb .='</tbody>';
   $vb .='</table>';
   
   $vb .='<table>';
   $vb .='<tbody>';
   $vb .='<tr>';
   $vb .='<td><p>Recebido em: ___/___/_______ &nbsp;Assinatura do Professor:_____________________________</p></td>';
   $vb .='<td>Recebido em: ___/___/_______ &nbsp;Assinatura do Chefe deDepartamento:_____________________________</td>';
   $vb .='</tr>';
   $vb .='</tbody>';
   $vb .='</table>';
   
     $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<td colspan="9" class="titulo">Diário de Conteúdo</td>';
  $vb .='</tr>';
  $vb .='<tr>';
  $vb .='<th>Etapa</th>';
  $vb .='<th>Ano</th>';
  $vb .='<th>Cod.</th>';
  $vb .='<th>Disciplina</th>';
  $vb .='<th>Turno</th>';
  $vb .='<th>Curso</th>';
  $vb .='<th>Série</th>';
  $vb .='<th>Turma</th>';
  $vb .='<th>Professor</th>';
  $vb .='</tr>';
  $vb .='<tr>';
  
  $pSQL1 = "select data from diario where YEAR(data)=2020";
  $pRES1 = mysqli_query($db,$pSQL1);
  $prow = mysqli_fetch_assoc($pRES1);
	  
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='</tr>';
  $vb .='</tbody>';
  $vb .='</table>';

  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<th>Data</th>';
  $vb .='<th>Aula</th>';
  $vb .='<th>Conteúdo Ministrado</th>';
  $vb .='<th>Professor</th>';
  $vb .='</tr>';
  
  $vb .='<tr>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='</tr>';
  
  $vb .='</tbody>';
  $vb .='</table>';
   
  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<td><p>Recebido em: ___/___/_______ &nbsp;Assinatura do Professor:_____________________________</p></td>';
  $vb .='<td>Recebido em: ___/___/_______ &nbsp;Assinatura do Chefe deDepartamento:_____________________________</td>';
  $vb .='</tr>';
  $vb .='</tbody>';
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

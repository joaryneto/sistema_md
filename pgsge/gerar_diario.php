<?php

//$_SESSION['tipo'] = 2;

$professor = $_GET['professor'];
$ano = $_GET['ano'];
$turmas = $_GET['turmas'];
$disciplina = $_GET['disciplina'];
$periodo = $_GET['etapa'];

$x = 0;
$pSQL1 = "select usuarios.nome,periodo.descricao as etapa ,diario.materia,materias.descricao as disciplina,turmas.descricao as cturma,diario.data,turmas_professor.usuario from diario 
inner join turmas_professor on turmas_professor.turma=diario.turma 
inner join turmas on turmas.codigo=diario.turma
inner join materias on materias.codigo=diario.materia
inner join periodo on periodo.codigo=diario.periodo
inner join usuarios on usuarios.codigo=diario.usuario
where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and diario.periodo=".$periodo." limit 1";
$pRES1 = mysqli_query($db,$pSQL1);
$tprow = mysqli_fetch_assoc($pRES1);

//require_once("load/class/mysql.php");

// Include autoloader 
require_once './template/vendor/dompdf/lib/html5lib/Parser.php';
require_once './template/vendor/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once './template/vendor/dompdf/lib/php-svg-lib/src/autoload.php';
require_once './template/vendor/dompdf/src/Autoloader.php';
 
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
                margin-bottom: 0.5cm;
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
				font-size: 8px;
			}
			table th
			{
				border: 1px solid black; 
				border-collapse: collapse;
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
  $vb .='<td><img src="https://app.ectecnologia.com.br/template/images/logo.png" class="logo"/></td>';
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
  $vb .='<td colspan="8" class="titulo">Diário de Classe</td>';
  $vb .='</tr>';
  $vb .='<tr>';
  $vb .='<th>Etapa</th>';
  $vb .='<th>Ano</th>';
  $vb .='<th>Cod. Disc.</th>';
  $vb .='<th>Disciplina</th>';
  $vb .='<th>Curso</th>';
  $vb .='<th>Série</th>';
  $vb .='<th>Turma</th>';
  $vb .='<th>Professor</th>';
  $vb .='</tr>';
  $vb .='<tr>';
  
	  
  $vb .='<td>'.$tprow['etapa'].'</td>';
  $vb .='<td>'.date("Y", strtotime($tprow['data'])).'</td>';
  $vb .='<td>'.str_pad($tprow['materia'], 4 , '0' , STR_PAD_LEFT).'</td>';
  $vb .='<td>'.$tprow['disciplina'].'</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>'.$tprow['cturma'].'</td>';
  $vb .='<td>'.$tprow['nome'].'</td>';
  $vb .='</tr>';
  $vb .='</tbody>';
  $vb .='</table>';

  $SQL1 = "select count(diario.codigo) as qtd from diario inner join turmas_professor on turmas_professor.turma=diario.turma where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and diario.periodo=".$periodo." and diario.status=1";
  $RES1 = mysqli_query($db,$SQL1);
  $row1 = mysqli_fetch_assoc($RES1);
  $valor1 = 1+$row1['qtd'];
  
  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<td colspan="4">&nbsp;</td>';
  $vb .='<td colspan="'.$valor1.'">Aulas / Data</td>';
  
  $SQL1 = "select count(diario.codigo) as qtd from diario 
  inner join turmas_professor on turmas_professor.turma=diario.turma 
  where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and tipo=2  and diario.periodo=".$periodo." and diario.status=1";
  $RES1 = mysqli_query($db,$SQL1);
  $row2 = mysqli_fetch_assoc($RES1);
  $valor2 = 2+$row2['qtd'];
  
  $vb .='<td colspan="'.$valor2.'">&nbsp;</td>';
  $vb .='</tr>';
  $vb .='<tr>';
  $vb .='<td colspan="3">&nbsp;</td>';
  $vb .='<th><b>Mês</b></th>';
  
  $RES1->close();
   
  $SQL1 = "select diario.data from diario 
  inner join turmas_professor on turmas_professor.turma=diario.turma 
  where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas."  and diario.periodo=".$periodo."  and diario.status=1";
  $RES1 = mysqli_query($db,$SQL1);
  while($row = mysqli_fetch_assoc($RES1)) 
  {
      $vb .='<td>'.date("m", strtotime($row['data'])).'</td>';
  }
  $RES1->close();
  $vb .='<th rowspan="2">T. F.</th>';
  
  $SQL1 = "select diario.data from diario 
  inner join turmas_professor on turmas_professor.turma=diario.turma 
  where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and tipo=2  and diario.periodo=".$periodo."  and diario.status=1";
  $RES1 = mysqli_query($db,$SQL1);
  while($row = mysqli_fetch_assoc($RES1)) 
  {
      $vb .='<td>'.date("m", strtotime($row['data'])).'</td>';
  }
  $RES1->close();
  
  $vb .='<th colspan="2">Total</th>';
  $vb .='</tr>';
  $vb .='<tr>';
  $vb .='<th>N°</th>';
  $vb .='<th>Matricula</th>';
  $vb .='<th>Aluno</th>';
  $vb .='<th>Dia</th>';
  $SQL2 = "select diario.data from diario 
  inner join turmas_professor on turmas_professor.turma=diario.turma 
  where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and diario.periodo=".$periodo."  and diario.status=1";
  $RES2 = mysqli_query($db,$SQL2);
  while($row = mysqli_fetch_assoc($RES2)) 
  {
     $vb .='<td>'.date("d", strtotime($row['data'])).'</td>';
  }
  $RES2->close();
  
  $SQL2 = "select diario.data from diario 
  inner join turmas_professor on turmas_professor.turma=diario.turma 
  where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and diario.tipo=2  and diario.periodo=".$periodo."  and diario.status=1";
  $RES2 = mysqli_query($db,$SQL2);
  while($row = mysqli_fetch_assoc($RES2)) 
  {
     $vb .='<td>'.date("d", strtotime($row['data'])).'</td>';
  }
  $RES2->close();
  
  $vb .='<td>N</td>';
  $vb .='<td>F</td>';
  $vb .='</tr>';
  $vb .='<tr>';
   
  $count = 1;
  $SQL3 = "select matriculas.codigo,matriculas.matricula,matriculas.nome from matriculas 
  inner join turmas_professor on turmas_professor.turma=matriculas.turma where turmas_professor.usuario=".$professor." and matriculas.turma=".$turmas."";
  $RES3 = mysqli_query($db,$SQL3);
  while($row = mysqli_fetch_assoc($RES3)) 
  {
	     
         $vb .='<td style="font-size: 8px">'.str_pad($count, 4 , '0' , STR_PAD_LEFT).'</td>';
         $vb .='<td style=" font-size: 8px">'.$row['matricula'].'</td>';
         $vb .='<td style="width: 130px; text-align: left; font-size: 8px" colspan="2">'.$row['nome'].'</td>';
   
         $falta = 0;
		 $SQL1 = "select diario.data, diario.codigo from diario 
		 inner join turmas_professor on turmas_professor.turma=diario.turma 
		 where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and diario.periodo=".$periodo."  and diario.status=1";
		 $RES1 = mysqli_query($db,$SQL1);
		 while($rrow2 = mysqli_fetch_assoc($RES1)) 
		 {
              
              $DSQL1 = "select data,nota from frequencia 
			  where data='".$rrow2['data']."' and matricula=".$row['codigo']." and diario=".$rrow2['codigo']." and YEAR(data)=".$ano." and falta=0;";
              $DRES1 = mysqli_query($db,$DSQL1);
              $drow = mysqli_fetch_assoc($DRES1);
                 
	          if(!Empty($drow['data']))
			  {
                   $vb .='<td style="font-size: 6px">P</td>';
				   
			  }
			  else
			  {
		         $vb .='<td style="font-size: 6px">F</td>'; 
				 $falta ++;
			  }
			  
			  $DRES1->close();
		 }
		 
		 $RES1->close();
		 
         $vb .='<td>'.$falta.'</td>';
		 
		 $RSQL1 = "select diario.data, diario.codigo from diario 
		 inner join turmas_professor on turmas_professor.turma=diario.turma 
		 where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and tipo=2 and diario.periodo=".$periodo."  and diario.status=1";
		 $RRES1 = mysqli_query($db,$RSQL1);
		 while($rrow2 = mysqli_fetch_assoc($RRES1)) 
		 {
              $DDSQL1 = "select nota from frequencia 
			  where data='".$rrow2['data']."' and matricula=".$row['codigo']." and diario=".$rrow2['codigo']." and YEAR(data)=".$ano." and falta=0;";
              $DDRES1 = mysqli_query($db,$DDSQL1);
              $ddrow = mysqli_fetch_assoc($DDRES1);
                 
	          if(!Empty($ddrow['nota']))
			  {
                   $vb .='<td>'.$ddrow['nota'].'</td>';
				   
			  }
			  else
			  {
		         $vb .='<td>0</td>'; 
				 //$falta ++;
			  }
			  
			  $DDRES1->close();
		 }
		 
		 $RRES1->close();
		 
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
   $vb .='<td>Recebido em: ___/___/_______ &nbsp;Assinatura do Chefe de Departamento:_____________________________</td>';
   $vb .='</tr>';
   $vb .='</tbody>';
   $vb .='</table>';
   
  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<td colspan="8" class="titulo">Diário de Conteúdo</td>';
  $vb .='</tr>';
  $vb .='<tr>';
  $vb .='<th>Etapa</th>';
  $vb .='<th>Ano</th>';
  $vb .='<th>Cod. Disc.</th>';
  $vb .='<th>Disciplina</th>';
  $vb .='<th>Curso</th>';
  $vb .='<th>Série</th>';
  $vb .='<th>Turma</th>';
  $vb .='<th>Professor</th>';
  $vb .='</tr>';
  $vb .='<tr>';
	  
  $vb .='<td>'.$tprow['etapa'].'</td>';
  $vb .='<td>'.date("Y", strtotime($tprow['data'])).'</td>';
  $vb .='<td>'.str_pad($tprow['materia'], 4 , '0' , STR_PAD_LEFT).'</td>';
  $vb .='<td>'.$tprow['disciplina'].'</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>&nbsp;</td>';
  $vb .='<td>'.$tprow['cturma'].'</td>';
  $vb .='<td>'.$tprow['nome'].'</td>';
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
  
  $aucount = 1;
  $SQL1 = "select diario.usuario,diario.data,diario.conteudo, diario.texto from diario 
  inner join turmas_professor on turmas_professor.turma=diario.turma 
  where YEAR(diario.data)=".$ano." and turmas_professor.usuario=".$professor." and diario.materia=".$disciplina." and diario.turma=".$turmas." and diario.periodo=".$periodo."  and diario.status=1";
  $RES1 = mysqli_query($db,$SQL1);
  while($row = mysqli_fetch_assoc($RES1)) 
  {
      $vb .='<tr>';
      $vb .='<td>'.date("d/m/Y", strtotime($row['data'])).'</td>';
      $vb .='<td>'.$aucount.' - '.$aucount.'</td>';
      $vb .='<td>'.$row['conteudo'].' <br> '.$row['texto'].'</td>';
      $vb .='<td>'.str_pad($row['usuario'], 6 , '0' , STR_PAD_LEFT).'</td>';
      $vb .='</tr>';
	  
      $aucount ++;
  }
  $RES1->close();
  
  $vb .='</tbody>';
  $vb .='</table>';
   
  $vb .='<table>';
  $vb .='<tbody>';
  $vb .='<tr>';
  $vb .='<td><p>Recebido em: ___/___/_______ &nbsp;Assinatura do Professor:_____________________________</p></td>';
  $vb .='<td>Recebido em: ___/___/_______ &nbsp;Assinatura do Chefe de Departamento:_____________________________</td>';
  $vb .='</tr>';
  $vb .='</tbody>';
  $vb .='</table>';
   
  $vb .='</main>';
  $vb .='</body>';
  $vb .='</html>';
  
  
$dat = date('ymdhis');
$nome = ''.$professor.$ano.''; 
$lnk = './arquivos/diario/'.$nome.'.pdf';  
// Load content from html file 
//$vb = file_get_contents("pgsge/rel_producao.php"); 

$SQL = "INSERT INTO arquivos (sistema,usuario,arquivo,data,status) VALUES('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$lnk."','".$datahora."',1);";
$RES = mysqli_query($db,$SQL);

//$RES->Close();

$dompdf->loadHtml($vb); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'landscape'); 
 
// Render the HTML as PDF 
$dompdf->render(); 

// Output the generated PDF (1 = download and 0 = preview) 
$dompdf->stream('teste.pdf', array("Attachment" => 0));

$output = $dompdf->output();
file_put_contents(''.$lnk.'', $output);

?>
<?

if(@$_GET['ap'] == "1")
{
	$x = 0;
	$RES1 = mysqli_query($db,"SELECT * FROM diario where sistema='".$_SESSION['sistema']."' and turma='".$_GET['turma']."' and materia='".$_GET['disciplina']."' and periodo='".$_GET['periodo']."' and data='".revertedata($_GET['txtdata'])."' and conteudo like '%'".$_GET['conteudo']."'%'");
	while($row = mysqli_fetch_array($RES1))
	{
		$x = 1;
	}
	
	
	if($x == 1)
	{
	    print("<script>window.alert('Conteudo ja cadastrada!')</script>");
		print("<script>window.location.href='sistema.php?url=cad_diario';</script>");
	}
	else
	{
	   $SQL2 = "INSERT into diario(sistema,usuario,turma,materia,periodo,video,data,conteudo,texto,tipo) values('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$_GET['turma']."','".$_GET['disciplina']."','".$_GET['periodo']."','".$_GET['video']."','".revertedata($_GET['txtdata'])."','".$_GET['conteudo']."','".$_GET['txtobs']."','".$_GET['tipo']."')";
	   $RES2 = mysqli_query($db,$SQL2);
	   
	   if($RES2)
	   {
		   //print("<script>window.alert('Conteudo Cadastrada com sucesso...')</script>");
		   
		   $RES1 = mysqli_query($db,"SELECT max(diario.codigo) as codigo FROM diario inner join turmas_professor on turmas_professor.turma=diario.turma where turmas_professor.usuario='".$_SESSION['usuario']."'");
		   $row = mysqli_fetch_array($RES1);
		   
		   
		   print("<script>
		      requestPage('?br=cad_diario&codigo=".$row['codigo']."','conteudo','GET');
		   </script>");
	   }
	   else
	   {
		   print('<script>
         swal({   
            title: "Atenção!",   
            text: "Ocorreu um erro, Entre em contato com Suporte! MSG-2",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
	   }
	   
	   //$RES1->close();
	   //$RES2->close();
	}
}
else if(@$_GET['ap'] == "2")
{
	$SQL1 = "UPDATE diario SET turma='".$_GET['turma']."',materia='".$_GET['disciplina']."',periodo='".$_GET['periodo']."', conteudo='".$_GET['conteudo']."',data='".revertedata($_GET['txtdata'])."', texto='".$_GET['txtobs']."',tipo='".$_GET['tipo']."' where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print('<script>
         swal({   
            title: "Atenção!",   
            text: "Atualizado com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
		print("<script>
		      requestPage('?br=cad_diario&codigo=".$row['codigo']."','conteudo','GET');
		   </script>");
	}
	else
	{
		print('<script>
         swal({   
            title: "Atenção!",   
            text: "Ocorreu um erro, Entre em contato com Suporte! MSG-3",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
		print("<script>
		      requestPage('?br=cad_diario&codigo=".$row['codigo']."','conteudo','GET');
		   </script>");
	}
}
else if(@$_GET['ap'] == 3)
{
	$SQL1 = "UPDATE diario SET status=2 where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."'";
	$RES = mysqli_query($db,$SQL1);
	
	
	print('<script>
         swal({   
            title: "Atenção!",   
            text: "Bloqueado com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
    </script>');
	
	print("<script>window.location.href='sistema.php?url=cad_diario';</script>");
	//$RES->close();
}


if(@$_GET['load'] == 1)
{
  $whe = "";
  if(Empty($_GET['pesquisa']))
  {
	/*print('<script>
         swal({   
            title: "Atenção!",   
            text: "Pesquisa em branco.",   
            timer: 1000,   
            showConfirmButton: false 
        });
    </script>');*/
  }
  else
  {
	  $whe = " and diario.conteudo like '%".$_GET['pesquisa']."%'";
  }

  $data = date('Y');
  $sql4 = "select periodo.descricao,diario.codigo,diario.conteudo,turmas.descricao as a,materias.descricao as b,diario.conteudo as c,diario.data from diario 
  inner JOIN turmas on turmas.codigo=diario.turma 
  inner join materias on materias.codigo=diario.materia 
  inner join periodo on periodo.codigo=diario.periodo 
  where diario.sistema='".$_SESSION['sistema']."' and YEAR(diario.data)=$data and diario.usuario='".$_SESSION['usuario']."' and diario.status=1 $whe order by diario.codigo desc;";
  $res4 = mysqli_query($db,$sql4); 
  while($row = mysqli_fetch_array($res4))
  {
  ?>
	<tr>
		<td data-title="Turma"><? echo $row['a'];?></td>
		<td data-title="Disciplina"><? echo $row['b'];?></td>
		<td data-title="Conteudo"><? echo $row['c'];?></td>
		<td data-title="Bimestre"><? echo $row['descricao'];?></td>
		<td data-title="Data"><? echo formatodata($row['data']);?></td>
		<td data-title="Editar"><a class="fa fa-edit" href="javascript: void(0);" onclick="sg_diario('<? echo $row['codigo']?>');" style="font-size: 150%;"><a></td>
		<td data-title="Excluir"><a class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir exame" style="font-size: 150%; color: red;" onclick="excluir(<? echo $row['codigo']?>)" href="javascript:void(0);"><a></td>
	</tr>
  <? }
  $res4->close();
?>
<?
}

if(@$_GET['load'] == 2)
{

  $turma = $_GET['turma'];
  $disciplina = $_GET['disciplina'];
  $periodo = $_GET['periodo'];

  $cano = date('Y');
  $sql5 = "select diario.codigo as coddiario,diario.tipo,diario.data,matriculas.codigo,matriculas.nome,turmas.descricao as turma,matriculas.foto from diario 
  inner JOIN turmas on turmas.codigo=diario.turma 
  inner join materias on materias.codigo=diario.materia 
  inner join periodo on periodo.codigo=diario.periodo
  inner join matriculas on matriculas.turma=diario.turma
  where diario.sistema='".$_SESSION['sistema']."' and diario.codigo='".$_GET['codigo']."' and matriculas.status in (0,1,3) and diario.usuario='".$_SESSION['usuario']."' and diario.turma='".$turma."';";
  $res5 = mysqli_query($db,$sql5); 
  $a = 0;
  while($row = mysqli_fetch_array($res5))
  {
		 
  ?>
	<tr>
		<td data-title="Foto"><? if(Empty($row['foto'])){echo '<img style="width: 40px" src="template/images/semfoto.png">';}else{echo "";}?></td>
		<td data-title="Nome"><? echo $row['nome'];?></td>
		<td data-title="Presença"><? 
			 

			 $SQL = "SELECT codigo,falta FROM frequencia where sistema='".$_SESSION['sistema']."' and matricula=".$row['codigo']." and diario=".$_GET['codigo']."";
			 $RES6 = mysqli_query($db,$SQL);
			 $rows = mysqli_fetch_array($RES6);
			 
			 //$p = 0;
			 //while($rows3 = mysqli_fetch_array($RES))
			 //{
			 //	 $p = 1;
			 //}
			 
			 if(Empty($rows['codigo']))
			 {
				$SQL = "INSERT INTO frequencia(sistema,diario,matricula,disciplina,periodo,data,falta) values('".$_SESSION['sistema']."','".$_GET['codigo']."','".$row['codigo']."','".$disciplina."','".$periodo."','".$data."','1');";
				$sucesso = mysqli_query($db,$SQL);
			 }
			 
			 
			 $SQL = "SELECT frequencia.codigo,frequencia.nota, frequencia.falta FROM frequencia 
			 inner join diario on diario.codigo=frequencia.diario
			 where frequencia.sistema='".$_SESSION['sistema']."' and frequencia.status=1 and frequencia.matricula=".$row['codigo']." and frequencia.diario=".$_GET['codigo']."";
			 $RES6 = mysqli_query($db,$SQL);
			 $rows1 = mysqli_fetch_array($RES6);
			 
			 ?>
			 <div class="checkbox pmd-default-theme">
			 <label class="pmd-checkbox pmd-checkbox-ripple-effect">
			 <input type="checkbox" class="pm-ini" name="<? echo $row['codigo'];?>" id="<? echo $row['codigo'];?>" value="<? echo $row['codigo'];?>" <? if($rows1['falta'] == "0"){?> checked <? }else{ ?> <? }?> OnClick="javascript: ajaxLoader('?br=atu_presenca&check='+ this.checked +'&data=<? echo $row['data'];?>&matricula=<? echo $row['codigo'];?>&diario=<? echo $row['coddiario'];?>&disciplina=<? echo $disciplina;?>&periodo=<? echo $periodo; ?>&ap=1','f<? echo $row['codigo'];?>','GET');" data-color="#009efb" />
			 <span class="pmd-checkbox-label">&nbsp;</span></div>
			 <!--<input type="checkbox" name="check[]" value="< echo $row['codigo'];?>" < if($rows1['falta'] == "0"){?> checked < }else{ ?> < }?> data-color="#009efb" />-->
			 </td>
			 <?if($row['tipo'] == 2){?>
			 <td data-title="Nota">
			 <script>
			    $(".notas").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
				
				function c_notas(nota,matricula,codigo)
				{
					ajaxLoader('?br=atu_diario&nota='+ nota +'&codigo='+ codigo +'&matricula='+ matricula +'&atnota=true','n'+ matricula +'','GET');
				}
				
			 </script>
			 <input type="text" class="form-control notas" name="nota" id="nota" value="<?=number_format($rows1['nota'],2,",",".");?>" onkeyup="c_notas(''+ this.value + '','<?=$row['codigo'];?>','<?=$rows1['codigo'];?>');" max="10"></td>
             <?}?>
			 <td data-title="Faltas no Periodo"><div id="f<? echo $row['codigo'];?>">
		<? 
			 $ano = date('Y');
			 $SQL7 = "SELECT frequencia.falta as qtd FROM frequencia 
			 inner join diario on diario.codigo=frequencia.diario
			 where frequencia.sistema='".$_SESSION['sistema']."' and frequencia.matricula=".$row['codigo']." and frequencia.disciplina=".$disciplina." and frequencia.periodo=".$periodo." and frequencia.falta=1 and diario.status=1 and YEAR(frequencia.data)=$ano ";
			 $RES7 = mysqli_query($db,$SQL7);
			 
			 $total = 0;
			 $n = 1;
			 $y = 0;	
			 
			 while($rows2 = mysqli_fetch_assoc($RES7))
			 {
				 //echo "The number is: $n <br>";
				 //$total = $rows2['qtd'];
				 $y = 1;
				 
				 $total = $n++;
			 }
			 
			 if($y == 1)
			 {
				echo $total;
			 }
			 else
			 {
				echo "0";
			 }
			 
			 //$RES6->close();
			 //$RES7->close();
			 
		echo "</div></td>";
		?>
		<td data-title="N. Total"><div id="n<? echo $row['codigo'];?>"></td>
		<?
     $a = 1;
   }
  if($a == 0)
  {
	  echo "<tr>
		   <td>Nenhum Aluno cadastrado na turma</td>
		   <td></td>
			  <td></td>
			  <td></td>
			 </tr>";
  }
}

if(@$_GET['load'] == 3)
{
	?>
	<table class="table pmd-table table-hover">
    <tbody>
	<?
	echo '<tr>';
	//echo '<td>Matricula</td>';
	echo '<td>Aluno</td>';
	$SQL2 = "select diario.data,materias.descricao  from diario 
    inner join turmas_professor on turmas_professor.turma=diario.turma 
	inner join materias on materias.codigo=diario.materia
    where YEAR(diario.data)='2020' and turmas_professor.usuario='6' and diario.turma='3' and diario.tipo=2  and diario.periodo='3'  and diario.status=1";
    $RES2 = mysqli_query($db,$SQL2);
    while($row = mysqli_fetch_assoc($RES2)) 
    {
       echo '<td>'.substr($row['descricao'], 0, 1).'-'.date("d/m", strtotime($row['data'])).'</td>';
    }
	
	echo '</tr>';
	echo '<tr>';
	
   	$SQL3 = "select matriculas.codigo,matriculas.matricula,matriculas.nome from matriculas 
    inner join turmas_professor on turmas_professor.turma=matriculas.turma where turmas_professor.usuario='6' and matriculas.turma='3'";
    $RES3 = mysqli_query($db,$SQL3);
    while($row = mysqli_fetch_assoc($RES3)) 
    {
        //echo '<td>'.$row['matricula'].'</td>';
        echo '<td style="text-align: left;">'.$row['nome'].'</td>';
		
		$RSQL1 = "select diario.data, diario.codigo from diario 
		inner join turmas_professor on turmas_professor.turma=diario.turma 
		where YEAR(diario.data)='2020' and turmas_professor.usuario='6' and diario.turma='3' and tipo=2 and diario.periodo='3' and diario.status=1";
		$RRES1 = mysqli_query($db,$RSQL1);
		while($rrow2 = mysqli_fetch_assoc($RRES1)) 
		{
              $DDSQL1 = "select codigo,nota from frequencia 
			  where matricula=".$row['codigo']." and diario=".$rrow2['codigo'].";";
              $DDRES1 = mysqli_query($db,$DDSQL1);
              $ddrow = mysqli_fetch_assoc($DDRES1);
                 
	          if(Empty($ddrow['nota']))
			  {
                  echo '<td><input type="text" name="nota" id="nota" value="'.$ddrow['nota'].'" onkeyup="requestPage2(\'?br=atu_diario&nota=\'+ this.value +\'&codigo='.$ddrow['codigo'].'&atnota=true\',\''.$row['codigo'].'\',\'GET\');" class="form-control"></td>';
				   
			  }
			  else
			  {
		         
				 echo '<td><input type="text" name="nota" id="nota" value="'.$ddrow['nota'].'" onkeyup="requestPage2(\'?br=atu_diario&nota=\'+ this.value +\'&codigo='.$ddrow['codigo'].'&atnota=true\',\''.$row['codigo'].'\',\'GET\');" class="form-control"></td>';
				 //$falta ++;
			  }
		}
		echo '<td id="'.$row['codigo'].'"></td>';
		echo '</tr>';
	}
	
	?>
	</tbody>
   </table><?
}

if(@$_GET['atnota'] == "true")
{
	$matricula = $_GET['matricula'];
	$nota = str_replace(',', ".", security::input(@$_GET['nota']));
	
	if($nota > 10.00)
	{
		echo "menos";
	}
	else
	{
	
	  $SQL1 = "UPDATE frequencia SET nota='".$nota."' where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."';";
	  $sucesso = mysqli_query($db,$SQL1);
	
	  if($sucesso)
	  {
        //print("<script>window.alert('Bimestre fechado com sucesso.');</script>");
		//print("<script>window.location.href='sistema.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
		
        $SQL = "SELECT sum(frequencia.nota) as nota from frequencia 
		inner join diario on diario.codigo=frequencia.diario
		where frequencia.sistema='".$_SESSION['sistema']."' and frequencia.periodo='".$_SESSION['periodo']."' and frequencia.disciplina='".$_SESSION['disciplina']."' and frequencia.matricula='".$matricula."' and diario.tipo=2;";
		$RES = mysqli_query($db,$SQL);
		$row = mysqli_fetch_array($RES);
		
		echo $row['nota'];
	  }
	  else
	  {
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	  }
	}
}

if(@$_GET['fechar'] == "3")
{
	$SQL1 = "UPDATE diario SET status=0 where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        //print("<script>window.alert('Bimestre fechado com sucesso.');</script>");
		//print("<script>window.location.href='sistema.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
	///$sucesso->close();
	
}
?>
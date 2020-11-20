<?

if($_GET['ap'] == "1")
{
	$x = 0;
	$RES1 = mysqli_query($db,"SELECT * FROM diario where turma='".$_GET['turma']."' and materia='".$_GET['disciplina']."' and periodo='".$_GET['periodo']."' and data='".revertedata($_GET['txtdata'])."' and conteudo like '%'".$_GET['conteudo']."'%'");
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
	   $SQL2 = "INSERT into diario(usuario,turma,materia,periodo,video,data,conteudo,texto,tipo) values('".$_SESSION['usuario']."','".$_GET['turma']."','".$_GET['disciplina']."','".$_GET['periodo']."','".$_GET['video']."','".revertedata($_GET['txtdata'])."','".$_GET['conteudo']."','".$_GET['txtobs']."','".$_GET['tipo']."')";
	   $RES2 = mysqli_query($db,$SQL2);
	   
	   if($RES2)
	   {
		   print("<script>window.alert('Conteudo Cadastrada com sucesso...')</script>");
		   
		   $RES1 = mysqli_query($db,"SELECT max(diario.codigo) as codigo FROM diario inner join turmas_professor on turmas_professor.turma=diario.turma where turmas_professor.usuario='".$_SESSION['usuario']."'");
		   $row = mysqli_fetch_array($RES1);
		   
		   
		   print("<script>window.location.href='sistema.php?url=cad_diario&codigo=".$row['codigo']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	   
	   //$RES1->close();
	   //$RES2->close();
	}
}
else if($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE diario SET turma='".$_GET['turma']."',materia='".$_GET['disciplina']."',periodo='".$_GET['periodo']."', conteudo='".$_GET['conteudo']."',data='".revertedata($_GET['txtdata'])."', texto='".$_GET['txtobs']."',tipo='".$_GET['tipo']."' where codigo='".$_GET['codigo']."'";
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
	}
}
if($_GET['ap'] == 3)
{
	$SQL1 = "UPDATE diario SET status=2 where codigo='".$_GET['codigo']."'";
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
  if(Empty($_GET['pesquisa']))
  {
	print('<script>
         swal({   
            title: "Atenção!",   
            text: "Pesquisa em branco.",   
            timer: 1000,   
            showConfirmButton: false 
        });
    </script>');
  }
  else
  {
	  $whe = " and diario.conteudo like '%".$_GET['pesquisa']."%'";
  }
  
  $data = date('Y');
  $sql4 = "select diario.codigo,diario.conteudo,turmas.descricao as a,materias.descricao as b,diario.conteudo as c,diario.data from diario 
  inner JOIN turmas on turmas.codigo=diario.turma 
  inner join materias on materias.codigo=diario.materia 
  inner join periodo on periodo.codigo=diario.periodo 
  where YEAR(diario.data)=$data and diario.usuario='".$_SESSION['usuario']."' and diario.status=1 $whe;";
  $res4 = mysqli_query($db,$sql4); 
  while($row = mysqli_fetch_array($res4))
  {
  ?>
	<tr>
		<td data-title="Turma"><? echo $row['a'];?></td>
		<td data-title="Disciplina"><? echo $row['b'];?></td>
		<td data-title="Conteudo"><? echo $row['c'];?></td>
		<td data-title="Data"><? echo formatodatahora($row['data']);?></td>
		<td data-title="Editar"><a class="fa fa-edit" href="sistema.php?url=cad_diario&codigo=<? echo $row['codigo']?>" style="font-size: 150%;"><a></td>
		<td data-title="Excluir"><a class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir exame" style="font-size: 150%; color: red;" onclick="excluir(<? echo $row['codigo']?>)" href="javascript:void(0);"><a></td>
	</tr>
  <? }
  $res4->close();
?>
<?
}

if(@$_GET['fechar'] == "3")
{
	$SQL1 = "UPDATE diario SET status=0 where codigo='".$_GET['codigo']."'";
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
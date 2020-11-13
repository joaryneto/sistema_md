<?

if($_GET['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM matriculas left join usuarios on usuarios.matricula=matriculas.matricula where matriculas.nome like '%".$_GET['nome']."%' or usuarios.nome like '%".$_GET['nome']."%' limit 1;";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}

	if($x == 1)
	{
	    print('<script> swal("Atenção", "Aluno(a) ja cadastrado!"); </script>');
		//print("<script>window.location.href='sistema.php?url=cad_alunos&cadastro=1';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into matriculas(matricula,nome,estado,cidade,ensino,turma,status) values('".$_SESSION['matricula']."','".$_GET['nome']."','".$_GET['estado']."','".$_GET['cidade']."','".$_GET['ensino']."','".$_GET['turma']."','".$_GET['situacao']."');";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $SQL2 = "INSERT into usuarios(login,senha,matricula,nome,tipo,status) values('".$_SESSION['matricula']."','".$_SESSION['matricula']."','".$_SESSION['matricula']."','".$_GET['nome']."',1,1);";
	   $sucesso = mysqli_query($db,$SQL2);
	   
	   if($sucesso)
	   {
		   print("<script> swal('Atenção', 'Aluno(a) Cadastrado com sucesso.'); </script>");
		   print("<script>window.location.href='sistema.php?url=cad_alunos';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
else if($_GET['ap'] == "2")
{
	$x = 0;
	$SQL = "SELECT * FROM matriculas 
	inner join usuarios on usuarios.matricula=matriculas.matricula 
	inner join turmas_professor on turmas_professor.turma=matriculas.turma 
	where matriculas.matricula='".$_GET['matricula']."' or usuarios.matricula='".$_GET['matricula']."' turmas_professor.usuario='".$_SESSION['usuario']."' limit 1;";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
    $SQL1 = "UPDATE matriculas SET nome='".$_GET['nome']."',estado='".$_GET['estado']."',cidade='".$_GET['cidade']."',ensino='".$_GET['ensino']."',turma='".$_GET['turma']."',status='".$_GET['situacao']."' where matricula='".$_GET['matricula']."';";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Atualizado com sucesso.');</script>");
		print("<script>window.location.href='sistema.php?url=cad_alunos';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
}
else if($_GET['ap'] == 3)
{
?>
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
	<table class="table pmd-table">
		<thead>
			<tr>
				<th>Matricula</th>
				<th>Nome</th>
				<th>Turma</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
		<?
		  $sql = "select matriculas.matricula,matriculas.nome,matriculas.nome,turmas.descricao,matriculas.status from matriculas 
		  inner join  turmas on turmas.codigo=matriculas.turma 
		  inner join turmas_professor on turmas_professor.turma=matriculas.turma and turmas_professor.usuario='".$_SESSION['usuario']."'
		  where matriculas.nome like '%".$_GET['pesquisa']."%' and matriculas.status in (0,1,3)";
		  $res = mysqli_query($db,$sql); 
		  while($row = mysqli_fetch_array($res))
		  {
		  ?>
			<tr>
				<td data-title="Matricula"><? echo $row['matricula'];?></td>
				<td data-title="Aluno"><? echo $row['nome'];?></td>
				<td data-title="Turma"><? echo $row['descricao'];?></td>
				<td data-title="Status"><? 
				Switch($row['status'])
				{
				 case 0:
				 { echo "Inativo";}
				 break;
				 case 1:
				 { echo "Ativo";}
				 break;
				 case 2:
				 { echo "Pre-Ativa";}
				 break;
				 case 3:
				 { echo "Transferido";}
				 break;
				}
										 ?></td>
				<td data-title="Editar"><a class="fa fa-edit" href="sistema.php?url=cad_alunos&cadastro=1&matricula=<? echo $row['matricula']?>" style="font-size: 150%;"><a></td>
			</tr>
		  <? } ?>
		</tbody>
	</table>
</div>
<?
}

?>
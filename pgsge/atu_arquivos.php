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

		
		  $SQL = "SELECT data,arquivo FROM arquivos where usuario='".$_SESSION['usuario']."' order by data desc limit 5;";
		  $res = mysqli_query($db,$SQL); 
		  while($row = mysqli_fetch_array($res))
		  {
		  ?>
			<tr>
				<td data-title="Data"><? echo formatodatahora($row['data']);?></td>
				<td data-title="Link"><a class="fa fa-edit" target="_brank" href="<? echo $row['arquivo']?>" style="font-size: 150%;"><a></td>
			</tr>
		  <? } 
}

?>
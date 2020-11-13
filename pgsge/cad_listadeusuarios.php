<?

if($_GET['ap'] == 1)
{
?>
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<th>Nome</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<? 

$sql = "SELECT * FROM usuarios where nome like '%".$_GET['pesquisa']."%'";
$res = mysqli_query($db,$sql); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
?>
<tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="javascript: window.location='sistema.php?url=cad_usuarios&codigo=<? echo $row['codigo'];?>';">
<td><? echo $row['nome'];?></td>
<td><? Switch($row['status'])
       {
		   case 0:
		     echo '<span class="label label-danger">Inativo</span>';
		   break;
		   case 1:
		     echo '<span class="label label-success">Ativo</span>';
		   break;
		   case 2:
		     echo '<span class="label label-warning">Pre-ativo</span>';
		   break;
	   }
	   ?></td>
</tr>
<? 
}
?>
</tbody>
</table>
<?
}
else if($_GET['ap'] == 2)
{
?>
<table class="display nowrap table table-hover table-striped table-bordered">
<thead>
<tr>
<th>Codigo</th>
<th>Conteúdo</th>
<th>Turmas</th>
<th>Disciplina</th>
<th>status</th>
</tr>
</thead>
<tbody>
<?
$data = date('Y');
$sql = "select diario.codigo,diario.conteudo,turmas.descricao as a,materias.descricao as b,diario.conteudo as c,diario.data,diario.status from diario 
inner JOIN turmas on turmas.codigo=diario.turma 
inner join materias on materias.codigo=diario.materia 
inner join periodo on periodo.codigo=diario.periodo where YEAR(data)=$data and diario.conteudo like '%".$_GET['pesquisa']."%'";
$res = mysqli_query($db,$sql); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
  ?>
<tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="javascript: window.location='iniciado.php?url=cad_notas&codigo=<? echo $row['codigo'];?>';">
<td><? echo $row['codigo'];?></td>
<td><? echo $row['conteudo'];?></td>
<td><? echo $row['a'];?></td>
<td><? echo $row['b'];?></td>
<td><? Switch($row['status'])
{
case 0:
echo '<span class="label label-danger">Fechado</span>';
break;
case 1:
echo '<span class="label label-success">Aberto</span>';
break;
case 2:
echo '<span class="label label-warning">Pre-ativo</span>';
break;
}
?></td>
</tr>
<? $x = 1;
}
if($x == 0)
{
echo "<tr><td>Nenhum resultado encontrado.</td><td></td><td></td><td></td></tr>";

}
}
?>
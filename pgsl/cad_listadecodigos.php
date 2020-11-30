<?

$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

if($_SESSION["donoSessao"]  != $tokenUser){
    header("location:login.php");
}

if($_GET['ap'] == 1)
{
?>
<table id="example23" class="display nowrap table table-hover table-striped table-bordered">
<thead>
<tr>
<th>Codigo</th>
<th>Nome</th>
<th>CPF</th>
</tr>
</thead>
<tbody>
<? 

if(strlen($_GET['pesquisa']) < 6)
{
	
}
else
{
$sql = "SELECT examesrequisicao.codigo,pessoas.nome,pessoas.cpf FROM examesrequisicao 
inner join pessoas on pessoas.cpf=examesrequisicao.pessoa 
where examesrequisicao.codigo='".$_GET['pesquisa']."' and examesrequisicao.status IN (2,3)";
$res = mysqli_query($db2,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr onclick="javascript: window.location='iniciado.php?url=enviar&codigo=<? echo $row['codigo'];?>';">
<td><? echo $row['codigo'];?></td>
<td><? echo $row['nome'];?></td>
<td><? echo $row['pessoa'];?></td>
</tr>
<? 
}

if($res == false)
{
	echo "nenhum resultado encontrado.";
}
}
?>
</tbody>
<tfoot>
<tr>
<th>Codigo</th>
<th>Nome</th>
<th>CPF</th>
</tr>
</tfoot>
</table>

<?
}
else
{
  echo "";
}
?>
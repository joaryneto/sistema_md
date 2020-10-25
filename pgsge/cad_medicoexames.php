<?

$SQL1 = "SELECT * FROM internet_usuarios where codigo='".$_GET['codigo']."'";
$pessoa = mysqli_query($db,$SQL1);

while($rows = mysqli_fetch_array($pessoa))
{
	if(Empty($rows['cod_usuario']))
	{
		$coduser = $rows['codigo'];
	}
	else
	{
		$coduser = $rows['cod_usuario'];
	}
}

$SQL2 = "SELECT * FROM laudar where cod_medico=".$coduser."";
$sucesso = mysqli_query($db,$SQL2);
	
$y = 0;
while($row = mysqli_fetch_array($sucesso))
{
   $y=1;
}
	
if($y == 1)
{
	
if($_GET['ap'] == 1)
{

if(isset($_GET['exame']))
{
	$x = 0;
	$SQL1 = "SELECT * FROM laudar where cod_exame=".$_GET['exame']." and cod_medico=".$coduser."";
	$sucesso = mysqli_query($db,$SQL1);
	
	while($row = mysqli_fetch_array($sucesso))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
        print('<script> window.alert("Exame ja cadastrado.")</script>');
	}
	else
	{
		$SQL2 = "INSERT INTO laudar(cod_exame,cod_medico) values('".$_GET['exame']."','".$coduser."');";
     	$sucesso = mysqli_query($db,$SQL2);
	}
}

?>

<?
}
elseif($_GET['ap'] == 2)
{
	$SQL1 = "SELECT codigo FROM tipo_exame where descricao like '%RX%'";
	$sucesso = mysqli_query($db,$SQL);
	
	while($res = mysqli_fetch_array($sucesso))
	{

		$SQL2 = "SELECT * FROM laudar where cod_exame='".$res['codigo']."'";
		$sucesso = mysqli_query($db,$SQL2);
		
		$x=0;
		
		while($row = mysqli_fetch_array($sucesso))
		{
			$x=1;
		}
	
		if($x == 0)
		{
		   $SQL3 = "INSERT INTO laudar(cod_exame,cod_medico) values('".$res['codigo']."','".$coduser."');";
		   $sucesso = mysqli_query($db,$SQL3);
		}
	}
	
	if($sucesso)
	{
		print('<script> window.alert("Pacote adicionado com sucesso...")</script>');		
	}
}
elseif($_GET['ap'] == 3)
{
	if(isset($_GET['exame']))
	{
	   $x = 0;
	   $sucesso = mysqli_query($db,"DELETE FROM laudar where id='".$_GET['exame']."'");
	   while($row = mysqli_fetch_array($sucesso))
	   {
		   $x = 1;
	   }
	   
	   if($x == 1)
	   {
	       print('<script> window.alert("Excluido com sucesso...")</script>');
	   }
	}
}
else
{
?>
      

				

 				
<? } ?>
<?
if($_GET['list'] == 1)
{
	
?>
<table id="example23" class="display nowrap table table-hover table-striped table-bordered">
<thead>
<tr>
<th>Codigo</th>
<th>Paciente</th>
<th>Opções</th>
</tr>
</thead>
<tbody>
<? 
$sql = "SELECT laudar.codigo,tipo_exame.descricao FROM laudar inner join tipo_exame on tipo_exame.codigo=laudar.cod_exame where laudar.cod_medico='".$coduser."'";
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr>
<td><? echo $row['codigo'];?></td>
<td><? echo $row['descricao'];?></td>
<td><a href="javascript: Web(0);" OnClick="javascript: ajaxLoader('?br=mexames&codigo=<? echo $coduser;?>&exame=<? echo $row['codigo']; ?>&ap=3&list=1','listaexames','GET');"><i class="fa fa-trash-o" style="font-size: 150%; color: red;"></i></a>
</td>
</tr>
<? } ?>
</tbody>
<tfoot>
<tr>
<th>Codigo</th>
<th>Paciente</th>
<th>Opções</th>
</tr>
</tfoot>
</table>
<?

}
}
else
{
	echo "Nenhum resultado encontrado.";
}
?>
<?

$sql = "SELECT * FROM clientes where nome like '%".$_GET['pesquisa']."%' limit 10";
$res = mysqli_query($db3,$sql); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
?>
<tr style="cursor: pointer;" onclick="SL_cliente('<? echo $row['codigo'];?>','<? echo $row['nome'];?>');">
<td data-title="Nome"><? echo $row['nome'];?></td>
<td data-title="Status"><? Switch($row['status'])
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
   ?>
</td>
</tr>
<? $x = 1;
}

if($x == 0)
{
 echo "<tr><td>Nenhum resultado encontrado.</td><td></td><td></td><td></td></tr>";

}

?>
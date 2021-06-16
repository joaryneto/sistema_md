<?

  $sql = "select * from clientes where sistema='".$_SESSION['sistema']."' and nome like '%".$_GET['pesquisa']."%';";
  $res = mysqli_query($db3,$sql); 
  while($row = mysqli_fetch_array($res))
  {
  ?>
	<tr>
		<td data-title="Codigo"><? echo $row['codigo'];?></td>
		<td data-title="Descrição"><? echo $row['nome'];?></td>
		<td data-title="Status"><? Switch($row['status'])
			   {
				   case 0:
					 echo '<span class="label label-danger">Inativo</span>';
				   break;
				   case 1:
					 echo '<span class="label label-success">Ativo</span>';
				   break;
			   }
			   ?></td>
		<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
		<td data-title="Editar"><a class="fa fa-edit" href="javascript:void(0);" onclick="edit_cliente(<?=$row['codigo'];?>);" style="font-size: 150%;"><a></td>
	</tr>
<? 
} 
?>
<?
$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$inputb['ap'] == 1){
	
  $pesquisa = @$inputb['pesquisa'];
  $sql = "select * from clientes where sistema='".$_SESSION['sistema']."' and nome like '%".$pesquisa."%';";
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
}else if(@$inputb['ap'] == 2)
{

$pesquisa = @$inputb['pesquisa'];

$SQL = "SELECT produtos.descricao,agendamento_servicos.codigo,agendamento.cliente,clientes.nome, clientes.celular,agendamento_servicos.data,agendamento_servicos.hora,agendamento_servicos.profissional FROM agendamento 
inner join clientes on clientes.codigo=agendamento.cliente 
inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
inner join produtos on produtos.codigo=agendamento_servicos.servico
where agendamento.sistema='".$_SESSION['sistema']."' and agendamento.status=1 and agendamento.nome like '%".$pesquisa."%' ORDER BY agendamento.codigo desc";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
?>
<tr style="cursor: pointer;" onclick="m_agendamento(<? echo $row['codigo'];?>);">
<td data-title="Nome"><? echo $row['nome'];?></td>
<td data-title="Serviço"><? echo $row['descricao'];?></td>
<td data-title="Data/Hora"><? echo formatodata($row['data'])." - ".formatohora($row['hora']); ?></td>
</tr>
<? $x = 1;
}

if($x == 0)
{
 echo "<tr><td>Nenhum resultado encontrado.</td><td></td><td></td><td></td></tr>";

}
}
?>
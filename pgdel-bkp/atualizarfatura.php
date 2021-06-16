<table>
<thead>
<tr>
        <th>CPF</th>
		<th>Data</th>
		<th>Paciente</th>
		<th>Descricão</th>
		<th>Total R$</th>
		</tr>
</thead>
<tbody>
<? 

echo $sql = "select ( laudos_enviados.valor_empresa-laudos_enviados.desconto_empresa) as totalsoma,laudos_enviados.codigo,laudos_enviados.valor_empresa, laudos_enviados.desconto_empresa, laudos_enviados.paciente,laudos_enviados.dataenvio, tipo_exame.descricao , laudos_enviados.cpf from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo
where laudos_enviados.fatura = 9138 and (valor_empresa - desconto_empresa) > 0 order by paciente asc";
										  
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr>
          <td><? echo $row['cpf'];?></td>
          <td><? echo $row['dataenvio'];?></td>
		  <td><? echo $row['paciente'];?></td>
		  <td><? echo $row['descricao'];?></td>
		  <td><? echo $row['totalsoma'];?></td>
		  <td></td>
		  <td></td>
		  <td></td>
		<td>
	</td>
</tr>
 <? } ?>
</tbody>
</table>

<?
$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$inputb['ap'] == 1)
{
	$SQLT = "SELECT count(agendamento_servicos.codigo) as qtd, vendas_mov.codigo, usuarios.nome, produtos.preco, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
	inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
	and agendamento_servicos.servico=produtos_usuarios.produto
	inner join produtos on produtos.codigo=produtos_usuarios.produto
	inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
	inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
	inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
	where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$inputb['profissional']."' and vendas_mov.`ccomissao`=0 and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".revertedata($inputb['inicio'])."' AS DATE) AND agendamento_servicos.data <= CAST('".revertedata($inputb['final'])."' AS DATE)";
    $REST = mysqli_query($db3,$SQLT);
	$rowT = mysqli_fetch_array($REST);
	
	if(isset($rowT['codigo']))
	{
		
	$SQL = "INSERT INTO comissao (sistema,usuario,profissional, status) values('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$inputb['profissional']."',1);";
	mysqli_query($db3,$SQL);
	
	$SQL2 = "SELECT max(codigo) as codigo FROM comissao where sistema='".$_SESSION['sistema']."' and profissional='".$inputb['profissional']."';";
	$RES2 = mysqli_query($db3,$SQL2);
	$ROW2 = mysqli_fetch_array($RES2);	
	
	$SQL = "SELECT count(agendamento_servicos.codigo) as qtd, vendas_mov.codigo, usuarios.nome, produtos.preco, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
	inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
	and agendamento_servicos.servico=produtos_usuarios.produto
	inner join produtos on produtos.codigo=produtos_usuarios.produto
	inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
	inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
	inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
	where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$inputb['profissional']."' and vendas_mov.`ccomissao`=0 and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".revertedata($inputb['inicio'])."' AS DATE) AND agendamento_servicos.data <= CAST('".revertedata($inputb['final'])."' AS DATE) GROUP BY agendamento_servicos.codigo";
    $RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$SQL3 = "UPDATE vendas_mov SET ccomissao='".$ROW2['codigo']."' where sistema='".$_SESSION['sistema']."' and codigo='".$row['codigo']."';";
		$RES3 = mysqli_query($db3,$SQL3);
		mysqli_fetch_array($RES3);
	}
		
	$SQL3 = "UPDATE comissao SET data='".$data."',data_inicio='".revertedata($inputb['inicio'])."',data_final='".revertedata($inputb['final'])."', valor='".$rowT['total']."' where sistema='".$_SESSION['sistema']."' and codigo='".$ROW2['codigo']."';";
	$RES3 = mysqli_query($db3,$SQL3);
	mysqli_fetch_array($RES3);
	
	print('
		<script>
		swal({   
 			   title: "Info!",   
 			   text: "Gerado com sucesso.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
	else
	{
		print('
		<script>
		swal({   
 			   title: "Info!",   
 			   text: "Nenhum dados encontrado para esse periodo.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
}
else if(@$inputb['ap'] == 2)
{
  $sql = "select comissao.codigo,usuarios.nome, comissao.valor from comissao 
  inner join usuarios on usuarios.codigo=comissao.profissional
  where comissao.sistema='".$_SESSION['sistema']."' and comissao.codigo='".$inputb['codigo']."';";
  $res = mysqli_query($db3,$sql); 
  $row = mysqli_fetch_array($res);
  
  if(isset($row['codigo']))
  {
	    $SQL3 = "UPDATE vendas_mov SET ccomissao='0' where sistema='".$_SESSION['sistema']."' and ccomissao='".$row['codigo']."';";
		mysqli_query($db3,$SQL3);
		
	    $SQL = "DELETE FROM comissao where sistema='".$_SESSION['sistema']."' and codigo='".$row['codigo']."';";
		mysqli_query($db3,$SQL);
		
		print('
		<script>
		swal({   
 			   title: "Info!",   
 			   text: "Excluido com sucesso.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
  }
  else
  {
		print('
		<script>
		swal({   
 			   title: "Info!",   
 			   text: "Nenhum dados encontrado para esse periodo.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
  }
}
else if($inputb['ap'] == 3)
{
  $sql = "select comissao.codigo,usuarios.nome, comissao.valor from comissao 
  inner join usuarios on usuarios.codigo=comissao.profissional
  where comissao.sistema='".$_SESSION['sistema']."' and comissao.codigo='".$inputb['codigo']."';";
  $res = mysqli_query($db3,$sql); 
  $row = mysqli_fetch_array($res);
  
  if(isset($row['codigo']))
  {
	  $SQL3 = "UPDATE comissao SET status=2 where sistema='".$_SESSION['sistema']."' and codigo='".$row['codigo']."';";
	  mysqli_query($db3,$SQL3);
  }
  else
  {
		print('
		<script>
		swal({   
 			   title: "Info!",   
 			   text: "Nenhum dados encontrado para esse periodo.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
  }
}

if(@$inputb['load'] == 1){
	
  $x = 0;
  $sql = "select comissao.codigo,usuarios.nome,comissao.profissional,comissao.data_inicio,comissao.data_final,comissao.valor from comissao 
  inner join usuarios on usuarios.codigo=comissao.profissional
  where comissao.sistema='".$_SESSION['sistema']."' and comissao.status=1;";
  $res = mysqli_query($db3,$sql); 
  while($row = mysqli_fetch_array($res))
  {
	  $x = 1;
  ?>
	<tr onclick="viewer('<?=$row['profissional'];?>','<?=$row['data_inicio'];?>','<?=$row['data_final'];?>');">
		<td data-title="Codigo"><? echo $row['codigo'];?></td>
		<td data-title="Profissional"><? echo $row['nome'];?></td>
		<td data-title="Periodo"><? echo formatodata($row['data_inicio'])." - ".formatodata($row['data_final']);?></td>
		<td data-title="Valor"><? echo number_format($row['valor'], 2, ',','.');?></td>
		<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
		<td data-title="Editar"><a class="fa fa-ban" href="javascript:void(0);" onclick="co_excluir(<?=$row['codigo'];?>);" style="font-size: 150%;"><a></td>
	</tr>
<? 
  } 
  
  if($x == 0)
  {
	 echo "<tr><td data-title='Situação'>Nenhuma comissão encontrada</td></tr>"; 
  }
}
else if(@$inputb['load'] == 2){
	
  $x = 0;
  $sql = "select comissao.codigo,usuarios.nome,comissao.profissional,comissao.data_inicio,comissao.data_final,comissao.valor,comissao.status from comissao 
  inner join usuarios on usuarios.codigo=comissao.profissional
  where comissao.sistema='".$_SESSION['sistema']."' and comissao.profissional='".$_SESSION['usuario']."' and comissao.status in (0,1,2);";
  $res = mysqli_query($db3,$sql); 
  while($row = mysqli_fetch_array($res))
  {
	  $x = 1;
  ?>
	<tr onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="viewer('<?=$row['codigo'];?>','<?=$row['profissional'];?>','<?=$row['data_inicio'];?>','<?=$row['data_final'];?>');">
		<td data-title="Codigo"><? echo $row['codigo'];?></td>
		<td data-title="Profissional"><? echo $row['nome'];?></td>
		<td data-title="Periodo"><? echo formatodata($row['data_inicio'])." - ".formatodata($row['data_final']);?></td>
		<td data-title="Total R$">R$ <? echo number_format($row['valor'], 2, ',','.');?></td>
		<td data-title="Situação"><? 
		 Switch($row['status'])
		 {
		 case 1:
		  echo '<span style="color: blue;">Pendente</span>';
         break;
         case 2:
		  echo '<span style="color: green;">Aprovado</span>';
         break;
		 }
         
		 ?></td>
	</tr>
<? 
  } 
  
  if($x == 0)
  {
	 echo "<tr data-title='Situação'><td>Nenhuma comissão encontrada</td></tr>"; 
  }
}?>
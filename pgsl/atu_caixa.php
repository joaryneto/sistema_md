<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu3'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}


if(@$_GET['load'] == 1)
{
	$desc = str_replace('.', "", security::input(@$_GET['desc']));
	$preco = str_replace('.', "", security::input(@$_GET['preco']));
	$total = str_replace('.', "", security::input(@$_GET['total']));
	
	$desc = str_replace(',', ".", $desc);
	$preco = str_replace(',', ".", $preco);
	$qtd = security::input(@$_GET['qtd']);
	$total = str_replace(',', ".", $total);
	$d = $desc;
	
	$valor = $preco * $qtd;
	$desc = $desc * $qtd;
	$valor = $valor-+$desc;
	$total = $preco-+$d;
	$v = number_format($valor,2,",",".");
	$total = number_format($total,2,",",".");
	
	//print("<script>swal('Atenção', '".$preco." e ".$d."');</script>"); 
	//echo $valor;
	?>
   <script> 
   $('#totals').val('<?=$v;?>');
   $('#total').val('<?=$total;?>');
   </script>
   <?
}
else if(@$_GET['load'] == 2)
{
	$SQL = "SELECT sum(preco) as total, count(codigo) as qtd FROM vendas_mov where sistema='".$_SESSION['sistema']."' and venda='".$_SESSION['venda']."'";
	$RES = mysqli_query($db3,$SQL);
	$CREW = mysqli_fetch_array($RES);	 
	
	$_SESSION['totalvenda'] = $CREW['total'];
	
	$dinheiro = str_replace(",",".", str_replace(".","",security::input(@$_GET['dinheiro'])));
	$debito = str_replace(",",".", str_replace(".","",security::input(@$_GET['ctdebito'])));
	$credito = str_replace(",",".", str_replace(".","",security::input(@$_GET['ctcredito'])));
	$ted = str_replace(",",".", str_replace(".","",security::input(@$_GET['ted'])));
	$totals = str_replace(",",".", $_SESSION['totalvenda']);
	
	$valor = $dinheiro+$debito+$credito+$ted;

	//print("<script>swal('Atenção', '".$valor." e ".$totals."');</script>");
	
	if($valor < $totals)
	{
		$v = $totals-+$valor;
		
		//print("<script>swal('Atenção', '".$valor." e ".$totals." total: ".$v."');</script>");
		print("<script> document.getElementById('vtroco').innerHTML = '<span  style=\"color: red;\">Falta: R$ ".number_format($v,2,",",".")."</span>';</script>");
		$_SESSION['recebido'] = $v;
	}
	else
	{
		$v = $valor-+$totals;
		//print("<script>swal('Atenção', '".$valor." e ".$totals."');</script>");
		print("<script> document.getElementById('vtroco').innerHTML = '<span style=\"color: green;\">Troco: R$".number_format($v,2,",",".")."</span>';</script>");
		$_SESSION['recebido'] = $v;
	}
}
else if(@$_GET['load'] == 3)
{
	$SQL = "SELECT sum(preco) as total FROM vendas_mov where sistema='".$_SESSION['sistema']."' and venda='".$_SESSION['venda']."'";
	$RES = mysqli_query($db3,$SQL);
	$CREW = mysqli_fetch_array($RES);
	
	$vtotal = $vtotal-+$CREW['total'];
	print('<script> document.getElementById("vtotalp").innerHTML = "'.number_format($CREW['total'],2,",",".").'";</script>');
	print('<script> document.getElementById("vtroco").innerHTML = "<span style=\'color: red;\'>Falta: R$ '.number_format($vtotal,2,",",".").'</span>";</script>');
}

if(@$_GET['ap'] == 1)
{
	
	$data = date("Y-m-d");
	$codigo = @$_GET['codigo'];
	//$venda = $_GET['venda'];
	
	$preco = str_replace('.', "", security::input(@$_GET['preco']));
	$total = str_replace('.', "", security::input(@$_GET['total']));
	
    $preco = str_replace(',', ".", $preco);
	$total = str_replace(',', ".", $total);
	$cliente = security::input(@$_GET['codigo']);
	$produto = security::input(@$_GET['produto']);
	$qtd = security::input(@$_GET['quantidade']);
	
	if(@$_GET['excluir'] == 1)
	{
	   //$teste = explode(",",$_GET['codigo']);
	   //echo $SQL = "SELECT codigo as qtd from vendas_mov sistema='".$_SESSION['sistema']."' and produto='".$codigo."' and venda='".$_SESSION['venda']."' and total='".$total."'";
	   //$RES = mysqli_query(db3,$SQL);
	   //$RSSS = mysqli_fetch_array($RES);
	
       //for ($xx = 1; $xx <= $RSSS['qtd']; $xx++) 
       //{
	      $SQL = "DELETE from vendas_mov where sistema='".$_SESSION['sistema']."' and produto='".$codigo."' and venda='".$_SESSION['venda']."' and total='".$total."'";
	      $RES = mysqli_query($db3,$SQL);
		  //print("<script>localStorage.removeItem('valor');</script>");
	   //}
	}
	else
	{
		//$xx = 0;
		for ($xx = 1; $xx <= $qtd; $xx++) 
		{
            $SQL = "INSERT vendas_mov(sistema,cliente,produto,venda,caixa,data,preco,total,usuario,status) values('".$_SESSION['sistema']."','".$cliente."','".$produto."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$data."','".$preco."','".$total."','".$_SESSION['usuario']."',1)";
            $RES = mysqli_query($db3,$SQL);

        } 
	
    }
	
	$SQL = "SELECT sum(preco) as total, count(codigo) as qtd FROM vendas_mov where sistema='".$_SESSION['sistema']."' and venda='".$_SESSION['venda']."'";
	$RES = mysqli_query($db3,$SQL);
	$CREW = mysqli_fetch_array($RES);	 
	
	$_SESSION['qtditens'] = $CREW['qtd'];
	$_SESSION['totalvenda'] = $CREW['total'];	
	
	print("<script> document.getElementById('vtotal').innerHTML = '".number_format($CREW['total'],2,",",".")."';</script>");
	print("<script> document.getElementById('qtdbgd').innerHTML = '".$_SESSION['qtditens']."';</script>");
}
else if(@$_GET['ap'] == 2)
{
    $SQL = "SELECT sum(total) as total FROM vendas_mov where venda='".$_SESSION['venda']."'";
	$RES = mysqli_query($db3,$SQL);
	$CREW = mysqli_fetch_array($RES);
	
	$_SESSION['totalvenda'] = $CREW['total'];
	
	$dinheiro = str_replace(",",".", str_replace(".","",security::input(@$_GET['dinheiro'])));
	$ctdebito = str_replace(",",".", str_replace(".","",security::input(@$_GET['ctdebito'])));
	$ctcredito = str_replace(",",".", str_replace(".","",security::input(@$_GET['ctcredito'])));
	$ted = str_replace(",",".", str_replace(".","",security::input(@$_GET['ted'])));
	$totals = str_replace(",",".", $_SESSION['totalvenda']);
	
	$valor = $dinheiro+$ctdebito+$ctcredito+$ted;
	
	if($valor < $totals)
	{
		     $v = $totals-+$valor;
			 print("<script>$('#pagamento').modal('show');</script>");
		     //print("<script>swal('Atenção', '".$dinheiro." e ".$_SESSION['totalvenda']." total: ".number_format($v,2,",",".")."');</script>");
		     print("<script>swal('Atenção', 'Existe uma diferença de valor total R$ ".number_format($v,2,",",".").". Confirme o valor pago.');</script>");
			 
	}
	else if($valor < $totals)
	{
		     $v = $totals-+$valor;
			 print("<script>$('#pagamento').modal('show');</script>");
		     //print("<script>swal('Atenção', '".$dinheiro." e ".$_SESSION['totalvenda']." total: ".number_format($v,2,",",".")."');</script>");
		     print("<script>swal('Atenção', 'Existe uma diferença de valor total R$ ".number_format($v,2,",",".").". Confirme o valor pago.');</script>");
			 
	}
	else
	{
		if(0 < $dinheiro)
		{
			//print("<script>swal('Atenção', '".$dinheiro."');</script>");
		    $SQL1 = "INSERT into vendas_recebidos(sistema,usuario,venda,caixa,total,tipo,status) VALUES('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$dinheiro."','1','1');";
	        mysqli_query($db3,$SQL1);
		}
		if(0 < $ctdebito)
		{
			//print("<script>swal('Atenção', '".$ctdebito."');</script>");
		    $SQL1 = "INSERT into vendas_recebidos(sistema,usuario,venda,caixa,total,tipo,status) VALUES('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$ctdebito."','2','1');";
	        mysqli_query($db3,$SQL1);
		}
		if(0 < $ctcredito)
		{
			//print("<script>swal('Atenção', '".$dinheiro."');</script>");
		    $SQL1 = "INSERT into vendas_recebidos(sistema,usuario,venda,caixa,total,tipo,status) VALUES('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$ctcredito."','3','1');";
	        mysqli_query($db3,$SQL1);
		}
		if(0 < $ted)
		{
			//print("<script>swal('Atenção', '".$dinheiro."');</script>");
		    $SQL1 = "INSERT into vendas_recebidos(sistema,usuario,venda,caixa,total,tipo,status) VALUES('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$ted."','4','1');";
	        mysqli_query($db3,$SQL1);
		}
		
	    $data = date('Y-m-d H:i:s');
	    $SQL1 = "UPDATE vendas SET status=0, data='".$data."' where sistema='".$_SESSION['sistema']."' and codigo='".$_SESSION['venda']."'";
		$RES = mysqli_query($db3,$SQL1);
		
		$SQL2 = "UPDATE agendamento_servicos SET status=1 where sistema='".$_SESSION['sistema']."' and codigo='".$_SESSION['pgtagendamento']."'";
	    $RES = mysqli_query($db3,$SQL2);
		
	    print("<script> 
		$('#modalap').modal('show');
		requestPage2('?br=cad_vendas&comprovante=true&codigo=".$_SESSION['venda']."','conteudo','GET');
		</script>");
	}
}
else if(@$_GET['ap'] == 3)
{
	$dinheiro = str_replace(",",".", str_replace(".","",security::input($_GET['dinheiro'])));
	
	$totals = $_SESSION['totalvenda'];
	$tipo = $_GET['tipo'];
	
	if($dinheiro <= $totals)
	{
		$v = $totals-+$dinheiro;
		
		$SQL1 = "INSERT into vendas_recebidos(sistema,venda,caixa,total,tipo,status) VALUES('".$_SESSION['sistema']."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$dinheiro."','".$tipo."','1');";
	    mysqli_query($db3,$SQL1);
		
	    //$data = date('Y-m-d H:i:s');
	    //$SQL2 = "UPDATE vendas SET status=2, data='".$data."' where sistema='".$_SESSION['sistema']."' and codigo='".$_SESSION['venda']."'";
		//$SQL2 = "UPDATE vendas_recebidos SET status=1 where sistema='".$_SESSION['sistema']."' and codigo='".$_SESSION['venda']."'";
	    $RES = mysqli_query($db3,$SQL2);
		
	    //print("<script>window.location.href='caixa.php';</script>");
		
		$_SESSION['totalvenda'] = $_SESSION['totalvenda']-$dinheiro;
		
	    print('<script> document.getElementById("vtroco").innerHTML = "<span style=\'color: red;\'>Falta: R$ '.number_format($v,2,",",".").'</span>";</script>');
	}
}

if(@$_GET['load'] == 1)
{
    $d_count = 1;			 
	$data = date('Y');
	$sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.preco) as totals, count(vendas_mov.produto) as quantidade from vendas_mov 
	inner join produtos on produtos.codigo=vendas_mov.produto 
	where vendas_mov.sistema='".$_SESSION['sistema']."' and vendas_mov.venda='".$_SESSION['venda']."' GROUP BY vendas_mov.total, vendas_mov.produto";
	$res = mysqli_query($db3,$sql); 
	$b = 0;
	while($row = mysqli_fetch_array($res))
	{
												 
	?>
	<tr onclick="excluir(<?=$row['produto'];?>,<?=$row['total'];?>)"><!-- color: #20aee3; -->
		<td data-title="#"><?=$d_count;?></td>
		<td data-title="Descrição">(<? echo $row['codigo'];?>) - <? echo $row['descricao'];?></td>
		<td data-title="Qtd/C. Uni."><? echo $row['quantidade'];?>x<? echo number_format($row['preco'],2,",",".");?></td>
		<td data-title="Total">R$ <? echo number_format($row['totals'],2,",",".");?></td>
	</tr>
	<? $b = 1;
	   $d_count ++;
	} 									  
	if($b == 0)
	{
	    echo '<tr><td colspan="4" class="text-center"> Nenhum registro encontrado.</td></tr>';
		print("<script> slow();</script>");
	}	
	
}
else if(@$_GET['load'] == 2)
{
    $d_count = 1;			 
	$data = date('Y');
	$sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.preco) as totals, count(vendas_mov.produto) as quantidade from vendas_mov 
	inner join produtos on produtos.codigo=vendas_mov.produto 
	where vendas_mov.sistema='".$_SESSION['sistema']."' and vendas_mov.venda='".$_SESSION['venda']."' GROUP BY vendas_mov.total, vendas_mov.produto";
	$res = mysqli_query($db3,$sql); 
	$b = 0;
	while($row = mysqli_fetch_array($res))
	{
												 
	?>
	<tr onclick="excluir(<?=$row['produto'];?>,<?=$row['total'];?>)"><!-- color: #20aee3; -->
		<td data-title="#"><?=$d_count;?></td>
		<td data-title="Descrição">(<? echo $row['codigo'];?>) - <? echo $row['descricao'];?></td>
		<td data-title="Qtd/C. Uni."><? echo $row['quantidade'];?>x<? echo number_format($row['preco'],2,",",".");?></td>
		<td data-title="Total">R$ <? echo number_format($row['totals'],2,",",".");?></td>
	</tr>
	<? $b = 1;
	   $d_count ++;
	} 									  
	if($b == 0)
	{
	    echo '<tr><td colspan="4" class="text-center"> Nenhum registro encontrado.</td></tr>';
	}	
	
}

?>	


















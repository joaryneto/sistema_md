<?
ob_start();
session_start();

?>
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


if($_GET['load'] == 1)
{
	$desc = str_replace('.', "", $_GET['desc']);
	$preco = str_replace('.', "", $_GET['preco']);
	$total = str_replace('.', "", $_GET['total']);
	
	$desc = str_replace(',', ".", $desc);
	$preco = str_replace(',', ".", $preco);
	$qtd = $_GET['qtd'];
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
else if($_GET['load'] == 2)
{
	$dinheiro = str_replace(",",".", str_replace(".","",$_GET['dinheiro']));
	$totals = str_replace(",",".", str_replace(".","",$_SESSION['totalvenda']));

	if($valor <= $totals)
	{
		$v = $totals-+$valor;
		
		print("<script>swal('Atenção', '".$valor." e ".$totals." total: ".$v."');</script>");
		print("<script> document.getElementById('vtroco').innerHTML = '<span  style=\"color: red;\">Falta: R$ ".number_format($v,2,",",".")."</span>';</script>");
		$_SESSION['recebido'] = $v;
	}
	else
	{
		$v = $valor-+$totals;
		print("<script>swal('Atenção', '".$valor." e ".$totals."');</script>");
		print("<script> document.getElementById('vtroco').innerHTML = '<span style=\"color: green;\">Troco: R$".number_format($v,2,",",".")."</span>';</script>");
		$_SESSION['recebido'] = $v;
	}
}
else if($_GET['load'] == 3)
{
	$SQL = "SELECT sum(total) as total FROM vendas_mov where venda='".$_SESSION['venda']."'";
	$RES = mysqli_query($db3,$SQL);
	$CREW = mysqli_fetch_array($RES);
	
	$vtotal = $vtotal-+$CREW['total'];
	print('<script> document.getElementById("vtotalp").innerHTML = "'.number_format($CREW['total'],2,",",".").'";</script>');
	print('<script> document.getElementById("vtroco").innerHTML = "<span style=\'color: red;\'>Falta: R$ '.number_format($vtotal,2,",",".").'</span>";</script>');
}

if($_GET['ap'] == 1)
{
	
	$data = date("Y-m-d");
	$codigo = $_GET['codigo'];
	//$venda = $_GET['venda'];
	
	$preco = str_replace('.', "", $_GET['preco']);
	$total = str_replace('.', "", $_GET['total']);
	
    $preco = str_replace(',', ".", $preco);
	$total = str_replace(',', ".", $total);
	$produto = $_GET['produto'];
	$qtd = $_GET['quantidade'];
	
	if($_GET['excluir'] == 1)
	{
	   //$teste = explode(",",$_GET['codigo']);
	
       //foreach($teste as $i)
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
            $SQL = "INSERT vendas_mov(sistema,produto,venda,caixa,data,preco,total,usuario,status) values('".$_SESSION['sistema']."','".$produto."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$data."','".$preco."','".$total."','".$_SESSION['usuario']."',1)";
            $RES = mysqli_query($db3,$SQL);
			
        } 
	
    }
	
	$SQL = "SELECT sum(total) as total FROM vendas_mov where venda='".$_SESSION['venda']."'";
	$RES = mysqli_query($db3,$SQL);
	$CREW = mysqli_fetch_array($RES);
						  
	$data = date('Y');
	$sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.total) as totals, count(vendas_mov.produto) as quantidade from vendas_mov inner join produtos on produtos.codigo=vendas_mov.produto where vendas_mov.venda='".$_SESSION['venda']."' GROUP BY vendas_mov.total, vendas_mov.produto";
	$res = mysqli_query($db3,$sql); 
	$b = 0;
	while($row = mysqli_fetch_array($res))
	{
												 
	?>
	<tr ><!-- color: #20aee3; -->
		<td class="text-center">(<? echo $row['codigo'];?>) - <? echo $row['descricao'];?></td>
		<td class="text-right"><? echo $row['quantidade'];?>x<? echo $row['total'];?></td>
		<td class="text-right">R$ <? echo number_format($row['totals'],2,",",".");?>  <a href="javascript: Web(0);" onclick="excluir(<?=$row['produto'];?>,<?=$row['total'];?>)"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="font-size: 150%; color: red;"></i></a></td>
	</tr>
	<? $b = 1;
	} 									  
	if($b == 0)
	{
	    echo '<tr><td colspan="4" class="text-center"> Nenhum registro encontrado.</td></tr>';
	}
	
	$_SESSION['totalvenda'] = $CREW['total'];	
	
	print("<script> document.getElementById('vtotal').innerHTML = '".number_format($CREW['total'],2,",",".")."';</script>");
	
}
else if($_GET['ap'] == 2)
{
    $SQL = "SELECT sum(total) as total FROM vendas_mov where venda='".$_SESSION['venda']."'";
	$RES = mysqli_query($db3,$SQL);
	$CREW = mysqli_fetch_array($RES);
	
	$dinheiro = str_replace(",",".", str_replace(".","",$_GET['dinheiro']));
	$tipo = $_GET['dinheiro'];
	
	if($valor < $totals)
	{
		$v = $totals-+$valor;
		//print("<script>swal('Atenção', '".$dinheiro." e ".$_SESSION['totalvenda']." total: ".number_format($v,2,",",".")."');</script>");
		print("<script>swal('Atenção', 'Existe uma diferença de valor total R$ ".number_format($v,2,",",".").". Confirme o valor pago.');</script>");
	}
	else
	{
		
		$SQL1 = "INSERT into vendas_recebidos(sistema,venda,caixa,total,tipo,status) VALUES('".$_SESSION['sistema']."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$dinheiro."','1','1');";
	    mysqli_query($db3,$SQL1);
		
	    $data = date('Y-m-d H:i:s');
	    $SQL2 = "UPDATE vendas SET status=0, data='".$data."' where sistema='".$_SESSION['sistema']."' and codigo='".$_SESSION['venda']."'";
		$SQL2 = "UPDATE vendas_recebidos SET status=1 where sistema='".$_SESSION['sistema']."' and codigo='".$_SESSION['venda']."'";
	    $RES = mysqli_query($db3,$SQL2);
		
	    print("<script>window.location.href='caixa.php';</script>");
	}
}
else if($_GET['ap'] == 3)
{
	$dinheiro = str_replace(",",".", str_replace(".","",$_GET['dinheiro']));
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

mysqli_close($db3);
?>	


















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

if($_GET['ap'] == 1)
{
	$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);
	
	$y = 0;
    $codigo = security::input(@$inputb['codigo']);
    $servico = security::input(@$inputb['servico']);
	$comissao = security::input(@$inputb['comissao']);
	
	$SQL = "SELECT * FROM produtos_usuarios where sistema='".$_SESSION['sistema']."' and usuario=".$codigo." and produto=".$servico.";";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$y = 1;
	}
	
	if($codigo == "")
	{
		print('<script>
		  swal({   
					    title: "Atenção",   
					    text: "Campo Serviço em branco.",   
					    timer: 1500,   
					    showConfirmButton: false 
                     });
		  </script>');
	}
	else if($servico == "")
	{
		print('<script>
		  swal({   
					    title: "Atenção",   
					    text: "Campo comissão em branco.",   
					    timer: 1500,   
					    showConfirmButton: false 
                     });
		  </script>');
	}
	else
	{
	
	 //$count = 0;
	 $x = 0;
	 $SQL1 = "SELECT * FROM produtos_usuarios where sistema='".$_SESSION['sistema']."' and usuario=".$codigo." and produto=".$servico.";";
	 $sucesso = mysqli_query($db3,$SQL1);
	
	 while($row = mysqli_fetch_array($sucesso))
	 {
		$x = 1;
		$cod = $row['codigo'];
		//$count++;
	 }
	
	 if($x == 1)
	 {
		$SQL = "UPDATE produtos_usuarios SET status=1, comissao='".$comissao."' where sistema='".$_SESSION['sistema']."' and codigo='".$cod."'";
		mysqli_query($db3,$SQL);
	 }
	 else
	 {
		//print("<script>window.alert('Aluno não esteve presente!');</script>");
		//echo "<br>";
		$SQL = "INSERT INTO produtos_usuarios(sistema,usuario,produto,comissao,status) values('".$_SESSION['sistema']."','".$codigo."','".$servico."','".$comissao."',1);";
		$sucesso = mysqli_query($db3,$SQL);
	  }	
	}
}
else if($_GET['ap'] == 2)
{
	 $inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);
	 
	 $codigo = security::input(@$inputb['codigo']);
     $servico = security::input(@$inputb['servico']);

	 $x = 0;
	 $SQL1 = "SELECT * FROM produtos_usuarios where sistema='".$_SESSION['sistema']."' and usuario=".$codigo." and codigo=".$servico.";";
	 $sucesso = mysqli_query($db3,$SQL1);
	
	 while($row = mysqli_fetch_array($sucesso))
	 {
		$x = 1;
		$cod = $row['codigo'];
		//$count++;
	 }
	
	 if($x == 1)
	 {
	    $SQL = "UPDATE produtos_usuarios SET status=0 where sistema='".$_SESSION['sistema']."' and codigo='".$servico."';";
	    mysqli_query($db3,$SQL);
	 }
	 else
	 {
		 print('<script>
		  swal({   
					    title: "Atenção",   
					    text: "Não faça isso novamente.",   
					    timer: 1500,   
					    showConfirmButton: false 
                     });
		  </script>');
	 }
}
if($_GET['load'] == 1)
{
	 $inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);
	 
	 $codigo = security::input(@$inputb['codigo']);
	 
     $b = 0;
	 $SQL2 = "SELECT produtos_usuarios.codigo, produtos.preco ,produtos.descricao, produtos_usuarios.comissao from produtos 
	 inner join produtos_usuarios on produtos_usuarios.produto=produtos.codigo 
	 where produtos_usuarios.usuario='".$_GET['codigo']."' and produtos.tipo=2 and produtos_usuarios.status=1 order by produtos.descricao ASC";
	 $RES2 = mysqli_query($db3,$SQL2);
	 while($row = mysqli_fetch_array($RES2))
	 {			 
		$valor = $row['preco']; // valor do produto
		$porcent = $row['comissao'] / 100; // 5%
		$comissao = $porcent * $valor;
		 
  ?>
	<tr><!-- color: #20aee3; -->
		<td data-title="Cod."><? echo $row['codigo'];?></td>
		<td data-title="Serviço"><? echo $row['descricao'];?></td>
		<td data-title="Preço">R$ <? echo number_format($row['preco'],2,",",".");?> </td>
		<td data-title="Comissão"><? echo number_format($row['comissao'], 2, ',', ',');?> % </td>
		<td data-title="Total">R$ <? echo number_format($comissao,2,",","."); ?></td>
		<td data-title="Opções"><a href="javascript: void(0);" onclick="m_desabilitar(<?=$row['codigo'];?>);"><i class="fa fa-ban" style="font-size: 150%; color: red;"></i></a></td>
	</tr>
  <? $b = 1;
  
   } 
  
  if($b == 0)
  {
	 echo '<tr ><!-- color: #20aee3; -->
		<td colspan="5" class="text-center"> Nenhum registro encontrado.</td>
	</tr>';
  }

}
?>	
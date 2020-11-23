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

if($_GET['ap'] == 1)
{
    $codigo = $_GET['codigo'];
    $check = $_GET['check'];
    $servico = $_GET['servico'];
	
	//$count = 0;
	$x = 0;
	$SQL1 = "SELECT * FROM produtos_usuarios where sistema='".$_SESSION['sistema']."' and usuario=".$codigo." and produto=".$servico."";
	$sucesso = mysqli_query($db3,$SQL1);
	
	while($row = mysqli_fetch_array($sucesso))
	{
		$x = 1;
		
		//$count++;
	}
	
	if($x == 1)
	{
		//echo "<br>";
        ?>
	<script> 
		//alert('TESTE');
		swal('Atenção', 'Já foi adicionado!'); 
	</script>
	<?
	}
	else
	{
		//print("<script>window.alert('Aluno não esteve presente!');</script>");
		//echo "<br>";
		$SQL = "INSERT INTO produtos_usuarios(sistema,usuario,produto,status) values('".$_SESSION['sistema']."','".$codigo."','".$servico."',1);";
		$sucesso = mysqli_query($db3,$SQL);
	}	
}
else if($_GET['ap'] == 2)
{
	$SQL = "UPDATE produtos_usuarios SET status=0 where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['servico']."'";
	mysqli_query($db3,$SQL);
}
if($_GET['load'] == 1)
{

	 $SQL2 = "SELECT produtos.codigo, produtos.descricao from produtos inner join produtos_usuarios on produtos_usuarios.produto=produtos.codigo where produtos_usuarios.usuario='".$_GET['codigo']."' and produtos.tipo=2 and produtos_usuarios.status=1 order by produtos.descricao ASC";
	 $RES2 = mysqli_query($db3,$SQL2);
	 while($row = mysqli_fetch_array($RES2))
	 {
		 
  ?>
	<tr><!-- color: #20aee3; -->
		<td data-title="Cod."><? echo $row['codigo'];?></td>
		<td data-title="Serviço"><? echo $row['descricao'];?></td>
		<td data-title="Comissão">R$ <? echo number_format($row['totals'],2,",",".");?></td>
		<td><a href="javascript: void(0);" onclick="m_desabilitar(<?=$row['codigo'];?>);"><i class="fa fa-trash-o" style="font-size: 150%; color: red;"></i></a></td>
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
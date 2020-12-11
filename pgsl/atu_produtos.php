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

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@security::input(@$inputb['ap']) == 1)
{

   $data = date('Y');
   $sql = "select * from produtos where sistema='".$_SESSION['sistema']."' and descricao like '%".security::input(@$inputb['pesquisa'])."%'";
   $res = mysqli_query($db3,$sql); 
   $x = 0;
   while($row = mysqli_fetch_array($res))
   {
   ?>
   <tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="itens('<? echo $row['descricao'];?>',<? echo $row['codigo'];?>,'<? echo number_format($row['preco'],2,",",".");?>');">
   <td data-title="Codigo"><? echo $row['codigo'];?></td>
   <td data-title="Descrição"><? echo $row['descricao'];?></td>
   <td data-title="Preço R$"><? echo $row['preco'];?></td>
   <td data-title="Estoque"><? echo $row['estoque'];?></td>
   </tr>
   <? $x = 1;
   }

	if($x == 0)
	{
	 echo "<tr><td colspan='4'>Nenhum resultado encontrado.</td></tr>";
   
   }
}
else if(security::input(@$inputb['ap']) == 2)
{  
  $sql = "select * from produtos where sistema='".$_SESSION['sistema']."' and descricao like '%".security::input(@$inputb['pesquisa'])."%'";
  $res = mysqli_query($db3,$sql); 
  while($row = mysqli_fetch_array($res))
  {
  ?>
	<tr>
		<td data-title="Codigo"><? echo $row['codigo'];?></td>
		<td data-title="Descrição"><? echo $row['descricao'];?></td>
		<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
		<td data-title="Editar"><a class="fa fa-edit" href="sistema.php?url=cad_produtos&codigo=<? echo $row['codigo']?>&cadastro=1" style="font-size: 150%;"><a></td>
	</tr>
  <?
  } 
}

if(security::input(@$inputb['load']) == 1)
{
  if(isset($inputb['pesquisa']))
  {
	$whe = " and descricao like '%".security::input(@$inputb['pesquisa'])."%'";  
  }
  
  $sql = "select * from produtos where sistema='".$_SESSION['sistema']."' $whe order by descricao asc limit 5;";
  $res = mysqli_query($db3,$sql); 
  while($row = mysqli_fetch_array($res))
  {
  ?>
	<tr>
		<td data-title="Codigo"><? echo $row['codigo'];?></td>
		<td data-title="Descrição"><? echo $row['descricao'];?></td>
		<td data-title="Preço">R$ <? echo number_format($row['preco'], 2, ',','.');?></td>
		<td data-title="Custo">R$ <? echo number_format($row['custo'], 2, ',','.');?></td>
		<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
		<td data-title="Editar"><a class="fa fa-edit" href="javascript:void(0);" onclick="edit_produtos('<? echo $row['codigo']?>');" style="font-size: 150%;"><a></td>
	</tr>
  <? } 
}
?>	


















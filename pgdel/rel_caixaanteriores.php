<style>
@media print {
    html, body {
        margin: 0;
        padding: 0;
        border: 0;
    }
    #print {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 14px;
    }
    #print ~ * {
        display: none;
    }
	.table-striped tbody tr:nth-of-type(2n+1) {
		background: #fdb5b5 !important;
	}
	
	.page-break { 
        page-break-before: always; 
    }
}

.table-striped tbody th 
{
		background: #fdb5b5 !important;
}

@page{
  size: auto;
  margin: 0mm;
}
</style>
<?

$inicio = revertedata(@$_POST['datainicio']);
$final = revertedata(@$_POST['datafinal']);

setlocale(LC_MONETARY,"pt_BR", "ptb");
//$valor = money_format('%n', $valor);

if(!Empty($_POST['datainicio']) and !Empty($_POST['datafinal']))
{
	$_SESSION['datainicio'] = $_POST['datainicio'];
	$_SESSION['datafinal'] = $_POST['datafinal'];
	$_SESSION['rusuario'] = $_POST['usuario'];
}

?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Agenda </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<div id="print" class="conteudo" style="color: black;">
<table style="width: 100%;font-size: 11px; color: black;" class="table-bordered">
<tbody>
<tr style="background-color: #20aee3;height: 30px;text-align: start;">
        <th>Codigo</th>
		<th>Data</th>
		<th>Descricão</th>
		<th>Total R$</th>
</tr>
<? 

$sql = "select vendas_mov.codigo, count(vendas_mov.codigo) as qtd,produtos.descricao,vendas_mov.data,vendas_mov.preco, vendas_mov.total from vendas_mov
INNER JOIN produtos on produtos.codigo=vendas_mov.produto
where vendas_mov.caixa='".$_GET['codigo']."' GROUP BY vendas_mov.codigo, vendas_mov.produto, vendas_mov.data ORDER BY data asc ";
										  
$res = mysqli_query($db3,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr>
          <td><? echo $row['codigo'];?></td>
          <td><? echo formatodatahora($row['data']);?></td>
		  <td><? echo $row['descricao'];?></td>
		  <td>R$ <? echo number_format($row['total'],2,",",".");?></td>
</tr>
 <? } ?>
</tbody>
</table>
<div style="float:right">
<br>
<table style=" top: 20px; font-size: 11px; color: black; width: auto;" class="table-bordered">
<thead>
<tr style="background-color: #20aee3;height: 30px;text-align: start;">
        <th style="width: 80px;">Qt / Valor</th>
		<th style="width: 200px;">Tipo do Produto</th>
		<th>Total R$</th>
</tr>
</thead>
<tbody>
<? 

$SQL2 = "select vendas_mov.codigo, count(vendas_mov.codigo) as qtd,produtos.descricao,vendas_mov.data,vendas_mov.preco, sum(vendas_mov.total) as totals from vendas_mov
INNER JOIN produtos on produtos.codigo=vendas_mov.produto
where vendas_mov.caixa='".$_GET['codigo']."' GROUP BY vendas_mov.produto ORDER BY data asc";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
          <td><? echo $row['qtd'];?> / R$ <? echo number_format($row['preco'],2,",",".");?></td>
          <td><? echo $row['descricao'];;?></td>
		  <td>R$ <? echo number_format($row['totals'],2,",",".");?></td>
</tr>
 <? 

 } 
 ?>
</tbody>
</table>
<br>
<table style="float: right;top: 200px;  color: black; font-size: 11px; width: auto;" class="table-bordered">
<thead>
<? 

$SQL2 = "select vendas_mov.codigo, count(vendas_mov.codigo) as qtd,produtos.descricao,vendas_mov.data,vendas_mov.preco, sum(vendas_mov.total) as totals from vendas_mov
INNER JOIN produtos on produtos.codigo=vendas_mov.produto
where vendas_mov.caixa='".$_GET['codigo']."' ORDER BY data asc";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
<th style="background-color: #20aee3;height: 30px;text-align: start;;width: 100px;">Total R$</th>
<th style="width: 100px; text-align: right;">R$ <? echo number_format($row['totals'],2,",",".");?></th>
</tr>
 <? 

 } 
 ?>
 </thead>
</table>
</div>
</div>
</div>
		<div class="modal-footer">
</div>
<?
if(@$_GET['imprimir'] == 1)
{
?>
<script>
printDiv('print');
</script>
<?
}
?>
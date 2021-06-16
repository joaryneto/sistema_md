<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$inicio = revertedata(@$inputb['inicio']);
$final = revertedata(@$inputb['final']);

setlocale(LC_MONETARY,"pt_BR", "ptb");
//$valor = money_format('%n', $valor);

if(!Empty($inputb['inicio']) and !Empty($inputb['final']))
{
	$_SESSION['inicio'] = $inputb['inicio'];
	$_SESSION['final'] = $inputb['final'];
	$_SESSION['profissional'] = $inputb['profissional'];
}

$sql = "SELECT clientes.nome as cliente , count(agendamento_servicos.codigo) as qtd, agendamento_servicos.data, agendamento_servicos.codigo, usuarios.nome, produtos.preco, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
and agendamento_servicos.servico=produtos_usuarios.produto
inner join produtos on produtos.codigo=produtos_usuarios.produto
inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
left join clientes on clientes.codigo=vendas_mov.cliente
where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$_SESSION['profissional']."' and vendas_mov.`ccomissao`=0 and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".revertedata($_SESSION['inicio'])."' AS DATE) AND agendamento_servicos.data <= CAST('".revertedata($_SESSION['final'])."' AS DATE) GROUP BY agendamento_servicos.codigo ORDER BY agendamento_servicos.data asc ";
										  
$res = mysqli_query($db3,$sql); 
$row = mysqli_fetch_array($res);

if(isset($row['codigo']))
{
	
?>
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

table 
{
		border-collapse: collapse;
		width: 100%;
		margin-bottom:10px;
	    font-family: Verdana, Arial, Helvetica, sans-serif;
}

.table-stripedd thead th
{
	    border: 1px solid black;
	    border-collapse: collapse
		font-size: 60%;
		margin-bottom:10px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		background: #20aee3 !important;
}

.table-stripedd tbody td 
{
	    border: 1px solid black;
		font-size: 60%;
	    border-collapse: collapse;
		margin-bottom:10px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
}

.table-stripedd thead td 
{
	    border: 1px solid black;
		font-size: 60%;
	    border-collapse: collapse;
		margin-bottom:10px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
}

@page{
  size: auto;
  margin: 0mm;
}
</style>
<?

$SQLF = "SELECT * FROM usuarios where codigo='".$_SESSION['profissional']."';";
$RES = mysqli_query($db3,$SQLF);
$ROWF = mysqli_fetch_array($RES);
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Extrato</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<div id="print" class="conteudo" style="color: black;">
<h4>Profissional: <?=$ROWF['nome'];?></h4>
<table class="table-stripedd">
<thead>
<tr>
        <th>Codigo</th>
		<th>Cliente</th>
		<th>Data</th>
		<th>Total R$</th>
</tr>
</thead>
<tbody>
<? 

$sql = "SELECT clientes.nome as cliente , count(agendamento_servicos.codigo) as qtd, agendamento_servicos.data, agendamento_servicos.codigo, usuarios.nome, produtos.preco, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
and agendamento_servicos.servico=produtos_usuarios.produto
inner join produtos on produtos.codigo=produtos_usuarios.produto
inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
left join clientes on clientes.codigo=vendas_mov.cliente
where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$_SESSION['profissional']."' and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".revertedata($_SESSION['inicio'])."' AS DATE) AND agendamento_servicos.data <= CAST('".revertedata($_SESSION['final'])."' AS DATE) GROUP BY agendamento_servicos.codigo ORDER BY agendamento_servicos.data asc ";
										  
$res = mysqli_query($db3,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr>
  <td><? echo $row['codigo'];?></td>
  <td><? echo $row['cliente'];?></td>
  <td><? echo formatodata($row['data']);?></td>
  <td style="width:70px;">R$ <? echo number_format($row['total'],2,",",".");?></td>
</tr>
 <? } ?>
</tbody>
</table>
<table style="top: 20px;" class="table-stripedd">
<thead>
<tr>
    <th>Qt / Valor</th>
	<th>Tipo do Produto</th>
	<th>Total R$</th>
</tr>
</thead>
<tbody>
<? 

$SQL2 = "SELECT clientes.nome as cliente , count(agendamento_servicos.codigo) as qtd, agendamento_servicos.data, agendamento_servicos.codigo, usuarios.nome, produtos.preco, produtos.descricao, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
and agendamento_servicos.servico=produtos_usuarios.produto
inner join produtos on produtos.codigo=produtos_usuarios.produto
inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
left join clientes on clientes.codigo=vendas_mov.cliente
where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$_SESSION['profissional']."' and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".revertedata($_SESSION['inicio'])."' AS DATE) AND agendamento_servicos.data <= CAST('".revertedata($_SESSION['final'])."' AS DATE) GROUP BY produtos.descricao ORDER BY agendamento_servicos.data asc ";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
    <td><? echo $row['qtd'];?> / R$ <? echo number_format($row['preco'],2,",",".");?></td>
    <td><? echo $row['descricao'];?></td>
	<td style="width:70px;">R$ <? echo number_format($row['total'],2,",",".");?></td>
</tr>
 <? 

 } 
 ?>
</tbody>
</table>
<table style="float: right;top: 200px; width: auto;" class="table-stripedd">
<thead>
<? 

$SQL2 = "SELECT count(agendamento_servicos.codigo) as qtd,agendamento_servicos.codigo, usuarios.nome, produtos.preco, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
and agendamento_servicos.servico=produtos_usuarios.produto
inner join produtos on produtos.codigo=produtos_usuarios.produto
inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$inputb['profissional']."' and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".revertedata($inputb['inicio'])."' AS DATE) AND agendamento_servicos.data <= CAST('".revertedata($inputb['final'])."' AS DATE)";
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
	
?>
<tr>
<th style="width:80px;">Total R$</th>
<td style="width:70px;">R$ <? echo number_format($row['total'],2,",",".");?></td>
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
}
else
{
	print('
		<script>
		$("#modalap").modal("hide");
		swal({   
 			   title: "Info!",   
 			   text: "Nenhum dados encontrado para esse periodo.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
}
?>
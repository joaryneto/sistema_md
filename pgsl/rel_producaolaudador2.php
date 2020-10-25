<script>

function cont(){
   var conteudo = document.getElementById('print').innerHTML;
   tela_impressao = window.open('about:blank');
   tela_impressao.document.write(conteudo);
   tela_impressao.window.print();
   tela_impressao.window.close();
}

function printBy(selector){
    var $print = $(selector)
        .clone()
        .addClass('print')
        .prependTo('body');

    // Stop JS execution
    window.print();

    // Remove div once printed
    $print.remove();
}


function printDiv(divID) 
{

//pega o Html da DIV
var divElements = document.getElementById(divID).innerHTML;
        //pega o HTML de toda tag Body
var oldPage = document.body.innerHTML;

//Alterna o body 
document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";

//Imprime o body atual
window.print();

//Retorna o conteudo original da página. 
document.body.innerHTML = oldPage;
}

function printDiv2(divID)  
{
   var conteudo = document.getElementById(divID).innerHTML;  
   var win = window.open();  
   win.document.write(conteudo);  
   win.print();  
   win.close();//Fecha após a impressão.  
} 

</script>
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

if(Empty($_POST['medico']))
{
	$medico = $_SESSION['usuario'];
}
else
{
	$medico = $_POST['medico'];
}

$SQL1 = "SELECT * FROM internet_usuarios where codigo='".$medico."'";
$pessoa = mysqli_query($db,$SQL1);

while($rows = mysqli_fetch_array($pessoa))
{
   if(Empty($rows['cod_usuario']))
   {
      $medico = $rows['codigo'];
   }
   else
   {
      $medico = $rows['cod_usuario'];
   }
}

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

$inicio = revertedata($_POST['datainicio']);
$final = revertedata($_POST['datafinal']);

if($_GET['bloquearCXCX']==1)
{
  $SQL = "UPDATE laudos_enviados SET laudador=NULL , status=-1 where codigo=".$_GET['codigo']."";
  $sucesso = mysqli_query($db,$SQL);
  
  if($sucesso)
  {
	 print "<script> window.alert('Laudo bloqueado com sucesso...'); </script>";
	 print "<script> window.location='iniciado.php?url=inicio';</script>"; 
  }
}

setlocale(LC_MONETARY,"pt_BR", "ptb");
//$valor = money_format('%n', $valor);

if(!Empty($_POST['datainicio']) and !Empty($_POST['datafinal']))
{
	$_SESSION['datainicio'] = $_POST['datainicio'];
	$_SESSION['datafinal'] = $_POST['datafinal'];
	$_SESSION['rusuario'] = $_POST['usuario'];
}

?>
<div id="print" class="conteudo" style="color: black;">
<table style="width: 100%;font-size: 11px; color: black;" class="table-bordered">
<thead>
<tr >
<td style="margin: 10px;" colspan="5">
<img src="template/img/logo_02.png" style="height: 70px;margin: 10px;width: auto;" alt="homepage" class="light-logo">
<span style="font-size: 14px;position: fixed;top: 40px;"><b>Relação de Movimentação</b> <br> <b>Data:</b> <? echo $_SESSION['datainicio']; ?> a <? echo $_SESSION['datafinal']; ?><br><b>Nome:</b> Joary Taques Figueiredo Neto
</span>
</td>
</tr>
</thead>
<tbody>
<tr style="background-color: #20aee3;height: 30px;text-align: start;">
        <th>Codigo</th>
		<th>Data</th>
		<th>Descricão</th>
		<th>Total R$</th>
</tr>
<? 

$sql = "select vendas_caixa.codigo,produtos.descricao, vendas_caixa.data,vendas_caixa.preco,vendas_caixa.total from vendas inner join vendas_caixa on vendas_caixa.caixa=vendas.codigo inner join produtos on produtos.codigo=vendas_caixa.produto where vendas_caixa.usuario = '".$_SESSION['rusuario']."' and vendas.status=0 and ( date(vendas_caixa.data) >= '".$_SESSION['datainicio']."' and date(vendas_caixa.data) <= '".$_SESSION['datafinal']."') order by data asc";
										  
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

$SQL2 = "select count(vendas_caixa.produto) as qtd,vendas_caixa.codigo,produtos.descricao, vendas_caixa.preco, vendas_caixa.total, sum(vendas_caixa.total) as totalsoma from vendas inner join vendas_caixa on vendas_caixa.caixa=vendas.codigo inner join produtos on produtos.codigo=vendas_caixa.produto where vendas_caixa.usuario = '".$_SESSION['rusuario']."' and ( date(vendas_caixa.data) >= '".$_SESSION['datainicio']."' and vendas.status=0 and date(vendas_caixa.data) <= '".$_SESSION['datafinal']."') GROUP BY vendas_caixa.total,vendas_caixa.produto";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
          <td><? echo $row['qtd'];?> / <? echo $row['total'];?></td>
          <td><? echo $row['descricao'];;?></td>
		  <td>R$ <? echo number_format($row['totalsoma'],2,",",".");?></td>
</tr>
 <? 

 } 
 ?>
</tbody>
</table>
<br>
<table style="float: right;top: 200px; font-size: 11px; width: auto;" class="table-bordered">
<thead>
<? 

$SQL2 = "select count(vendas_caixa.produto),vendas_caixa.codigo,produtos.descricao, vendas_caixa.preco,sum(vendas_caixa.total) as total from vendas inner join vendas_caixa on vendas_caixa.caixa=vendas.codigo inner join produtos on produtos.codigo=vendas_caixa.produto where vendas_caixa.usuario = '".$_SESSION['rusuario']."' and vendas.status=0 and ( date(vendas_caixa.data) >= '".$_SESSION['datainicio']."' and date(vendas_caixa.data) <= '".$_SESSION['datafinal']."')";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
<th style="background-color: #20aee3;height: 30px;text-align: start;;width: 100px;">Total R$</th>
<th style="width: 100px; text-align: right;">R$ <? echo number_format($row['total'],2,",",".");?></th>
</tr>
 <? 

 } 
 ?>
 </thead>
</table>
</div>
</div>
<?
if($_GET['imprimir'] == 1)
{
?>
<script>
printDiv('print');
</script>
<?
}
?>
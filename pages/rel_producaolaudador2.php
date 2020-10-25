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

?>
<div id="print" class="conteudo" style="color: black;">
<table style="width: 100%;font-size: 11px; color: black;" class="table-bordered">
<thead>
<tr >
<td colspan="5"><img src="template/img/logo.png" style="height: 70px;margin: 10px;" alt="homepage" class="light-logo"><span style="position: relative;left: 10%;font-weight: bold;font-size: 14px;">Relação de produção - <? echo $_POST['datainicio']; ?> a <? echo $_POST['datafinal']; ?></span></td>
</tr>
</thead>
<tbody>
<tr style="background-color: #fdb5b5;">
        <th>CPF</th>
		<th>Data</th>
		<th>Paciente</th>
		<th>Descricão</th>
		<th>Total R$</th>
</tr>
<? 

$sql = "select laudos_enviados.*, tipo_exame.descricao from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo 
where laudos_enviados.status=2 and laudos_enviados.laudador = '".$medico."' and ( date(dataenvio) >= '".$inicio."' and date(dataenvio) <= '".$final."')";
										  
$res = mysqli_query($db3,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr>
          <td><? echo $row['codigo'];?></td>
          <td><? echo date("d/m/Y", strtotime($row['dataenvio']));?></td>
		  <td><? echo $row['paciente'];?></td>
		  <td><? echo $row['descricao'];?></td>
		  <td><? echo number_format($row['valor_laudador'],2,",",".");?></td>
</tr>
 <? } ?>
</tbody>
</table>
<div style="float:right">
<br>
<table style="top: 20px; font-size: 11px; color: black; width: auto;" class="table-bordered">
<thead>
<tr style="background-color: #fdb5b5;">
        <th style="width: 100px;">Qt / Valor</th>
		<th style="width: 300px;">Tipo de Laudo</th>
		<th>Total R$</th>
</tr>
</thead>
<tbody>
<? 

$SQL2 = "select count(laudos_enviados.tipolaudo) as qtd, tipo_exame.descricao, laudos_enviados.valor_empresa, sum(laudos_enviados.valor_laudador) as total , laudos_enviados.desconto_empresa, valor_laudador as totalsoma from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo
where laudos_enviados.status=2 and laudos_enviados.laudador = '".$medico."' and ( date(dataenvio) >= '".$inicio."' and date(dataenvio) <= '".$final."')
group by laudos_enviados.tipolaudo
order by descricao asc";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
          <td><? echo $row['qtd'];?> / <? echo $row['totalsoma'];?></td>
          <td><? echo $row['descricao'];;?></td>
		  <td><? echo number_format($row['total'],2,",",".");?></td>
</tr>
 <? 

 } 
 ?>
</tbody>
</table>
<br>
<table style="float: right;top: 200px; font-size: 11px; color: black; width: auto;" class="table-bordered">
<thead>
<? 

$SQL2 = "select count(laudos_enviados.tipolaudo) as qtd, tipo_exame.descricao, laudos_enviados.valor_empresa, sum(laudos_enviados.valor_laudador) as total , laudos_enviados.desconto_empresa, valor_laudador as totalsoma from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo
where laudos_enviados.status=2 and laudos_enviados.laudador = '".$medico."' and ( date(dataenvio) >= '".$inicio."' and date(dataenvio) <= '".$final."')
order by descricao asc";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
<th style="background-color: #fdb5b5;width: 100px;">Total </th>
<th style="width: 100px;text-align: right;"><? echo number_format($row['total'],2,",",".");?></th>
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
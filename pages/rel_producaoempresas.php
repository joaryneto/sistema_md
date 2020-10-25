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
	
	.header {
        display: table-header-group;
    }
	
	.content {
        display: table-row-group;
    }
}

#page-break { 
        page-break-before: always; 
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

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

$inicio = revertedata($_POST['datainicio']);
$final = revertedata($_POST['datafinal']);

if($_GET['bloqueafgsfsdr']==1)
{
  $SQL = "UPDATE laudos_enviados SET laudador=NULL , status=-1 where codigo=".$_GET['codigo']."";
  $sucesso = mysqli_query($db,$SQL);
  
  if($sucesso)
  {
	 print "<script> window.alert('Laudo bloqueado com sucesso...'); </script>";
	 print "<script> window.location='iniciado.php?url=inicio';</script>"; 
  }
}

?>
<div id="print" class="conteudo" style="color: black;">
<?

if($_POST['cnpj'] == 0)
{
	$where = "";
}
else
{
	$where = " where cnpj=".$_POST['cnpj'];
}

$contar = 0;
$SQL = "select cnpj, razao, fantasia from empresas $where order by razao asc";
$RES = mysqli_query($db,$SQL);
while($ross = mysqli_fetch_array($RES))
{
	

$csql = "select laudos_enviados.codigo,laudos_enviados.dataenvio,laudos_enviados.paciente,(valor_empresa-desconto_empresa) as valor, tipo_exame.descricao from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo 
where laudos_enviados.status=2 and laudos_enviados.empresa = '".$ross['cnpj']."' and ( date(dataenvio) >= '".$inicio."' and date(dataenvio) <= '".$final."')";									  
$cres = mysqli_query($db,$csql); 
$crow = mysqli_fetch_array($cres);
	
if($crow == false)
{
	
}
else
{
//echo $contar."<br>";	
?>
<table <? if($contar >= 1){?> id="page-break" <? } ?> class="table-bordered" style="width: 100%;font-size: 11px; color: black;">
<tr >
<td colspan="5">
<img src="template/img/logo.png" style="height: 70px;margin: 10px;position: relative;top: -15px;" alt="homepage" class="light-logo">
<span style="font-size: 18px; text-align: left;display: inline-block;position: relative;top: 20px;left: 20px;font-weight: bolder;">
Razão Social: <? echo $ross['razao'];?><br>
Fantasia: <? echo $ross['fantasia'];?><br>
Impresso em: <? echo date("d/m/Y");?>
</span>
</td>
</tr>
<tbody>
<tr style="background-color: #fb8e8e;">
        <th>CPF</th>
		<th>Data</th>
		<th>Paciente</th>
		<th>Descricão</th>
		<th>Valor R$</th>
</tr>
<? 

$sql = "select laudos_enviados.codigo,laudos_enviados.dataenvio,laudos_enviados.paciente,(valor_empresa-desconto_empresa) as valor, tipo_exame.descricao from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo 
where laudos_enviados.status=2 and laudos_enviados.empresa = '".$ross['cnpj']."' and ( date(dataenvio) >= '".$inicio."' and date(dataenvio) <= '".$final."')";


										  
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{
	
?>
<tr>
          <td><? echo $row['codigo'];?></td>
          <td><? echo date("d/m/Y", strtotime($row['dataenvio']));?></td>
		  <td><? echo $row['paciente'];?></td>
		  <td><? echo $row['descricao'];?></td>
		  <td><? echo number_format($row['valor'],2,",",".");?></td>
</tr>
<? } ?>
</tbody>
</table>
<div style="float:right; padding-bottom: 20px;">
<!--<br>
<div id="content">
<table style="top: 20px; font-size: 11px; color: black; width: auto;" class="table-bordered">
<thead>
<tr style="background-color: #fdb5b5;">
        <th style="width: 100px;">Qt / Valor</th>
		<th style="width: 300px;">Tipo de Laudo</th>
		<th>Total R$</th>
</tr>
</thead>
<tbody>
< 

$SQL2 = "select count(laudos_enviados.tipolaudo) as qtd,(laudos_enviados.valor_empresa-laudos_enviados.desconto_empresa) as totalsoma, tipo_exame.descricao, sum(laudos_enviados.valor_empresa-laudos_enviados.desconto_empresa) as total from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo where laudos_enviados.empresa = '36894418000137' and ( date(dataenvio) >= '2020-02-01' and date(dataenvio) <= '2020-02-31') group by laudos_enviados.tipolaudo";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
          <td>< echo $row['qtd'];?> / < echo $row['totalsoma'];?></td>
          <td>< echo $row['descricao'];;?></td>
		  <td>< echo number_format($row['total'],2,",",".");?></td>
</tr>
 <

 } 
 ?>
</tbody>
</table>
</div>-->
<br>
<table style="float: right;top: 200px; font-size: 11px; color: black; width: auto;" class="table-bordered">
<thead>
<? 

$SQL2 = "select count(laudos_enviados.tipolaudo) as qtd,(laudos_enviados.valor_empresa-laudos_enviados.desconto_empresa) as valor, tipo_exame.descricao, sum(laudos_enviados.valor_empresa-laudos_enviados.desconto_empresa) as total from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo where laudos_enviados.status=2 and laudos_enviados.empresa = '".$ross['cnpj']."' and ( date(dataenvio) >= '".$inicio."' and date(dataenvio) <= '".$final."')";
		
$count = 0;		
$res2 = mysqli_query($db,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
<tr>
<th style="background-color: #fb8e8e;width: 200px;">Quantidade de exames realizados </th>
<th style="width: 100px;text-align: right;"><? echo $row['qtd'];?></th>
</tr>
<tr>
<th style="background-color: #fb8e8e;width: 100px;">Total R$</th>
<th style="width: 100px;text-align: right;"><? echo number_format($row['total'],2,",",".");?></th>
</tr>
 <? 

 } 
 ?>
 </thead>
</table>
</div>
<? 

  $contar++;
 } 
} 
?>
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
<?

if($_GET['ap'] == "1")
{
   $SQL = "SELECT * FROM responsavel where nome like '%".$_GET['nome']."%'";
   $RES = mysqli_query($db,$SQL);
   $x = 0;
   while($row = mysqli_fetch_array($RES))
   {
      $x = 1;
   }

   if($x == 1)
   {
	   print("<script>window.alert('Responsavel ja cadastrado!')</script>");
   }
   else
   {

       $SQLD = "INSERT INTO responsavel(matricula,nome,cpf,rg,telefone,autorizacao,parentesco) VALUES('".$_GET['codigo']."','".$_GET['nome']."','".$_GET['cpf']."','".$_GET['rg']."','".$_GET['telefone']."','".$_GET['autorizacao']."','".$_GET['parentesco']."');";
       $RES = mysqli_query($db,$SQLD);
   }
}
if($_GET['excluir'] == 1)
{
	$SQL = "DELETE FROM responsavel where codigo='".$_GET['codres']."'";
	$RES = mysqli_query($db,$SQL);
}
if($_GET['list'] == 1)
{
?>
<table id="ltresponsavel" class="display nowrap table table-hover table-striped table-bordered">
<thead>
<tr>
<th>Responsavel</th>
<th>Aluno</th>
<th>X</th>
</tr>
</thead>
<tbody>
<?

    $SQL = "SELECT responsavel.codigo,responsavel.nome as resp,matriculas.nome as aluno FROM responsavel inner join matriculas on matriculas.codigo=responsavel.matricula where responsavel.matricula='".$_GET['codigo']."'"; 
    $RESB = mysqli_query($db,$SQL);
	$b = 0;
	while($rowb = mysqli_fetch_array($RESB))
	{
												  
	?>
	  <tr>
          <td><? echo $rowb['resp'];?></td>
          <td><? echo $rowb['aluno'];?></td>
		  <td><a class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir exame" style="font-size: 150%; color: red;" href="javascript: WEB(0);" Onclick="javascript: ajaxLoader('?br=cad_listaresponsavel&codigo=<? echo $_GET['codigo'];?>&codres=<? echo $rowb['codigo'];?>&excluir=1&list=1','ltresponsavel','GET');"></a></td>
      </tr>
<?    $b = 1;
    } ?>
<?
if($b == 0)
{
	echo "<tr>
          <td>Nenhum encontrado</td>
          <td>.</td>
		  <td>.</td>
      </tr>";
}
	
?>
</tbody>
<tfoot>
<tr>
<th>Responsavel</th>
<th>Aluno</th>
<th>X</th>
</tr>
</tfoot>
</table>

<?}?>
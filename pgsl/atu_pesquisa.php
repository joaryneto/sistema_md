<?
ob_start();
session_start();


if(!Empty($_GET['pesquisa']) and $_GET['ap'] == 1)
{
?>

<div class="tableFixHead" id="pcliente"> <table class="table table-hover">
                                            <tbody id="itenss">
<?

//require_once("../load/class/mysql.php");

$pesquisa = $_GET['pesquisa'];

$SQL = "SELECT codigo,nome FROM clientes where nome like '%".$pesquisa."%' LIMIT 10;";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
	?>
	<tr Onclick="selectcliente('<?=$row['codigo'];?>','<?=$row['nome'];?>');"><td colspan="3"><?=$row['nome']?></td></tr>
	
	<?
}




?>
   </tbody>
 </table>
</div>

<?
}
else if($_GET['ap'] == 2)
{
   	?>
	<label>Cliente :</label>
	<input name="codigo" id="codigo" type="hidden" value="<?=$_GET['nome'];?>" autocomplete="off" class="form-control" required="required" />
	<input name="nome" id="nome" type="text" onkeyup="buscarcliente(this.value);" value="<?=$_GET['nome'];?>" autocomplete="off" class="form-control" required="required" />
	<div id="pesquisacliente"></div>
	<?
}

mysqli_close($db3);

?>













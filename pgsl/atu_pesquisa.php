<?
ob_start();
session_start();


if(!Empty($_GET['pesquisa']))
{
?>

<div class="tableFixHead" style="position: absolute;top: -21px;background-color: white;"> <table class="table table-hover">
                                            <tbody id="itenss">
<?

//require_once("../load/class/mysql.php");

$pesquisa = $_GET['pesquisa'];

$SQL = "SELECT codigo,nome FROM clientes where nome like '%".$pesquisa."%' LIMIT 10;";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
	echo '<tr><td colspan="3">'.$row['nome'].'</td></tr>';
}

mysqli_close($db3);


?>
   </tbody>
 </table>
</div>

<?}?>













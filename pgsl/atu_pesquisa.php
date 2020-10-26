<?
ob_start();
session_start();

?>
<div class="tableFixHead"> <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Descrição</th>
                                                    <th class="text-right">Qtd/C. Uni.</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
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
















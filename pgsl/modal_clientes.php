<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

if(@$_SESSION['menu99'] == false)
{
   //print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   //print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

?>		

<?
if($_GET['modal'] == 1)
{
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Lista de Cliente :</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="form-group "><label>Busca:</label>
<input name="user" type="text" class="form-control" autocomplete="off" onkeyup="javascript: requestPage2('?br=atu_listacliente&pesquisa='+ this.value +'&ap=1','listclientes','GET');" />
</div>
<div>
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<thead>
<tr>
<th>Nome</th>
<th>Status</th>
</tr>
</thead>
<tbody id="listclientes">
<?
$sql = "SELECT * FROM clientes limit 10";
$res = mysqli_query($db3,$sql); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
?>
<tr style="cursor: pointer;" onclick="SL_cliente('<? echo $row['codigo'];?>','<? echo $row['nome'];?>');">
<td data-title="Nome"><? echo $row['nome'];?></td>
<td data-title="Status"><? Switch($row['status'])
	 {
	   case 0:
		 echo '<span class="label label-danger">Inativo</span>';
	   break;
	   case 1:
		 echo '<span class="label label-success">Ativo</span>';
	   break;
	   case 2:
		 echo '<span class="label label-warning">Pre-ativo</span>';
	   break;
   }
   ?>
</td>
</tr>
<? $x = 1;
}

if($x == 0)
{
 echo "<tr><td>Nenhum resultado encontrado.</td><td></td><td></td><td></td></tr>";

}
?>
</tbody>	
</table>
</div>
</div>
</form>										 
<div class="modal-footer">
</div>
<? } ?>
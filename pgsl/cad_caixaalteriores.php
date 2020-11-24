<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu3'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

?>	

<div class="container-fluid bg-template mb-4">
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
                    <i class="material-icons md-dark pmd-md" style="font-size: 180px; position: absolute;float: right; top: 50px; left: 61%;">account_balance</i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Caixa Alteriores";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                    <input type="text" Onkeyup="pesquisar(this.value);" class="form-control form-control-lg search bottom-25 position-relative border-0" placeholder="Pesquisa">
                </div>
            </div>
        </div>   
				  
<div class="container pt-5">
<div class="row">
<div class="col-md-12 col-sm-12"> 
<div class="component-box">
	<?
	
	$SQL3 = "SELECT sum(total) as total FROM vendas_mov where sistema='".$_SESSION['sistema']."' and caixa='".$_SESSION['caixa']."'";
	$RES3 = mysqli_query($db3,$SQL3);
	$ROW3 = mysqli_fetch_array($RES3);
	
	$vtotal = number_format($ROW3['total'],2,",",".");
	
	?>
	<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
		 <table class="table pmd-table">
				<thead>
					<tr>
						<th>Cod.</th>
						<th>Usuario</th>
						<th>Abertura/Fechamento</th>
						<th>Fechamento</th>
						<th>Total R$</th>
					</tr>
				</thead>
				<tbody>
			  <? 
			  $sql = "select vendas_op.codigo,vendas_op.data_ab,vendas_op.hora_ab,vendas_op.data_fe,vendas_op.hora_fe,usuarios.nome,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.total) as totals, count(vendas_mov.produto) as quantidade from vendas_op 
			  left join vendas_mov on vendas_mov.caixa=vendas_op.codigo
			  left join produtos on produtos.codigo=vendas_mov.produto
			  inner join usuarios on usuarios.codigo=vendas_op.usuario
			  where vendas_op.sistema='".$_SESSION['sistema']."' and vendas_op.sistema='".$_SESSION['sistema']."' and vendas_op.status=0 GROUP BY vendas_op.codigo";
			  
			  $res = mysqli_query($db3,$sql); 
			  $b = 0;
			  while($row = mysqli_fetch_array($res))
			  {
					 
			  ?>
				<tr onclick="requestPage2('?br=rel_caixaanteriores&codigo=<? echo $row['codigo'];?>','modals','GET');" data-toggle="modal" data-target="#modalusuario" aria-invalid="false"><!-- color: #20aee3; -->
					<td data-title="Cod."><? echo $row['codigo'];?></td>
					<td data-title="Usuario"><? echo $row['nome'];?></td>
					<td data-title="Abertura"><? echo formatodata($row['data_ab']);?> <? echo $row['hora_ab'];?></td>
					<td data-title="Fechamento"><? if(!Empty($row['data_fe'])){ echo formatodatahora($row['data_fe']);}?> <? echo $row['hora_fe'];?></td>
					<td data-title="Total R$">R$ <? echo number_format($row['totals'],2,",",".");?></td>
				</tr>
			  <? $b = 1;
			  
			  } 
			  
			  if($b == 0)
			  {
				 echo '<tr ><!-- color: #20aee3; -->
					<td colspan="5" class="text-center"> Nenhum registro encontrado.</td>
				</tr>';
			  }
			  ?>
				</tbody>
			</table>
		</div></div>
	</div>
</div>
</div>
<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

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
	
       $SQL = "SELECT vendas.data as datavenda, vendas_mov.venda, configuracoes.fantasia,usuarios.nome as vendedor,agendamento.codigo,agendamento_servicos.codigo as codservico,agendamento.cliente,clientes.nome, clientes.celular,agendamento_servicos.data,agendamento_servicos.hora,agendamento_servicos.profissional FROM agendamento 
       inner join clientes on clientes.codigo=agendamento.cliente 
       inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
       inner join vendas_mov on vendas_mov.produto=agendamento_servicos.servico
       inner join usuarios on usuarios.codigo=vendas_mov.usuario
       inner join configuracoes on configuracoes.sistema=agendamento_servicos.sistema
	   inner join vendas on vendas.codigo=vendas_mov.venda
       where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.status=1 and vendas_mov.venda='".@$_GET['codigo']."' ORDER BY agendamento.codigo desc limit 1";
       $RES = mysqli_query($db3,$SQL);
       while($row = mysqli_fetch_array($RES))
	   {
?>
<div class="modal-header">
<h2 class="pmd-card-title-text"><?=$row['fantasia'];?></h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="card mb-4" id="sua_div">
                <div class="card-header success-gradient py-4">
                    <div class="row">
                        <div class="col font-weight-bold">Comprovante de Venda - NÃO FISCAL
                            <br><small><h2>Pago</h2></small>
                        </div>
                        <div class="col text-right">
                               ID:<b>#<?=str_pad($row['venda'], 4 , '0' , STR_PAD_LEFT);?></b>
                        </div>
                    </div>
                </div>
                <div class="card-body paid-img">
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <p class="mb-2 font-weight-bold">Vendido por: <?=$row['vendedor'];?></p>
                            <p class="content-color-secondary">Cliente: <?=$row['nome'];?>,
                            <!--    <br> #
                                <br> #
                                <br> #--></p>
                        </div>
                    </div>
					
                    <div class="row mb-4">
                        <div class="col">
                            <p class="mb-2 font-weight-bold">Forma de pagamento:</p>
							 <?
					            $s_SQL = "SELECT * FROM vendas_recebidos where sistema='".$_SESSION['sistema']."' and venda='".@$_GET['codigo']."'";
					            $s_RES = mysqli_query($db3,$s_SQL);
					            while($s_row = mysqli_fetch_array($s_RES))
								{
					             ?>
                                  <p class="content-color-secondary">
								     <?  
												switch($s_row['tipo'])
												{
													case 1:
													{
													   echo "Dinheiro ( A Vista )";
													}
													break;
													case 2:
													{
													   echo "Cartão de Débito ( A Vista )";
													}
													break;
													case 3:
													{
													   echo "Cartão de Crédito";
													}
													break;
													case 4:
													{
													   echo "Trans. ( Ted, doc, tev)";
													}
													break;
												}
												
 								         ?>
                                  </p>
	                     <? } ?>
                        </div>
                        <div class="col text-right">
                            <p class="mb-2 font-weight-bold">Data:</p>
                            <p class="content-color-secondary"><?=formatodatahora($row['datavenda']);?>
                                <br><span class="text-danger">#</span></p>
                        </div>
                    </div>
                    <h3 class="text-center">Detalhes do pedido</h3>
                    <table class="table mb-0 border">
                        <thead>
                            <tr class="bg-light-secondary">
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Qtd/Preço Uni.</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
						    <?
							$d_count = 1;	
							$total = "";
							$sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.preco) as totals, count(vendas_mov.produto) as quantidade from vendas_mov inner join produtos on produtos.codigo=vendas_mov.produto where vendas_mov.sistema='".$_SESSION['sistema']."' and vendas_mov.venda='".@$_GET['codigo']."' GROUP BY vendas_mov.total, vendas_mov.produto";
							$res = mysqli_query($db3,$sql); 
							$b = 0;
							while($b_row = mysqli_fetch_array($res))
							{
								$total = $total+$b_row['totals'];
								
							?>
                            <tr>
								<td data-title="#"><? echo $b_row['codigo'];?></td>
								<td data-title="Descrição"><? echo $b_row['descricao'];?></td>
								<td data-title="Qtd/Preço Uni."><? echo $b_row['quantidade'];?>x<? echo number_format($b_row['preco'],2,",",".");?></td>
								<td class="text-right" data-title="Total">R$ <? echo number_format($b_row['totals'],2,",",".");?></td>
                            </tr>
							  
							<? 
							   $d_count ++; 
							} 
							?>
                            <tr>
                                <!--<td colspan="2">Taxas de entrega</td>-->
                                <td colspan="2" class="text-right text-success"></td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr class="font-weight-bold bg-light-secondary">
                                <td colspan="2">Total:</td>
                                <td colspan="2" class="text-right">R$ <?=number_format($total,2,",",".");?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                    <p></p>
                    <br>
                    <div class="text-right mb-4">
                        <p class="content-color-secondary">_______________________________________</p>
                        <p class="mb-2 font-weight-bold"><?=$row['nome'];?></p>
                    </div>
                </div>
                <div class="card-footer border-top">
                    <a href="#" id="btnPrint" class="btn pink-gradient float-right"><i class="material-icons mr-2">print</i>Imprimir</a>
                </div>
				<? } ?>
				<div style="display: none"><div class="printable"></div>
	     </div>
        <script src="template/js/printThis.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#btnPrint").click(function () {
                    //get the modal box content and load it into the printable div
                    $(".printable").html($("#sua_div").html());
                    $(".printable #btnPrint").remove();
                    $(".printable").printThis();
                });
            });
        </script>
</form>										 
<div class="modal-footer">
</div>
  <? 
}
?>
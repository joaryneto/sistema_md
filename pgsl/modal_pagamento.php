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
	
       $SQL = "SELECT agendamento.codigo,agendamento_servicos.codigo as codservico,agendamento.cliente,clientes.nome, clientes.celular,agendamento_servicos.data,agendamento_servicos.hora,agendamento_servicos.profissional FROM agendamento 
       inner join clientes on clientes.codigo=agendamento.cliente 
       inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
	   inner join vendas_mov on vendas_mov.produto=agendamento_servicos.servico
       where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.status=1 and vendas_mov.venda='".@$_GET['codigo']."' ORDER BY agendamento.codigo desc limit 1";
       $RES = mysqli_query($db3,$SQL);
       while($row = mysqli_fetch_array($RES))
	   {
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Comprovante - </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="card mb-4" id="sua_div">
                <div class="card-header success-gradient py-4">
                    <div class="row">
                        <div class="col font-weight-bold">Comprovante de Venda - NÃO FISCAL
                            <br><small>Pago</small>
                        </div>
                        <div class="col text-right">
                               ID:<b>#123456</b>
                        </div>
                    </div>
                </div>
                <div class="card-body paid-img">
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <p class="mb-2 font-weight-bold">Vendido por:</p>
                            <p class="content-color-secondary">Nome,
                                <br> #
                                <br> #
                                <br> #</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <p class="mb-2 font-weight-bold">Forma de pagamento:</p>
                            <p class="content-color-secondary">Visa 
                                <br>
                                <a href="">#</a>
                            </p>
                        </div>
                        <div class="col text-right">
                            <p class="mb-2 font-weight-bold">Data do pedido:</p>
                            <p class="content-color-secondary">#
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
							$sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.preco) as totals, count(vendas_mov.produto) as quantidade from vendas_mov inner join produtos on produtos.codigo=vendas_mov.produto where vendas_mov.sistema='".$_SESSION['sistema']."' and vendas_mov.venda='".@$_GET['codigo']."' GROUP BY vendas_mov.total, vendas_mov.produto";
							$res = mysqli_query($db3,$sql); 
							$b = 0;
							while($row = mysqli_fetch_array($res))
							{
								
							?>
                            <tr>
								<td data-title="#"><?=$d_count;?></td>
								<td data-title="Descrição">(<? echo $row['codigo'];?>) - <? echo $row['descricao'];?></td>
								<td data-title="Qtd/Preço Uni."><? echo $row['quantidade'];?>x<? echo number_format($row['preco'],2,",",".");?></td>
								<td class="text-right" data-title="Total">R$ <? echo number_format($row['totals'],2,",",".");?></td>
                            </tr>
							  
							<? 
							   $d_count ++; 
							} 
							?>
                            <tr>
                                <td colspan="2">Delivery Charges</td>
                                <td colspan="2" class="text-right text-success">FREE</td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr class="font-weight-bold bg-light-secondary">
                                <td colspan="2">Total:</td>
                                <td colspan="2" class="text-right">R$ 20900.00</td>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                    <p>We recommend power services for our customers</p>
                    <br>
                    <div class="text-right mb-4">
                        <p class="content-color-secondary">Autorizar assinatura</p>
                        <p class="mb-2 font-weight-bold">Maxartkiller</p>
                    </div>
                </div>
                <div class="card-footer border-top">
                    <a href="#" id="btnPrint" class="btn pink-gradient float-right"><i class="material-icons mr-2">print</i>Imprimir</a>
                </div>
				<div style="display: none"><div class="printable"></div></div>
        <script src="http://leandrolisura.com.br/wp-content/uploads/2017/07/printThis.js"></script>
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
  <? }
}
?>
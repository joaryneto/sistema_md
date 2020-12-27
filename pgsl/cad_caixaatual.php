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
            <div class="row hn-154 position-relative">
			<div class="background opac heightset">
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Caixa Atual";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
              <div class="row">
				
							    <?
								
								$SQL3 = "SELECT sum(vendas_mov.total) as total FROM vendas_mov 
								inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
								where vendas_mov.sistema='".$_SESSION['sistema']."' and vendas_mov.caixa='".$_SESSION['caixa']."' and vendas_recebidos.status=1;";
								$RES3 = mysqli_query($db3,$SQL3);
								$ROW3 = mysqli_fetch_array($RES3);
								
								$vtotal = number_format($ROW3['total'],2,",",".");
								
								?>
								<script>
								function cx_cancelar(codigo)
								{
									if(codigo == "")
									{
										
									}
									else
									{
										swal({   
										    title: "Atenção!",   
										     text: "Gostaria de cancelar este item?",   
										    type: "warning",   
										    showCancelButton: true,   
										    //confirmButtonColor: "#DD6B55",   
 										     confirmButtonText: "Sim",
										    cancelButtonText: "Não", 			
										    closeOnConfirm: true 
										}, function()
										{
										    requestPage2('?br=atu_caixa&codigo='+ codigo +'&ap=4&load=3','u_load','GET');
										});
									}
								}
							    </script>
								<div class="col-md-12">
					            <div class="component-box">
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							        <table class="table pmd-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
													<th>Cliente</th>
                                                    <th>Descrição</th>
                                                    <th>Qtd/C. Uni.</th>
													<th>Status</th>
                                                    <th>Total</th>
													<?if($row['status'] == 1){?>
													<th>Opções</th>
													<? } ?> 
                                                </tr>
                                            </thead>
                                            <tbody id="u_load">
                                                <? 
										  
										  $data = date('Y');
										  $sql = "select vendas_recebidos.status,clientes.nome, vendas_mov.venda , vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.total) as totals, count(vendas_mov.produto) as quantidade from vendas 
										  inner join vendas_mov on vendas_mov.venda=vendas.codigo
										  inner join produtos on produtos.codigo=vendas_mov.produto
										  left join agendamento_servicos on agendamento_servicos.codigo=vendas_mov.agendamento
										  left join agendamento on agendamento.codigo=agendamento_servicos.agendamento
                                          left join clientes on clientes.codigo=agendamento.cliente	
                                          inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda										  
										  where vendas_mov.sistema='".$_SESSION['sistema']."' and vendas_mov.caixa='".$_SESSION['caixa']."' GROUP BY vendas_mov.total, vendas_recebidos.codigo, produtos.descricao ";
										  $res = mysqli_query($db3,$sql); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res))
										  {
											  
											
												 
										  ?>
                                            <tr ><!-- color: #20aee3; -->
											    <td data-title="#"><? echo $row['codigo'];?></td>
												<td data-title="Cliente"><? echo $row['nome'];?></td>
                                                <td data-title="Descrição"><? echo $row['descricao'];?></td>
												<td data-title="Qtd/C. Uni."><? echo $row['quantidade'];?>x<? echo $row['preco'];?></td>
												<td data-title="Total">R$ <? echo number_format($row['totals'],2,",",".");?></td>
												<td data-title="Status"><?
												 Switch($row['status'])
												 {
													 case 1:
													 echo '<span style="color: green;">Aprovado</span>';
													 break;
													 case 2:
													 echo '<span style="color: blue;">Estorno</span>';
													 break;
													 case 3:
													 echo '<span style="color: red;">Cancelado</span>';
													 break;
												 }
												?></td>
												<?if($row['status'] == 1){?>
												<td data-title="Opções">
												<a class="fa fa-window-close" href="javascript:void(0);" alt="Visualizar" onclick="cx_cancelar('<?=$row['venda'];?>');" style="font-size: 150%; color: red;"><a>
		                                        </td>
												<? } ?>
                                            </tr>
										  <? $b = 1;
										  
										  } 
										  
										  if($b == 0)
										  {
											 echo '<tr ><!-- color: #20aee3; -->
											    <td colspan="4" class="text-center"> Nenhum registro encontrado.</td>
                                            </tr>';
										  }
										  ?>
                                            </tbody>
                                        </table>
                                    </div>
									</div>
									</div>
								<div class="input-group col-md-12 m-t-20">
								<input type="hidden" class="form-control" name="totalcaixa" id="totalcaixa" value="" required="" aria-invalid="false">
								<h1 style="color: green;font-weight: bold;">Total: R$ <span id="vtotal"><?=$vtotal;?></span></h1>
								</div>
								<div class="input-group col-md-10 m-t-20">
								<div id="gravar"></div></div>
							
					</div>
				</div>
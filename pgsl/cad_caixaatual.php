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
								
								$SQL3 = "SELECT sum(total) as total FROM vendas_mov where caixa='".$_SESSION['caixa']."'";
								$RES3 = mysqli_query($db3,$SQL3);
								$ROW3 = mysqli_fetch_array($RES3);
								
								$vtotal = number_format($ROW3['total'],2,",",".");
								
								?>
								<div class="form-group col-md-12 m-t-20" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Descrição</th>
                                                    <th class="text-right">Qtd/C. Uni.</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="itenss">
                                                <? 
										  
										  $data = date('Y');
										  $sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.total) as totals, count(vendas_mov.produto) as quantidade from vendas 
										  inner join vendas_mov on vendas_mov.venda=vendas.codigo
										  inner join produtos on produtos.codigo=vendas_mov.produto 
										  where vendas_mov.caixa='".$_SESSION['caixa']."' GROUP BY vendas_mov.total,vendas_mov.codigo";
										  $res = mysqli_query($db3,$sql); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res))
										  {
												 
										  ?>
                                            <tr ><!-- color: #20aee3; -->
											    <td class="text-center"><? echo $row['codigo'];?></td>
                                                <td class="text-center"><? echo $row['descricao'];?></td>
												<td class="text-right"><? echo $row['quantidade'];?>x<? echo $row['preco'];?></td>
												<td class="text-right">R$ <? echo number_format($row['totals'],2,",",".");?></td>
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
								<div class="input-group col-md-12 m-t-20">
								<input type="hidden" class="form-control" name="totalcaixa" id="totalcaixa" value="" required="" aria-invalid="false">
								<h1 style="color: green;font-weight: bold;">Total: R$ <span id="vtotal"><?=$vtotal;?></span></h1>
								</div>
								<div class="input-group col-md-10 m-t-20">
								<div id="gravar"></div></div>
							
					</div>
				</div>
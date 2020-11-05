<?
ob_start();
session_start();

?>
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
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Meios de Pagamento";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
              <div class="row">
							    <?
								
								//$SQL3 = "SELECT sum(total) as total FROM vendas_mov where caixa='".$_SESSION['caixa']."'";
								//$RES3 = mysqli_query($db3,$SQL3);
								//$ROW3 = mysqli_fetch_array($RES3);
								
								//$vtotal = number_format($ROW3['total'],2,",",".");
								
								?>
								<div class="form-group col-md-12 m-t-20" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Usuario</th>
                                                    <th class="text-right">Transação</th>
                                                    <th class="text-right">Data</th>
													<th class="text-right">Total R$</th>
                                                </tr>
                                            </thead>
                                            <tbody id="itenss">
                                                <? 
										  $sql = "select vendas_recebidos.codigo, vendas_recebidos.total, vendas_recebidos.tipo, usuarios.nome, vendas.data from vendas_recebidos 
										  inner join vendas_op on vendas_op.codigo=vendas_recebidos.caixa
										  left join vendas_mov on vendas_mov.caixa=vendas_op.codigo 
										  left join produtos on produtos.codigo=vendas_mov.produto 
										  inner join usuarios on usuarios.codigo=vendas_op.usuario 
										  inner join vendas on vendas.codigo=vendas_mov.venda
										  where vendas_op.sistema='".$_SESSION['sistema']."' and vendas_op.usuario='".$_SESSION['usuario']."' GROUP BY vendas_recebidos.codigo";
										  
										  $res = mysqli_query($db3,$sql); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res))
										  {
												 
										  ?>
                                            <tr><!-- color: #20aee3; -->
                                                <td class="text-center"><? echo $row['nome'];?></td>
												<td class="text-right"><?  
												switch($row['tipo'])
												{
													case 1:
													{
													   echo "Dinheiro";
													}
													break;
													case 2:
													{
													   echo "Cartão de Débito";
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
												?> </td>
												<td class="text-right"><? echo formatodatahora($row['data']);?></td>
												<td class="text-right">R$ <? echo number_format($row['total'],2,",",".");?></td>
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
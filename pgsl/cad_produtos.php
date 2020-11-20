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

if(isset($_GET['codigo']))
{
	$sucesso = mysqli_query($db,"SELECT descricao FROM turmas where codigo='".$_GET['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $descricao = $row['descricao'];
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if($_GET['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM produtos where sistema='".$_SESSION['sistema']."' and descricao like '%".$_POST['descricao']."%'";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Produtos já foi cadastrada, escolha outro.')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_produtos';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into produtos(sistema,codigob, descricao, preco, custo, estoque) values('".$_SESSION['sistema']."','".$_POST['codbarra']."','".$_POST['descricao']."','".$_POST['preco']."','".$_POST['custo']."','".$_POST['estoque']."')";
	   $sucesso = mysqli_query($db3,$SQL1);
	   
	   if($sucesso)
	   {
		   //print("<script>window.alert('Produtos Cadastrada com sucesso.')</script>");
		   print("<script>window.location.href='sistema.php?url=cad_produtos';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE produtos SET codigob='".$_POST['codbarra']."',descricao=".$_POST['descricao'].",preco= where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_turmas';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

?>		
<div class="container-fluid bg-template mb-4">
            <div class="row hn-154 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Produtos";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>   
		
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
			<!--Tabs with Icon example -->
								<form class="form-material m-t-40 row" name="laudo" method="post" action="<? if($_GET['codigo'] ==""){ echo "sistema.php?url=cad_produtos&ap=1";}else { echo "sistema.php?url=cad_turmas&ap=2&codigo=".$_GET['codigo']."";} ?>">
							
								<div class="form-group col-md-2 m-t-20"><label>Codigo de Barra :</label>
								<input type="text" name="codbarra" id="codbarra" value="<? if(isset($_GET['codigo'])){ echo $codbarra;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-4 m-t-20"><label>Descrição :</label>
								<input type="text" name="descricao" id="descricao" value="<? if(isset($_GET['codigo'])){ echo $descricao;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Preço :</label>
								<input type="text" name="preco" id="preco" value="<? if(isset($_GET['codigo'])){ echo $preco;} ?>" data-mask="#.##0,00" data-mask-reverse="true" class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Custo :</label>
								<input type="text" name="custo" id="custo" value="<? if(isset($_GET['codigo'])){ echo $custo;} ?>" data-mask="#.##0,00" data-mask-reverse="true" class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Estoque :</label>
								<input type="text" name="estoque" id="estoque" value="<? if(isset($_GET['codigo'])){ echo $estoque;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-4 m-t-20">
								<br>
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Gravar";}else { echo "Cadastrar";} ?></button>

								<? if(!Empty($_GET['codigo'])) { ?><a class="btn btn-info" href="iniciado.php?url=cad_produtos"><i class="fa fa-plus-circle"></i> Novo Cadastro</a><? } ?>
								</div></div>
								
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							        <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
												<!--<th>Valor Total</th>-->
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  
										  $sql = "select * from produtos where sistema='".$_SESSION['sistema']."'";
										  $res = mysqli_query($db3,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td data-title="Codigo"><? echo $row['codigo'];?></td>
                                                <td data-title="Descrição"><? echo $row['descricao'];?></td>
												<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
												<td data-title="Editar"><a class="fa fa-edit" href="iniciado.php?url=cad_produtos&codigo=<? echo $row['codigo']?>" style="font-size: 150%;"><a></td>
                                            </tr>
										  <? } ?>
                                        </tbody>
                                    </table>
                                 </div>
							   </form>
                        </div>
					</div>
				</div>
			</div>
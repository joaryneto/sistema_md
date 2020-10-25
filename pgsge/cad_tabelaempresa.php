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

if($_SESSION['menu2'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

if(isset($_GET['codigo']))
{
	$sucess = mysqli_query($db,"SELECT desconto FROM tabelaexames where codigo='".$_GET['codigo']."'");
	
	if($sucess)
	{
      while($row = mysqli_fetch_array($sucess))
	  {
		 $valorA = $row['desconto'];
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if(isset($_GET['exame']))
{
	$sucess = mysqli_query($db,"SELECT descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['exame']."'");
	
	if($sucess)
	{
      while($row = mysqli_fetch_array($sucess))
	  {
		 $descricao = $row['descricao'];
		 $valorB = $row['valor_padrao'];
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
	$sucess = mysqli_query($db,"SELECT * FROM tabelaexames where exame='".$_POST['exame']."' and empresa='".$_POST['cnpj']."'");
	
	if($sucess)
	{
	    print("<script>window.alert('Exame ja existe')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelaempresa&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into tabelaexames(empresa,exame,desconto) values('".$_POST['cnpj']."','".$_POST['exame']."','".$_POST['valor']."')";
	   $sucess = mysqli_query($db,$SQL1);

	   $SQL2 = "INSERT into tabelaexames(empresa,exame,desconto) values('".$_POST['cnpj']."','".$_POST['exame']."','".$_POST['valor']."')";
	   $sucess2 = mysqli_query($db3,$SQL2);
	   
	   if($sucess and $sucess2)
	   {
		   print("<script>window.alert('Exame Adiconado com sucess')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_tabelaempresa&cnpj=".$_POST['cnpj']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE tabelaexames SET desconto=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucess = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE tabelaexames SET desconto=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucess2 = mysqli_query($db3,$SQL2);
	
	if($sucess and $sucess2)
	{
        print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelaempresa&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

?>		
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de tabela por Empresa";?></h4>
								<form name="laudo" class="form-material m-t-40 row" method="post" action="<? if($_GET['codigo'] ==""){ echo "iniciado.php?url=cad_tabelaempresa&ap=1";}else { echo "iniciado.php?url=cad_tabelaempresa&ap=2&codigo=".$_GET['codigo']."";} ?>">
								
								<script>
								
								function orcnpj(cnp)
								{
									window.location.href='iniciado.php?url=cad_tabelaempresa&cnpj=' + cnp;					
								}
								
								function exames(codigo,exame)
								{
									window.location.href='iniciado.php?url=cad_tabelaempresa&cnpj=' + codigo + "&exame=" + exame;					
								}
								
								function valores(valor)
							    {
									var x =  "<? echo $valorB; ?>"-+valor;
									$("#sub").text("Total R$ "+ x);
								}
						
								</script>
								<div class="form-group col-md-3 m-t-20"><label>Empresa:</label>
								<select name="cnpj" class="select2 form-control custom-select" onChange="orcnpj(this.value);" style="width: 100%; height:36px;" required="required">
                                    <option>Selecionar Empresa</option>
                                    <optgroup label="IMAGGI">
									<? 
										  $sql = "select cnpj,razao from empresas";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['cnpj']?>" <? if($_GET['cnpj'] == $row['cnpj']){ echo "selected"; } ?>><? echo $row['razao']?></option>
										  <? } ?>
                                    </optgroup>
                                </select></div>
								<div class="form-group col-md-3 m-t-20"><label>Exame:</label>
								<!-- onChange="exames('< echo $_GET['cnpj'];?>',this.value);" -->
								<select name="exame" class="select2 form-control custom-select" style="width: 100%; height:36px;" required="required">
                                    <option>Selecionar exame</option>
                                    <optgroup label="IMAGGI">
									<? 
										  $sql = "select codigo,descricao,valor_padrao,status from tipo_exame";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($_GET['exame'] == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
										  <? } ?>
                                    </optgroup>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Desconto R$</label>
								<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
								<input type="text" name="valor" id="valor" value="<? if(isset($_GET['codigo'])){ echo $valorA;} ?>" class="form-control" required="required"></div>
								<!--<div class="form-group"><label id="sub">Total R$ < if(isset($_GET['codigo'])){ echo $valorB+-$valorA;}?></label>
					            </div>-->
								<div class="form-group col-md-4 m-t-20">
								<div class="form-actions">
								<br>
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Alterar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="iniciado.php?url=cad_tabelaempresa"><i class="fa fa-plus-circle"></i> Novo Cadastro</a>
								</div></div>
								</form>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
                                                <th>Valor Unitario</th>
												<th>Desconto</th>
												<th>Valor Total</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  if(isset($_GET['cnpj']))
										  {
										  $sql = "select tabelaexames.codigo,tabelaexames.desconto,tipo_exame.descricao,tipo_exame.valor_padrao,tabelaexames.exame from tabelaexames inner join tipo_exame on tipo_exame.codigo=tabelaexames.exame where tabelaexames.empresa='".$_GET['cnpj']."'";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
                                                <td><? echo $row['descricao'];?></td>
                                                <td><? echo $row['valor_padrao'];?></td>
												<td><? echo $row['desconto'];?></td>
												<td><? echo $numero = number_format($row['valor_padrao']-+$row['desconto'], 2, ',','.');?></td>
												<td><a class="fa fa-edit" href="iniciado.php?url=cad_tabelaempresa&cnpj=<?echo $_GET['cnpj']?>&exame=<?echo $row['exame']?>&codigo=<? echo $row['codigo']?>"> Editar<a></td>
                                            </tr>
										  <? } } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
                                                <th>Valor Unitario</th>
												<th>Desconto</th>
												<th>Valor Total</th>
												<th>X</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
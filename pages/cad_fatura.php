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

//if($_SESSION['menu12'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

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
	   
	   if($sucess)
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
	$SQL2 = "UPDATE tabelaexames SET desconto=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucess = mysqli_query($db,$SQL2);
	
	if($sucess)
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

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Faturas geradas";?></h4>
								<form name="laudo" class="form-material m-t-40 row" method="post" action="<? if($_GET['codigo'] ==""){ echo "iniciado.php?url=cad_tabelaempresa&ap=1";}else { echo "iniciado.php?url=cad_tabelaempresa&ap=2&codigo=".$_GET['codigo']."";} ?>">
								<div class="form-group col-md-2 m-t-20"><label>CNPJ / CPF :</label>
								<input type="text" name="cnpj" id="cnpj" class="form-control" required="required"><a style="position: absolute;left: 80%;" class="btn btn-info" href="#" data-toggle="modal" data-target="#usuarios"><i class="fa fa-search"></i></a></div>
								<div class="form-group col-md-2 m-t-20"><label>Tipo de Fatura:</label>
								<select name="cnpj" class="select2 form-control custom-select" onChange="orcnpj(this.value);" style="width: 100%; height:36px;">
                                    <option value="">Selecionar</option>
								    <option value="0" Selected>Normal</option>
									<option value="1">Avulsa</option>
                                </select></div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Data Limit :</label>
                                    <input type="text" name="faturalimit" id="faturalimit" value="" class="form-control" required="required">
                                </div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Mês de Vencimento :</label>
                                    <input type="text" name="faturavenci" id="faturavenc" data-mask="99/9999" value="" class="form-control" required="required">
                                </div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Mês Faturado :</label>
                                    <input type="text" name="faturames" id="faturame" data-mask="99/9999" value="" class="form-control" required="required">
                                </div>
								<div class="form-group col-md-4 m-t-20">
								<div class="form-actions">
								<br>
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Alterar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="iniciado.php?url=cad_tabelaempresa"><i class="fa fa-plus-circle"></i> Novo cadastro</a>
								</div></div>
								</form>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
												<th>CNPJ</th>
                                                <th>RAZÃO</th>
												<th>Valor R$</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  //if(isset($_GET['cnpj']))
										  //{
										     $sql = "select faturas.codigo,faturas.valor,empresas.razao,empresas.cnpj from faturas inner join empresas on empresas.cnpj=faturas.cliente";
										     $res = mysqli_query($db3,$sql); 
										     while($row = mysqli_fetch_array($res))
										     {
										     ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
												<td><? echo $row['cnpj'];?></td>
                                                <td><? echo $row['razao'];?></td>
												<td><? echo number_format($row['valor'],2,",",".");?></td>
												<td><a class="fa fa-eye" data-toggle="modal" data-target="#faturelatorio" href="" OnClick="javascript: ajaxLoader('?br=faturarelatorio&codigo=<? echo $row['codigo'];?>','relatorio','GET');"> Visualizar Fatura<a></td>
                                            </tr>
										    <? 
											
											 } 
											 //} 
											 
											 ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>CNPJ</th>
                                                <th>RAZÃO</th>
												<th>Valor R$</th>
												<th>X</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
								<div id="faturelatorio" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="card">
											<div class="card-body">
											
											<div id="relatorio">
											
											</div>
											</div>
											</div>
											</div>
											</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
										
                                        <!-- /.modal-content -->
                                    </div>
									
                                    <!-- /.modal-dialog -->
                                </div>
                                								
                            </div>
                        </div>
					</div>
				</div>
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

if($_SESSION['menu11'] == false)
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
  if(isset($_POST['check']))
  {
	foreach($_POST['check'] as $menus)
	{
		//echo "</br>".$menus;
	}
  }
}
elseif($_GET['ap2'] == "2")
{
	$SQL2 = "";
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
<script>
function mensagem() {



var name=confirm("Você esta iniciando a geração das faturas referentes ao mês , confoirma essa informação ? \nLembre-se que após geradas, o mês de referencia das faturas não poderão ser alterados. Confirma a geração ?")
if (name==true)
{
    //form.submit();
	document.getElementById("Formfatura").submit();
}
else
{
   return false;
}
}
</script>
								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Faturas geradas";?></h4>
								<form name="Formfatura" id="Formfatura" class="form-material m-t-40 row" method="post" action="iniciado.php?url=cad_gerarfatura&ap=1" enctype="multipart/form-data">
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<a class="btn btn-info" href="javascript: WEB(0)" OnClick="javascript: ajaxLoader('?br=cad_listagerarfatura&cnpj='+ document.getElementById('cnpj').value +'&faturalimit='+ document.getElementById('faturalimit').value +'&faturavenci='+ document.getElementById('faturavenci').value +'&faturames='+ document.getElementById('faturames').value +'&ap=1','gerarfaturass','GET');"><i class="fa fa-plus-circle"></i> Filtrar Dados</a>
								<button class="btn btn-info" href="javascript: WEB(0)" type="submit" OnClick="javascript: requestPage('iniciado','?br=teste&ap=1','relatorio2','POST', BuscaElementosForm('Formfatura'));" data-toggle="modal" data-target="#naofaturado"><i class="fa fa-plus-circle"></i> Não Faturado</button>
								<button class="btn btn-info" href="javascript: WEB(0)" type="submit" onClick="mensagem()"><i class="fa fa-plus-circle"></i> Gerar Fatura</button>
								</div></div>
								<div class="form-group col-md-2 m-t-20"><label>Empregador :</label>
								<input type="text" name="cnpj" id="cnpj" value="<? if(!Empty($_GET['empresa'])){ echo $_GET['empresa']; }?>" class="form-control"><a style="position: absolute;left: 80%;" class="btn btn-info" href="#" data-toggle="modal" data-target="#usuarios"><i class="fa fa-search"></i></a></div>
								<div class="form-group col-md-2 m-t-20"><label>Tipo de Fatura:</label>
								<select name="cnpj" class="select2 form-control custom-select" onChange="orcnpj(this.value);" style="width: 100%; height:36px;">
								    <option value="0" Selected>Normal</option>
									<option value="1">Avulsa</option>
                                </select></div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Data Limit :</label>
                                    <input type="text" name="faturalimit" id="faturalimit" value="" class="form-control" required="required">
                                </div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Mês de Vencimento :</label>
                                    <input type="text" name="faturavenci" id="faturavenci" data-mask="99/9999" value="" class="form-control" required="required">
                                </div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Mês Faturado :</label>
                                    <input type="text" name="faturames" id="faturames" data-mask="99/9999" value="" class="form-control" required="required">
                                </div>
                                <div class="form-group col-md-12 m-t-20" id="gerarfaturass">
                                    <table class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
											    <th>X</th>
                                                <th>CNPJ</th>
                                                <th>Fantasia</th>
                                                <th>Razão</th>
                                                <th>Qtd</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
												<td></td>
                                                <td></td>
												<td></td>
												<td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
											    <th>X</th>
                                                <th>CNPJ</th>
                                                <th>Fantasia</th>
                                                <th>Razão</th>
                                                <th>Qtd</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
								</form>
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

								<div id="naofaturado" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="card">
											<div class="card-body">
											
											<div id="relatorio2">
											
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
								<div id="usuarios" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Lista de Usuarios : </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="form-group"><label>Busca:</label>
                                             <input name="user" type="text" class="form-control" onkeyup="javascript: ajaxLoader('?br=listempresas&pesquisa='+ this.value +'&ap=2','listusuarios','GET');" />
											</div>
											<div class="table-responsive m-t-40" id="listusuarios">
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
								<div id="gerarfaturass2"></div>
                            </div>
                        </div>
					</div>
				</div>
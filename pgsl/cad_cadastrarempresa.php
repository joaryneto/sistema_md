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

if($_SESSION['menu13'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

if(isset($_GET['empresa']))
{
	$SQL = "SELECT * FROM empresas where cnpj='".$_GET['empresa']."'";
	$sucesso = mysqli_query($db,$SQL);
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $cnpj = $row['cnpj'];
		 $razao = $row['razao'];
		 $fantasia = $row['fantasia'];
		 $identificacao = $row['identificacao'];
		 $endereco = $row['endereco'];
		 $numero = $row['numero'];
		 $uf = $row['cod_uf'];
		 $cidade = $row['cod_cidade'];
		 $bairro = $row['bairro'];
		 $cep = $row['cep'];
		 $complemento = $row['complemento'];
		 $telefone = $row['telefone'];
		 $celular = $row['celular'];
		 $email = $row['email'];
		 $responsavel = $row['responsavel'];
		 $situacao = $row['status'];
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if(isset($_GET['exame']))
{
	$sucesso = mysqli_query($db,"SELECT descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['exame']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
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
	$sucesso = mysqli_query($db,"SELECT * FROM empresas where cnpj='".$_POST['cnpj']."'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Exame ja existe')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=".$_GET['empresa']."';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into empresas(cnpj,razao,fantasia,identificacao,endereco,numero,bairro,cep,complemento,cod_cidade,cod_uf,telefone,celular,responsavel,status) 
	   values('".$_POST['cnpj']."','".$_POST['razao']."','".$_POST['fantasia']."','".$_POST['identificacao']."','".$_POST['endereco']."','".$_POST['numero']."','".$_POST['bairro']."','".$_POST['cep']."','".$_POST['complemento']."','".$_POST['cidade']."','".$_POST['estado']."','".$_POST['telefone']."','".$_POST['celular']."','".$_POST['responsavel']."','".$_POST['situacao']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $SQL2 = "INSERT into empresas(cnpj,razao,fantasia,identificacao,endereco,numero,bairro,cep,complemento,cod_cidade,cod_uf,telefone,celular,responsavel,status) 
	   values('".$_POST['cnpj']."','".$_POST['razao']."','".$_POST['fantasia']."','".$_POST['identificacao']."','".$_POST['endereco']."','".$_POST['numero']."','".$_POST['bairro']."','".$_POST['cep']."','".$_POST['complemento']."','".$_POST['cidade']."','".$_POST['estado']."','".$_POST['telefone']."','".$_POST['celular']."','".$_POST['responsavel']."','".$_POST['situacao']."')";
	   $sucesso2 = mysqli_query($db3,$SQL2);
	   
	   if($sucesso and $sucesso2)
	   {
		   print("<script>window.alert('Exame Adiconado com sucess')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_cadastrarempresa&empresa=".$_GET['empresa']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE empresas SET razao='".$_POST['razao']."',fantasia='".$_POST['fantasia']."',identificacao='".$_POST['identificacao']."',endereco='".$_POST['endereco']."',numero='".$_POST['numero']."',bairro='".$_POST['bairro']."',cep='".$_POST['cep']."',complemento='".$_POST['complemento']."',cod_cidade='".$_POST['cidade']."',cod_uf='".$_POST['estado']."',telefone='".$_POST['telefone']."',celular='".$_POST['celular']."',responsavel='".$_POST['responsavel']."',status='".$_POST['situacao']."' where cnpj='".$_GET['empresa']."'";
	$sucesso = mysqli_query($db,$SQL1);

    $SQL2 = "UPDATE empresas SET razao='".$_POST['razao']."',fantasia='".$_POST['fantasia']."',identificacao='".$_POST['identificacao']."',endereco='".$_POST['endereco']."',numero='".$_POST['numero']."',bairro='".$_POST['bairro']."',cep='".$_POST['cep']."',complemento='".$_POST['complemento']."',cod_cidade='".$_POST['cidade']."',cod_uf='".$_POST['estado']."',telefone='".$_POST['telefone']."',celular='".$_POST['celular']."',responsavel='".$_POST['responsavel']."',status='".$_POST['situacao']."' where cnpj='".$_GET['empresa']."'";
	$sucesso2 = mysqli_query($db3,$SQL2);
	
	if($sucesso and $sucesso2)
	{
        print("<script>window.alert('Gravado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_cadastrarempresa&empresa=".$_GET['empresa']."';</script>");
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

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de Empresas";?></h4>
								<form name="laudo" class="form-material m-t-40 row" method="post" action="<? if($_GET['empresa'] ==""){ echo "iniciado.php?url=cad_cadastrarempresa&ap=1";}else { echo "iniciado.php?url=cad_cadastrarempresa&ap=2&empresa=".$_GET['empresa']."";} ?>">
								
								<script>
								
								function orcnpj(cnp)
								{
									window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=' + cnp;					
								}
								
								function exames(codigo,exame)
								{
									window.location.href='iniciado.php?url=cad_tabelalaudador&codigo=' + codigo + "&exame=" + exame;					
								}
								
								function valores(valor)
							    {
									var x =  "<? echo $valorB; ?>"-+valor;
									$("#sub").text("Total R$ "+ x);
								}
								
								</script>
								<div class="form-group col-md-2 m-t-20"><label>CNPJ :</label>
								<input type="text" name="cnpj" id="cnpj" <? if(isset($_GET['empresa'])){ ?> value="<? echo $cnpj; ?>"  disabled <? } ?> class="form-control" required="required"><a style="position: absolute;left: 80%;" class="btn btn-info" href="#" data-toggle="modal" data-target="#usuarios"><i class="fa fa-search"></i></a>
								</div>
								<div class="form-group col-md-5 m-t-20"><label>Razâo :</label>
								<input type="text" name="razao" id="Razao" <? if(isset($_GET['empresa'])){ ?> value="<? echo $razao; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-5 m-t-20"><label>Fantasia :</label>
								<input type="text" name="fantasia" id="fantasia" <? if(isset($_GET['empresa'])){ ?> value="<? echo $fantasia; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Identificação :</label>
								<input type="text" name="identificacao" id="identificacao" <? if(isset($_GET['empresa'])){ ?> value="<? echo $identificacao; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Endereço :</label>
								<input type="text" name="endereco" id="endereco" <? if(isset($_GET['empresa'])){ ?> value="<? echo $endereco; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-1 m-t-20"><label>N° :</label>
								<input type="text" name="numero" id="numero" <? if(isset($_GET['empresa'])){ ?> value="<? echo $numero; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Bairro :</label>
								<input type="text" name="bairro" id="bairro" <? if(isset($_GET['empresa'])){ ?> value="<? echo $bairro; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>CEP :</label>
								<input type="text" name="cep" id="cep" <? if(isset($_GET['empresa'])){ ?> value="<? echo $cep; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Complemento:</label>
								<input type="text" name="complemento" id="complemento" <? if(isset($_GET['empresa'])){ ?> value="<? echo $complemento; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Estado :</label>
								<select name="estado" class="form-control" style="width: 100%; height:36px;">
                                    <option></option>
									<? 
										  $sql = "select id_ibge,estado from estados";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['id_ibge']?>" <? if($uf == $row['id_ibge']){ echo "selected"; } ?>><? echo $row['estado']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-3 m-t-20"><label>Cidade :</label>
								<select name="cidade" class="form-control" style="width: 100%; height:36px;">
                                    <option></option>
									<? 
										  $sql = "select cod_municipio,municipio from municipios";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['cod_municipio']?>" <? if($cidade == $row['cod_municipio']){ echo "selected"; } ?>><? echo $row['municipio']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Telefone :</label>
								<input type="text" name="telefone" id="telefone" <? if(isset($_GET['empresa'])){ ?> value="<? echo $telefone; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Celular :</label>
								<input type="text" name="celular" id="celular" <? if(isset($_GET['empresa'])){ ?> value="<? echo $celular; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Email :</label>
								<input type="text" name="email" id="email" <? if(isset($_GET['empresa'])){ ?> value="<? echo $email; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-4 m-t-20"><label>Respnsavel :</label>
								<input type="text" name="responsavel" id="responsavel" <? if(isset($_GET['empresa'])){ ?> value="<? echo $responsavel; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Situação :</label>
								<select name="situacao" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option></option>
									<option value="0" <? if($situacao == 0){ echo "selected"; } ?>>Inativa</option>
									<option value="1" <? if($situacao == 1 or Empty($_GET['empresa'])){ echo "selected"; } ?>>Ativa</option>
                                </select></div>
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['empresa'])){ echo "Gravar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="iniciado.php?url=cad_tabelalaudador"><i class="fa fa-plus-circle"></i> Novo Cadastro</a>
								</div></div>
								</form>
								
                                 <div id="usuarios" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Lista de Empresas</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="form-group"><label>Busca:</label>
                                             <input name="user" type="text" class="form-control" onkeyup="javascript: ajaxLoader('?br=listempresas&pesquisa='+ this.value +'&ap=1','listempresas','GET');" />
											</div>
											<div class="table-responsive m-t-40" id="listempresas">
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
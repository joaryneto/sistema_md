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

if($_SESSION['menu10'] == false)
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
	if(Empty($_POST['cnpj']) || Empty($_POST['exame1']) || Empty($_POST['exame2']))
	{
		print("<script>window.alert('Preencha todos os campos!')</script>");
	}
    else
	{
	$SQL = "SELECT * FROM exames_empresa where cod_exame='".$_POST['exame2']."' and empresa='".$_POST['cnpj']."'";
	$sucess = mysqli_query($db,$SQL);
	
	$x = 0;
	
	while($row = mysqli_fetch_array($sucess))
	{
	   $x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Exame ja foi cadastrado')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_exameempresa&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into exames_empresa(empresa,cod_exame,cod_exame_empresa) values('".$_POST['cnpj']."','".$_POST['exame1']."','".$_POST['exame2']."')";
	   $sucess = mysqli_query($db,$SQL1);
	   
	   //$SQL2 = "INSERT into exames_empresa(empresa,cod_exame,cod_exame_empresa) values('".$_POST['cnpj']."','".$_POST['exame1']."','".$_POST['exame2']."')";
	   //$sucess2 = mysqli_query($db3,$SQL2);
	   
	   if($sucess)
	   {
		   print("<script>window.alert('Exame Adiconado com sucess')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_exameempresa&cnpj=".$_POST['cnpj']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
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
		print("<script>window.location.href='iniciado.php?url=cad_exameempresa&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}
elseif($_GET['ap'] == "3")
{
	$SQL2 = "DELETE FROM exames_empresa where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL2);
	
	if($sucesso)
	{
        print("<script>window.alert('Excluido com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_exameempresa&cnpj=".$_GET['cnpj']."';</script>");
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
								<form class="form-material m-t-40 row" name="laudo" method="post" class="form-material m-t-40 row" action="iniciado.php?url=cad_exameempresa&ap=1">
								
								<script>
								
								function orcnpj(cnp)
								{
									window.location.href='iniciado.php?url=cad_exameempresa&cnpj=' + cnp;					
								}
								
								function exames(codigo,exame)
								{
									window.location.href='iniciado.php?url=cad_exameempresa&cnpj=' + codigo + "&exame=" + exame;					
								}
								
								function valores(valor)
							    {
									var x =  "<? echo $valorB; ?>"-+valor;
									$("#sub").text("Total R$ "+ x);
								}
								
								</script>
								<div class="form-group col-md-3 m-t-20"><label>Empresa:</label>
								<select name="cnpj" class="select2 form-control custom-select" onChange="orcnpj(this.value);" style="width: 100%; height:36px;">
                                    <option value="">Selecionar Empresa</option>
									<? 
										  $sql = "select cnpj,razao from empresas";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['cnpj']?>" <? if($_GET['cnpj'] == $row['cnpj']){ echo "selected"; } ?>><? echo $row['razao']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-4 m-t-20"><label>Exames IMAGGI:</label>
								<!-- onChange="exames('< echo $_GET['cnpj'];?>',this.value);" -->
								<select name="exame1" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option value="">Selecionar exame IMAGGI</option>
									<? 
										  $sql = "select codigo,descricao,valor_padrao,status from tipo_exame";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($_GET['exame'] == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-4 m-t-20"><label>Exame da EMPRESA:</label>
								<!-- onChange="exames('< echo $_GET['cnpj'];?>',this.value);" -->
								<select name="exame2" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option value="">Selecionar exame</option>
									<? 
										  //$sql = "select codigo,descricao from exames where empresa='".$_GET['cnpj']."' and status=1";
										  $sql = "select codigo,descricao from exames where status=1";
										  $res = mysqli_query($db2,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($_GET['exame'] == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
										  <? } ?>
                                </select></div>
								
								<div class="form-group col-md-5 m-t-20">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Alterar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="iniciado.php?url=cad_exameempresa"><i class="fa fa-plus-circle"></i> Novo</a>
								</form>
								</div>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>IMAGGI</th>
												<th>HISMET</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  if(isset($_GET['cnpj']))
										  {
										  
										  $sql = "select exames_empresa.codigo,tipo_exame.descricao as imaggi,exames.descricao as hismet from exames_empresa 
										  inner join tipo_exame on tipo_exame.codigo=exames_empresa.cod_exame 
										  inner join exames on exames.codigo=exames_empresa.cod_exame_empresa 
										  where exames_empresa.empresa='".$_GET['cnpj']."'";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
                                                <td><? echo $row['imaggi'];?></td>
                                                <td><? echo $row['hismet'];?></td>
												<td><a class="fa fa-trash-o" href="iniciado.php?url=cad_exameempresa&cnpj=<?echo $_GET['cnpj']?>&codigo=<? echo $row['codigo']?>&ap=3" style="font-size: 150%; color: red;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir"><a></td>
                                            </tr>
										  <? } } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>IMAGGI</th>
												<th>HISMET</th>
												<th>X</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>			
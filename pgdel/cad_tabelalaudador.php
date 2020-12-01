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

if($_SESSION['menu3'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

if(isset($_GET['codigo']))
{
	$sucesso = mysqli_query($db,"SELECT valor,laudador FROM tabelapg where laudador='".$_GET['empresa']."' and codigo='".$_GET['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $valorA = $row['valor'];
		 $laudador = $row['laudador'];
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
	$sucesso = mysqli_query($db,"SELECT * FROM tabelapg where exame='".$_POST['exame']."' and laudador='".$_POST['cnpj']."'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Exame ja existe')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=".$_POST['cnpj']."';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into tabelapg(laudador,exame,valor) values('".$_POST['cnpj']."','".$_POST['exame']."','".$_POST['valor']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $SQL2 = "INSERT into tabelapg(laudador,exame,valor) values('".$_POST['cnpj']."','".$_POST['exame']."','".$_POST['valor']."')";
	   $sucesso = mysqli_query($db3,$SQL2);
	   
	   if($sucesso)
	   {
		   print("<script>window.alert('Exame Adiconado com sucess')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=".$_POST['cnpj']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE tabelapg SET valor=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE tabelapg SET valor=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db3,$SQL2);
	
	if($sucesso)
	{
        print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=".$_POST['cnpj']."';</script>");
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

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de pagamento a Laudadores";?></h4>
								<form class="form-material m-t-40 row" name="laudo" method="post" action="<? if($_GET['codigo'] ==""){ echo "iniciado.php?url=cad_tabelalaudador&ap=1";}else { echo "iniciado.php?url=cad_tabelalaudador&ap=2&codigo=".$_GET['codigo']."";} ?>">
								
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
								<div class="form-group col-md-3 m-t-20"><label>Laudador:</label>
								<select name="cnpj" class="select2 form-control custom-select" onChange="orcnpj(this.value);" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar Laudador</option>
									<? 
										  $sql = "select empresa,nome from internet_usuarios where tipocad=1";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['empresa']?>" <? if($_GET['empresa'] == $row['empresa']){ echo "selected"; } ?>><? echo $row['nome']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-3 m-t-20"><label>Exame:</label>
								<!-- onChange="exames('< echo $_GET['cnpj'];?>',this.value);" -->
								<select name="exame" class="select2 form-control custom-select" style="width: 100%; height:36px;" <?if(isset($_GET['exame'])){ ?> disabled <? } ?> required="required">
                                    <option value="">Selecionar exame</option>
									<? 
										  $sql = "select codigo,descricao,valor_padrao,status from tipo_exame";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($_GET['exame'] == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Valor R$</label>
								<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
								<input type="text" name="valor" id="valor" value="<? if(isset($_GET['codigo'])){ echo $valorA;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-4 m-t-20">
								<br>
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Alterar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="iniciado.php?url=cad_tabelalaudador"><i class="fa fa-plus-circle"></i> Novo Cadastro</a>
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
												<!--<th>Valor Total</th>-->
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  if(isset($_GET['empresa']))
										  {
										  $sql = "select tabelapg.codigo,tabelapg.valor,tipo_exame.descricao,tipo_exame.valor_padrao,tabelapg.exame from tabelapg inner join tipo_exame on tipo_exame.codigo=tabelapg.exame where tabelapg.laudador='".$_GET['empresa']."'";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
                                                <td><? echo $row['descricao'];?></td>
                                                <td><? echo $row['valor_padrao'];?></td>
												<td><? echo $row['valor'];?></td>
												<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
												<td><a class="fa fa-edit" href="iniciado.php?url=cad_tabelalaudador&empresa=<? echo $_GET['empresa']?>&exame=<?echo $row['exame']?>&codigo=<? echo $row['codigo']?>"> Editar<a></td>
                                            </tr>
										  <? } } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
                                                <th>Valor Unitario</th>
												<th>Desconto</th>
												<!--<th>Valor Total</th>-->
												<th>X</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
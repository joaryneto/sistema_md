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
	$sucess = mysqli_query($db,"SELECT descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['codigo']."'");
	
	if($sucess)
	{
      while($row = mysqli_fetch_array($sucess))
	  {
		 $descricao = $row['descricao'];
		 $valor = $row['valor_padrao'];
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
	$sucess = mysqli_query($db,"SELECT * FROM tipo_exame where descricao like '%".$_POST['descricao']."%'");
	
	$x = 0;
	while($row = mysqli_fetch_array($sucess))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Exame ja existe')</script>");
	}
	else
	{
	   $SQL1 = "INSERT into tipo_exame(descricao,valor_padrao,status) values('".$_POST['descricao']."','".$_POST['valor']."','1')";
	   $sucess = mysqli_query($db,$SQL1);
	   
	   $SQL2 = "INSERT into tipo_exame(descricao,valor_padrao,status) values('".$_POST['descricao']."','".$_POST['valor']."','1')";
	   $sucess2 = mysqli_query($db3,$SQL2);
	   
	   if($sucess and $sucess2)
	   {
		   print("<script>window.alert('Exame Adiconado com sucess')</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE tipo_exame SET descricao='".$_POST['descricao']."', valor_padrao=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucess = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE tipo_exame SET descricao='".$_POST['descricao']."', valor_padrao=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucess2 = mysqli_query($db3,$SQL2);
	
	if($sucess and $sucess2)
	{
        print("<script>window.alert('Alterado com sucesso.')</script>");
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
							    <h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de Exame";?></h4>
								<form class="form-material m-t-40 row"  name="laudo" method="post" action="<? if($_GET['codigo'] ==""){ echo "iniciado.php?url=cad_exames&ap=1";}else { echo "iniciado.php?url=cad_exames&ap=2&codigo=".$_GET['codigo']."";} ?>">
								<div class="form-group col-md-3 m-t-20"><label>Descrição</label>
								<input type="text" name="descricao" value="<? if(isset($_GET['codigo'])){ echo $descricao;} ?>" class="form-control"></div>
								<div class="form-group col-md-3 m-t-20"><label>Valor R$</label>
								<input type="text" name="valor" placeholder="" value="<? if(isset($_GET['codigo'])){ echo $valor;} ?>" class="form-control"></div>
								<div class="form-group col-md-4 m-t-20">
								<div class="form-actions">
								<br>
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Alterar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="iniciado.php?url=cad_exames"><i class="fa fa-plus-circle"></i> Novo</a>
								</div></div>
								</form>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
                                                <th>Valor</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  $sql = "select codigo,descricao,valor_padrao,status from tipo_exame";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo']?></td>
                                                <td><? echo $row['descricao']?></td>
                                                <td><? echo $row['valor_padrao']?></td>
												<td><a class="fa fa-edit" href="iniciado.php?url=cad_exames&codigo=<? echo $row['codigo']?>"> Editar<a></td>
                                            </tr>
										  <? } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
                                                <th>Valor</th>
												<th>X</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>			
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
	$sucesso = mysqli_query($db,"SELECT descricao FROM materias where codigo='".$_GET['codigo']."'");
	
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
	$sucesso = mysqli_query($db,"SELECT * FROM materias where laudador like '%".$_POST['descricao']."%'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Matéria ja cadastrada!')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_materias';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into materias(descricao) values('".$_POST['descricao']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   print("<script>window.alert('Matéria cadastrada com sucesso...')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_materias';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE materias SET descricao=".$_POST['descricao']." where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_materias';</script>");
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

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de Matérias";?></h4>
								<form class="form-material m-t-40 row" name="laudo" method="post" action="<? if($_GET['codigo'] ==""){ echo "iniciado.php?url=cad_materias&ap=1";}else { echo "iniciado.php?url=cad_materias&ap=2&codigo=".$_GET['codigo']."";} ?>">
							
								<div class="form-group col-md-2 m-t-20"><label>Nome da Matéria :</label>
								<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
								<input type="text" name="descricao" id="descricao" value="<? if(isset($_GET['codigo'])){ echo $descricao;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-4 m-t-20">
								<br>
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Alterar";}else { echo "Cadastrar";} ?></button>
								<? if(!Empty($_GET['codigo'])) { ?><a class="btn btn-info" href="iniciado.php?url=cad_turmas"><i class="fa fa-plus-circle"></i> Novo Cadastro</a><? } ?>
								</div></div>
                                <div class="form-group col-md-12 m-t-20">
                                    <table class="display nowrap table table-hover table-striped table-bordered">
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
										  
										  $sql = "select * from materias";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
                                                <td><? echo $row['descricao'];?></td>
												<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
												<td><a class="fa fa-edit" href="iniciado.php?url=cad_materias&codigo=<? echo $row['codigo']?>" style="font-size: 150%;"><a></td>
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
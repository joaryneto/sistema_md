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
	$sucesso = mysqli_query($db,"SELECT * FROM matriculas where nome like '%".$_POST['nome']."%'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Aluno(a) ja cadastrado!')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_turma';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into matriculas(matricula,nome,estado,cidade,ensino,turma) values('".$_POST['nome']."','".$_POST['estado']."','".$_POST['cidade']."','".$_POST['ensino']."','".$_POST['turma']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $SQL1 = "INSERT into usuarios(login,senha,matricula,nome,tipo,status) values('".$_POST['nome']."','".$_POST['estado']."','".$_POST['cidade']."','".$_POST['ensino']."','".$_POST['turma']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   print("<script>window.alert('Turma Cadastrada com sucesso...')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_turma';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE turmas SET descricao=".$_POST['descricao']." where codigo='".$_GET['codigo']."'";
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
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Cadastro de Alunos";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
        </div>
</div>   
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
		                        <form class="m-t-40 row" name="laudo" method="post" action="sistema.php?url=cad_alunos&ap=1">
								<?if($_GET['cadastro'] == 1){?>
								<?
								   $d = date('YdHis');
								   $matri = $d;
								   $_SESSION['matricula'] = $matri;
								?>
								<div class="form-group col-md-3 m-t-20"><label>Matricula :</label>
								<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
								<input type="text" name="matricula" id="matricula" value="<? if(isset($_GET['codigo'])){ echo $matricula;}else{ echo $_SESSION['matricula'];} ?>" readonly class="form-control" required="required">
								</div>
		                        <div class="form-group col-md-3 m-t-20"><label>Nome :</label>
								<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
								<input type="text" name="nome" id="nome" value="<? if(isset($_GET['codigo'])){ echo $nome;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Estado :</label>
								<select name="estado" id="estado" class="form-control" onChange="javascript: ajaxLoader('?br=cad_listacidades&estado='+ this.value ,'cidades','GET');" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql = "select id_ibge,estado from estados";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['id_ibge']?>" <? if($estado == $row['id_ibge']){ echo "selected"; } ?>><? echo $row['estado']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Cidade :</label>
								<div id="cidades">
								<select name="cidade" id="cidade"class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar</option>
									<? 
									if(!Empty($cidade))
								    {
										  $sql = "select cod_municipio,municipio from municipios";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['cod_municipio']?>" <? if($cidade == $row['cod_municipio']){ echo "selected"; } ?>><? echo $row['municipio']?></option>
									<? } } ?>
                                </select>
								</div>
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Ensino :</label>
								<select name="ensino" id="ensino" class="form-control" onChange="javascript: ajaxLoader('?br=cad_listacurso&curso='+ this.value ,'cursar','GET');"  style="width: 100%; height:36px;">
                                  <option value="">Selecionar</option>
								  <option value="0" <? if($ensino == 0 and isset($_GET['codigo'])){ echo "selected"; } ?>>Infantil</option>
								  <option value="1" <? if($ensino == 1 and isset($_GET['codigo'])){ echo "selected"; } ?>>Fundamental</option>
								  <option value="2" <? if($ensino == 2 and isset($_GET['codigo'])){ echo "selected"; } ?>>Médio</option>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Turma :</label>
								<div id="cursar">
								<select name="turma" id="turma" class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar</option>
									<? 
									      if(isset($_GET['codigo']))
										  {
										  $sql = "select codigo,descricao from turmas";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($turma == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
										  <? 
										  } 
										  } 
										  ?>
                                </select></div>
								</div>
								<div class="form-group col-md-12 m-t-20">
								<button type="button" onclick="window.location='sistema.php?url=cad_alunos&cadastro=1';" class="btn btn-info"><i class="fa fa-plus-circle"></i> Gravar</button>
								</div>
								<?}else{?>
								<div class="form-group col-md-12 m-t-20">
								<button type="button" onclick="window.location='sistema.php?url=cad_alunos&cadastro=1';" class="btn btn-info"><i class="fa fa-plus-circle"></i> Cadastrar</button>
								</div>
								<div class="form-group col-md-12 m-t-20"><label>Pesquisa :</label>
								<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
								<input type="text" name="pesquisa" id="pesquisa" value="<? if(isset($_POST['pesquisa'])){ echo $_POST['pesquisa'];} ?>" class="form-control" required="required">
								</div>
								
								<div class="col-md-12">
					            <div class="component-box">
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							        <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Matricula</th>
                                                <th>Nome</th>
												<th>Turma</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?
										  
										  if(!Empty($_POST['pesquisa']))
										  {
											  $Whernome = " matriculas.nome like '%".$_POST['pesquisa']."%'";
										  }
										  
										  $sql = "select matriculas.matricula,matriculas.nome,matriculas.nome,turmas.descricao from matriculas 
										  inner join  turmas on turmas.codigo=matriculas.turma 
										  inner join turmas_professor on turmas_professor.turma=matriculas.turma and turmas_professor.usuario='".$_SESSION['usuario']."'
										  where $Whernome matriculas.status=1";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td data-title="Matricula"><? echo $row['matricula'];?></td>
                                                <td data-title="Aluno"><? echo $row['nome'];?></td>
												<td data-title="Turma"><? echo $row['descricao'];?></td>
												<td data-title="Editar"><a class="fa fa-edit" href="iniciado.php?url=cad_turmas&codigo=<? echo $row['codigo']?>" style="font-size: 150%;"><a></td>
                                            </tr>
										  <? } ?>
                                        </tbody>
                                    </table>
                                </div>
								</div>
								</div>
								<?}?>
								</form>
                            </div>
                        </div>
					</div>
				</div>
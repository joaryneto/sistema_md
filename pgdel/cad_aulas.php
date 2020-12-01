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

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

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
	$sucesso = mysqli_query($db,"SELECT * FROM diario where turma='".$_POST['turma']."' and materia='".$_POST['disciplina']."' and periodo='".$_POST['periodo']."' and data='".revertedata($_POST['txtdata'])."' and conteudo like '%'".$_POST['conteudo']."'%'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Conteudo ja cadastrada!')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into diario(turma,materia,periodo,data,conteudo) values('".$_POST['turma']."','".$_POST['disciplina']."','".$_POST['periodo']."','".revertedata($_POST['txtdata'])."','".$_POST['conteudo']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   print("<script>window.alert('Conteudo Cadastrada com sucesso...')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
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
		print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}
if($_GET['excluir'] == 1)
{
	$SQL1 = "DELETE FROM diario where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Excluido com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
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

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de Turmas";?></h4>
								<form class="form-material m-t-40 row" name="laudo" method="post" action="iniciado.php?url=cad_aulas">
							
								<div class="form-group col-md-3 m-t-20"><label>Turma :</label>
								<select name="turma" id="turma" class="select2 form-control custom-select" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql = "select * from turmas";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($row['codigo']==$_POST['turma']){ echo " selected"; }?>><? echo $row['descricao']?></option>
										  <? } ?>
                                </select>
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Diciplina :</label>
								<select name="disciplina" id="disciplina" class="select2 form-control custom-select" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql = "select * from materias";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($row['codigo']==$_POST['disciplina']){ echo " selected"; }?>><? echo $row['descricao']?></option>
										  <? } ?>
                                </select>
								</div>
								<div class="form-group col-md-4 m-t-20"><label><b>Conteudo :</b></label>
                                <input type="text" name="conteudo" class="form-control" id="conteudo" value="<? if(!Empty($_POST['conteudo'])){ echo $_POST['conteudo']; } ?>" placeholder="" required="required">
								</div>
								<div class="form-group col-md-12 m-t-20">
								<br>
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> Pesquisar</button>
								<a class="btn btn-info" href="iniciado.php?url=cad_diario"><i class="fa fa-plus-circle"></i> Novo </a>
								</div></div>
								</form>
								<? if(!Empty($_POST['turma'])){?>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Turma</th>
												<th>Periodo</th>
												<th>Conteúdo</th>
												<th>Status</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  
										  
										  $data = date('Y');
										  $sql = "select turmas.descricao as a,materias.descricao as b,periodo.descricao as c,diario.data from diario 
										  inner join turmas on turmas.codigo=diario.turma 
										  inner join materias on materias.codigo=diario.materia 
										  inner join periodo on periodo.codigo=diario.periodo 
										  where diario.turma='".$_POST['turma']."' and diario.materia='".$_POST['disciplina']."' and diario.conteudo like '%".$_POST['conteudo']."%'";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
											    <td><? echo formatodatahora($row['data']);?></td>
                                                <td><? echo $row['a'];?></td>
												<td><? echo $row['b'];?></td>
												<td><? echo $row['c'];?></td>
												<td><a class="fa fa-edit" href="iniciado.php?url=cad_diario&codigo=<? echo $row['codigo']?>" style="font-size: 150%;"><a></td>
                                            </tr>
										  <? }  ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Data</th>
                                                <th>Turma</th>
												<th>Periodo</th>
												<th>Conteúdo</th>
												<th>Status</th>
												<th>X</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
								<? }?>
                            </div>
                        </div>
					</div>
				</div>
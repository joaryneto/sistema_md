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
	$sucesso = mysqli_query($db,"SELECT descricao FROM materias where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."'");
	
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
	$x = 0;
	$RES = mysqli_query($db,"SELECT * FROM materias where sistema='".$_SESSION['sistema']."' and descricao like '%".$_POST['descricao']."%'");
	while($row = mysql_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Disciplina ja cadastrada!')</script>");
		print("<script>window.location.href='sistema.php?url=cad_turmas';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into turmas(sistema,curso,descricao) values('".$_SESSION['sistema']."','".$_POST['curso']."','".$_POST['descricao']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   print("<script>window.alert('Turma Cadastrada com sucesso...')</script>");
		   print("<script>window.location.href='sistema.php?url=cad_turmas';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE turmas SET descricao=".$_POST['descricao']." where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."'";
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
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Cadastro de Turmas";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
					<input type="text" name="pesquisa" id="pesquisa" value="" class="form-control form-control-lg search bottom-25 position-relative border-0" onkeyup="javascript: requestPage2('?br=atu_turmas&pesquisa='+ this.value +'&load=1','listaturmas','GET');" required='required'>
                    <button class="btn btn-info btnadd-sh" onclick="requestPage2('?br=modal_turmas&modal=1','modals','GET');" data-toggle="modal" data-target="#modalap" data-title="Turmas"><i class='fa fa-plus-circle'></i></button>
                </div>
        </div>
</div>   
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
		                        <form class="m-t-40 row" name="alunoform" id="alunoform" method="post">
								<div class="col-md-12">
					            <div class="component-box">
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							        <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Descrição</th>
												<th>Status</th>
												<th>Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listaturmas">
										<?
										  							
                                          $x = 0;																	
										  $sql = "select * from turmas where sistema='".$_SESSION['sistema']."';";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
											   $x = 1;
										  ?>
                                            <tr>
                                                <td data-title="Descrição"><? echo $row['descricao'];?></td>
												<td data-title="Status"><? 
												Switch($row['status'])
												{
												 case 0:
												 { echo "Inativo";}
												 break;
												 case 1:
												 { echo "Ativo";}
												 break;
												 case 2:
												 { echo "Pre-Ativa";}
												 break;
												 case 3:
												 { echo "Transferido";}
												 break;
												}
																		 ?></td>
												<td data-title="Editar">
												<a class="fa fa-edit" href="javascript: void(0);" onclick="edit_turmas('<?=$row['codigo'];?>');" style="font-size: 150%;"><a>
												</td>
                                            </tr>
										  <? }
										    if($x == 0)
											{
											?>
										    <tr>
                                                <td data-title="Descrição">Nenhum registro encontrado.</td>
											<tr>
											<?
											}
  										  ?>
                                        </tbody>
                                    </table>
                                </div>
								</div>
								</div>
							  </form>
                            </div>
                        </div>
					</div>
				</div>
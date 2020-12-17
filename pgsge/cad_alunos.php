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

$situacao = "";
$estado = "";
$cidade = "";
$ensino = "";

if(isset($_GET['matricula']))
{
	$x = 0;
	$RES = mysqli_query($db,"SELECT * FROM matriculas where matricula='".$_GET['matricula']."'");
	while($row = mysqli_fetch_array($RES))
	{
		 
		 $x = 1;
		 $matricula = $row['matricula'];
		 $nome = $row['nome'];
		 $estado = $row['estado'];
		 $cidade = $row['cidade'];
		 $ensino = $row['ensino'];
		 $turma = $row['turma'];
		 $situacao = $row['status'];

		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	}
	
	if($x == 0)
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
		print("<script>window.location.href='sistema.php?url=cad_alunos';</script>");
	}
}

?>	

<script>

function gravar()
{
	var matricula = document.getElementById('matricula').value;
	var nome = document.getElementById('cnome').value;
	var estado = document.getElementById('estado').value;
	var cidade = document.getElementById('cidade').value;
	var ensino = document.getElementById('ensino').value;
	var turma = document.getElementById('turma').value;
	var status = document.getElementById('situacao').value;
	
	if(matricula == "")
	{
		swal('Atenção', 'Campo Matricula em branco.');
	}
	else if(nome == "")
	{
		swal('Atenção', 'Campo Nome em branco.');
	}
	else if(estado == "")
	{
		swal('Atenção', 'Campo Estado em branco.');
	}
	else if(cidade == "")
	{
		swal('Atenção', 'Campo Cidade em branco.');
	}
	else if(ensino == "")
	{
		swal('Atenção', 'Campo Ensino em branco.');
	}
	else if(turma == "")
	{
		swal('Atenção', 'Campo Turma em branco.');
	}
	else if(status == "")
	{
		swal('Atenção', 'Campo Situação em branco.');
	}
	else
	{
        requestPage2('?br=atu_alunos&matricula='+ matricula +'&nome='+ nome +'&estado='+ estado +'&cidade='+ cidade +'&ensino='+ ensino +'&turma='+ turma +'&situacao='+ status +'&ap=<? if(Empty($_GET["matricula"])){ echo "1";}else{ echo "2";}?>','load','GET');
    }
}

</script>
<?

$input = "";

if(Empty($_GET['cadastro']))
{
  $input = "";
  $valor = 290;
}
else
{
  $valor = 154;
}
?>
<div class="container-fluid bg-template mb-4">
            <div class="row hn-<?=$valor;?> position-relative">
			<div class="background opac heightset">
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Cadastro de Alunos";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
					<input type="text" name="pesquisa" id="pesquisa" value="" class="form-control form-control-lg search bottom-25 position-relative border-0" onkeyup="javascript: requestPage2('?br=atu_alunos&pesquisa='+ this.value +'&ap=3','listaalunos','GET');" required='required'>
                    <button class="btn btn-info btnadd-sh" onclick="requestPage2('?br=modal_alunos&modal=1','modals','GET');" data-toggle="modal" data-target="#modalap" data-title="Alunos"><i class='fa fa-plus-circle'></i></button>
                </div>
        </div>
</div>   
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
		                        <form class="m-t-40 row" name="alunoform" id="alunoform" method="post">
								<div class="col-md-12">
					            <div class="component-box" id="listaalunos">
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							        <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Matricula</th>
                                                <th>Nome</th>
												<th>Turma</th>
												<th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?
										  
										  if(!Empty($_POST['pesquisa']))
										  {
											  $Whernome = " matriculas.nome like '%".$_POST['pesquisa']."%'";
										  }
										  
										  $sql = "select matriculas.matricula,matriculas.nome,matriculas.nome,turmas.descricao,matriculas.status from matriculas 
										  inner join  turmas on turmas.codigo=matriculas.turma 
										  inner join turmas_professor on turmas_professor.turma=matriculas.turma and turmas_professor.usuario='".$_SESSION['usuario']."'
										  where $Whernome matriculas.status in (0,1,3)";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td data-title="Matricula"><? echo $row['matricula'];?></td>
                                                <td data-title="Aluno"><? echo $row['nome'];?></td>
												<td data-title="Turma"><? echo $row['descricao'];?></td>
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
												<a class="fa fa-edit" href="javascript: void(0);" onclick="edit_alunos(<?=$row['matricula'];?>);" style="font-size: 150%;"><a>
												</td>
                                            </tr>
										  <? } ?>
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
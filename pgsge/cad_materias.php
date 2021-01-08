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
?>

<div class="container-fluid bg-template mb-4">
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Cadastro de Disciplinas";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
					<input type="text" name="pesquisa" id="pesquisa" value="" class="form-control form-control-lg search bottom-25 position-relative border-0" onkeyup="javascript: requestPage2('?br=atu_disciplinas&pesquisa='+ this.value +'&load=1','list','GET');" required='required'>
                    <button class="btn btn-info btnadd-sh" onclick="requestPage2('?br=modal_materias&modal=1','modals','GET');" data-toggle="modal" data-target="#modalap" data-title="Turmas"><i class='fa fa-plus-circle'></i></button>
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
                                        <tbody id="list">
										<?
										  							
                                          $x = 0;																	
										  $sql = "select * from materias where sistema='".$_SESSION['sistema']."';";
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
												<a class="fa fa-edit" href="javascript: void(0);" onclick="edit_disciplinas('<?=$row['codigo'];?>');" style="font-size: 150%;"><a>
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
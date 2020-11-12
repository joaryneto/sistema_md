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
//   print("<script>window.location.href='sistema.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

if(isset($_GET['codigo']))
{
	$SQL = "SELECT diario.tipo,diario.turma,diario.video,diario.materia,diario.periodo,diario.data,diario.conteudo,diario.texto,materias.descricao as mdescricao,turmas.descricao as tdescricao,periodo.descricao as pdescricao FROM diario 
	inner join materias on materias.codigo=diario.materia 
	inner join turmas on turmas.codigo=diario.turma
	inner join periodo on periodo.codigo=diario.periodo
	where diario.codigo='".$_GET['codigo']."'";
	
	$sucesso = mysqli_query($db,$SQL);
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $turma = $row['turma'];
		 $disciplina = $row['materia'];
		 $periodo = $row['periodo'];
		 $data = $row['data'];
		 $conteudo = $row['conteudo'];
		 $texto = $row['texto'];
		 $video = $row['video'];
		 $pdescricao = $row['pdescricao'];
		 $tdescricao = $row['tdescricao'];
		 $mdescricao = $row['mdescricao'];
		 $tipo = $row['tipo'];
		 
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
	
	//$sucesso->close();
}

if($_GET['ap'] == "1")
{
	$x = 0;
	$RES1 = mysqli_query($db,"SELECT * FROM diario where turma='".$_POST['turma']."' and materia='".$_POST['disciplina']."' and periodo='".$_POST['periodo']."' and data='".revertedata($_POST['txtdata'])."' and conteudo like '%'".$_POST['conteudo']."'%'");
	while($row = mysqli_fetch_array($RES1))
	{
		$x = 1;
	}
	
	
	if($x == 1)
	{
	    print("<script>window.alert('Conteudo ja cadastrada!')</script>");
		print("<script>window.location.href='sistema.php?url=cad_diario';</script>");
	}
	else
	{
	   $SQL2 = "INSERT into diario(usuario,turma,materia,periodo,video,data,conteudo,texto,tipo) values('".$_SESSION['usuario']."','".$_POST['turma']."','".$_POST['disciplina']."','".$_POST['periodo']."','".$_POST['video']."','".revertedata($_POST['txtdata'])."','".$_POST['conteudo']."','".$_POST['txtobs']."','".$_POST['tipo']."')";
	   $RES2 = mysqli_query($db,$SQL2);
	   
	   if($RES2)
	   {
		   print("<script>window.alert('Conteudo Cadastrada com sucesso...')</script>");
		   
		   $RES1 = mysqli_query($db,"SELECT max(diario.codigo) as codigo FROM diario inner join turmas_professor on turmas_professor.turma=diario.turma where turmas_professor.usuario='".$_SESSION['usuario']."'");
		   $row = mysqli_fetch_array($RES1);
		   
		   
		   print("<script>window.location.href='sistema.php?url=cad_diario&codigo=".$row['codigo']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	   
	   //$RES1->close();
	   //$RES2->close();
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE diario SET conteudo='".$_POST['conteudo']."', texto='".$_POST['txtobs']."',tipo='".$_POST['tipo']."' where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Atualizado com sucesso.');</script>");
		print("<script>window.location.href='sistema.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
	//$sucesso->close();
	
}

if($_GET['fechar'] == "3")
{
	$SQL1 = "UPDATE diario SET status=0 where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Bimestre fechado com sucesso.');</script>");
		print("<script>window.location.href='sistema.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
	///$sucesso->close();
	
}
if($_GET['excluir'] == 1)
{
	$SQL1 = "DELETE FROM diario where codigo='".$_GET['codigo']."'";
	$RES = mysqli_query($db,$SQL1);
	
	print("<script>alert('Excluido com sucesso.');</script>");
	print("<script>window.location.href='sistema.php?url=cad_diario';</script>");
	//$RES->close();
}

?>	
<script>
function gravar() 
{

var i = 0;
$.each($("input[name='check[]']:checked"),function()
{
	i++;
});


//if(i == 0)
//{
//	swal('Atenção', 'Selecione os alunos para gravar.');
//	//alert('TESTE');
//    return true;	
//}
//else
//{
		swal({   
            title: "Atenção!",   
            text: "Você esta iniciando a gravação de presença dos alunos.",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, Gravar!",
            cancelButtonText: "Não, Cancelar!", 			
            closeOnConfirm: true 
        }, function()
		{   
		
		    var i = 0;
			var o = 0;
			
		    var matriculas = [];
		    $.each($("input[name='check[]']:checked"),function()
		    {
		    	  matriculas.push($(this).val());
				  o++;
		    });
			
			var nots = [];
		    $.each($("input[name='check[]']:not(:checked)"),function()
		    {
		    	  nots.push($(this).val());
				  i++;
		    });
	   
	        var not = "";
	        if(i === 0)
			{
		       not = "";
			}
			else
			{
			   not = nots.join(", ");
			}
			
			var matricula = "";
			if(o === 0)
			{
			   matricula = "";
			}
			else
			{
			   matricula = matriculas.join(",");
			}
			
		    ajaxLoader('?br=atu_presenca&matricula='+ matricula +'&nots='+ nots +'&data=<? echo $data;?>&diario=<? echo $_GET['codigo'];?>&disciplina=<? echo $_GET['disciplina'];?>&periodo=<? echo $periodo; ?>&gravar=1','gravarpresenca','GET');
			
	});
}

function gravarnota() 
{

var i = 0;
$.each($("input[name='check[]']:value"),function()
{
	i++;
});

		swal({   
            title: "Atenção!",   
            text: "Você esta iniciando a gravação de Notas dos alunos.",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, Gravar!",
            cancelButtonText: "Não, Cancelar!", 			
            closeOnConfirm: true 
        }, function()
		{   
		
		    var i = 0;
			var o = 0;
			
		    var notas = [];
		    $.each($("input[name='check[]']"),function()
		    {
		    	  notas.push($(this).val());
				  o++;
		    });
					
			var nota = notas.join(",");
			
		    ajaxLoader('?br=atu_nota&notas='+ nota +'&data=<? echo $data;?>&diario=<? echo $_GET['codigo'];?>&disciplina=<? echo $_GET['disciplina'];?>&periodo=<? echo $periodo; ?>&gravar=1','gravarpresenca','GET');
			
	});
}

function gravardiario()
{
	
}

</script>	
<div class="container-fluid bg-template mb-4">
            <div class="row hn-154 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Diario de Classe";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
			<!--Tabs with Icon example -->
							    
								
							    <? if(Empty($_GET['codigo']) and Empty($_GET['frequencia']) and Empty($_GET['nota']) or Empty($_GET['codigo']) and Empty($_GET['nota']) and Empty($_GET['frequencia']) or !Empty($_GET['codigo']) and Empty($_GET['frequencia']) and Empty($_GET['nota']) or !Empty($_GET['codigo']) and Empty($_GET['nota']) and Empty($_GET['frequencia'])) { ?>
                                <?
								if(Empty($_GET['codigo']) and Empty($_GET['frequencia']))
								{  $action = "sistema.php?url=cad_diario&ap=1";}
							    if(!Empty($_GET['codigo']))
								{  $action = "sistema.php?url=cad_diario&codigo=".$_GET['codigo']."&ap=2";}
								
								//$token = md5(uniqid(""));
									 
							    /*$x = 0;
								$DSQL1 = "select codigo from diario where usuario = '".$_SESSION['usuario']."' and status = 2 order by codigo desc limit 1;";
								$DRES1 = mysqli_query($db,$DSQL1);
								while($ROW2 = mysqli_fetch_array($DRES1))
								{
									$x = 1;
									$_SESSION['diario'] = $ROW2['codigo'];
								}
								
								$DRES1->close();
								
								if($x == 0)
							    { 
									$DSQL2 = "insert into diario(usuario,status) values ('".$_SESSION['usuario']."',2)";
								    mysqli_query($db,$DSQL2);
								}
								
								$DSQL3 = "select codigo from diario where usuario = '".$_SESSION['usuario']."' and status = 2 order by codigo desc limit 1;";
								$DRES3 = mysqli_query($db,$DSQL3);
								while($ROW2 = mysqli_fetch_array($DRES3))
								{
									echo $_SESSION['diario'] = $ROW2['codigo'];
								}
								$DRES3->close();
								*/
								
								?>
								<form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>">
								<input type="hidden" name="diario" id="diario" class="form-control"  value="<? echo $_SESSION['diario']; ?>">
								<div class="form-group col-md-4 m-t-20"><label>Turma :</label>
								<select name="turma" id="turma" style="width: 100%; height:36px;" class="select2 form-control custom-select" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql1 = "select turmas.descricao,turmas.codigo from turmas
										  inner join turmas_professor on turmas_professor.turma=turmas.codigo
										  where turmas_professor.usuario='".$_SESSION['usuario']."' group by turmas.descricao";
										  $res1 = mysqli_query($db,$sql1); 
										  while($row = mysqli_fetch_array($res1))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($row['codigo']==$turma){ echo " selected"; }?>><? echo $row['descricao'];?></option>
										  <? } 
										  $res1->close();
										  ?>
                                </select>
								</div>
								<div class="form-group col-md-4 m-t-20"><label>Diciplina :</label>
								<select name="disciplina" id="disciplina" style="width: 100%; height:36px;" class="select2 form-control custom-select" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql2 = "select materias.descricao,materias.codigo from materias
										  inner join materias_professor on materias_professor.materia=materias.codigo
										  where materias_professor.usuario='".$_SESSION['usuario']."' group by materias.descricao";
										  $res2 = mysqli_query($db,$sql2); 
										  while($row = mysqli_fetch_array($res2))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($row['codigo']==$disciplina){ echo " selected"; }?>><? echo $row['descricao'];?></option>
										  <? }
                                          $res2->close();
										  ?>
                                </select>
								</div>
								<div class="form-group col-md-4 m-t-20"><label>Periodo :</label>
								<select name="periodo" id="periodo" style="width: 100%; height:36px;" class="select2 form-control custom-select" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql3 = "select * from periodo";
										  $res3 = mysqli_query($db,$sql3); 
										  while($row = mysqli_fetch_array($res3))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($row['codigo']==$periodo){ echo " selected"; }?>><? echo $row['descricao'];?></option>
										  <? }
										  $res3->close();
										  ?>
                                </select>
								</div>
								<div class="form-group col-md-5 m-t-20"><label><b>Link Video :</b></label>
                                <input type="text" name="video" id="video" class="form-control"  value="<? if(!Empty($_GET['codigo'])){ echo $video; } ?>">
								</div>
								<div class="form-group col-md-2 m-t-20"><label><b>Data :</b></label>
                                <input type="text" name="txtdata" id="txtdata" class="form-control"  value="<? if(!Empty($_GET['codigo'])){ echo formatodatahora($data); } ?>" placeholder="dd/mm/yyyy"  data-mask="00/00/0000" data-mask-clearifnotmatch="true"  required="required">
								</div>
								
								<div class="form-group col-md-5 m-t-20"><label><b>Conteudo Lecionado :</b></label>
                                <input type="text" name="conteudo" class="form-control" id="conteudo" value="<? if(!Empty($_GET['codigo'])){ echo $conteudo;} ?>" placeholder="" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Tipo :</label>
								<select name="tipo" id="tipo" class="form-control" style="width: 100%; height:36px;" required="required">
                                      <option value="">Selecionar Tipo</option>
                                      <option value="1" <? if(1 == $tipo and isset($_GET['codigo'])){ echo "selected"; } ?>>Aula Normal</option>
									  <option value="2" <? if(2 == $tipo and isset($_GET['codigo'])){ echo "selected"; } ?>>Avaliação</option>
                                </select>
								</div>
								<div class="form-group col-md-12 m-t-20"><label><b>Texto :</b></label>                               
								<textarea class="textarea_editor form-control" name="txtobs" id="txtobs" rows="10" placeholder="Escreva aqui ..." required="required"><? if(!Empty($_GET['codigo'])){ echo $texto;} ?></textarea>
								</div>
								<? }else{ ?>
								<div class="col-md-12">
								<h2>Turma : <? echo $tdescricao;?></h2>
								<h2>Disciplina : <? echo $mdescricao;?></h2>
								<h2>Bimestre : <? echo $pdescricao;?></h2>
								<h2>Conteudo : <? echo $conteudo;?></h2>
								</div>
								<? } ?>
								<div class="form-group col-md-12 m-t-20">
								<br>
								<? if(Empty($_GET['codigo'])){?>
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> Cadastrar </button>
								<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="sistema.php?url=cad_diario"><i class="fa fa-plus-circle"></i> Novo</a>
								<?}else{?>
								<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="sistema.php?url=cad_diario&codigo=<? echo $_GET['codigo']; ?>&excluir=1"><i class="fa fa-plus-circle"></i> Excluir</a>
								<? if(Empty($_GET['frequencia']) && Empty($_GET['nota'])){?>
								<button class="btn pmd-btn-outline pmd-ripple-effect btn-primary" type="submit" ><i class="fa fa-plus-circle"></i> Gravar </button>
								<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="sistema.php?url=cad_diario<?if(Empty($_GET['codigo'])){?>&codigo=<? echo $_GET['codigo']; ?><?}?>"><i class="fa fa-plus-circle"></i> Voltar</a>
								<? }else{ ?>
								<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="sistema.php?url=cad_diario<?if(!Empty($_GET['codigo'])){?>&codigo=<? echo $_GET['codigo']; ?><?}?>"><i class="fa fa-plus-circle"></i> Voltar</a>
								<?if(!Empty($_GET['frequencia']) and Empty($_GET['nota'])){?>
								<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: WEB(0)" onClick="gravar();"><i class="fa fa-plus-circle"></i> Gravar</a>
								<? }?><?}?>
								
								
								<?}?>
								<? if(!Empty($_GET['codigo']) and Empty($_GET['frequencia']) && Empty($_GET['nota'])) { ?>
								<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="sistema.php?url=cad_diario&codigo=<? echo $_GET['codigo']; ?>&frequencia=1&disciplina=<? echo $disciplina;?>"><i class="fa fa-plus-circle"></i> Registrar Frequencia</a>
								<? } ?>
								<? if(!Empty($_GET['codigo']) and Empty($_GET['nota']) && Empty($_GET['frequencia'])) { ?>
								<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="sistema.php?url=cad_diario&codigo=<? echo $_GET['codigo']; ?>&nota=1&disciplina=<? echo $disciplina;?>"><i class="fa fa-plus-circle"></i> Inserir Nota</a>
								<? } ?>
								<? if(!Empty($_GET['codigo']) and !Empty($_GET['nota']) && Empty($_GET['frequencia'])) { ?>
								<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle"></i> Fechar Bimestre</a>
								<? } ?>
								
								</div>
								<? if(Empty($_GET['codigo']) && Empty($_GET['frequencia']) && Empty($_GET['nota'])){?>
								<div class="form-group col-md-5 m-t-20"><label>Pesquisa :</label>
                                <input type="text" name="pesquisa" class="form-control" id="pesquisa" value="<? if(!Empty($_GET['codigo'])){ echo $conteudo;} ?>" placeholder="Pesquisar conteúdo">
								</div>
                          <div class="col-md-12">
					       <div class="component-box">
							<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							  <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Turma</th>
												<th>Disciplina</th>
												<th>Conteudo</th>
												<th>Data</th>
												<th>Editar</th>
												<th>Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listdiario">
										<? 
										  
										  $data = date('Y');
										  $sql4 = "select diario.codigo,diario.conteudo,turmas.descricao as a,materias.descricao as b,diario.conteudo as c,diario.data from diario 
										  inner JOIN turmas on turmas.codigo=diario.turma 
										  inner join materias on materias.codigo=diario.materia 
										  inner join periodo on periodo.codigo=diario.periodo where YEAR(diario.data)=$data and diario.usuario='".$_SESSION['usuario']."';";
										  $res4 = mysqli_query($db,$sql4); 
										  while($row = mysqli_fetch_array($res4))
										  {
										  ?>
                                            <tr>
                                                <td data-title="Turma"><? echo $row['a'];?></td>
												<td data-title="Disciplina"><? echo $row['b'];?></td>
												<td data-title="Conteudo"><? echo $row['c'];?></td>
												<td data-title="Data"><? echo formatodatahora($row['data']);?></td>
												<td data-title="Editar"><a class="fa fa-edit" href="sistema.php?url=cad_diario&codigo=<? echo $row['codigo']?>" style="font-size: 150%;"><a></td>
												<td data-title="Excluir"><a class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir exame" style="font-size: 150%; color: red;" href="sistema.php?url=cad_diario&codigo=<? echo $row['codigo']?>&excluir=1"><a></td>
                                            </tr>
										  <? }
										  $res4->close();
										  ?>
                                        </tbody>
                                    </table>
                                  </div>
								</div>
				               </div>
								<?}
								if($_GET['frequencia'] == 1){?>
								<div class="col-md-12">
					       <div class="component-box">
							<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							  <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nome</th>
												<th>Presença</th>
												<th>Faltas no Periodo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  
										  $data = date('Y');
										  $sql5 = "select diario.codigo as coddiario,diario.data,matriculas.codigo,matriculas.nome,turmas.descricao as turma,matriculas.foto from diario 
										  inner JOIN turmas on turmas.codigo=diario.turma 
										  inner join materias on materias.codigo=diario.materia 
										  inner join periodo on periodo.codigo=diario.periodo
										  inner join matriculas on matriculas.turma=diario.turma
										  where diario.codigo='".$_GET['codigo']."' and matriculas.status=1 and diario.usuario='".$_SESSION['usuario']."' and diario.turma='".$turma."';";
										  $res5 = mysqli_query($db,$sql5); 
										  $a = 0;
										  while($row = mysqli_fetch_array($res5))
										  {
												 
										  ?>
                                            <tr>
                                                <td><? if(Empty($row['foto'])){echo '<img style="width: 40px" src="template/images/semfoto.png">';}else{echo "TESTE 2";}?></td>
                                                <td><? echo $row['nome'];?></td>
												<td><? 
												     
													 $SQL = "SELECT codigo,falta FROM frequencia where matricula=".$row['codigo']." and diario=".$_GET['codigo']."";
													 $RES6 = mysqli_query($db,$SQL);
												     $rows1 = mysqli_fetch_array($RES6);
													 //$p = 0;
													 //while($rows3 = mysqli_fetch_array($RES))
													 //{
													 //	 $p = 1;
													 //}
													 
													 ?>
												      <!--<input type="checkbox" name="check[]" value="<? echo $row['codigo'];?>" <? if($rows1['falta'] == "0"){?> checked <? }else{ ?> <? }?> OnClick="javascript: ajaxLoader('?br=atu_presenca&check='+ this.checked +'&data=<? echo $row['data'];?>&matricula=<? echo $row['codigo'];?>&diario=<? echo $_GET['codigo'];?>&disciplina=<? echo $_GET['disciplina'];?>&periodo=<? echo $periodo; ?>&ap=1','<? echo $row['codigo'];?>','GET');" data-color="#009efb" />-->
													  
													  <input type="checkbox" name="check[]" value="<? echo $row['codigo'];?>" <? if($rows1['falta'] == "0"){?> checked <? }else{ ?> <? }?> data-color="#009efb" />
													  
													  
													  
													  </td>
												<td><div id="<? echo $row['codigo'];?>">
												<? 
											         $ano = date('Y');
													 echo $SQL7 = "SELECT falta as qtd FROM frequencia where matricula=".$row['codigo']." and disciplina=".$disciplina." and periodo=".$periodo." and falta=1 and YEAR(data)=$ano ";
													 $RES7 = mysqli_query($db,$SQL7);
													 
													 $total = 0;
													 $n = 1;
												     $y = 0;	
													 
													 while($rows2 = mysqli_fetch_assoc($RES7))
													 {
														 //echo "The number is: $n <br>";
														 //$total = $rows2['qtd'];
														 $y = 1;
														 
														 $total = $n++;
													 }
													 
													 if($y == 1)
													 {
														echo $total;
													 }
													 else
													 {
													    echo "0";
													 }
													 
													 //$RES6->close();
													 //$RES7->close();
													 
												?></div>
												</td>
                                            </tr>
										  <? $a = 1;} 
										  if($a == 0)
										  {
											  echo "<tr>
   											       <td>Nenhum Aluno cadastrado na turma</td>
   											       <td></td>
													  <td></td>
													  <td></td>
   											         </tr>";
										  }
										  //$res5->close();
										  ?>
                                        </tbody>
                                    </table>
                                </div></div></div>
								<?}?>
								<? if($_GET['nota'] == 1){?>
								<script>
								
								function runScript(e,) {
								  
								  if (e.keyCode == 13) {
									
									
								  }
								}
								</script>
								<div class="col-md-12">
					       <div class="component-box">
							<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							  <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nome</th>
												<th>Nota</th>
												<th>Nota final</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  
										  $data = date('Y');
										  $sql8 = "select diario.codigo as coddiario,diario.data,matriculas.codigo,matriculas.nome,turmas.descricao as turma,matriculas.foto from diario 
										  inner JOIN turmas on turmas.codigo=diario.turma 
										  inner join materias on materias.codigo=diario.materia 
										  inner join periodo on periodo.codigo=diario.periodo
										  inner join matriculas on matriculas.turma=diario.turma
										  where diario.codigo='".$_GET['codigo']."' and matriculas.status=1 and diario.usuario='".$_SESSION['usuario']."';";
										  $res8 = mysqli_query($db,$sql8); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res8))
										  {
												 
										  ?>
                                            <tr>
                                                <td><? if(Empty($row['foto'])){echo '<img style="width: 40px" src="template/images/semfoto.png">';}else{echo "TESTE 2";}?></td>
                                                <td><? echo $row['nome'];?></td>
												<td><? 
												     
													 $SQL9 = "SELECT codigo,nota,falta FROM frequencia where matricula='".$row['codigo']."' and diario='".$_GET['codigo']."'";
													 $RES9 = mysqli_query($db,$SQL9);
												     $rows1 = mysqli_fetch_array($RES9);
													 
													 $falta = $rows1['falta'];
													 $valor = number_format($rows1['nota'], 2, ".", ".");
													 
													 if($falta == "0")
													 {
													 ?>
												      
													  <!--<input type="text" class="form-control" name="<? echo $row['codigo'];?>" value="<? echo $valor;?>" onKeypress="javascript: ajaxLoader('?br=atu_nota&nota='+ this.value +'&data=<? echo $row['data'];?>&matricula=<? echo $row['codigo'];?>&diario=<? echo $_GET['codigo'];?>&disciplina=<? echo $_GET['disciplina'];?>&periodo=<? echo $periodo; ?>&ap=1','<? echo $row['codigo'];?>','GET'); return(moeda(this,'.',',',event));">-->
													  <input type="text" class="form-control" name="nota" id="nota<? echo $rows1['codigo'];?>" value="<? echo $valor;?>" data-mask="#.##0.00" data-mask-reverse="true" onkeydown="javascript: if(event.key === 'Enter'){ ajaxLoader('?br=atu_nota&nota='+ this.value +'&codigo=<? echo $rows1['codigo'];?>&ap=1','<? echo $rows1['codigo'];?>','GET');}" maxlength="5">
													 <?}
													   else
													   { 
												          echo "Faltou";
													   }
													   ?>
													  
													  </td>
												<td><div id="<? echo $rows1['codigo'];?>">
												<? 
											         
													 $SQL10 = "SELECT sum(nota) as qtd FROM frequencia where matricula='".$row['codigo']."' and disciplina='".$disciplina."' and periodo='".$periodo."' and falta=0 and diario=".$row['coddiario']."";
													 $RES10 = mysqli_query($db,$SQL10);
												     $rows2 = mysqli_fetch_array($RES10);
													 echo $rows2['qtd'];
												?></div>
												</td>
                                            </tr>
										  <? $b = 1;} if($b == 0){
											  echo "<tr>
   											       <td>Nenhum Aluno cadastrado na turma</td>
   											       <td></td>
													  <td></td>
													  <td></td>
   											         </tr>";
										  }
										  //$res8->close();
										  //$RES9->close();
										  //$RES10->close();
										  ?>
                                        </tbody>
                                    </table>
                                </div> </div> </div>
								<?}?>
								</form>
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Atenção!</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="gravarpresenca"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <a href="sistema.php?url=cad_diario&fechar=1" class="btn btn-primary">Continuar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Atenção!</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Você tem certeza que gostaria de fechar o Bimestre de <? echo $mdescricao; ?></h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <a href="sistema.php?url=cad_diario&fechar=1" class="btn btn-primary">Continuar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
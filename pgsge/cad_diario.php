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

if(@$_GET['ap'] == "1")
{
	$x = 0;
	$RES1 = mysqli_query($db,"SELECT * FROM diario where sistema='".$_SESSION['sistema']."' and turma='".$_GET['turma']."' and materia='".$_GET['disciplina']."' and periodo='".$_GET['periodo']."' and data='".revertedata($_GET['txtdata'])."' and conteudo like '%'".$_GET['conteudo']."'%'");
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
	   $SQL2 = "INSERT into diario(sistema,usuario,turma,materia,periodo,video,data,conteudo,texto,tipo) values('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$_GET['turma']."','".$_GET['disciplina']."','".$_GET['periodo']."','".$_GET['video']."','".revertedata($_GET['txtdata'])."','".$_GET['conteudo']."','".$_GET['txtobs']."','".$_GET['tipo']."')";
	   $RES2 = mysqli_query($db,$SQL2);
	   
	   if($RES2)
	   {
		   //print("<script>window.alert('Conteudo Cadastrada com sucesso...')</script>");
		   
		   $RES1 = mysqli_query($db,"SELECT max(diario.codigo) as codigo FROM diario inner join turmas_professor on turmas_professor.turma=diario.turma where turmas_professor.usuario='".$_SESSION['usuario']."'");
		   $row = mysqli_fetch_array($RES1);
		   
		   $codigo = $row['codigo'];
		   
		   print("<script>
		      requestPage('?br=cad_diario&codigo=".$row['codigo']."','conteudo','GET');
		   </script>");
	   }
	   else
	   {
		   print('<script>
         swal({   
            title: "Atenção!",   
            text: "Ocorreu um erro, Entre em contato com Suporte! MSG-2",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
	   }
	   
	   //$RES1->close();
	   //$RES2->close();
	}
}
else if(@$_GET['ap'] == "2")
{
	$SQL1 = "UPDATE diario SET turma='".$_GET['turma']."',materia='".$_GET['disciplina']."',periodo='".$_GET['periodo']."', conteudo='".$_GET['conteudo']."',data='".revertedata($_GET['txtdata'])."', texto='".$_GET['txtobs']."',tipo='".$_GET['tipo']."' where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print('<script>
         swal({   
            title: "Atenção!",   
            text: "Atualizado com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
		print("<script>
		      //requestPage('?br=cad_diario&codigo=".$row['codigo']."','conteudo','GET');
		   </script>");
	}
	else
	{
		print('<script>
         swal({   
            title: "Atenção!",   
            text: "Ocorreu um erro, Entre em contato com Suporte! MSG-3",   
            timer: 1000,   
            showConfirmButton: false 
        });
        </script>');
		print("<script>
		      //requestPage('?br=cad_diario&codigo=".$row['codigo']."','conteudo','GET');
		   </script>");
	}
}


$turma = "";
$disciplina = "";
$periodo = "";
$data = "";
$conteudo = "";
$texto = "";
$video = "";
$pdescricao = "";
$tdescricao = "";
$mdescricao = "";
$tipo = "";


if(isset($_GET['codigo']))
{
	$codigo = $_GET['codigo'];
}
	 
if(isset($codigo))
{
	
	$SQL = "SELECT diario.codigo, diario.tipo,diario.turma,diario.video,diario.materia,diario.periodo,diario.data,diario.conteudo,diario.texto,materias.descricao as mdescricao,turmas.descricao as tdescricao,periodo.descricao as pdescricao FROM diario 
	inner join materias on materias.codigo=diario.materia 
	inner join turmas on turmas.codigo=diario.turma
	inner join periodo on periodo.codigo=diario.periodo
	where diario.sistema='".$_SESSION['sistema']."' and diario.codigo='".$codigo."'";
	
	$sucesso = mysqli_query($db,$SQL);
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $codigo = $row['codigo'];
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
		 
		 $_SESSION['turma'] = $turma;
		 $_SESSION['disciplina'] = $disciplina;
		 $_SESSION['periodo'] = $periodo;
		 
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
	
	//$sucesso->close();
}

?>	
<script>

function psdiario(texto)
{
	var ano = document.getElementById('ano').value;
	
	requestPage2('?br=atu_diario&pesquisa='+ texto +'&ano='+ ano +'&load=1','listdiario','GET');
}

function psano(ano)
{
	var texto = document.getElementById('pesquisa').value;
	
	requestPage2('?br=atu_diario&pesquisa='+ texto +'&ano='+ ano +'&load=1','listdiario','GET');
}

function excluir(codigo)
{
	swal({   
            title: "Atenção!",   
            text: "Você certeza que gostaria de excluir este conteúdo?",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, Gravar!",
            cancelButtonText: "Não, Cancelar!", 			
            closeOnConfirm: true 
        }, function()
		{  
	        if(codigo == null)
	        {
		
	        }
	        else
	        {
	        	  requestPage('?br=atu_diario&ap=1&codigo='+ codigo +'&load=1','listdiario','GET');
	        }
        });
}

$('.sge-t-gravar').on('click',function()
{
    var turma = document.getElementById('turma').value;
	var disciplina = document.getElementById('disciplina').value;
	var periodo = document.getElementById('periodo').value;
	var video = document.getElementById('video').value;
	var txtdata = document.getElementById('txtdata').value;
	var conteudo = document.getElementById('titulo').value;
	var tipo = document.getElementById('tipo').value;
	var txtobs = document.getElementById('txtobs').value;

	if(turma == "")
	{
		swal('Atenção', 'Preencha o campo Turma');
		//window.alert('teste');
	}
	else if(disciplina == "")
	{
		swal('Atenção', 'Preencha o campo Disciplina');
		//window.alert('teste');
	}
	else if(periodo == "")
	{
		swal('Atenção', 'Preencha o campo Periodo');
		//window.alert('teste');
	}
	else if(txtdata == "")
	{
		swal('Atenção', 'Preencha o campo Data');
		//window.alert('teste');
	}
	else if(conteudo == "")
	{
		swal('Atenção', 'Preencha o campo conteúdo');
		//window.alert('teste');
	}
	else if(tipo == "")
	{
		swal('Atenção', 'Preencha o campo Tipo');
		//window.alert('teste');
	}
    else
	{
		<?if(isset($_GET['codigo'])){?>
		   requestPage('?br=cad_diario&turma='+ turma +'&disciplina='+ disciplina +'&periodo='+ periodo +'&video='+ video +'&txtdata='+ txtdata +'&conteudo='+ conteudo +'&tipo='+ tipo +'&txtobs='+ txtobs +'&codigo=<?=$codigo?>&ap=2','conteudo','GET');
		<?}else{?>
		   requestPage('?br=cad_diario&turma='+ turma +'&disciplina='+ disciplina +'&periodo='+ periodo +'&video='+ video +'&txtdata='+ txtdata +'&conteudo='+ conteudo +'&tipo='+ tipo +'&txtobs='+ txtobs +'&ap=1','conteudo','GET');
		<?}?>
	}		
});


$("#check[]").on('change', function() {
  if ($(this).is(':checked')) 
  {
    $(this).attr('value', 'true');
	alert('TESTE 1');
  } else {
    $(this).attr('value', 'false');
	alert('TESTE 2');
  }
  
   //$('#checkbox-value').text($('#checkbox1').val());
});

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
			                    
								<div class="m-t-40 row">
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
                                <input type="text" name="video" id="video" class="form-control" autocomplete="off" value="<? if(!Empty($_GET['codigo'])){ echo $video; } ?>">
								</div>
								<div class="form-group col-md-2 m-t-20"><label><b>Data :</b></label>
                                <input type="text" name="txtdata" id="txtdata" class="form-control"  value="<? if(!Empty($_GET['codigo'])){ echo formatodatahora($data); } ?>" placeholder="dd/mm/yyyy"  data-mask="00/00/0000" data-mask-clearifnotmatch="true"  required="required">
								</div>
								
								<div class="form-group col-md-5 m-t-20"><label><b>Conteudo Lecionado :</b></label>
                                <input type="text" name="titulo" class="form-control"  autocomplete="off" id="titulo" value="<? if(!Empty($_GET['codigo'])){ echo $conteudo;} ?>" placeholder="" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Tipo :</label>
								<select name="tipo" id="tipo" class="form-control" style="width: 100%; height:36px;" required="required">
                                      <option value="">Selecionar Tipo</option>
                                      <option value="1" <? if(1 == $tipo and isset($_GET['codigo'])){ echo "selected"; } ?>>Aula Normal</option>
									  <option value="2" <? if(2 == $tipo and isset($_GET['codigo'])){ echo "selected"; } ?>>Avaliação</option>
                                </select>
								</div>
								<div class="form-group col-md-12 m-t-20"><label><b>Texto :</b></label>                               
								<textarea class="textarea_editor form-control" name="txtobs"  autocomplete="off" id="txtobs" rows="10" placeholder="Escreva aqui ..." required="required"><? if(!Empty($_GET['codigo'])){ echo $texto;} ?></textarea>
								</div>
								<script>
								$('#txtdata').mask('00/00/0000', {'translation': {0: {pattern: /[0-9*]/}}});
								
								jQuery('#txtdata').datepicker({
									format: 'dd/mm/yyyy',
								    autoclose: true,
								    todayHighlight: true
								});
								$(function() {

								    $('.textarea_editor').wysihtml5();


								 });
								 
								 
								</script>
								<div class="form-group col-md-12 m-t-20">
								<br>
								<script>
								$('.sge-t-dnovo').on('click',function()
								{	
								   //b_menuslow();
								   requestPage('?br=cad_diario','conteudo','GET');
								});
								
								function sg_diario(codigo)
								{
									requestPage('?br=cad_diario&codigo='+ codigo +'','conteudo','GET');
								}
								
								</script>
								<button type="button" class="btn btn-info sge-t-gravar"><i class="fa fa-plus-circle"></i> Gravar </button>
								<button class="btn btn-info sge-t-dnovo"><i class="fa fa-plus-circle"></i> Novo</button>
								</div>
								<? if(Empty($_GET['frequencia']) && Empty($_GET['nota']) && Empty($codigo) && Empty($_GET['cadastro'])){?>
								<div class="form-group col-md-12 m-t-20">
                                <input type="text" name="pesquisa" id="pesquisa" onkeyup="psdiario(this.value);" class="form-control"  autocomplete="off"  value="" placeholder="Pesquisar conteúdo">
								<select name="ano" id="ano" class="form-control btnadd-us" onchange="psano(this.value);" style="width: 30%; height: calc(2.3em + .75rem + 2px) !important;" required="required">
                                      <option value="">Escolher Ano</option>
                                      <option value="2020" <? if(2020 == $ano){ echo "selected"; } ?>>2020</option>
									  <option value="2021" <? if(2021 == $ano){ echo "selected"; } ?>>2021</option>
                                </select>
								</div>
								<script>
								//window.onload = function ()
								//{
									requestPage2('?br=atu_diario&ano=<?=$ano;?>&load=1','listdiario','GET');
								//}
								</script>
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
                                        </tbody>
                                    </table>
                                  </div>
								</div>
				               </div>
								<?} 
								//else
								//{
								//	echo '<div id="listdiario"> </div>';
								//}
								if(@$_GET['frequencia'] == 1 || !Empty($codigo) and Empty($_GET['nota'])){?>
								<div class="col-md-12">
					            <div class="component-box">
								<script>
								//window.onload = function ()
								//{
								     requestPage2('?br=atu_diario&codigo=<?=$codigo;?>&disciplina=<?=$disciplina;?>&periodo=<?=$periodo;?>&turma=<?=$turma;?>&load=2','listpresenca','GET');
								//}
								</script>
							    <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							    <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nome</th>
												<th>Presença</th>
												<th>Nota</th>
												<th>T. Faltas</th>
												<th>N. Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listpresenca">
                                        </tbody>
                                    </table>
                                </div></div></div>
								<?}?>
								<? if(@$_GET['nota'] == 1){?>
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
										  where diario.sistema='".$_SESSION['sistema']."' and diario.codigo='".$_GET['codigo']."' and matriculas.status in (0,1,3) and diario.usuario='".$_SESSION['usuario']."';";
										  $res8 = mysqli_query($db,$sql8); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res8))
										  {
												 
										  ?>
                                            <tr>
                                                <td data-title="Foto"><? if(Empty($row['foto'])){echo '<img style="width: 40px" src="template/images/semfoto.png">';}else{echo "TESTE 2";}?></td>
                                                <td data-title="Nome"><? echo $row['nome'];?></td>
												<td data-title="Nota"><? 
												     
													 $SQL9 = "SELECT codigo,nota,falta FROM frequencia where sistema='".$_SESSION['sistema']."' and matricula='".$row['codigo']."' and diario='".$_GET['codigo']."'";
													 $RES9 = mysqli_query($db,$SQL9);
												     $rows1 = mysqli_fetch_array($RES9);
													 
													 $falta = $rows1['falta'];
													 $valor = number_format($rows1['nota'], 2, ".", ".");
													 
													 if($falta == "0")
													 {
													 ?>
												      
													  <!--<input type="text" class="form-control" name="<? echo $row['codigo'];?>" value="<? echo $valor;?>" onKeypress="javascript: ajaxLoader('?br=atu_nota&nota='+ this.value +'&data=<? echo $row['data'];?>&matricula=<? echo $row['codigo'];?>&diario=<? echo $_GET['codigo'];?>&disciplina=<? echo $_GET['disciplina'];?>&periodo=<? echo $periodo; ?>&ap=1','<? echo $row['codigo'];?>','GET'); return(moeda(this,'.',',',event));">-->
													  <input type="text" class="form-control" name="nota" id="nota<? echo $rows1['codigo'];?>" value="<? echo $valor;?>" data-mask="#.##0.00" data-mask-reverse="true" onkeydown="javascript: ajaxLoader('?br=atu_nota&nota='+ this.value +'&codigo=<? echo $rows1['codigo'];?>&ap=1','<? echo $rows1['codigo'];?>','GET'); " maxlength="5">
													 <?}
													   else
													   { 
												          echo "Faltou";
													   }
													   ?>
													  
													  </td>
												<td data-title="Nota final"><div id="<? echo $rows1['codigo'];?>">
												<? 
											         
													 $SQL10 = "SELECT sum(nota) as qtd FROM frequencia where sistema='".$_SESSION['sistema']."' and matricula='".$row['codigo']."' and disciplina='".$disciplina."' and periodo='".$periodo."' and falta=0 and diario=".$row['coddiario']."";
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
								</div>
                            </div>
                        </div>
					</div>
				</div>
	
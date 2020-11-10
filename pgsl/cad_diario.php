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
	$SQL = "SELECT diario.turma,diario.materia,diario.periodo,diario.data,diario.conteudo,diario.texto,materias.descricao as mdescricao,turmas.descricao as tdescricao,periodo.descricao as pdescricao FROM diario 
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
		 $pdescricao = $row['pdescricao'];
		 $tdescricao = $row['tdescricao'];
		 $mdescricao = $row['mdescricao'];
		 
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
	   $SQL1 = "INSERT into diario(turma,materia,periodo,data,conteudo,texto) values('".$_POST['turma']."','".$_POST['disciplina']."','".$_POST['periodo']."','".revertedata($_POST['txtdata'])."','".$_POST['conteudo']."','".$_POST['txtobs']."')";
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
	$SQL1 = "UPDATE diario SET conteudo='".$_POST['conteudo']."', texto='".$_POST['txtobs']."' where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Atualizado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

if($_GET['fechar'] == "3")
{
	$SQL1 = "UPDATE diario SET status=0 where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Bimestre fechado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
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
			   matricula = matriculas.join(", ");
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
					
			var nota = notas.join(", ");
			
		    ajaxLoader('?br=atu_nota&notas='+ nota +'&data=<? echo $data;?>&diario=<? echo $_GET['codigo'];?>&disciplina=<? echo $_GET['disciplina'];?>&periodo=<? echo $periodo; ?>&gravar=1','gravarpresenca','GET');
			
	});
}
</script>	
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
							    
								
							    <? if(Empty($_GET['codigo']) and Empty($_GET['frequencia']) and Empty($_GET['nota']) or Empty($_GET['codigo']) and Empty($_GET['nota']) and Empty($_GET['frequencia']) or !Empty($_GET['codigo']) and Empty($_GET['frequencia']) and Empty($_GET['nota']) or !Empty($_GET['codigo']) and Empty($_GET['nota']) and Empty($_GET['frequencia'])) { ?>
                                <?
								if(Empty($_GET['codigo']) and Empty($_GET['frequencia']))
								{  $action = "iniciado.php?url=cad_diario&ap=1";}
							    if(!Empty($_GET['codigo']))
								{  $action = "iniciado.php?url=cad_diario&codigo=".$_GET['codigo']."&ap=2";}
								
								?>
								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de Aulas";?></h4>
								<form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>">
								<div class="form-group col-md-4 m-t-20"><label>Turma :</label>
								<select name="turma" id="turma" style="width: 100%; height:36px;" class="select2 form-control custom-select" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql = "select * from turmas";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($row['codigo']==$turma){ echo " selected"; }?>><? echo $row['descricao'];?></option>
										  <? } ?>
                                </select>
								</div>
								<div class="form-group col-md-4 m-t-20"><label>Diciplina :</label>
								<select name="disciplina" id="disciplina" style="width: 100%; height:36px;" class="select2 form-control custom-select" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql = "select * from materias";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($row['codigo']==$disciplina){ echo " selected"; }?>><? echo $row['descricao'];?></option>
										  <? } ?>
                                </select>
								</div>
								<div class="form-group col-md-4 m-t-20"><label>Periodo :</label>
								<select name="periodo" id="periodo" style="width: 100%; height:36px;" class="select2 form-control custom-select" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql = "select * from periodo";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($row['codigo']==$periodo){ echo " selected"; }?>><? echo $row['descricao'];?></option>
										  <? } ?>
                                </select>
								</div>
								<div class="form-group col-md-2 m-t-20"><label><b>Data :</b></label>
                                <input type="text" name="txtdata" id="txtdata" class="form-control"  value="<? if(!Empty($_GET['codigo'])){ echo formatodatahora($data); } ?>" placeholder="dd/mm/yyyy"  data-mask="99/99/9999"  required="required">
								</div>
								<div class="form-group col-md-5 m-t-20"><label><b>Conteudo Lecionado :</b></label>
                                <input type="text" name="conteudo" class="form-control" id="conteudo" value="<? if(!Empty($_GET['codigo'])){ echo $conteudo;} ?>" placeholder="" required="required">
								</div>
								<div class="form-group col-md-12 m-t-20"><label><b>Texto :</b></label>                               
								<textarea class="textarea_editor form-control" name="txtobs" id="txtobs" rows="10" placeholder="Escreva aqui ..." required="required"><? if(!Empty($_GET['codigo'])){ echo $texto;} ?></textarea>
								</div>
								<? }else{ ?>
								<h4>Turma : <? echo $tdescricao;?></h4>
								<h4>Disciplina : <? echo $mdescricao;?></h4>
								<h4>Bimestre : <? echo $pdescricao;?></h4>
								<h4>Conteudo : <? echo $conteudo;?></h4>
								<? } ?>
								<div class="form-group col-md-12 m-t-20">
								<br>
								<div class="form-actions">
								<? if(Empty($_GET['codigo'])){?>
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> Cadastrar </button>
								<a class="btn btn-info" href="iniciado.php?url=cad_diario"><i class="fa fa-plus-circle"></i> Novo</a>
								<?}else{?>
								<a class="btn btn-info" href="iniciado.php?url=cad_diario&codigo=<? echo $_GET['codigo']; ?>&excluir=1"><i class="fa fa-plus-circle"></i> Excluir</a>
								<? if(Empty($_GET['frequencia']) && Empty($_GET['nota'])){?>
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> Gravar </button>
								<a class="btn btn-info" href="iniciado.php?url=cad_diario<?if(Empty($_GET['codigo'])){?>&codigo=<? echo $_GET['codigo']; ?><?}?>"><i class="fa fa-plus-circle"></i> Voltar</a>
								<? }else{ ?>
								<a class="btn btn-info" href="iniciado.php?url=cad_diario<?if(!Empty($_GET['codigo'])){?>&codigo=<? echo $_GET['codigo']; ?><?}?>"><i class="fa fa-plus-circle"></i> Voltar</a>
								<?if(!Empty($_GET['frequencia']) and Empty($_GET['nota'])){?>
								<a class="btn btn-info" href="javascript: WEB(0)" onClick="gravar();"><i class="fa fa-plus-circle"></i> Gravar</a>
								<? }?><?}?>
								
								
								<?}?>
								<? if(!Empty($_GET['codigo']) and Empty($_GET['frequencia']) && Empty($_GET['nota'])) { ?>
								<a class="btn btn-info" href="iniciado.php?url=cad_diario&codigo=<? echo $_GET['codigo']; ?>&frequencia=1&disciplina=<? echo $disciplina;?>"><i class="fa fa-plus-circle"></i> Registrar Frequencia</a>
								<? } ?>
								<? if(!Empty($_GET['codigo']) and Empty($_GET['nota']) && Empty($_GET['frequencia'])) { ?>
								<a class="btn btn-info" href="iniciado.php?url=cad_diario&codigo=<? echo $_GET['codigo']; ?>&nota=1&disciplina=<? echo $disciplina;?>"><i class="fa fa-plus-circle"></i> Inserir Nota</a>
								<? } ?>
								<? if(!Empty($_GET['codigo']) and !Empty($_GET['nota']) && Empty($_GET['frequencia'])) { ?>
								<a class="btn btn-info" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle"></i> Fechar Bimestre</a>
								<? } ?>
								
								</div></div>
								<? if(Empty($_GET['codigo']) && Empty($_GET['frequencia']) && Empty($_GET['nota'])){?>
                                <div class="form-group col-md-12 m-t-20">
                                    <table class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Turma</th>
												<th>Disciplina</th>
												<th>Conteudo</th>
												<th>Data</th>
												<th>X</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  
										  $data = date('Y');
										  $sql = "select diario.codigo,diario.conteudo,turmas.descricao as a,materias.descricao as b,diario.conteudo as c,diario.data from diario 
										  inner JOIN turmas on turmas.codigo=diario.turma 
										  inner join materias on materias.codigo=diario.materia 
										  inner join periodo on periodo.codigo=diario.periodo where YEAR(data)=$data";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
                                                <td><? echo $row['a'];?></td>
												<td><? echo $row['b'];?></td>
												<td><? echo $row['c'];?></td>
												<td><? echo formatodatahora($row['data']);?></td>
												<td><a class="fa fa-edit" href="iniciado.php?url=cad_diario&codigo=<? echo $row['codigo']?>" style="font-size: 150%;"><a></td>
												<td><a class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir exame" style="font-size: 150%; color: red;" href="iniciado.php?url=cad_diario&codigo=<? echo $row['codigo']?>&excluir=1"><a></td>
                                            </tr>
										  <? } ?>
                                        </tbody>
                                    </table>
                                </div>
								<?}
								if($_GET['frequencia'] == 1){?>
								<div class="form-group col-md-12 m-t-20">
                                    <table class="display nowrap table table-hover table-striped table-bordered">
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
										  $sql = "select diario.data,matriculas.codigo,matriculas.nome,turmas.descricao as turma,matriculas.foto from diario 
										  inner JOIN turmas on turmas.codigo=diario.turma 
										  inner join materias on materias.codigo=diario.materia 
										  inner join periodo on periodo.codigo=diario.periodo
										  inner join matriculas on matriculas.turma=diario.turma
										  where diario.codigo='".$_GET['codigo']."' and matriculas.status=1";
										  $res = mysqli_query($db,$sql); 
										  $a = 0;
										  while($row = mysqli_fetch_array($res))
										  {
												 
										  ?>
                                            <tr>
                                                <td><? if(Empty($row['foto'])){echo '<img style="width: 40px" src="template/img/semfoto.png">';}else{echo "TESTE 2";}?></td>
                                                <td><? echo $row['nome'];?></td>
												<td><? 
												     
													 $SQL = "SELECT codigo,falta FROM frequencia where matricula=".$row['codigo']." and diario=".$_GET['codigo']."";
													 $RES = mysqli_query($db,$SQL);
												     $rows1 = mysqli_fetch_array($RES);
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
													 $SQL = "SELECT falta as qtd FROM frequencia where matricula=".$row['codigo']." and disciplina=".$disciplina." and periodo=".$periodo." and falta=1 and YEAR(data)=$ano";
													 $RES = mysqli_query($db,$SQL);
													 
													 $total = 0;
													 $n = 1;
												     $y = 0;	
													 
													 while($rows2 = mysqli_fetch_assoc($RES))
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
													 
												?></div>
												</td>
                                            </tr>
										  <? $a = 1;} if($a == 0){
											  echo "<tr>
   											       <td>Nenhum Aluno cadastrado na turma</td>
   											       <td></td>
													  <td></td>
													  <td></td>
   											         </tr>";
										  }?>
                                        </tbody>
                                    </table>
                                </div>
								<?}?>
								<? if($_GET['nota'] == 1){?>
								<script>
								
								function runScript(e,) {
								  
								  if (e.keyCode == 13) {
									
									
								  }
								}
								</script>
								<div class="form-group col-md-12 m-t-20">
                                    <table class="display nowrap table table-hover table-striped table-bordered">
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
										  $sql = "select diario.data,matriculas.codigo,matriculas.nome,turmas.descricao as turma,matriculas.foto from diario 
										  inner JOIN turmas on turmas.codigo=diario.turma 
										  inner join materias on materias.codigo=diario.materia 
										  inner join periodo on periodo.codigo=diario.periodo
										  inner join matriculas on matriculas.turma=diario.turma
										  where diario.codigo='".$_GET['codigo']."' and matriculas.status=1";
										  $res = mysqli_query($db,$sql); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res))
										  {
												 
										  ?>
                                            <tr>
                                                <td><? if(Empty($row['foto'])){echo '<img style="width: 40px" src="template/img/semfoto.png">';}else{echo "TESTE 2";}?></td>
                                                <td><? echo $row['nome'];?></td>
												<td><? 
												     
													 $SQL = "SELECT codigo,nota,falta FROM frequencia where matricula='".$row['codigo']."' and diario='".$_GET['codigo']."'";
													 $RES = mysqli_query($db,$SQL);
												     $rows1 = mysqli_fetch_array($RES);
													 
													 $falta = $rows1['falta'];
													 $valor = number_format($rows1['nota'], 2, ".", ".");
													 
													 if($falta == "0")
													 {
													 ?>
												      
													  <!--<input type="text" class="form-control" name="< echo $row['codigo'];?>" value="< echo $valor;?>" onKeypress="javascript: ajaxLoader('?br=atu_nota&nota='+ this.value +'&data=< echo $row['data'];?>&matricula=< echo $row['codigo'];?>&diario=< echo $_GET['codigo'];?>&disciplina=< echo $_GET['disciplina'];?>&periodo=< echo $periodo; ?>&ap=1','< echo $row['codigo'];?>','GET'); return(moeda(this,'.',',',event));">-->
													  
													  <input type="text" class="form-control" name="nota" id="nota<? echo $rows1['codigo'];?>" value="<? echo $valor;?>" onkeydown="javascript: if(event.key === 'Enter'){ ajaxLoader('?br=atu_nota&nota='+ this.value +'&codigo=<? echo $rows1['codigo'];?>&ap=1','<? echo $rows1['codigo'];?>','GET');}" maxlength="5">
													 <?}else{ echo "Faltou";}?>
													  <script>
													       $("#nota<? echo $rows1['codigo'];?>").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:'.', affixesStay: false});
													  </script>
													  </td>
												<td><div id="<? echo $row['codigo'];?>">
												<? 
											         
													 $SQL = "SELECT sum(nota) as qtd FROM frequencia where matricula='".$row['codigo']."' and disciplina='".$disciplina."' and periodo='".$periodo."' and falta=0";
													 $RES = mysqli_query($db,$SQL);
												     $rows2 = mysqli_fetch_array($RES);
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
										  }?>
                                        </tbody>
                                    </table>
                                </div>
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
                                                <a href="iniciado.php?url=cad_diario&fechar=1" class="btn btn-primary">Continuar</a>
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
                                                <a href="iniciado.php?url=cad_diario&fechar=1" class="btn btn-primary">Continuar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
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
								
								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de Aulas";?></h4>
								
								<form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>">
								
								<? if(!Empty($_GET['codigo'])){?>
								<div class="form-group col-md-12 m-t-20">
								<h4><b>Turma :</b> <? echo $tdescricao;?></h4>
								<h4>Disciplina : <? echo $mdescricao;?></h4>
								<h4>Bimestre : <? echo $pdescricao;?></h4>
								<h4>Conteudo : <? echo $conteudo;?></h4>
								</div>
								<? } ?>
								
                                <div class="input-group col-md-5 m-t-20">
                                       <input type="text" class="form-control" <? if(isset($_GET['codigo'])){ ?> placeholder="Conteúdo : <? echo $conteudo; ?>" disabled <? } ?> required="" aria-invalid="false"> 
                                       <div class="input-group-append">
                                     <button class="btn btn-info" type="button" data-toggle="modal" data-target="#usuarioss"><i class="fa fa-search"></i></button>
                                </div> 
                                <div class="help-block"></div></div>
								<? if(!Empty($_GET['codigo'])){?>
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<a class="btn btn-info" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle"></i> Fechar Bimestre</a>
								<a class="btn btn-info" href="iniciado.php?url=<?=$_GET['url'];?>"><i class="fa fa-plus-circle"></i> Novo</a>
								</div></div>
								
							
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
												      
													  <!--<input type="text" class="form-control" name="<? echo $row['codigo'];?>" value="<? echo $valor;?>" onKeypress="javascript: ajaxLoader('?br=atu_nota&nota='+ this.value +'&data=<? echo $row['data'];?>&matricula=<? echo $row['codigo'];?>&diario=<? echo $_GET['codigo'];?>&disciplina=<? echo $_GET['disciplina'];?>&periodo=<? echo $periodo; ?>&ap=1','<? echo $row['codigo'];?>','GET'); return(moeda(this,'.',',',event));">-->
													  <input type="text" class="form-control" name="nota" value="<? echo $valor;?>" onkeypress="return(moeda(this,'.','.',event));" onkeydown="javascript: if(event.key === 'Enter'){ ajaxLoader('?br=atu_nota&codigo=<? echo $rows1['codigo'];?>&nota='+ this.value +'&data=<? echo $row['data'];?>&matricula=<? echo $row['codigo'];?>&diario=<? echo $_GET['codigo'];?>&disciplina=<? echo $_GET['disciplina'];?>&periodo=<? echo $periodo; ?>&ap=1','<? echo $row['codigo'];?>','GET');}">
													 <?}else{ echo "Faltou";}?>
													  
													  </td>
												<td><div id="<? echo $row['codigo'];?>">
												<? 
											         if($falta == "0")
													 {
													 $SQL = "SELECT sum(nota) as qtd FROM frequencia where matricula='".$row['codigo']."' and disciplina='".$disciplina."' and periodo='".$periodo."' and falta=0";
													 $RES = mysqli_query($db,$SQL);
												     $rows2 = mysqli_fetch_array($RES);
													 echo $rows2['qtd'];
													 }
													 else
													 {
														 echo "";
													 }
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
								<? } ?>
								</div>
								
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
								
								<div id="usuarioss" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Lista de Conteúdo : </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="form-group col-md-12 m-t-20"><label>Busca:</label>
                                             <input name="user" type="text" class="form-control" onkeyup="javascript: ajaxLoader('?br=listusuarios&pesquisa='+ this.value +'&ap=2','listusuarios','GET');" />
											</div>
											
											<div class="form-group col-md-12 m-t-20" id="listusuarios">
											<table class="display nowrap table table-hover table-striped table-bordered">
											<thead>
											  <tr>
											<th>Codigo</th>
											<th>Conteúdo</th>
											<th>Turmas</th>
											<th>Disciplina</th>
											<th>status</th>
											</tr>
											 </thead>
											   <tbody>
											   <?
											   $data = date('Y');
										       $sql = "select diario.codigo,diario.conteudo,turmas.descricao as a,materias.descricao as b,diario.conteudo as c,diario.data,diario.status from diario 
										       inner JOIN turmas on turmas.codigo=diario.turma 
										       inner join materias on materias.codigo=diario.materia 
										       inner join periodo on periodo.codigo=diario.periodo where YEAR(data)=$data";
											   $res = mysqli_query($db,$sql); 
											   $x = 0;
											   while($row = mysqli_fetch_array($res))
											   {
											   ?>
											   <tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="javascript: window.location='iniciado.php?url=<?=$_GET['url'];?>&codigo=<? echo $row['codigo'];?>';">
											   <td><? echo $row['codigo'];?></td>
											   <td><? echo $row['conteudo'];?></td>
											   <td><? echo $row['a'];?></td>
											   <td><? echo $row['b'];?></td>
											   <td><? Switch($row['status'])
 											         {
											   		   case 0:
											   		     echo '<span class="label label-danger">Fechado</span>';
											   		   break;
											   		   case 1:
											   		     echo '<span class="label label-success">Aberto</span>';
											   		   break;
													   case 2:
											   		     echo '<span class="label label-warning">Pre-ativo</span>';
											   		   break;
											   	   }
											   	   ?></td>
											   </tr>
											   <? $x = 1;
											   }

 											    if($x == 0)
 											    {
											   	 echo "<tr><td>Nenhum resultado encontrado.</td><td></td><td></td><td></td></tr>";
 											   
 											   }
											   ?>
											 </tbody>
											
                                            </table>											 
											</div>
											</div>
											</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
										
                                        <!-- /.modal-content -->
                                    </div>
									
                                    <!-- /.modal-dialog -->
                                </div>
								</form>
                            </div>
                        </div>
					</div>
				</div>
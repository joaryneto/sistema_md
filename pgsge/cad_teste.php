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
	$SQL = "SELECT diario.codigo, diario.tipo,diario.turma,diario.video,diario.materia,diario.periodo,diario.data,diario.conteudo,diario.texto,materias.descricao as mdescricao,turmas.descricao as tdescricao,periodo.descricao as pdescricao FROM diario 
	inner join materias on materias.codigo=diario.materia 
	inner join turmas on turmas.codigo=diario.turma
	inner join periodo on periodo.codigo=diario.periodo
	where diario.sistema='".$_SESSION['sistema']."' and diario.codigo='".$_GET['codigo']."'";
	
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

<? if(!Empty($_GET['frequencia'])){?>
/*function ppresenca(){
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
			   not = nots.join(",");
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
			
			var vdiario = "<? echo $_GET['codigo'];?>";
			var vdisciplina = "<? echo $_GET['disciplina'];?>";
			
		    requestPage('?br=atu_presenca&matricula='+ matricula +'&nots='+ nots +'&data=<? echo $data;?>&diario='+ vdiario +'&disciplina='+ vdisciplina +'&periodo=&gravar=1','gravarpresenca','GET');
			
	});
}*/
<? } ?>

function psdiario(texto)
{
  if(texto == "")
  {
        /* swal({   
            title: "Atenção!",   
            text: "Pesquisa em branco.",   
            timer: 1000,   
            showConfirmButton: false 
        });*/
  }
  else
  {
	  requestPage2('?br=atu_diario&pesquisa='+ texto +'&load=1','listdiario','GET');
  }
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
	        	  requestPage('?br=atu_diario&ap=3&codigo='+ codigo +'&load=1','listdiario','GET');
	        }
        });
}

function gravarrio(sv,codigo)
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
		if(sv == 1)
		{
		   requestPage('?br=atu_diario&turma='+ turma +'&disciplina='+ disciplina +'&periodo='+ periodo +'&video='+ video +'&txtdata='+ txtdata +'&conteudo='+ conteudo +'&tipo='+ tipo +'&txtobs='+ txtobs +'&ap='+ sv +'&codigo='+ codigo +'&load=1','listdiario','GET');
		}
		else
		{
		   requestPage('?br=atu_diario&turma='+ turma +'&disciplina='+ disciplina +'&periodo='+ periodo +'&video='+ video +'&txtdata='+ txtdata +'&conteudo='+ conteudo +'&tipo='+ tipo +'&txtobs='+ txtobs +'&ap='+ sv +'&codigo='+ codigo +'&load=1','modals','GET');
		}
	}		
}


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
								<script>
								window.onload = function ()
								{
									requestPage2('?br=atu_diario&load=3','listdiario','GET');
								}
								</script>
								 <div class="form-group col-md-12 m-t-20">
								 <button type="button" class="btn btn-info c_gravar" onClick="requestPage2('?br=atu_diario&load=3','listdiario','GET');"><i class="fa fa-plus-circle"></i> Carregar</button>
                                 </div>
								 <div class="col-md-12">
					              <div class="component-box">
							       <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view" id="listdiario">
                                  </div>
								</div>
				               </div>
							 </form>
                            </div>
                        </div>
					</div>
				</div>
	
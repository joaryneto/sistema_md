<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$_SESSION['menu99'] == false)
{
   //print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   //print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

?>		

<?
if($_GET['modal'] == 1) 
{ 

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$inputb['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM matriculas where sistema='".$_SESSION['sistema']."' and nome like '%".$inputb['nome']."%';'";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print('
		<script>
		swal({   
 			   title: "Atenção!",   
 			   text: "Aluno já foi cadastrada, escolha outro.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
	else
	{
	   $SQL1 = "INSERT into matriculas(sistema,matricula,nome,estado,cidade,ensino,turma,status) values('".$_SESSION['sistema']."','".$_SESSION['matricula']."','".$_GET['nome']."','".$_GET['estado']."','".$_GET['cidade']."','".$_GET['ensino']."','".$_GET['turma']."','".$_GET['situacao']."');";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $SQL2 = "INSERT into usuarios(sistema,login,senha,matricula,nome,tipo,status) values('".$_SESSION['sistema']."','".$_SESSION['matricula']."','".$_SESSION['matricula']."','".$_SESSION['matricula']."','".$_GET['nome']."',1,1);";
	   $sucesso = mysqli_query($db,$SQL2);
	   
	   if($sucesso)
	   {
		   print('
		   <script>
		   swal({   
 			   title: "Info",   
 			   text: "Gravado com sucesso.",   
 			   timer: 1000,   
 			   showConfirmButton: false 
		   });
		   </script>');
	   }
	   else
	   {
		   print('
		<script>
		swal({   
 			   title: "Atenção!",   
 			   text: "Ocorreu um erro, Entre em contato com Suporte! MSG-3",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	   }
	}
}
else if(@$inputb['ap'] == "2")
{
	$SQL1 = "UPDATE matriculas SET nome='".$_GET['nome']."',estado='".$_GET['estado']."',cidade='".$_GET['cidade']."',ensino='".$_GET['ensino']."',turma='".$_GET['turma']."',status='".$_GET['situacao']."' where matricula='".$_GET['codigo']."';";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print('
		<script>
		swal({   
 			   title: "Info",   
 			   text: "Gravado com sucesso.",   
 			   timer: 1000,   
 			   showConfirmButton: false 
 		});
		</script>');
		//print("<script>window.location.href='sistema.php?url=cad_clientes';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
}

$situacao = "";
$estado = "";
$cidade = "";
$ensino = "";

if(isset($inputb['codigo']))
{
	$x = 0;
	$RES = mysqli_query($db,"SELECT * FROM matriculas where matricula='".$inputb['codigo']."'");
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
	}
	
	if($x == 0)
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
		print("<script>window.location.href='sistema.php?url=cad_alunos';</script>");
	}
}

?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Cadastro de Alunos</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12 col-sm-12"> 
<div class="component-box">
<!--Tabs with Icon example -->
            <script>
			
			$('.c_gravar').on('click',function()
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
					swal({   
 			               title: "Atenção",   
 			               text: "Campo Matricula em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(nome == "")
				{
					swal({   
 			               title: "Atenção",   
 			               text: "Campo Nome em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(estado == "")
				{
					swal({   
 			               title: "Atenção",   
 			               text: "Campo Estado em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(cidade == "")
				{
					swal({   
 			               title: "Atenção",   
 			               text: "Campo Cidade em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(ensino == "")
				{
					swal({   
 			               title: "Atenção",   
 			               text: "Campo Ensino em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(turma == "")
				{
					swal({   
 			               title: "Atenção",   
 			               text: "Campo Turma em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(status == "")
				{
					swal({   
 			               title: "Atenção",   
 			               text: "'Campo Situação em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else
				{
				   <? if(isset($inputb['codigo']))
				   {?>
			          requestPage2('?br=modal_alunos&codigo='+ matricula +'&nome='+ nome +'&estado='+ estado +'&cidade='+ cidade +'&ensino='+ ensino +'&turma='+ turma +'&situacao='+ status +'&modal=1&ap=2','modals','GET');
				   <? } else {?>
				      requestPage2('?br=modal_alunos&codigo='+ matricula +'&nome='+ nome +'&estado='+ estado +'&cidade='+ cidade +'&ensino='+ ensino +'&turma='+ turma +'&situacao='+ status +'&modal=1&ap=1','modals','GET');
				   <? } ?>
				}
			});
			
			$('.c_novo').on('click',function()
		    {
				requestPage2('?br=modal_alunos&modal=1','modals','GET');
			});
			
			$('#nascimento').mask('00/00/0000', {'translation': {0: {pattern: /[0-9*]/}}});
			$('#telefone').mask('(00)0000-0000', {'translation': {0: {pattern: /[0-9*]/}}});
            $('#celular').mask('(00)0.0000-0000', {'translation': {0: {pattern: /[0-9*]/}}});
			
			</script>
			<form class="m-t-40 row" name="laudo" method="post" action="<? if(@$codigo ==""){ echo "sistema.php?url=cad_clientes&ap=1";}else { echo "sistema.php?url=cad_clientes&ap=2&codigo=".@$codigo."";} ?>">
            <?
			  
			   $d = date('YdHis');
			   $matri = $d;
			   $_SESSION['matricula'] = $matri;
			?>
			<div class="form-group col-md-3 m-t-20"><label>Matricula :</label>
			<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
			<input type="text" name="matricula" id="matricula" value="<? if(isset($inputb['codigo'])){ echo $matricula;}else{ echo $_SESSION['matricula'];} ?>" readonly class="form-control" required="required">
			</div>
			<div class="form-group col-md-3 m-t-20"><label>Nome :</label>
			<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
			<input type="text" name="cnome" id="cnome" value="<? if(isset($inputb['codigo'])){ echo $nome;} ?>" class="form-control" required="required">
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
			<div class="form-group col-md-3 m-t-20"><label>Cidade :</label>
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
			<div class="form-group col-md-3 m-t-20"><label>Ensino :</label>
			<select name="ensino" id="ensino" class="form-control" onChange="javascript: ajaxLoader('?br=cad_listacurso&curso='+ this.value ,'cursar','GET');"  style="width: 100%; height:36px;">
			  <option value="">Selecionar <?=$ensino;?></option>
			  <option value="0" <? if($ensino == 0){ echo "selected"; } ?>>Infantil</option>
			  <option value="1" <? if($ensino == 1){ echo "selected"; } ?>>Fundamental</option>
			  <option value="2" <? if($ensino == 2){ echo "selected"; } ?>>Médio</option>
			</select></div>
			<div class="form-group col-md-3 m-t-20"><label>Turma :</label>
			<div id="cursar">
			<select name="turma" id="turma" class="form-control" style="width: 100%; height:36px;" required="required">
				<option value="">Selecionar </option>
				<? 
					  if(isset($inputb['codigo']))
					  {
					  $sql = "select turmas.codigo,turmas.descricao from turmas inner join turmas_professor on turmas_professor.turma=turmas.codigo where turmas.curso='".$ensino."' and turmas_professor.usuario='".$_SESSION['usuario']."'";
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
			<div class="form-group col-md-2 m-t-20"><label>Situação :</label>
			<select name="situacao" id="situacao" class="form-control" style="width: 100%; height:36px;" required="required">
				<option>Selecionar Situação</option>
					   <option value="0" <? if(0 == $situacao){ echo "selected"; } ?>>Inativa</option>
					   <option value="1" <? if(1 == $situacao){ echo "selected"; } ?>>Ativa</option>
					   <option value="2" <? if(2 == $situacao){ echo "selected"; } ?>>Pre-Ativa</option>
					   <option value="3" <? if(3 == $situacao){ echo "selected"; } ?>>Transferido</option>
			</select>
			</div>
			<div class="form-group col-md-12 m-t-20" id="load">
			</div>
			<div class="form-group col-md-12 m-t-20">
			<button type="button" class="btn btn-info c_gravar"><i class="fa fa-plus-circle"></i> Gravar</button>
			<button type="button" class="btn btn-info c_novo"><i class="fa fa-plus-circle"></i> voltar</button>
			</div>
			<div class="form-group col-md-12 m-t-20">
			<input type='text' name='pesquisa' id='pesquisa' placeholder="Pesquisar Cliente" class='form-control' onkeyup="javascript: requestPage2('?br=atu_alunos&pesquisa='+ this.value +'&ap=3','clistalunos','GET');">
			</div>
			<div class="col-md-12">
			<div class="component-box">
			<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
				<table class="table pmd-table">
					<thead>
						<tr>
							<th>Codigo</th>
							<th>Descrição</th>
							<th>Status</th>
							<th>X</th>
						</tr>
					</thead>
					<tbody id="clistalunos">
					</tbody>
				</table>
			 </div>
			 </div>
			 </div>
		   </form>
</div>
</div>
</div>
<div class="modal-footer">
</div>
<? 
// --------- FINAL CADASTRO DE CLIENTES -------------//

}
else if($inputb['modal'] == 4)
{	
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Lista de Agendamento</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="form-group ">
<script>
	
function m_cbusca()
{
	var pesquisa = document.getElementById('user').value;
	
	requestPage2('?br=atu_clientes&pesquisa='+ pesquisa +'&ap=2','listclientes','GET');
}

</script>
<input name="user" id="user" type="text" class="form-control" placeholder="Buscar Clientes agendados." autocomplete="off" onkeyup="m_cbusca();"  />
</div>
<div>
<script>
function m_cliente(codigo)
{
	alert("teste");
}
</script>
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<thead>
<tr>
<th>Cliente</th>
<th>Serviço</th>
<th>Data/Hora</th>
</tr>
</thead>
<tbody id="listclientes">
<?
$m_data = date("Y-m-d");
$x = 0;
$SQL = "SELECT produtos.descricao,agendamento_servicos.codigo,agendamento.cliente,clientes.nome, clientes.celular,agendamento_servicos.data,agendamento_servicos.hora,agendamento_servicos.profissional FROM agendamento 
inner join clientes on clientes.codigo=agendamento.cliente 
inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
inner join produtos on produtos.codigo=agendamento_servicos.servico
where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.status=0 and agendamento_servicos.data='$m_data' ORDER BY agendamento.codigo desc";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
?>
<tr style="cursor: pointer;" onclick="m_agendamento(<?=$row['codigo'];?>);">
<td data-title="Nome"><? echo $row['nome'];?></td>
<td data-title="Serviço"><? echo $row['descricao'];?></td>
<td data-title="Data/Hora"><? echo formatodata($row['data'])." - ".formatohora($row['hora']); ?></td>
</tr>
<? $x = 1;
}

if($x == 0)
{
 echo "<tr><td colspan='3'>Nenhum resultado encontrado.</td></tr>";

}
?>
</tbody>	
</table>
</div>
</div>
</form>	
</div>
<div class="modal-footer">
</div>
<?}?>
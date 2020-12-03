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
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Lista de Cliente :</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="form-group "><label>Busca:</label>
<input name="user" type="text" class="form-control" autocomplete="off" onkeyup="javascript: requestPage2('?br=atu_listacliente&pesquisa='+ this.value +'&ap=1','listclientes','GET');" />
</div>
<div>
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<thead>
<tr>
<th>Nome</th>
<th>Status</th>
</tr>
</thead>
<tbody id="listclientes">
<?
$sql = "SELECT * FROM clientes limit 10";
$res = mysqli_query($db3,$sql); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
?>
<tr style="cursor: pointer;" onclick="SL_cliente('<? echo $row['codigo'];?>','<? echo $row['nome'];?>');">
<td data-title="Nome"><? echo $row['nome'];?></td>
<td data-title="Status"><? Switch($row['status'])
	 {
	   case 0:
		 echo '<span class="label label-danger">Inativo</span>';
	   break;
	   case 1:
		 echo '<span class="label label-success">Ativo</span>';
	   break;
	   case 2:
		 echo '<span class="label label-warning">Pre-ativo</span>';
	   break;
   }
   ?>
</td>
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
</form>										 
<div class="modal-footer">
</div>
<? 
}
else if($_GET['modal'] == 2)
{
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Lista de Cliente :</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="form-group "><label>Busca:</label>
<input name="user" type="text" class="form-control" autocomplete="off" onkeyup="javascript: requestPage2('?br=atu_listacliente&pesquisa='+ this.value +'&ap=1','listclientes','GET');" />
</div>
<div>
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<thead>
<tr>
<th>Nome</th>
<th>Status</th>
</tr>
</thead>
<tbody id="listclientes">
<?
$sql = "SELECT * FROM clientes limit 10";
$res = mysqli_query($db3,$sql); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
?>
<tr style="cursor: pointer;" onclick="window.location='sistema.php?url=cad_clientes&cadastro=1&codigo=<? echo $row['codigo'];?>';">
<td data-title="Nome"><? echo $row['nome'];?></td>
<td data-title="Status"><? Switch($row['status'])
	 {
	   case 0:
		 echo '<span class="label label-danger">Inativo</span>';
	   break;
	   case 1:
		 echo '<span class="label label-success">Ativo</span>';
	   break;
	   case 2:
		 echo '<span class="label label-warning">Pre-ativo</span>';
	   break;
   }
   ?>
</td>
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
</form>										 
<div class="modal-footer">
</div>
<? 
}
// --------- INICIO CADASTRO DE CLIENTES -------------//
else if($_GET['modal'] == 3) 
{ 

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$nome = "";
$nascimento = "";
$sexo = "";
$telefone = "";
$celular = "";
$rg = "";
$cpf = "";
$status = "";

if(@$inputb['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM clientes where sistema='".$_SESSION['sistema']."' and nome like '%".$inputb['nome']."%';'";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Cliente já foi cadastrada, escolha outro.')</script>");
		print("<script>window.location.href='sistema.php?url=cad_clientes';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into clientes(sistema, nome, nascimento,sexo, telefone, celular, rg, cpf, status) values('".$_SESSION['sistema']."','".$inputb['nome']."','".revertedata($inputb['nascimento'])."','".$inputb['sexo']."','".$inputb['telefone']."','".$inputb['celular']."','".$inputb['rg']."','".$inputb['cpf']."','".$inputb['status']."')";
	   $sucesso = mysqli_query($db3,$SQL1);
	   
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
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
else if(@$inputb['ap'] == "2")
{
	$SQL1 = "UPDATE clientes SET nome='".$inputb['nome']."',nascimento='".revertedata($inputb['nascimento'])."',sexo='".$inputb['sexo']."',telefone='".$inputb['telefone']."',celular='".$inputb['celular']."',rg='".$inputb['rg']."',cpf='".$inputb['cpf']."',status='".$inputb['status']."' where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'";
	$sucesso = mysqli_query($db3,$SQL1);
	
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

if(isset($inputb['codigo']))
{
	$sucesso = mysqli_query($db3,"SELECT codigo,nome,nascimento,sexo,telefone,celular,rg,cpf,status FROM clientes where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $codigo = $row['codigo'];
		 $nome = $row['nome'];
		 $nascimento = formatodata($row['nascimento']);
		 $sexo = $row['sexo'];
		 $telefone = $row['telefone'];
		 $celular = $row['celular'];
		 $rg = $row['rg'];
		 $cpf = $row['cpf'];
		 $status = $row['status'];
		 
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}
else
{
	$codigo = "";
}

?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Cadastro de Cliente</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12 col-sm-12"> 
<div class="component-box">
<!--Tabs with Icon example -->
            <script>
			
			function c_gravar()
		    {
				var nome = document.getElementById('nome').value;
				var sexo = document.getElementById('sexo').value;
				var nascimento = document.getElementById('nascimento').value;
				var telefone = document.getElementById('telefone').value;
				var celular = document.getElementById('celular').value;
				var rg = document.getElementById('rg').value;
				var cpf = document.getElementById('cpf').value;
				var status = document.getElementById('status').value;
				
				if(nome == "")
			    {
					    swal({   
 			               title: "Atenção",   
 			               text: "Campo Nome em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(sexo == "")
			    {
					   swal({   
 			               title: "Atenção",   
 			               text: "Campo Sexo em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(celular == "")
			    {
 			           swal({   
 			               title: "Atenção",   
 			               text: "Campo celular em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else
				{
				   <? if(@$inputb['codigo'])
				   {?>
				      requestPage2('?br=modal_clientes&codigo=<?=$codigo;?>&nome='+ nome +'&sexo='+ sexo +'&nascimento='+ nascimento +'&telefone='+ telefone +'&celular='+ celular +'&rg='+ rg +'&cpf='+ cpf +'&status='+ status +'&modal=3&ap=2','modals','GET');
				   <? } else {?>
				      requestPage2('?br=modal_clientes&nome='+ nome +'&sexo='+ sexo +'&nascimento='+ nascimento +'&telefone='+ telefone +'&celular='+ celular +'&rg='+ rg +'&cpf='+ cpf +'&status='+ status +'&modal=3&ap=1','modals','GET');
				   <? } ?>
				}
			}
			
			function edit_cliente(codigo)
			{				
			   requestPage2('?br=modal_clientes&codigo=' + codigo +'&modal=3','modals','GET');
			}
			
			$('#c_novo').on('click',function()
		    {
				requestPage2('?br=modal_clientes&modal=3','modals','GET');
			});
			
			$('#nascimento').mask('00/00/0000', {'translation': {0: {pattern: /[0-9*]/}}});
			$('#telefone').mask('(00)0000-0000', {'translation': {0: {pattern: /[0-9*]/}}});
            $('#celular').mask('(00)0.0000-0000', {'translation': {0: {pattern: /[0-9*]/}}});
			
			</script>
			<form class="m-t-40 row" name="laudo" method="post" action="<? if(@$codigo ==""){ echo "sistema.php?url=cad_clientes&ap=1";}else { echo "sistema.php?url=cad_clientes&ap=2&codigo=".@$codigo."";} ?>">
			<div class="form-group col-md-12 m-t-20"><label>Nome :</label>
			<input type="text" name="nome" id="nome" placeholder="Nome do Cliente" value="<? if(isset($codigo)){ echo $nome;} ?>" class="form-control" required="required"></div>
			<div class="form-group col-md-3 m-t-20"><label>Data de Nasc. :</label>
			<input type="text" name="nascimento" id="nascimento" value="<? if(isset($codigo)){ echo $nascimento;} ?>" placeholder="00/00/0000" class="form-control">
			</div>
			<div class="form-group col-md-3 m-t-20"><label>Sexo :</label>
			<select name="sexo" id="sexo" class="form-control" style="width: 100%; height:36px;" required="required">
				<option value="">Selecionar Sexo</option>
				   <option value="1" <? if(1 == $sexo){ echo "selected"; } ?>>Masculino</option>
				   <option value="2" <? if(2 == $sexo){ echo "selected"; } ?>>Feminino</option>
			</select></div>
			<div class="form-group col-md-3 m-t-20"><label>Telefone. :</label>
			<input type="text" name="telefone" id="telefone" placeholder="(DD)0000-0000" value="<? if(isset($codigo)){ echo $telefone;} ?>" data-mask="(00)0000-0000" class="form-control">
			</div>
			<div class="form-group col-md-3 m-t-20"><label>Celular :</label>
			<input type="text" name="celular" id="celular" placeholder="(DD)00000-0000" value="<? if(isset($codigo)){ echo $celular;} ?>" data-mask="(00)00000-0000" class="form-control">
			</div>
			<div class="form-group col-md-3 m-t-20"><label>RG :</label>
			<input type="text" name="rg" id="rg" value="<? if(isset($codigo)){ echo $rg;} ?>" placeholder="00000000" data-mask="00000000" class="form-control">
			</div>
			<div class="form-group col-md-3 m-t-20"><label>CPF :</label>
			<input type="text" name="cpf" id="cpf" value="<? if(isset($codigo)){ echo $cpf;} ?>" placeholder="00000000000" data-mask="00000000000" class="form-control">
			</div>
			<div class="form-group col-md-3 m-t-20"><label>Status :</label>
			<select name="status" id="status" class="form-control" style="width: 100%; height:36px;" required="required">
				<option value="">Selecionar Status</option>
				   <option value="1" <? if("1" == $status){ echo "selected"; } ?>>Ativo</option>
				   <option value="0" <? if("0" == $status){ echo "selected"; } ?>>Inativo</option>
			</select></div>
			<div class="form-group col-md-12 m-t-20">
			<br>
			<div class="form-actions">
			<button type="button" onclick="c_gravar();" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($codigo)){ echo "Gravar";}else { echo "Cadastrar";} ?></button>

			<? if(!Empty($codigo)) { ?>
			<button class="btn btn-info" type="button" id="c_novo"><i class="fa fa-plus-circle"></i> Novo</button>
			<? } ?>
			</div></div>
			<div class="form-group col-md-12 m-t-20">
			<input type='text' name='pesquisa' id='pesquisa' placeholder="Pesquisar Cliente" class='form-control' onkeyup="javascript: requestPage2('?br=atu_clientes&pesquisa='+ this.value +'&ap=1','clistclientes','GET');">
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
					<tbody id="clistclientes">
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
<input name="user" type="text" class="form-control" placeholder="Buscar Clientes agendados." autocomplete="off" onkeyup="javascript: requestPage2('?br=atu_clientes&pesquisa='+ this.value +'&ap=2','listclientes','GET');" />
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
where agendamento.sistema='".$_SESSION['sistema']."' and agendamento.status=1 and agendamento_servicos.data='$m_data' ORDER BY agendamento.codigo desc";
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
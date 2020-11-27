<script>

function data(valor)
{
	if(event.key === 'Enter') 
	{
	  if(valor == "")
	  {
	    swal('Atenção', 'Selecione uma data.');
	  }
	  else
   	  {
	      //$('#codigo').val(codigo);
		$( "dataagenda" ).datepicker( "hide" );
	    requestPage2('?br=atu_pesquisa&codigo=<?=$_SESSION['codcliente'];?>&data='+ valor +'&tipo=2&ap=2','loadfagenda','GET');
	  }
	}
}

function bccliente(nome)
{
	if(nome == "")
	{
	    swal('Atenção', 'Campo cliente branco.');
	}
	else
	{
	   requestPage2('?br=atu_pesquisa&pesquisa='+ nome +'&tipo=3&ap=1','pesquisacliente','GET');
    }
}

function cliente_s()
{	
    var data = document.getElementById('dataagenda').value;
	var nome = document.getElementById('nome').value;
	var codigo = document.getElementById('codigo').value;
	
	if(data == "")
	{
	    swal('Atenção', 'Selecione uma data.');
	}
	else if(hora == "")
	{
	    swal('Atenção', 'Selecione uma hora.');
	}
	else if(nome == "")
	{
	    swal('Atenção', 'Selecione Cliente data.');
	}
	else if(codigo == "")
	{
	    swal('Atenção', 'Selecione um Cliente data.');
	}
	else
	{
		//$('#modalusuario').modal('hide');
	    requestPage2('?br=atu_pesquisa&data='+ data +'&hora='+ hora +'&nome='+ nome +'&pcodigo='+ pcodigo +'&codigo='+ codigo +'&ap=8','modals','GET');
	}
}

function proximo_a()
{
	requestPage2('?br=atu_pesquisa&data='+ document.getElementById('dataagenda').value +'&ap=8','modals','GET');
}

function novo_a()
{
	requestPage2('?br=atu_pesquisa&ap=1&novo=1','modals','GET');
}

function proximo_b(codigo)
{
	var data = document.getElementById('dataagenda').value;
	var hora = document.getElementById('hora').value;
	var profissional = document.getElementById('profissional').value;
	
	requestPage2('?br=atu_pesquisa&codigo='+ codigo +'&profissional='+ profissional +'&data='+ data +'&hora='+ hora +'&ap=3','modals','GET');
}

function proximo_c(codigo, nome, agendamento)
{
	requestPage2('?br=atu_pesquisa&codigo='+ codigo +'&nome='+ nome +'&agendamento='+ agendamento +'&ap=2','modals','GET');
}

</script>
<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$inputb['ap'] == 1)
{   
	$_SESSION['codcliente'] = @$inputb['codigo'];
	$_SESSION['nome'] = @$inputb['nome'];
	
	$x = 0;
	$SQL = "SELECT * FROM agendamento where sistema='".$_SESSION['sistema']."' and usuario='".$_SESSION['usuario']."' and status=0;";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$_SESSION['agendamento'] = $row['codigo'];
		$codigo = $row['cliente'];
		$nome = $row['nome'];
		$profissional = $row['profissional'];
		$data = $row['data'];
		$hora = $row['hora'];
		$x = 1;
	}
	
	if($x == 1)
	{
		print("<script> requestPage2('?br=atu_pesquisa&codigo=$codigo&data=$data&ap=8','modals','GET');</script> ");
	}
	else
	{
		
    ?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Agenda - Data </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<form class="m-t-40 row">
		<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente">
		    <label for="first-name">Data:</label>
			<input name="dataagenda" id="dataagenda" type="text" autocomplete="off" class="form-control  form-control-lg" required="required" />
		</div>
		<script>
		jQuery('#dataagenda').datepicker({
				format: 'dd/mm/yyyy',
 		       autoclose: true,
 		       todayHighlight: true,
				language: "pt-BR",
				orientation: "bottom left",
				startDate: "-0d"
 		   });
 	    </script>
		<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="proximo_a();"><i class="fa fa-plus-circle"></i> Proximo</a>
		</form>
		</div>
		<div class="modal-footer">
     </div>
		<?
	}
}
else if(@$inputb['ap'] == 2)
{	
   
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Agendar </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<form class="m-t-40 row">
    <?if(!Empty($inputb['nome']) and !Empty($inputb['codigo']))
	{
		$_SESSION['nome'] = @$inputb['nome'];
        $_SESSION['codcliente']	= @$inputb['codigo'];
		
	?>
	<div class="form-group pmd-textfield pmd-textfield-floating-label"><label for="first-name">Nome:</label>
	<input type="text" name="nome" id="nome" value="<?=$_SESSION['nome'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" disabled />
	<input type="hidden" name="codigo" id="codigo" value="<?=$_SESSION['codcliente'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
	</div>
    <? } ?>
	<?if(!Empty($inputb['profissional']) and !Empty($inputb['codigo']))
	{
		
		$SQL = "SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['profissional']."';";
		$RES = mysqli_query($db3,$SQL);
		$RESS = mysqli_fetch_array($RES);
		
		$_SESSION['pnome'] = $RESS['nome'];
        $_SESSION['codpro']	= @$inputb['codigo'];
		
	?>
    <? } ?>
	<div class="form-group pmd-textfield pmd-textfield-floating-label"><label for="first-name">Data:</label>
	<input type="text" name="dataagenda" id="dataagenda" value="<?=$_GET['data'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" disabled />
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label"><label for="first-name">Horario:</label>
	<select name="hora" id="hora" class="form-control" placeholder="Escolha um horario" autocomplete="off"  style="width: 100%; height:36px;" required="required" <? if(!Empty($inputb['hora'])){ echo "disabled";}?> >
	<option value=""></option>
		<?
		
		$data = revertedata($inputb['data']);
		
		$SQL1 = "SELECT horarios.hora FROM horarios ORDER BY horarios.hora asc";
		$RES1 = mysqli_query($db3,$SQL1);
		while($row1 = mysqli_fetch_array($RES1))
		{
			
		  $x = 0;
		  $nome = "";
		  
		  $SQL2 = "SELECT hora,nome FROM agendamento where sistema='".$_SESSION['sistema']."' and data='".$data."' and profissional='".$_SESSION['codpro']."' and hora='".$row1['hora']."'";
		  $RES2 = mysqli_query($db3,$SQL2);
		  while($row2 = mysqli_fetch_array($RES2))
		  {
			 $nome = $row2['nome'];
			 $x = 1;
		  }
		  
		  $inputb['hora']." - ".$row1['hora'];
		  if($inputb['hora'] == $row1['hora'])
	      {
			  $selectd = "selected"; 
		  }
		  else
		  {
		      $selectd = "";  
		  }
		  
		  if($x == 0)
		  {
			   echo "<option value='".$row1['hora']."' ".$selectd.">".$row1['hora']."</option>";
		  }
		  else
		  {
			   
			   
			   echo "<option value='".$row1['hora']."' ".$selectd.">".$row1['hora']." - ".$nome." </option>";
		  }
		}

		?>
	</select>
	</div>
	<?if(Empty($_GET['nome'])){?>
	<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="proximo_b();"><i class="fa fa-plus-circle"></i> Proximo</a>
    <?}else{?>
	<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="cliente_s();"><i class="fa fa-plus-circle"></i> Proximo</a>
	<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="novo_a();"><i class="fa fa-plus-circle"></i> Novo</a>
	<?}?>
		
</form>
		</div>
		<div class="modal-footer">
</div>
	<?

}
else if(@$inputb['ap'] == 3)
{
	$_SESSION['codigo'] = @$inputb['codigo'];
	
	?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Agenda - Cliente </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<form class="m-t-40 row">
    <script>
	function cliente_r(pesquisa, data, hora , profissional)
    {
		if(pesquisa == "")
		{
			
		}
		else
		{
	        requestPage2('?br=atu_pesquisa&pesquisa='+ pesquisa +'&profissional='+ profissional +'&data='+ data +'&hora='+ hora +'&ap=4','inputcliente','GET');
		}
    }
	</script>
	<div class="form-group pmd-textfield pmd-textfield-floating-label">
	<input type="text" name="nome" id="nome" value="" placeholder="Buscar cliente por nome" onkeyup="cliente_r(this.value,'<?=$_SESSION['adata'];?>','<?=$_SESSION['ahora'];?>','<?=$_SESSION['aprofissional'];?>');" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" />
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente">
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label">
	<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="requestPage2('?br=atu_pesquisa&tipo=1&ap=1','modals','GET');"><i class="fa fa-plus-circle"></i> Novo</a>
	</div>
</form>
		</div>
		<div class="modal-footer">
</div>
	<?
}
else if(@$inputb['ap'] == 4)
{
	
$pesquisa = @$inputb['pesquisa'];

?>
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<tbody>
<?
$SQL = "SELECT * FROM clientes where sistema='".$_SESSION['sistema']."' and nome like '%".$pesquisa."%';";
$res = mysqli_query($db3,$SQL); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
?>
<tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="proximo_c('<?=$row['codigo'];?>','<?=$row['nome'];?>');">
<td data-title="Cliente"><? echo $row['nome'];?></td>
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
<?
}
else if(@$inputb['ap'] == 5)
{
   	?>
	<select name="hora2" id="hora2" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
	<option value="">Selecionar Horario</option>
		<?
		
		$SQL1 = "SELECT hora FROM horarios where sistema='".$_SESSION['sistema']."'";
		$RES1 = mysqli_query($db3,$SQL1);
		while($row1 = mysqli_fetch_array($RES1))
		{
		  $x = 0;
		  $SQL2 = "SELECT hora FROM agendamento where data='".revertedata($_GET['data'])."' and hora='".$row1['hora']."'";
		  $RES2 = mysqli_query($db3,$SQL2);
		  while($row2 = mysqli_fetch_array($RES2))
		  {
		     //$rhora = formatohora($row['inicio']);
			 $x = 1;
		  }
		  
		  if($x == 1)
		  {
			  
		  }
		  else
		  {
			  echo "<option value='".$row1['hora']."'>".$row1['hora']."</option>";
		  }
		}
     ?>
	 </select>

	<?
}
else if(@$inputb['ap'] == 232)
{
	
$data = @$inputb['data'];
$hora = @$inputb['hora'];
$pesquisa = @$inputb['pesquisa'];

?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Agenda - Profissional </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<script>
function phorario(profissional)
{
	var data = document.getElementById('dataagenda').value;

	if(profissional == "")
	{
		
	}
	else if(data == "")
	{
		
	}
	else
	{
		requestPage2('?br=atu_pesquisa&profissional='+ profissional +'&data='+ data +'&ap=7','p_load','GET');
	}
}
</script>
<div class="form-group pmd-textfield pmd-textfield-floating-label">
<input type="hidden" name="dataagenda" id="dataagenda" value="<?=$data;?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
<select name="profissional" id="profissional" class="form-control" onchange="phorario(this.value);" autocomplete="off" required="required">
	<option value="">Selecionar Profissional</option>
		<?
		
		$SQL1 = "SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and tipo in (2,3,4) and status=1;";
		$RES1 = mysqli_query($db3,$SQL1);
		while($row = mysqli_fetch_array($RES1))
		{
			echo "<option value='".$row['codigo']."'>".$row['nome']."</option>";
		}
     ?>
</select>
</div>
<div class="form-group pmd-textfield pmd-textfield-floating-label" id="p_load">
</div>
<div class="form-group pmd-textfield pmd-textfield-floating-label">
	<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="proximo_b();"><i class="fa fa-plus-circle"></i> Proximo</a>
</div>
</div>
<div class="modal-footer">
</div>
<?
}
else if(@$inputb['ap'] == 7)
{
    $data = @$inputb['hora'];
	$profissional = @$inputb['profissional'];
	
	?>
	<label for="first-name">Horario:</label>
	<select name="hora" id="hora" class="form-control" placeholder="Escolha um horario" autocomplete="off" required="required">
	<option value=""></option>
		<?
		
		$data = revertedata($inputb['data']);
		
		$SQL1 = "SELECT horarios.hora FROM horarios ORDER BY horarios.hora asc";
		$RES1 = mysqli_query($db3,$SQL1);
		while($row1 = mysqli_fetch_array($RES1))
		{
			
		  $x = 0;
		  $nome = "";
		  
		  echo $SQL2 = "SELECT hora,nome FROM agendamento where sistema='".$_SESSION['sistema']."' and data='".$data."' and profissional='".$profissional."' and hora='".$row1['hora']."'";
		  $RES2 = mysqli_query($db3,$SQL2);
		  while($row2 = mysqli_fetch_array($RES2))
		  {
			 $nome = $row2['nome'];
			 $x = 1;
		  }
		  
		  if($inputb['hora'] == $row1['hora'])
	      {
			  $selectd = "selected"; 
		  }
		  else
		  {
		      $selectd = "";  
		  }
		  
		  if($x == 0)
		  {
			   echo "<option value='".$row1['hora']."' ".$selectd.">".$row1['hora']."</option>";
		  }
		  else
		  {
			   
			   
			   echo "<option value='".$row1['hora']."' ".$selectd.">".$row1['hora']." - ".$nome." </option>";
		  }
		}

		?>
	</select>
	<?
}
else if(@$inputb['ap'] == 8)
{
	$p_data = @$inputb['data'];
	$p_codigo = @$inputb['codigo'];
	
	$p_x = 0;
	$SQL = "SELECT codigo FROM agendamento where sistema='".$_SESSION['sistema']."' and usuario='".$_SESSION['usuario']."' and status=0;";
	$RES = mysqli_query($db3,$SQL);
	while($rows = mysqli_fetch_array($RES))
	{
		$p_x = 1;
	}

	if($p_x == 0)
    {
	   $query = "INSERT INTO agendamento (sistema, usuario, data, status) VALUES ('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".revertedata($inputb['data'])."','0')";
       $sucesso = mysqli_query($db3,$query);
	}
	
	$SQL = "SELECT codigo FROM agendamento where sistema='".$_SESSION['sistema']."' and usuario='".$_SESSION['usuario']."' and status=0;";
	$RES = mysqli_query($db3,$SQL);
	$rows = mysqli_fetch_array($RES);
	
	$SQL2 = "SELECT count(produtos.codigo) as qtd, sum(produtos.preco) as total FROM agendamento 
	inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
	inner join produtos on produtos.codigo=agendamento_servicos.servico
	where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.agendamento='".$rows['codigo']."' and agendamento.status=0 ORDER BY agendamento.codigo asc";
	
	$RES2 = mysqli_query($db3,$SQL2);
	$rowds = mysqli_fetch_array($RES2);
	
	print('<script> document.getElementById("sv_qtd").innerHTML = "'.$rowds['qtd'].'";</script>');
	print('<script> document.getElementById("sv_total").innerHTML = "<span style=\'color: green;\'>Total: R$ '.number_format($rowds['total'],2,",",".").'</span>";</script>');
	
	?>
	<div class="modal-header">
<h2 class="pmd-card-title-text">Agenda - Servicos - <?=formatodata($p_data);?></h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
	<script>
	function servico_add(codigo)
    {
		var data = document.getElementById('dataagenda').value;
		var hora = document.getElementById('hora').value;
		var profissional = document.getElementById('profissional').value;
		var servico = document.getElementById('servico').value;
		
		if(servico == "")
		{
			swal('Atenção', 'Selecione um serviço.');
		}
		else
		{
		   requestPage2('?br=atu_pesquisa&codigo='+ codigo +'&servico='+ servico +'&profissional='+ profissional +'&data='+ data +'&hora='+ hora +'&addservico=true&load=2','listaservicos','GET');
		}
	}
	
	jQuery('#dataagenda').datepicker({
		format: 'dd/mm/yyyy',
 		autoclose: true,
 		todayHighlight: true,
		language: "pt-BR",
		orientation: "bottom left",
		startDate: "-0d"
	});
	
	function sleep(ms) {
	   return new Promise(resolve => setTimeout(resolve, ms));
	}

	async function phorario(dataagenda)
    {
		await sleep(500);
		
		var profissional = document.getElementById('profissional').value;
		
		if(profissional == null)
		{
			swal('Atenção', 'Selecione um profissional.');
		}
		else if(dataagenda == "")
		{
			swal('Atenção', 'Selecione uma Data.');
		}
		else
		{
			requestoption('?br=atu_pesquisa&profissional='+ profissional +'&data='+ dataagenda +'&lhorario=true','hora','GET');
		}
	}
	
	function pservico()
    {
		var profissional = document.getElementById('profissional').value;
		
		requestoption('?br=atu_pesquisa&profissional='+ profissional +'&lservico=true','servico','GET');
	}
	
	</script>
	<div class="m-t-40 row" id="forcaixa">
	<div class="form-group col-md-12 m-t-20">
	<select name="profissional" id="profissional" class="form-control" autocomplete="off" required="required">
	<option value="">Selecionar Profissional</option>
		<?
		
		$SQL1 = "SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and tipo in (2,3,4) and status=1;";
		$RES1 = mysqli_query($db3,$SQL1);
		while($row = mysqli_fetch_array($RES1))
		{
			echo "<option value='".$row['codigo']."'>".$row['nome']."</option>";
		}
     ?>
	</select>
	</div>
	<div class="form-group col-md-12 m-t-20"><label>Data:</label>
		<input name="dataagenda" id="dataagenda" type="text" onchange="phorario(this.value);" placeholder="00/00/00000" autocomplete="off" class="form-control  form-control-lg" required="required" />
	</div>
	<div class="form-group col-md-12 m-t-20"><label>Horario:</label>
	<select name="hora" id="hora" class="form-control" placeholder="Escolha um serviço" onchange="pservico();" autocomplete="off" required="required" >
	</select>
	</div>
	<div class="form-group col-md-12 m-t-20"><label>Serviços:</label>
	<select name="servico" id="servico" class="form-control" placeholder="Escolha um serviço" autocomplete="off"  required="required" >
	</select>
	<button class="btn btn-info btnadd-ad" onclick="servico_add(<?=$rows['codigo'];?>);"><i class="fa fa-plus-circle"></i></button>
	</div>
	</div>
	<div id="dtable" style="display: none;">
	<h2>Lista de Serviços agendados :</h2>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="s_load">
	<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
		<table class="table pmd-table">
			<thead>
				<tr>
					<th>Descrição</th>
					<th>Profissional</th>
					<th>Data - Hora</th>
					<th>Valor</th>
					
				</tr>
			</thead>
			<tbody id="listaservicos">
			<?
			    
	        $SQL = "SELECT usuarios.nome,agendamento.codigo as codagenda, agendamento_servicos.codigo, agendamento_servicos.data,agendamento_servicos.hora, produtos.descricao, produtos.preco FROM agendamento 
	        inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
	        inner join produtos on produtos.codigo=agendamento_servicos.servico
            inner join usuarios on usuarios.codigo=agendamento_servicos.profissional
	        where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.agendamento='".$_SESSION['agendamento']."' and agendamento.status=0 ORDER BY agendamento.codigo asc";
	
	        $RES = mysqli_query($db3,$SQL);
	        while($row = mysqli_fetch_array($RES))
	        {
		    ?>
		    <tr onclick="a_ex(<? echo $row['codigo']?>)" href="javascript:void(0);">
		      <td data-title="Descrição">
		        <?=$row['descricao'];?>
		     </td>
			 <td data-title="Data - Hora">
		        <?=$row['nome'];?>
		     </td>
			 <td data-title="Data - Hora">
		        <?=formatodata($row['data']);?> - <?=formatohora($row['hora']);?>
		     </td>
			 <td data-title="Data - Hora">
		        R$ <?=number_format($row['preco'],2,",",".");?>
		     </td>
		   </tr>
	        <?	} ?>
			</tbody>
		</table>
	 </div>
	 </div>
	 </div>
	 <h2 id="sv_total"><span style="color: green;">Total: R$ 0,00</span></h2>
	 <div class="form-group pmd-textfield pmd-textfield-floating-label">
	    <a class="btn pmd-btn-outline pmd-ripple-effect btn-warning" href="javascript: void(0);" onclick="sv_itens();"><b id="sv_qtd"></b> <i class="material-icons">add_shopping_cart</i> Itens</a>
    </div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label">
	    <a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="proximo_b(<?=$rows['codigo'];?>);"><i class="material-icons">person_add</i>  Proximo</a>
    </div>
<script>
function sv_itens()
{
  if($('#dtable').css('display') == 'none' )
  {
	 $("#forcaixa" ).hide( "slow" );
	 $("#dtable" ).show( "slow" );
  }
  else
  {
	 $("#forcaixa" ).show( "slow" );
	 $("#dtable" ).hide( "slow" );
  }
}

</script>
<script>
function a_ex(codigo)
{
	if(codigo == null)
	{

	}
	else
	{
		  requestPage2('?br=atu_pesquisa&codigo=<?=$rows["codigo"];?>&servico='+ codigo +'&excluir=true&load=2','listaservicos','GET');
	}
}
</script>
	  </div>
     <div class="modal-footer">
    </div>
	<?
}
else if(@$inputb['ap'] == 9)
{
	$servico = $inputb['servico'];
	$codigo = $inputb['codigo'];
	$data = $inputb['data'];
	$hora = $inputb['hora'];
	
	if($inputb['servico'] == "")
	{
		print "<script> swal('t', 'Selecione um serviço.'); </script>";
	}
	else
	{
		echo $SQL = "INSERT into agendamento_servicos(sistema,agendamento,servico,data,hora) values('".$_SESSION['sistema']."','".$codigo."','".$servico."','".$data."','".$hora."');";
		//mysqli_query($db3,$SQL);
	}
}

if(@$inputb['cliente'] == "true")
{
	$_SESSION['codigo'] = @$inputb['codigo'];
	
	?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Agenda - Cliente </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<form class="m-t-40 row">
    <script>
	function cliente_r(pesquisa, data, hora , profissional)
    {
		if(pesquisa == "")
		{
			
		}
		else
		{
	        requestPage2('?br=atu_pesquisa&pesquisa='+ pesquisa +'&profissional='+ profissional +'&data='+ data +'&hora='+ hora +'&ap=4','inputcliente','GET');
		}
    }
	</script>
	<div class="form-group pmd-textfield pmd-textfield-floating-label">
	<input type="text" name="nome" id="nome" value="" placeholder="Buscar cliente por nome" onkeyup="cliente_r(this.value,'<?=$_SESSION['adata'];?>','<?=$_SESSION['ahora'];?>','<?=$_SESSION['aprofissional'];?>');" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" />
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente">
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label">
	<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="requestPage2('?br=atu_pesquisa&tipo=1&ap=1','modals','GET');"><i class="fa fa-plus-circle"></i> Novo</a>
	</div>
</form>
		</div>
		<div class="modal-footer">
</div>
	<?
}
else if(@$inputb['pesq'] == "true")
{
	
$pesquisa = @$inputb['pesquisa'];

?>
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<tbody>
<?
$SQL = "SELECT * FROM clientes where sistema='".$_SESSION['sistema']."' and nome like '%".$pesquisa."%';";
$res = mysqli_query($db3,$SQL); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
?>
<tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="proximo_c('<?=$row['codigo'];?>','<?=$row['nome'];?>');">
<td data-title="Cliente"><? echo $row['nome'];?></td>
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
<?
}

if(@$inputb['novo'] == 1)
{
   $codigo = $_SESSION['agendamento'];
   
   if(!isset($_SESSION['agendamento']))
   { 
      
   }
   else
   {
      $SQL = "DELETE from agendamento WHERE sistema='".$_SESSION['sistema']."' and codigo='".$codigo."' and status=0";
      mysqli_query($db3,$SQL);
   }
 ?>
 
  <script>
  swal({   
            title: "Atenção",   
            text: "Excluido com sucesso.",   
            timer: 1000,   
            showConfirmButton: false 
        });
  </script>
 
 <?
}

if(@$inputb['excluir'] == "true")
{
	$codigo = $inputb['codigo'];
	$servico = $inputb['servico'];
	
	$SQL1 = "DELETE from agendamento_servicos where sistema='".$_SESSION['sistema']."' and codigo='".$servico."'";
	$RES1 = mysqli_query($db3,$SQL1);
	
	$SQL2 = "SELECT count(produtos.codigo) as qtd,sum(produtos.preco) as total FROM agendamento 
	inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
	inner join produtos on produtos.codigo=agendamento_servicos.servico
	where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.agendamento='".$codigo."' and agendamento.status=0 ORDER BY agendamento.codigo asc";
	
	$RES2 = mysqli_query($db3,$SQL2);
	$row = mysqli_fetch_array($RES2);
	
	print('<script> document.getElementById("sv_total").innerHTML = "<span style=\'color: green;\'>Total: R$ '.number_format($row['total'],2,",",".").'</span>";</script>');
	print('<script> document.getElementById("sv_qtd").innerHTML = "'.$row['qtd'].'";</script>');

}

if(@$inputb['addservico'] == "true")
{
	$servico = $inputb['servico'];
	$profissional = $inputb['profissional'];
	$codigo = $inputb['codigo'];
	$data = $inputb['data'];
	$hora = $inputb['hora'];
	
	if($inputb['servico'] == "")
	{
		print "<script> swal('t', 'Selecione um serviço.'); </script>";
	}
	else
	{
		$SQL = "INSERT into agendamento_servicos(sistema,agendamento,servico,profissional,data,hora) values('".$_SESSION['sistema']."','".$codigo."','".$servico."','".$profissional."','".revertedata($data)."','".$hora."');";
		mysqli_query($db3,$SQL);
	}
	
	$SQL = "SELECT count(produtos.codigo) as qtd,sum(produtos.preco) as total FROM agendamento 
	inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
	inner join produtos on produtos.codigo=agendamento_servicos.servico
	where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.agendamento='".$codigo."' and agendamento.status=0 ORDER BY agendamento.codigo asc";
	
	$RES = mysqli_query($db3,$SQL);
	$row = mysqli_fetch_array($RES);
	
	print('<script> document.getElementById("sv_total").innerHTML = "<span style=\'color: green;\'>Total: R$ '.number_format($row['total'],2,",",".").'</span>";</script>');
	print('<script> document.getElementById("sv_qtd").innerHTML = "'.$row['qtd'].'";</script>');
}

if(@$inputb['lhorario'] == "true")
{
    $data = @$inputb['data'];
	$profissional = @$inputb['profissional'];
	
	?>
	<label for="first-name">Horario:</label>
	<select name="hora" id="hora" class="form-control" placeholder="Escolha um horario" autocomplete="off" required="required">
	<option value=""></option>
		<?
		
		$data = revertedata($inputb['data']);
		
		echo $SQL1 = "SELECT horarios.hora FROM horarios ORDER BY horarios.hora asc";
		$RES1 = mysqli_query($db3,$SQL1);
		while($row1 = mysqli_fetch_array($RES1))
		{
			
		  $x = 0;
		  $nome = "";
		  
		  echo $SQL2 = "SELECT agendamento_servicos.hora,agendamento.nome FROM agendamento inner join agendamento_servicos.agendamento=agendamento.codigo where sistema='".$_SESSION['sistema']."' and data='".$data."' and profissional='".$profissional."' and hora='".$row1['hora']."'";
		  $RES2 = mysqli_query($db3,$SQL2);
		  while($row2 = mysqli_fetch_array($RES2))
		  {
			 $nome = $row2['nome'];
			 $x = 1;
		  }
		  
		  if($inputb['hora'] == $row1['hora'])
	      {
			  $selectd = "selected"; 
		  }
		  else
		  {
		      $selectd = "";  
		  }
		  
		  if($x == 0)
		  {
			   echo "<option value='".$row1['hora']."' ".$selectd.">".$row1['hora']."</option>";
		  }
		  else
		  {
			   
			   
			   echo "<option value='".$row1['hora']."' ".$selectd.">".$row1['hora']." - ".$nome." </option>";
		  }
		}

		?>
	</select>
	<?
}

if(@$inputb['lservico'] == "true")
{ 
    $p_codigo = @$inputb['profissional'];
    ?>
    <option value=""></option>
	<?  
	
	$SQL = "SELECT produtos.codigo, produtos.descricao FROM produtos 
	inner join produtos_usuarios on produtos_usuarios.produto=produtos.codigo
	where produtos.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='{$p_codigo}' and produtos.tipo=2";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		echo "<option value='".$row['codigo']."'>".$row['descricao']." - ".$nome." </option>";
	}
}

if(@$inputb['load'] == 1)
{
	            
	$SQL = "SELECT agendamento.codigo,agendamento.cliente,clientes.nome, clientes.celular,agendamento.data,agendamento.hora FROM agendamento inner join clientes on clientes.codigo=agendamento.cliente where agendamento.sistema='".$_SESSION['sistema']."' and clientes.nome like '%".$_GET['pesquisa']."%' and agendamento.status=1 ORDER BY agendamento.codigo asc";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		?>
		<div class="col-12 col-md-6 mb-4">
            <div class="row">
                <div class="col-4">
                    <figure class="m-0 h-150 w-100 rounded overflow-hidden">
                        <div class="background" style='background-image: url("template/images/escova-inteligente.jpg");'>  
                                </div>
                            </figure>
                        </div>
                        <div class="col pl-0">
                            <h3><p class="large text-mute" style="font-size: initial;"><? echo $row['nome'];?></p></h3>
                            <p class="large text-mute" style="font-size: initial;">Dia: <? echo formatodata($row['data']);?> às Hora: <? echo formatohora($row['hora']);?>hs</p>
                            <button type="button" onclick="agenda(2,'<? echo $row['codigo'];?>','<? echo $row['cliente'];?>','<? echo $row['data'];?>','<? echo $row['hora'];?>','<? echo $row['nome'];?>');" class="btn pmd-btn-outline pmd-ripple-effect btn-primary">Editar</button>
							<button type="button" onclick="agendaex('<? echo $row['codigo'];?>');" class="btn pmd-btn-outline pmd-ripple-effect btn-danger">Excluir</button>
							<div class="pmd-card-actions">
								<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button" onclick="whats('<? echo str_replace("(","", str_replace(")","", str_replace("-","",$row['celular'])));?>','Bom dia *<? echo $row['nome'];?>*! %0APassando para lembrar que você tem horário agendado hoje às *<? echo formatohora($row['hora']);?>hs*.%0A%0A *Studio KA*');"><i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 210%; color: green;"></i></button>
								<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">thumb_up</i></button>
								<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">drafts</i></button>
							</div>
                        </div>
                    </div>
					
                </div>
			  <?
			  
	}
}
else if(@$inputb['load'] == 2)
{
	$codigo = @$inputb['codigo'];
	            
	$SQL = "SELECT usuarios.nome,agendamento.codigo as codagenda, agendamento_servicos.codigo, agendamento_servicos.data,agendamento_servicos.hora, produtos.descricao,produtos.preco FROM agendamento 
	inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
	inner join produtos on produtos.codigo=agendamento_servicos.servico
	inner join usuarios on usuarios.codigo=agendamento_servicos.profissional
	where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.agendamento='".$codigo."' and agendamento.status=0 ORDER BY agendamento.codigo asc";
	
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		?>
		<tr onclick="a_ex(<? echo $row['codigo']?>)" href="javascript:void(0);">
		 <td data-title="Descrição">
		  <?=$row['descricao'];?>
		 </td>
		 <td data-title="Data - Hora">
		        <?=$row['nome'];?>
		     </td>
		  <td data-title="Data - Hora">
		        <?=formatodata($row['data']);?> - <?=formatohora($row['hora']);?>
		     </td>
	     <td data-title="Data - Hora">
		        R$ <?=number_format($row['preco'],2,",",".");?>
		     </td>
		</tr>
	    <?	  
	}
}
?>













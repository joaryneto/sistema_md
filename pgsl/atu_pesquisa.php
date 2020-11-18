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

function cliente()
{	
    var data = document.getElementById('dataagenda').value;
	var hora = document.getElementById('hora').value;
	var nome = document.getElementById('nome').value;
	var codigo = document.getElementById('codigo').value;
	
	if(valor == "")
	{
	    swal('Atenção', 'Selecione uma data.');
	}
	else if(valor == "")
	{
	    swal('Atenção', 'Selecione uma data.');
	}
	else if(valor == "")
	{
	    swal('Atenção', 'Selecione uma data.');
	}
	else
	{
	    requestPage2('?br=atu_pesquisa&data='+ data +'&hora='+ hora +'&nome='+ cliente +'&codigo='+ cliente +'&ap=2','modals','GET');
	}
}

function proximo1()
{
	requestPage2('?br=atu_pesquisa&data='+ document.getElementById('dataagenda').value +'&ap=2','modals','GET');
}

function proximo2()
{
	requestPage2('?br=atu_pesquisa&data='+ document.getElementById('dataagenda').value +'&ap=2','modals','GET');
}

</script>
<?

if(@$_GET['ap'] == 1)
{   
		$_SESSION['codcliente'] = @$_GET['codigo'];
		$_SESSION['nome'] = @$_GET['nome'];
		
		?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Gerar Diario </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<form class="m-t-40 row">
		<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente">
		<label for="first-name">Data:</label>
			<input name="dataagenda" id="dataagenda" type="text" autocomplete="off" class="form-control" required="required" />
		</div>
		<script>
		jQuery('#dataagenda').datepicker({
				format: 'dd/mm/yyyy',
 		       autoclose: true,
 		       todayHighlight: true,
				language: "pt-BR",
				orientation: "bottom left"
 		   });
 	    </script>
		<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="proximo();"><i class="fa fa-plus-circle"></i> Proximo</a>
		</form>
		</div>
		<div class="modal-footer">
</div>
		<?
}
else if($_GET['ap'] == 2)
{
	$_SESSION['adata'] = @$_GET['data'];
	$_SESSION['ahora'] = @$_GET['hora'];
	
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Gerar Diario </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<form class="m-t-40 row">
    <?if(!Empty($_GET['nome']) and !Empty($_GET['codigo']))
	{
		$_SESSION['nome'] = @$_GET['nome'];
        $_SESSION['codcliente']	= @$_GET['codigo'];
		
	?>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente"><label for="first-name">Nome:</label>
	<input type="text" name="nome" id="nome" value="<?=$_SESSION['nome'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" disabled />
	<input type="hidden" name="codigo" id="codigo" value="<?=$_SESSION['codcliente'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
	</div>
    <? } ?>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente"><label for="first-name">Data:</label>
	<input type="text" name="dataagenda" id="dataagenda" value="<?=$_SESSION['adata'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" disabled />
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente"><label for="first-name">Horario:</label>
	<select name="hora" id="hora" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
	<option value="">Horarios</option>
		<?
		
		$data = revertedata($_GET['data']);
		
		$SQL1 = "SELECT horarios.hora, agendamento.nome FROM horarios left join agendamento on agendamento.hora=horarios.hora ORDER BY horarios.hora asc";
		$RES1 = mysqli_query($db3,$SQL1);
		while($row1 = mysqli_fetch_array($RES1))
		{
			
		  /*$x = 0;
		  $SQL2 = "SELECT hora FROM agendamento left join where data='".$data."' and hora='".$row1['hora']."'";
		  $RES2 = mysqli_query($db3,$SQL2);
		  while($row2 = mysqli_fetch_array($RES2))
		  {
			 $x = 1;
		  }*/
		  
		  //if($x == 1)
		  //{
			  if(Empty($_SESSION['ahora']))
			  {
				 $selectd = ""; 
			  }
			  else
			  {
				 $selectd = "selected";  
			  }
			  
			  echo "<option value='".$row1['hora']."' ".$selectd.">".$row1['hora']." - ".$row1['nome']."</option>";
		 // }
		 // else
		  //{
		//	  echo "<option value='".$row1['hora']."'>".$row1['hora']." </option>";
		  //}
		}

		?>
	</select>
	</div>
	<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="cliente();"><i class="fa fa-plus-circle"></i> Proximo</a>
		
</form>
		</div>
		<div class="modal-footer">
</div>
	<?

}
else if()
{
	?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Gerar Diario </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="modal-body">
<form class="m-t-40 row">
    <?if(!Empty($_GET['nome']) and !Empty($_GET['codigo']))
	{
		$_SESSION['nome'] = @$_GET['nome'];
        $_SESSION['codcliente']	= @$_GET['codigo'];
		
	?>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente"><label for="first-name">Nome:</label>
	<input type="text" name="nome" id="nome" value="" onkeyup="" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" />
	</div>	
	<a class="btn pmd-btn-outline pmd-ripple-effect btn-primary" href="javascript: void(0);" onclick="cliente();"><i class="fa fa-plus-circle"></i> Proximo</a>
		
</form>
		</div>
		<div class="modal-footer">
</div>
	<?
}
else if($_GET['ap'] == 4)
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
if(@$_GET['load'] == 1)
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
                            <p class="large text-mute" style="font-size: initial;">Dia: <? echo formatodatahora($row['data']);?> às Hora: <? echo formatohora($row['hora']);?>hs</p>
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
?>













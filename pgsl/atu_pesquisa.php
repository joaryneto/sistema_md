<?
ob_start();
session_start();


if($_GET['ap'] == 1)
{
  if($_GET['tipo'] == 1)
  {
	  ?>
	    <div class="form-group pmd-textfield pmd-textfield-floating-label"><label for="first-name">Pesquisar Cliente:</label>
			<input name="nome" id="nome" type="text" onkeyup="bcliente(this.value)" style="width:300px" autocomplete="off" class="form-control" required="required" />
			<div id="pesquisacliente"></div>
		</div>						
	   <?
  }
  else
  {
?>
     <div class="tableFixHead" id="pcliente"> 
       <table class="table table-hover">
         <tbody id="itenss">
        <?
		unset($_SESSION['codcliente']);
		unset($_SESSION['nome']);
		
        $pesquisa = $_GET['pesquisa'];

         $SQL = "SELECT codigo,nome FROM clientes where nome like '%".$pesquisa."%' LIMIT 10;";
         $RES = mysqli_query($db3,$SQL);
         while($row = mysqli_fetch_array($RES))
         {
	   ?>
	   <tr Onclick="cliente('<?=$row['codigo'];?>','<?=$row['nome'];?>');"><td colspan="3"><?=$row['nome']?></td></tr>
	
	   <?
          }
       ?>
       </tbody>
      </table>
    </div>

   <?
  }
}
else if($_GET['ap'] == 2)
{   
	if($_GET['tipo'] == 1)
	{
		$_SESSION['codcliente'] = $_GET['codigo'];
		$_SESSION['nome'] = $_GET['nome'];
		
		?>
		<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente">
		<label for="first-name">Data:</label>
			<input name="dataagenda" id="dataagenda" OnChange="data(this.value);" type="text" autocomplete="off" class="form-control" required="required" />
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
		<?
	}
	else
	{
   	?>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente"><label for="first-name">Nome:</label>
	<input type="text" name="nome" id="nome" value="<?=$_SESSION['nome'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" disabled />
	<input type="hidden" name="codigo" id="codigo" value="<?=$_SESSION['codcliente'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente"><label for="first-name">Data:</label>
	<input type="text" name="dataagenda" id="dataagenda" value="<?=$_GET['data'];?>" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required" disabled />
	</div>
	<div class="form-group pmd-textfield pmd-textfield-floating-label" id="inputcliente"><label for="first-name">Horario:</label>
	<select name="hora" id="hora" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
	<option value=""></option>
		<?
		
		$data = revertedata($_GET['data']);
		
		
		$SQL1 = "SELECT hora FROM horarios where sistema='".$_SESSION['sistema']."'";
		$RES1 = mysqli_query($db3,$SQL1);
		while($row1 = mysqli_fetch_array($RES1))
		{
		  $x = 0;
		  $SQL2 = "SELECT hora FROM agendamento where data='".$data."' and hora='".$row1['hora']."'";
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
	</div>
	<?
	}
}
else if($_GET['ap'] == 3)
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
else if($_GET['ap'] == 4)
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
else if($_GET['ap'] == 5)
{
	
}

?>













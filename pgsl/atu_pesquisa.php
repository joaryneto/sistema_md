<?
ob_start();
session_start();


if(!Empty($_GET['pesquisa']) and $_GET['ap'] == 1)
{
?>

<div class="tableFixHead" id="pcliente"> <table class="table table-hover">
                                            <tbody id="itenss">
<?

//require_once("../load/class/mysql.php");

$pesquisa = $_GET['pesquisa'];

$SQL = "SELECT codigo,nome FROM clientes where nome like '%".$pesquisa."%' LIMIT 10;";
$RES = mysqli_query($db3,$SQL);
while($row = mysqli_fetch_array($RES))
{
	?>
	<tr Onclick="selectcliente('<?=$row['codigo'];?>','<?=$row['nome'];?>');"><td colspan="3"><?=$row['nome']?></td></tr>
	
	<?
}




?>
   </tbody>
 </table>
</div>

<?
}
else if($_GET['ap'] == 2)
{
   	?>
	<!--<label>Cliente :</label>
	<input name="codigo" id="codigo" type="hidden" value="<?=$_GET['nome'];?>" autocomplete="off" class="form-control" required="required" />
	<input name="nome" id="nome" type="text" onkeyup="buscarcliente(this.value);" value="<?=$_GET['nome'];?>" autocomplete="off" class="form-control" required="required" />
	<div id="pesquisacliente"></div>-->
	<label>Horario:</label>
	<select name="hora" id="hora" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
	<option>Selecionar Horario</option>
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
<script>
function agendar()
{	
	var datav = document.getElementById('dataagenda').value;
	var horav = document.getElementById('hora').value;
	var codigo = document.getElementById('codigo').value;
	var nome = document.getElementById('nome').value;
	
	if(datav == "")
	{
		swal('Atenção', 'Selecione uma data.');
	}
	if(horav == "")
	{
		swal('Atenção', 'Selecione a hora.');
	}
	if(codigo == "")
	{
		swal('Atenção', 'Selecione um Cliente.');
	}
	if(nome == "")
	{
		swal('Atenção', 'Selecione uma Cliente.');
	}
	else
	{
	   document.getElementById('pcliente').style.display = 'none';
	   $('#codigo').val(codigo);
	   $('#nome').val(nome);
	   requestPage2('?br=atu_agendamento&codigo='+ codigo +'&nome='+ nome +'&data='+ datav +'&hora='+ horav +'&ap=1','horario','GET');
	}
}
	</script>
	<?
}
else if($_GET['ap'] == 3)
{
   	?>
	<select name="hora2" id="hora2" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
	<option>Selecionar Horario</option>
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
	            
	$SQL = "SELECT agendamento.cliente,clientes.nome,agendamento.data,agendamento.hora FROM agendamento inner join clientes on clientes.codigo=agendamento.cliente where agendamento.sistema='".$_SESSION['sistema']."' and clientes.nome like '%".$_GET['pesquisa']."%' ORDER BY agendamento.codigo asc";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
				?>
				<div class="col-6 col-md-4 col-lg-3 mb-4" onclick="editar('<?=$row['cliente'];?>','<?=$row['data'];?>','<?=$row['hora'];?>','<?=$row['nome'];?>');">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background" style='background-image: url("template/images/escova-inteligente.jpg");'>
                        </div>
                        <div>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1" style="font-size: 95%;"><? echo $row['nome'];?></h6>
					<p><span>Hora: <? echo $row['hora'];?>hs</span></p>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">Marcado no dia: <? echo formatodatahora($row['data']);?></span></p>
                </div>
			  <?
			  
	}
}

?>













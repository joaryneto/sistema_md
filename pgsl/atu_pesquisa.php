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
		
		//$hora = '06:30:00';
		//for($i = 0; $i < 31; $i++)
		//{
		  
		  //$hora = date('H:i:s', strtotime('+30 minute', strtotime($hora)));
		  //echo "<option value='$hora'>$hora - ".$rhora."</option>";
		  
		  //echo $SQL = "INSERT horarios (hora,sistema) values('".$hora."','".$_SESSION['sistema']."');";
		  //$RES = mysqli_query($db3,$SQL);
		  
		  /*$x = 0;
		  echo $SQL = "SELECT inicio FROM agendamento where inicio='".$data." ".$hora."'";
		  $RES = mysqli_query($db3,$SQL);
		  while($row = mysqli_fetch_array($RES))
		  {
		     $rhora = formatohora($row['inicio']);
			 $x = 1;
		  }
		  
		  if($x == 1)
		  {
			  
		  }
		  else
		  {
			  
		  }*/
        //}

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



?>













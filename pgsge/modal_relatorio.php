
<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

if(@$_SESSION['menu99'] == false)
{
   //print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   //print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

?>		

<?if($_GET['modal'] == 1){?>
<script>

function gravar()
{
	var professor = document.getElementById('r_professor').value;
	var turmas = document.getElementById('r_turmas').value;
	var disciplina = document.getElementById('r_disciplina').value;
	var ano = document.getElementById('r_ano').value;
	var etapa = document.getElementById('r_etapa').value;
	
	if(professor == "")
	{
		swal('Atenção', 'Campo Professor em branco.');
	}
	else if(turmas == "")
	{
		swal('Atenção', 'Campo Turma em branco.');
	}
	else if(disciplina == "")
	{
		swal('Atenção', 'Campo Disciplina em branco.');
	}
	else if(ano == "")
	{
		swal('Atenção', 'Campo Data em branco.');
	}
	else if(etapa == "")
	{
		swal('Atenção', 'Campo Periodo em branco.');
	}
	else
	{
        relatorio('?br=gerar_diario&professor='+ professor +'&turmas='+ turmas +'&disciplina='+ disciplina +'&ano='+ ano +'&etapa='+ etapa +'','loadmodal','GET');
		//window.open('relatorio.php?url=gerar_diario&professor='+ professor +'&turmas='+ turmas +'&disciplina='+ disciplina +'&ano='+ ano +'');
    }
}

</script>
<div class="modal-header">
<h2 class="pmd-card-title-text">Gerar Diario </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="form-group col-md-9 m-t-20"><label>Professor :</label>
<select name="professor" id="r_professor" class="form-control" style="width: 100%; height:36px;" onChange="javascript: ajaxLoader('?br=atu_relatorio&codigo='+ this.value +'&ap=1','r_turmas','GET');" required="required">
	<option value="">Escolher</option>
	<? 
	   $SQL = "Select * from usuarios where tipo=2";
       $RES = mysqli_query($db,$SQL);
       while($row = mysqli_fetch_array($RES))
       {		   
	?> <option value="<?=$row['codigo'];?>"><?=$row['nome'];?></option>
     <?}?>
</select>
</div>
<div class="form-group col-md-5 m-t-20"><label>Turma :</label>
<select name="turmas" id="r_turmas" class="form-control" style="width: 100%; height:36px;" onChange="javascript: ajaxLoader('?br=atu_relatorio&codigo='+ document.getElementById('r_professor').value +'&ap=2','r_disciplina','GET');" required="required">
	<option value="">Escolher</option>
</select>
</div>
<div class="form-group col-md-5 m-t-20"><label>Disciplina :</label>
<select name="disciplina" id="r_disciplina" class="form-control" style="width: 100%; height:36px;" required="required">
	<option value="">Escolher</option>
</select>
</div>
<div class="form-group col-md-4 m-t-20"><label>Periodo :</label>
<select name="r_etapa" id="r_etapa" style="width: 100%; height:36px;" class="select2 form-control custom-select" required="required">
	<option value="">Selecionar</option>
	<? 
		  $sql3 = "select * from periodo";
		  $res3 = mysqli_query($db,$sql3); 
		  while($row = mysqli_fetch_array($res3))
		  {
		  ?>
		   <option value="<? echo $row['codigo']?>"><? echo $row['descricao'];?></option>
		  <? }
		  $res3->close();
		  ?>
</select>
</div>
<div class="form-group col-md-3 m-t-20"><label>Ano :</label>
<input name="ano" id="r_ano" type="text" readonly class="form-control" autocomplete="off" />
</div>
<script>
	jQuery('#r_ano').datepicker({
		format: 'yyyy',
        autoclose: true,
        todayHighlight: true,
		viewMode: "years",
        minViewMode: "years",
		language: "pt-BR",
		orientation: "bottom left"
    });
</script>
<div class="form-group col-md-12 m-t-20">
<button type="button" onclick="gravar();" class="btn btn-info"><i class="fa fa-plus-circle"></i> Gerar</button>
</div>
<div class="form-group col-md-12 m-t-20" id="loadmodal">
</div>
<script>

setInterval(function()
{ 
   
   ajaxLoader('?br=atu_arquivos&ap=3";}?>','m_arquivos','GET'); 
}, 1000);
							
</script>
<div class="form-group col-md-12 m-t-20" id="loadmodal">
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
	<table class="table pmd-table">
		<thead>
			<tr>
				<th>Data</th>
				<th>Link</th>
			</tr>
		</thead>
		<tbody id="m_arquivos">
		<?
		
		  $SQL = "SELECT data,arquivo FROM arquivos where usuario='".$_SESSION['usuario']."' order by data desc limit 5;";
		  $res = mysqli_query($db,$SQL); 
		  while($row = mysqli_fetch_array($res))
		  {
		  ?>
			<tr>
				<td data-title="Data"><? echo formatodatahora($row['data']);?></td>
				<td data-title="Link"><a class="fa fa-edit" target="_brank" href="<? echo $row['arquivo']?>" style="font-size: 150%;"><a></td>
			</tr>
		  <? } ?>
		</tbody>
	</table>
  </div>
</div>
</form>										 
<div class="modal-footer">
</div>
<? }?>
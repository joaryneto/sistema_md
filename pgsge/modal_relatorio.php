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

if($_SESSION['menu99'] == false)
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
	var professor = document.getElementById('professor').value;
	var turmas = document.getElementById('turmas').value;
	var disciplina = document.getElementById('disciplina').value;
	var ano = document.getElementById('ano').value;
	
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
	else
	{
        //relatorio('?br=gerar_diario&professor='+ professor +'&turmas='+ turmas +'&disciplina='+ disciplina +'&ano='+ ano +'','load','GET');
		window.open('relatorio.php?url=gerar_diario&professor='+ professor +'&turmas='+ turmas +'&disciplina='+ disciplina +'&ano='+ ano +'');
    }
}

</script>
<div class="modal-header">
<h2 class="pmd-card-title-text">Gerar Diario :</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="m-t-40 row">
<div class="form-group col-md-9 m-t-20"><label>Professor :</label>
<select name="professor" id="professor" class="form-control" style="width: 100%; height:36px;" onChange="javascript: ajaxLoader('?br=atu_relatorio&codigo='+ this.value +'&ap=1','turmas','GET');" required="required">
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
<select name="turmas" id="turmas" class="form-control" style="width: 100%; height:36px;" onChange="javascript: ajaxLoader('?br=atu_relatorio&codigo='+ document.getElementById('professor').value +'&ap=2','disciplina','GET');" required="required">
	<option value="">Escolher</option>
</select>
</div>
<div class="form-group col-md-5 m-t-20"><label>Disciplina :</label>
<select name="disciplina" id="disciplina" class="form-control" style="width: 100%; height:36px;" required="required">
	<option value="">Escolher</option>
</select>
</div>
<div class="form-group col-md-3 m-t-20"><label>Ano :</label>
<input name="ano" id="ano" type="text" readonly class="form-control" autocomplete="off" />
</div>
<script>
	jQuery('#ano').datepicker({
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
<div class="form-group col-md-12 m-t-20" id="load">
<div>
</form>										 
<div class="modal-footer">
<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
</div>
<? }?>
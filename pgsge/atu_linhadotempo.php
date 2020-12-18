<?
if(@$_GET['load'] == 1)
{
$mes = $_GET['mes'];
$ano=date("Y");

if($_SESSION['permissao'] == 1)
{
	$whe = " and matriculas.matricula='".$_SESSION['matricula']."'";
}
else
{
	$whe = " and usuarios.codigo='".$_SESSION['usuario']."'";
}

$count = 0; 
$SQL = "select usuarios.nome,diario.data,diario.conteudo,diario.video,diario.texto,matriculas.codigo,turmas.descricao as turma,materias.descricao as disciplina,matriculas.foto from diario 
inner JOIN turmas on turmas.codigo=diario.turma 
inner join materias on materias.codigo=diario.materia 
inner join matriculas on matriculas.turma=diario.turma  
inner join usuarios on usuarios.codigo=diario.usuario 
inner join turmas_professor on turmas_professor.turma=diario.turma and turmas_professor.usuario=diario.usuario
where matriculas.status=1 $whe and month(diario.data)=".$mes." and YEAR(diario.data)=".$ano."";

$RES = mysqli_query($db,$SQL);
while($row = mysqli_fetch_array($RES))
{
$professor = $row['nome'];
$disciplina = $row['disciplina'];
$hora = date("Y",strtotime($row['data']));
$dia = date("d",strtotime($row['data']));
$conteudo = $row['conteudo'];
$texto = $row['texto'];
$video = $row['video'];

?>

<div class="col-lg-6 col-md-6">
	<!-- Card -->
	<!-- Default card starts -->
<div class="pmd-card pmd-card-default pmd-z-depth">

<!-- Card header -->
<div class="pmd-card-title">
<div class="media-left">
<h2>Dia <? echo $dia;?></h2>
</div>
<div class="media-body media-middle">
<h3 class="pmd-card-title-text"><?=$professor?></h3>
<span class="pmd-card-subtitle-text"><?=$disciplina?></span>
</div>
</div>

<!-- Card media -->
<?if(!Empty($video)){?>
<div class="pmd-card-media">
<iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$video;?>" class="card-img-top img-responsive" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
<?}?>
<!-- Card body -->
<div class="pmd-card-title">
<h2 class="pmd-card-title-text"><?=$conteudo?></h2>
</div>	

<div class="pmd-card-body">
<?=$texto?>
</div>

<!-- Card media actions -->
<div class="pmd-card-actions">
<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">share</i></button>
<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">thumb_up</i></button>
<!--<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">drafts</i></button>-->
</div>

<!-- Card actions 
<div class="pmd-card-actions">
<button class="btn pmd-btn-flat pmd-ripple-effect btn-primary" type="button">Primary</button>
<button type="button" class="btn pmd-btn-flat pmd-ripple-effect btn-default">Action</button>
</div>-->
</div>
<!--Default card ends -->
	<!-- Card -->
</div>

<?}
}
?>
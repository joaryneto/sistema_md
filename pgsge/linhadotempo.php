<?

$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu0'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

if(isset($_GET['mes']))
{
	$mes=$_GET['mes'];
	$ano=date("Y");
}
else
{
	$mes=date("m");
	$ano=date("Y");
}

?>
<script>
								
	function mess(mes)
	{
		window.location.href='sistema.php?url=linhadotempo&mes=' + mes;					
    }
</script>
<div class="container-fluid bg-template mb-4">
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Agenda";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
					<select name="empresa" id="empresa" class="form-control form-control-lg search bottom-25 position-relative border-0" onChange="mess(this.value);" style="width: 100%; height:36px;">
				<option value="01" <? if($mes == "01"){ echo "selected";}?>>Janeiro</option>
				<option value="02" <? if($mes == "02"){ echo "selected";}?>>Fevereiro</option>
				<option value="03" <? if($mes == "03"){ echo "selected";}?>>Março</option>
				<option value="04" <? if($mes == "04"){ echo "selected";}?>>Abril</option>
				<option value="05" <? if($mes == "05"){ echo "selected";}?>>Maio</option>
				<option value="06" <? if($mes == "06"){ echo "selected";}?>>Junho</option>
				<option value="07" <? if($mes == "07"){ echo "selected";}?>>Julho</option>
				<option value="08" <? if($mes == "08"){ echo "selected";}?>>Agosto</option>
				<option value="09" <? if($mes == "09"){ echo "selected";}?>>Setembro</option>
				<option value="10" <? if($mes == "10"){ echo "selected";}?>>Outubro</option>
				<option value="11" <? if($mes == "11"){ echo "selected";}?>>Novembro</option>
				<option value="12" <? if($mes == "12"){ echo "selected";}?>>Dezembro</option>
			 </select>
                </div>
        </div>
</div>   
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
			<!--Tabs with Icon example -->
             <div class="row" id="load">
				<?
				$count = 0; 
				$SQL = "select usuarios.nome,diario.data,diario.conteudo,diario.video,diario.texto,matriculas.codigo,turmas.descricao as turma,materias.descricao as disciplina,matriculas.foto from diario 
				inner JOIN turmas on turmas.codigo=diario.turma 
				inner join materias on materias.codigo=diario.materia 
				inner join matriculas on matriculas.turma=diario.turma  
				inner join usuarios on usuarios.codigo=diario.usuario 
				inner join turmas_professor on turmas_professor.turma=diario.turma and turmas_professor.usuario=diario.usuario
				where matriculas.status=1 and matriculas.matricula=".$_SESSION['matricula']." and month(diario.data)=".$mes." and YEAR(diario.data)=".$ano."";
				$RES = mysqli_query($db,$SQL);
				while($row = mysqli_fetch_array($RES))
				{
						$professor = $row['nome'];
						$disciplina = $row['disciplina'];
						$hora = date("Y",strtotime($row['data']));
						$dia = date("d",strtotime($row['data']));
						$conteudo = $row['conteudo'];
						$texto = $row['texto'];
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
			  $RES->close();
			  ?>
		   </div>
	   </div>
    </div>
  </div>
</div>
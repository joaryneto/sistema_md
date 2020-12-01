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

if($_GET['bloquear']==1 and $menu7 == 1 or $_GET['bloquear']==1 and $menu99 == 1)
{
  $SQL = "UPDATE laudos_enviados SET laudador=NULL , status=-1 where codigo=".$_GET['codigo']."";
  $sucesso = mysqli_query($db,$SQL);
  
  if($sucesso)
  {
	 print "<script> window.alert('Laudo bloqueado com sucesso...'); </script>";
	 print "<script> window.location='iniciado.php?url=inicio';</script>"; 
  }
}

if($_GET['excluir']==1 and $menu8 == 1)
{
  
  $SQL = "UPDATE laudos_enviados SET laudador=NULL , status=-2 where codigo=".$_GET['codigo']."";
  $sucesso = mysqli_query($db,$SQL);
  
  if($sucesso)
  {
	 print "<script> window.alert('Laudo excluido com sucesso...'); </script>";
	 print "<script> window.location='iniciado.php?url=inicio';</script>"; 
  }
  
  //$SQL = "DELETE FROM laudos_enviados where codigo=".$_GET['codigo']."";
  //$sucesso = mysqli_query($db,$SQL);
  
  //if($sucesso)
  //{
	// print "<script> window.alert('Laudo excluido com sucesso...'); </script>";
	// print "<script> window.location='iniciado.php?url=inicio';</script>"; 
  //}
}

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

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
<link href="template/css/pages/timeline-vertical-horizontal.css" rel="stylesheet">
<script>
								
	function mess(mes)
	{
		window.location.href='iniciado.php?url=linhadotempo&mes=' + mes;					
    }
</script>
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="timeline" style="max-width: 1400px;">
								    <li>
									<select name="empresa" id="empresa" class="form-control" onChange="mess(this.value);" style="width: 100%; height:36px;">
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
								     </li>
									 <li style="padding: 30px;">
                                           <div class="timeline-badge success" style="border-radius: 10px;">Dias</div>
                                         
                                        </li>
									<?
									
									 
									 
									 $count = 0; 
									 $SQL = "select usuarios.nome,diario.data,diario.conteudo,diario.texto,matriculas.codigo,turmas.descricao as turma,materias.descricao as disciplina,matriculas.foto from turmas_professor 
									 inner JOIN turmas on turmas.codigo=turmas_professor.turma 
									 inner join diario on diario.turma=turmas.codigo
									 inner join materias on materias.codigo=diario.materia 
									 inner join matriculas on matriculas.turma=diario.turma  
									 inner join usuarios on usuarios.codigo=turmas_professor.usuario 
									 where matriculas.status=1 and matriculas.matricula=".$cod_aluno." and month(diario.data)=".$mes." and YEAR(diario.data)=".$ano."";
									 $RES = mysqli_query($db,$SQL);
									 while($row = mysqli_fetch_array($RES))
									 {
										 $professor = $row['nome'];
										 $disciplina = $row['disciplina'];
										 $hora = date("Y",strtotime($row['data']));
										 $dia = date("d",strtotime($row['data']));
										 $conteudo = $row['conteudo'];
										 $texto = $row['texto'];
										
                                         if($count == 0)
                                         {
								     ?>
									    
                                        <li>
                                           <div class="timeline-badge success"><? echo $dia;?></div>
                                          <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Prof. <? echo $professor; ?></h4>
												<h4 class="timeline-title">Disciplina: <? echo $disciplina; ?> - <? echo $conteudo; ?> </h4>
                                            </div>
                                            <div class="timeline-body">
                                                <p><? echo $texto;?></p>
                                            </div>
                                        </div>
                                        </li>
										 <?   $count = 1;
										   }
										   else
										   { ?>
										<li class="timeline-inverted">
                                        <div class="timeline-badge warning"><? echo $dia;?></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Prof. <? echo $professor; ?></h4>
												<h4 class="timeline-title">Disciplina: <? echo $disciplina; ?> - <? echo $conteudo; ?> </h4>
                                            </div>
                                            <div class="timeline-body">
                                                <p><? echo $texto;?></p>
                                            </div>
                                         </div>
                                        </li>
										 <?   $count = 0;
										    } ?>
										 
									<? //$count++;
									} ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
</div>				

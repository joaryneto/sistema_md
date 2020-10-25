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

if($_SESSION['menu5'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}
	
$SQL1 = "Select laudos_enviados.*, tipo_exame.descricao FROM laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo where laudos_enviados.codigo='".$_GET['codigo']."'";
$res_dado = mysqli_query($db,$SQL1);

while ($row_dado = mysqli_fetch_array($res_dado)) 
{
	
	$protocolo=$row_dado['protocolo'];
	$paciente=$row_dado['paciente'];
	$datainicio=$row_dado['datainiciolaudo'];
	$nascimento=$row_dado['nascimento'];
	$infoadcionais=$row_dado['obs'];
	$tipolaudo=$row_dado['tipolaudo'];
	$exameenviado=$row_dado['descricao'];
	
}

$res_result = mysqli_query($db,"SELECT * FROM resultado_laudo where laudo=".$_GET['codigo']." order by codigo asc");
while ($row_result = @mysqli_fetch_array($res_result)) 
{
	
	if($carregaResul=="")
	{
		$carregaResul = $row_result['resultado'];
	}else{
		$carregaResul = $row_result['resultado'].";".$carregaResul;
	}
	
}
   
$res_q = mysqli_query($db,"SELECT codigo FROM resultado where tipo_exame=".$tipolaudo." order by descricao desc");
while ($row_q = @mysqli_fetch_array($res_q)) {
				
		$res_q2 = mysqli_query($db,"SELECT count(codigo) as qtd FROM comentario_tipo_exame where tipo_exame=".$tipolaudo." and resultado_exame=".$row_q['codigo']." order by descricao desc");
		while ($row_q2 = @mysqli_fetch_array($res_q2)) {		
			$qtdReg = $qtdReg + $row_q2['qtd'];
		}
		
}

$msg="";

$erro=false;

if(isset($_POST['enviar']))
{

	if(Empty($_POST['produto']) and $_POST['erro'] == 0)
	{
		//print "<script> window.alert('Selecione o resultado.'); </script>";
		print "<script> window.location='iniciado.php?url=confirmar_laudo&codigo=".$_GET['codigo']."'; </script>";
	}
	else
	{
	
		
		if($_POST['erro']==0)
		{		
              $SQL_Del = "DELETE FROM resultado_laudo where laudo = '".$_GET['codigo']."'";
			  mysqli_query($db,$SQL_Del);
				
			  if(isset($_POST['produto']))
              {
                  if(!empty($_POST['produto']) && is_array($_POST['produto']))
                  {
                     foreach($_POST['produto'] as $item) 
                     {
						 ///if(@$item['check'])
                         //{
							//print "<script> window.alert('".$item."'); </script>";
							
							$SQL_In = "INSERT into resultado_laudo(laudo, resultado) values('".$_GET['codigo']."',".$item.");";
							$sucess = mysqli_query($db,$SQL_In);
                         //}							 
				     }
				  }
				  
				  if($sucess)
				  {
					  print "<script> window.location='iniciado.php?url=confirmar_laudo&codigo=".$_GET['codigo']."'; </script>";
				  }
			  }
			
		}
		else
		{				
			//print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
			print "<script> window.location='iniciado.php?url=confirmar_inconsistencia&codigo=".$_GET['codigo']."'; </script>";
				
		}
	}
	
}


if($_GET['ap'] == 1)
{
  //$SQL2 = "UPDATE laudos_enviandos SET laudador='null', status=1 where codigo=".$_GET['codigo']."";
  //$RES = mysqli_query($SQL2);
}

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}


$sql = "SELECT codigo,imagem,protocolo FROM imagens where protocolo='".$protocolo."'";
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{  

$SQL2 = "SELECT * FROM laudos_enviados where protocolo=".$row['protocolo']."";
$RES2 = mysqli_query($db,$SQL2);
 
while($rows = mysqli_fetch_array($RES2))
{
	 if($rows['pasta'] == 0)
	 {
		 $local = "/laudos_enviados/";
	 }
	 else
	 {
		 $local = "/laudos_enviados/".$protocolo."/";
	 }
	 
	 $status=$rows['status']; 
}
}
 
?>    
       
<script>

//function visualizar(protocolo,dcm,codigo)
//{
//	window.open('http://sistemav2.imaggi.com.br/dwv/viewers/mobile/index.html?input=http://sistemav2.imaggi.com.br/laudos_enviados/'+ protocolo +'/'+ dcm +'&codigo='+ codigo +'');
//}

function ajustar()
{
try{    
var oBody       =       ifrm.document.body;
var oFrame      =       document.all("viwer");          
oFrame.style.height = oBody.scrollHeight + (oBody.offsetHeight - oBody.clientHeight);
oFrame.style.width = oBody.scrollWidth + (oBody.offsetWidth - oBody.clientWidth);
}
catch(e)
{
window.status = 'Error: ' + e.number + '; ' + e.description;
}
}

function getExt(filename)
{
	var ext = filename.split(".").pop();
    if(ext == filename) return "";
    return ext;

}

function visualizar(local,arquivo)
{	
	if(getExt(arquivo)=="pdf")
	{
		document.getElementById("verPdf").innerHTML = "<object data=.."+ local +""+arquivo+" type=application/pdf width=100% height=1024></object>";

	}
	else if(getExt(arquivo) == "PDF")
	{
		document.getElementById("verPdf").innerHTML = "<object data=.."+ local +""+arquivo+" type=application/pdf width=100% height=1024></object>";
	}
	else if(getExt(arquivo) == "dcm")
	{
		document.getElementById("verPdf").innerHTML = "<div id=rx><iframe src='/dwv/viewers/mobile/index.html?input=http://<? echo $_SERVER[HTTP_HOST];?>"+ local +""+arquivo+"&codigo=<?php echo $codigo;?>' height=1024 width=100%></iframe></div>";
	}
	else
	{
		document.getElementById("verPdf").innerHTML = "<img src="+arquivo+">";
	}
}
</script>	   
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
							<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Laudar exame";?></h4>
                                <div class="table-responsive m-t-40">
								<form name="laudo" method="post" action="iniciado.php?url=laudar&codigo=<? echo $_GET['codigo']; ?>">
								 <? echo $checked_count = count($_POST['produto']); ?><br>
								<div class="anchor">
			                    <ul>
			                    <?
								$SQL4 = "SELECT * FROM resultado where tipo_exame=".$tipolaudo." order by descricao desc";
								$res_r = mysqli_query($db,$SQL4);
								
			                    while ($row_r = mysqli_fetch_array($res_r)) {			
			                    ?>
			                    <li>
			                    <label><input type="checkbox"  hidden="true" /><? echo $row_r['descricao']; ?></label>
			                    <ul>
								
			                    <?
								
								$SQL5 = "SELECT codigo,descricao FROM comentario_tipo_exame where tipo_exame=".$tipolaudo." and resultado_exame=".$row_r['codigo']." order by descricao desc";
								$res_r2 = mysqli_query($db,$SQL5);
			                    while ($row_r2 = mysqli_fetch_array($res_r2)) 
								{			
			                    ?>
                                      <li>
									  <label>
									  <input name="produto[]" type="checkbox" value="<? echo $row_r2['codigo']; ?>" /> <? echo $row_r2['descricao']; ?>
									  </label>
									  </li>                        
                                      <? } ?>
					                 </ul>
				                     </li>	
                                   <? } ?>		
			                        </ul>
		                         </div>
								<br>
								<div class="form-group"><label><b>Paciente :</b> <? echo $paciente; ?></label></div>
								<div class="form-group"><label><b>Nascimento :</b>  <? echo formatodatahora($nascimento); ?> - Idade :</label></div>
								<div class="form-group"><label><b>Exame :</b>  <? echo $exameenviado ?></label></div>
								<div class="form-group"><label><b>Info. Adcionais :</b>  <? echo $infoadcionais ?></label></div>
								<div class="form-group"><label><b>Imagens enviadas :</b>  </label><Br>
								  <?
										$contar=0;
		
										$valid_formats = array("dcm","jpg","pdf","jpeg","PDF");		
										$SQL2 = "SELECT * FROM imagens where protocolo = '".$protocolo."' order by codigo asc";
										$res_img = mysqli_query($db,$SQL2);
										while ($row_img = mysqli_fetch_array($res_img)) 
										{
                                            $contar++;
		
		
		                                  $file = ".".$local.$row_img['imagem'];
		                                  if(file_exists($file))
                                          {
											 ?>
											    <a class="btn waves-effect waves-light btn-info" href="javascript: Web(0);" data-toggle="modal" data-target="#respon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver imagem" OnClick="visualizar('<? echo $local; ?>','<? echo $row_img['imagem']; ?>')"><? echo $contar; ?> <i class="fa fa-eye"></i></a>
  								             <?
										  }
 								       }
									   
									    echo "<br><br><h4>Download:</h4><br>";
									    $valid_formats = array("dcm","jpg","pdf","jpeg","PDF");		
										$SQL2 = "SELECT * FROM imagens where protocolo = '".$protocolo."' order by codigo asc";
										$res_img = mysqli_query($db,$SQL2);
										
										$contar2=0;
									   	while ($row_img = mysqli_fetch_array($res_img)) 
										{
                                            $contar2++;
		
		
		                                  $file = ".".$local.$row_img['imagem'];
		                                  if(file_exists($file))
										  {
											 ?>
											  <a class="btn waves-effect waves-light btn-info" target="_brank" href="<? echo $local;?><? echo $row_img['imagem']; ?>"><? echo $contar2; ?> <i class="fa fa-download"></i></a>
										     <?
										  }
 								        }
								 ?>
								</div>
								<div class="form-group"><label><input name="erro" type="checkbox" id="erro" value="1" />
          Exame com inconsistencia de imagens ou informa&ccedil;&otilde;es.</label></div>
		  <div class="form-group"><label><input class="btn btn-info" type="submit" name="enviar" id="enviar" value="Iniciar Finaliza&ccedil;&atilde;o">
        &nbsp;&nbsp;&nbsp;&nbsp;
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#responsive-modal">Desistir do Laudo</button> </label>
		</div>
		
		                        <!-- sample modal content -->
                                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Atenção!</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                Deseja realmente desistir do laudo ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>
                                                <button type="button" onclick="javascript: window.location='iniciado.php?url=cancela_laudamento&codigo=<? echo $_GET['codigo']; ?>';" class="btn btn-danger waves-effect waves-light">Sim</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal --></form> 
								<div id="respon" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog modal-lg">
								<div class="modal-content">
								<div class="modal-header">
								<h4 class="modal-title" id="myLargeModalLabel"><b>Imagem do Exame</b></h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								</div>
								<div class="modal-body">

								<div id="verPdf"> 
								</div>
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
								</div>
								</div>
								</div>
								</div>
                                </div>
                            </div>
                        </div>
					</div>
<?

if($erro==true)
{ 
    print ("<script> window.alert(Laudo finalizado com sucesso.');</script>");
}

if($carregaResul=="")
{
	$some_arr = explode(";", $_POST['resultado']);
}
else
{
	$some_arr = explode(";", $carregaResul);
}

$arr_length = count($some_arr);
for($i=0;$i<$arr_length;$i++)
{
	$chkSelecionados="'".$some_arr[$i]."',".$chkSelecionados;
}

?>				
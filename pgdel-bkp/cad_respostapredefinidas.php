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

if($_SESSION['menu16'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

if(isset($_GET['codigo']))
{
	$sucesso = mysqli_query($db,"SELECT * FROM comentario_tipo_exame where codigo='".$_GET['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $exame = $row['tipo_exame'];
		 $resulexame = $row['resultado_exame'];
		 $resultado = $row['descricao'];
		 $conclusao = $row['conclusao'];
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if(isset($_GET['exame']))
{
	$sucesso = mysqli_query($db,"SELECT codigo,descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['exame']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $exame = $row['codigo'];
		 $descricao = $row['descricao'];
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if($_GET['ap'] == "1")
{
$sucesso = mysqli_query($db,"SELECT * FROM comentario_tipo_exame where tipo_exame='".$_POST['exame']."' and resultado_exame='".$_POST['resultadoexame']."'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Exame ja existe')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_resultadoexame';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into comentario_tipo_exame(tipo_exame,resultado_exame,descricao,conclusao,status) values('".$_POST['exame']."','".$_POST['resultadoexame']."','".$_POST['resultado']."','".$_POST['conclusao']."',1)";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $SQL2 = "INSERT into comentario_tipo_exame(tipo_exame,resultado_exame,descricao,conclusao,status) values('".$_POST['exame']."','".$_POST['resultadoexame']."','".$_POST['resultado']."','".$_POST['conclusao']."',1)";
	   $sucesso2 = mysqli_query($db3,$SQL2);
	   
	   if($sucesso and $sucesso2)
	   {
		   print("<script>window.alert('Exame Adiconado com sucess')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_respostapredefinidas';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE comentario_tipo_exame SET descricao='".$_POST['resultado']."',conclusao='".$_POST['conclusao']."' where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE comentario_tipo_exame SET descricao='".$_POST['resultado']."',conclusao='".$_POST['conclusao']."' where codigo='".$_GET['codigo']."'";
	$sucesso2 = mysqli_query($db3,$SQL2);
	
	if($sucesso and $sucesso2)
	{
        print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_respostapredefinidas&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}


function limitarTexto($texto, $limite, $quebrar = true)
{
  //corta as tags do texto para evitar corte errado
  $contador = strlen(strip_tags($texto));
  if($contador <= $limite):
    //se o número do texto form menor ou igual o limite então retorna ele mesmo
    $newtext = $texto;
  else:
    if($quebrar == true): //se for maior e $quebrar for true
      //corta o texto no limite indicado e retira o ultimo espaço branco
      $newtext = trim(mb_substr($texto, 0, $limite))."...";
    else:
      //localiza ultimo espaço antes de $limite
      $ultimo_espaço = strrpos(mb_substr($texto, 0, $limite)," ");
      //corta o $texto até a posição lozalizada
      $newtext = trim(mb_substr($texto, 0, $ultimo_espaço))."...";
    endif;
  endif;
  return $newtext;
}

?>		
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de Respostas Pre-definidas";?></h4>
								<form class="form-material m-t-40 row" name="laudo" method="post" action="<? if($_GET['codigo'] ==""){ echo "iniciado.php?url=cad_respostapredefinidas&ap=1";}else { echo "iniciado.php?url=cad_respostapredefinidas&ap=2&codigo=".$_GET['codigo']."";} ?>">
								
								<script>
								
								function resu(exame)
								{
									window.location.href='iniciado.php?url=cad_respostapredefinidas&exame=' + exame;					
								}
								
								</script>
								<div class="form-group col-md-4 m-t-20"><label>Exame :</label>
								<!-- onChange="exames('< echo $_GET['cnpj'];?>',this.value);" -->
								<select name="exame" class="select2 form-control custom-select" onChange="resu(this.value);" style="width: 100%; height:36px;" <?if(isset($_GET['codigo'])){ ?> Disabled <? } ?> required="required">
                                    <option value="">Selecione Exame</option>
									<? 
										  $sql = "select codigo,descricao,valor_padrao,status from tipo_exame";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($exame == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-4 m-t-20"><label>Resultado Exame :</label>
								<!-- onChange="exames('< echo $_GET['cnpj'];?>',this.value);" -->
								<select name="resultadoexame" class="select2 form-control custom-select" style="width: 100%; height:36px;" <?if(isset($_GET['codigo'])){ ?> Disabled <? } ?> required="required">
                                <option value="">Selecione Resultado</option>
								<? 
										  $sql = "select codigo,descricao from resultado where tipo_exame='".$exame."'";
										  $res = mysqli_query($db,$sql);
										  
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($resulexame == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
										  <?
										  }
								?>
                                </select></div>
								<div class="form-group col-md-6 m-t-20"><label>Resultado :</label>
								<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
								<textarea name="resultado" class="form-control" rows="5" id="resultado" style="width:100%;border-width:0px;" required="required"><? if(isset($_GET['codigo'])){ echo $resultado;} ?></textarea>
								</div>
								<div class="form-group col-md-6 m-t-20"><label>Conclusão :</label>
								<textarea name="conclusao" class="form-control" rows="5" id="conclusao" style="width:100%;border-width:0px;"><? if(isset($_GET['codigo'])){ echo $conclusao;} ?></textarea>
								</div>
								<div class="form-group col-md-4 m-t-20">
								<br>
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Alterar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="iniciado.php?url=cad_respostapredefinidas"><i class="fa fa-plus-circle"></i> Novo cadastro</a>
								</div></div>
								</form>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
												<!--<th>Valor Total</th>-->
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  //if(isset($_GET['empresa']))
										  //{
										  $sql = "select comentario_tipo_exame.codigo,comentario_tipo_exame.descricao, comentario_tipo_exame.conclusao from comentario_tipo_exame";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
                                                <td><? echo limitarTexto($row['descricao'],100);?></td>
												<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
												<td><a class="fa fa-edit" style="font-size: 150%;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" href="iniciado.php?url=cad_respostapredefinidas&codigo=<? echo $row['codigo']?>"><a></td>
                                            </tr>
										  <? } //} ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>	
												<!--<th>Valor Total</th>-->
												<th>X</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
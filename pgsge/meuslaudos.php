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
	
if($_GET['bloquear']==1)
{
  $SQL = "UPDATE laudos_enviandos SET laudador='null', status=1 where codigo=".$_GET['codigo']."";
  $RES = mysqli_query($SQL);
}

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

if(isset($_POST['button']))
{
	$mes=$_POST['mes'];
	$ano=$_POST['ano'];
	$tipo=$_POST['tipo'];
}
else
{
	$mes=date("m");
	$ano=date("Y");
}

?>                
				<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
							   <h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Lista de exames";?> </h4>
							   <form class="form-material m-t-40 row" id="form1" name="form1" method="post" action="iniciado.php?url=meuslaudos">
							   <div class="form-group col-md-3 m-t-20"><label>Nome :
							   <input type="text" name="nome" id="nome" value="<? echo $_POST['nome']; ?>" class="form-control">
							   </div>
							   <div class="form-group col-md-3 m-t-20"><label>Mês :</label><select class="select2 form-control custom-select" name="mes" id="mes">
		<option value="" <? if($mes==""){ echo "selected"; } ?> >Todos os meses</option>
        <option value="1" <? if($mes==1){ echo "selected"; } ?> >Janeiro</option>
		<option value="2" <? if($mes==2){ echo "selected"; } ?> >Fevereiro</option>
		<option value="3" <? if($mes==3){ echo "selected"; } ?> >Março</option>
		<option value="4" <? if($mes==4){ echo "selected"; } ?> >Abril</option>
		<option value="5" <? if($mes==5){ echo "selected"; } ?> >Maio</option>
		<option value="6" <? if($mes==6){ echo "selected"; } ?> >Junho</option>
		<option value="7" <? if($mes==7){ echo "selected"; } ?> >Julho</option>
		<option value="8" <? if($mes==8){ echo "selected"; } ?> >Agosto</option>
		<option value="9" <? if($mes==9){ echo "selected"; } ?> >Setembro</option>
		<option value="10" <? if($mes==10){ echo "selected"; } ?> >Outubro</option>
		<option value="11" <? if($mes==11){ echo "selected"; } ?> >Novembro</option>
		<option value="12" <? if($mes==12){ echo "selected"; } ?> >Dezembro</option>                                                                                        
    </select>
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Ano :</label>
								<select class="select2 form-control custom-select" name="ano" id="ano">
        <option value="" <? if($ano==""){ echo "selected"; } ?> >Todos os anos</option>
        <option value="2015" <? if($ano==2015){ echo "selected"; } ?> >2015</option>
        <option value="2016" <? if($ano==2016){ echo "selected"; } ?> >2016</option>
        <option value="2017" <? if($ano==2017){ echo "selected"; } ?> >2017</option>
        <option value="2018" <? if($ano==2018){ echo "selected"; } ?> >2018</option>
        <option value="2019" <? if($ano==2019){ echo "selected"; } ?> >2019</option>
        <option value="2020" <? if($ano==2020){ echo "selected"; } ?> >2020</option>                                        
      </select>
								</div>
								<div class="form-group col-md-3 m-t-20">
								<br>
								<input type="submit" class="btn btn-info" name="button" id="button" value="Filtrar" />
								</div>
								</form>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Paciente</th>
												<th>Tipo de Exame</th>
												<th>Enviado</th>
												<th>Situação</th>
												<th>Finalizado</th>
												<th>Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										
										  $laudador = "";
										  
										  if($tipo == 1)
										  {
											   $status = " and laudos_enviados.status IN (2,3) ";
										  }
										  elseif($tipo == 2)
										  {
											   $status = " and laudos_enviados.status IN (2,3) ";
										  }
										  elseif($tipo == 3 )
										  {
											   $status = " and laudos_enviados.status IN (2,3)";
										  }
										  
										  if($mes == 0)
										  {
											  $meses = " ";
										  }
										  else
										  {
											  $meses = " and month(laudos_enviados.dataenvio)='".$mes."'";
										  }
										  
										  if($ano == 0)
										  {
											  $anos = " ";
										  }
										  else
										  {
											  $anos = " year(laudos_enviados.dataenvio)=".$ano." ";
										  }
										  
										  if(Empty($_POST['nome']))
										  {
											  $bnome = "";
										  }
										  else
										  {
											  $bnome = " and paciente like '%".$_POST['nome']."%' ";
										  }
										  
										  $sql = "select laudos_enviados.codigo,laudos_enviados.inconsistencia,laudos_enviados.protocolo,laudos_enviados.paciente,empresas.identificacao,tipo_exame.descricao,laudos_enviados.dataenvio,laudos_enviados.status,laudos_enviados.dataterminolaudo from laudos_enviados inner join empresas on empresas.cnpj=laudos_enviados.empresa 
										  inner join tipo_exame on tipo_exame.codigo=laudos_enviados.tipolaudo 
										  where $anos $status $meses $bnome and laudos_enviados.laudador=".$_SESSION['usuario']." order by laudos_enviados.codigo desc";
										  
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
                                                <td><? echo $row['paciente'];?></td>
												<td><? echo $row['descricao'];?></td>
												<td><? echo formatodatahora($row['dataenvio']);?></td>
												<td><? 
												
												if(Empty($defineuser))
												{
													$wher = "codigo='".$row['laudador']."'";
												}
												else
												{
													$wher = "cod_usuario='".$row['laudador']."'";
												}
												
												$SQL_laud = "SELECT * FROM internet_usuarios where $wher";
												$RES_laud = mysqli_query($db,$SQL_laud);
												
												while($rows = mysqli_fetch_array($RES_laud))
												{
													$por = $rows['nome'];
												}
												
												Switch($row['status'])
												            { 
															   case 1:
															   {
															     echo '<i class="fa fa-arrow-up" style="font-size: 150%; color: green;"></i>';
															   }break;
															   case 2:
															   {
																      if($row['laudo_terceiro'] == 1)
																      {  
																		 $SQLIMG = "SELECT * FROM laudo_terceiros where protocolo=".$row['protocolo']." limit 1";
																		 $RESIMG = mysqli_query($db,$SQLIMG);
																		 
																		 while($rows = mysqli_fetch_array($RESIMG))
																		 {																	 
																		     echo '<a href="laudos_terceiros/'.$rows['arquivo'].'" target="_brank"><i class="fa fa-archive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Visualizar Laudo" style="font-size: 150%; color: #46bef9;"></i></a>'; 
																		 }
																	  }
																	  else
																	  {
																         echo '<a href="laudo/emitir_laudo_medico_pdf2.php?codigo='.$row['codigo'].'" target="_brank"><i class="fa fa-archive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Visualizar Laudo" style="font-size: 150%; color: #46bef9;"></i></a>';																		  
																	  }
															   }break;
															   case 3:
															   {
																 echo '<a href="iniciado.php?url=confirmar_inconsistencia&codigo='.$row['codigo'].'"><i class="fa fa-exclamation-triangle" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$row['inconsistencia'].'" style="font-size: 150%; color: #f0cc08;"></i></a>';
															   }break;
															   case "-1":
															   {
																 echo '<i class="fa fa-ban" style="font-size: 150%; color: red;"></i>';
															   }break;
															   default:
															   {
																 echo '';
															   }
															}
															?></td>
												<td><? if($row['status'] == 2){ echo formatodatahora($row['dataterminolaudo']); }?></td>
												<td>
												<table>
												<tr>
												<td>
												<? if($menu6 == 1 and $row['status'] == 2 and $row['laudo_terceiro'] == 0 or $menu6 == 1 and $row['status'] == 3 and $row['laudo_terceiro'] == 0 ){ ?><td>
												<a href="iniciado.php?url=editar_laudo&codigo=<? echo $row['codigo']; ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar Exame Laudado" style="font-size: 150%; color: #f0cc08;"></i></a>
												</td><? } ?>
												</td>
												<td>
												<a href="" OnClick="javascript: ajaxLoader('?br=mimagens&protocolo=<? echo $row['protocolo'];?>&modal=1&list=1','images','GET');" data-toggle="modal" data-target="#exames"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Visualizar imagens" style="font-size: 150%; color: #46bef9;"></i></a>
												</td>										
												</tr>
												</table>
												</td>
                                            </tr>
										  <? } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Paciente</th>
												<th>Tipo de Exame</th>
												<th>Enviado</th>
												<th>Situação</th>
												<th>Finalizado</th>
												<th>Opções</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
<div id="exames" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">
<b>Lista de exames :</b></h4>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<div id="images">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
</div>			
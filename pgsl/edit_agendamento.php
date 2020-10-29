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

//if($_SESSION['menu3'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

?>		
          
                              
									<div class="row">
									<div class="col-12">
									<div class="form-group col-md-12 m-t-20" id="inputcliente"><label>Cliente:</label>
									    <input name="nome2" id="nome2" type="text" value="<?=$_GET['nome'];?>" autocomplete="off" class="form-control" required="required">
									<div id="pesquisacliente"></div>
									</div>
									<div class="form-group col-md-12 m-t-20" id="inputcliente"><label>Data:</label>
										<input name="codagenda" id="codagenda" type="hidden" autocomplete="off" value="<?=$_GET['codigo'];?>" class="form-control" required="required">
									    <input name="dataagenda2"  id="dataagenda2" value="<?=formatodatahora($_GET['data']);?>" type="text" autocomplete="off" class="form-control">
										<script>
										jQuery('#dataagenda2').datepicker({
												format: 'dd/mm/yyyy',
 										       autoclose: true,
										        todayHighlight: true,
												language: "pt-BR",
												orientation: "bottom left"
										});
										
										</script>
									</div>
									<div class="form-group col-md-4 m-t-20">
									  <label>Horario:</label>
									    <div id="horario2">
										<select name="hora2" id="hora2" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
										<option>Selecionar Horario</option>
		<?
		
											$data = revertedata($_GET['data']);
		
											$SQL1 = "SELECT hora FROM horarios where sistema='".$_SESSION['sistema']."'";
											$RES1 = mysqli_query($db3,$SQL1);
											while($row1 = mysqli_fetch_array($RES1))
											{
											  $x = 0;
											  $SQL2 = "SELECT hora FROM agendamento where data='".$_GET['data']."' and hora='".$row1['hora']."' and hora NOT LIKE '".$_GET['hora']."%'";
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
												  ?>
												  <option value="<?=$row1['hora'];?>" <? if($_GET['hora'] == $row1['hora']){ echo "selected";} ?>><?=$row1['hora'];?></option>
												  <?
											  }
											}
											
									
											?>
										</select>
										</div>
									</div>
							</div>
						</div>
                   
               

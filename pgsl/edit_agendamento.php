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
									    <input name="dataagenda2"  id="dataagenda2" value="" type="text" autocomplete="off" class="form-control">
										<script>
										jQuery('#dataagenda2').datepicker({
												format: 'dd/mm/yyyy',
 										        autoclose: true,
										        todayHighlight: true,
												language: "pt-BR",
												orientation: "bottom left"
										});
										
										//function changedata(datavv)
									    //{
											//var datav = document.getElementById('dataagenda2').value;
											
										//	requestPage2('?br=atu_pesquisa&data='+ datavv +'&ap=3','horario2','GET');
										//}
										
										$('#dataagenda2').on('change', function() 
										{
											jQuery('#dataagenda2').datepicker({autoclose: true});
											var datav = document.getElementById('dataagenda2').value;
										    requestPage2('?br=atu_pesquisa&data='+ datav +'&ap=3','horario2','GET');
										});
										
										
										</script>
									</div>
									<div class="form-group col-md-4 m-t-20">
									  <label>Horario:</label>
									    <div id="horario2">
										<select name="hora2" id="hora2" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
										<option>Selecionar Horario</option>
										</select>
										</div>
									</div>
							</div>
						</div>
                   
               

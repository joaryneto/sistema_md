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
<div class="container my-5">
							    <?
								
								$SQL3 = "SELECT sum(total) as total FROM vendas_mov where caixa='".$_SESSION['caixa']."'";
								$RES3 = mysqli_query($db3,$SQL3);
								$ROW3 = mysqli_fetch_array($RES3);
								
								$vtotal = number_format($ROW3['total'],2,",",".");
								
								?>

								<h1 class="card-title"><? echo $_SESSION["PAGINA"] = "Agendamentos";?></h1>
                                <form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>"> 
								<div class="form-group col-md-4 m-t-20" style="clear: both;"><label>Calendario</label>
								   <div class="input-group">
                                       <input type="text" name="data" autocomplete="off" id="data" class="form-control" onchange="testesds(this.value);" placeholder="00/00/0000">
                                        <div class="input-group-append">
                                           <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                   </div>
								</div>									
                                <div class="form-group col-md-12 m-t-20" style="clear: both;">
								<div id="calendar" style="width: 100%; display: inline-block;"></div>   
                                </div>			
								<script>
								function testesds(dates)
						        {
									var data = moment(dates, 'DD/MM/YYYY', true).format('YYYY-MM-DD');
									
									//alert(data);
									
								    $('#calendar').fullCalendar('changeView', 'agendaDay');
									$('#calendar').fullCalendar('gotoDate', data);
								}
								
								
								</script>
								
								
								<!--<div class="form-group col-md-12 m-t-20" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Hora</th>
                                                    <th class="text-center"><?=$profissional?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="itenss">
                                                <
										  
										  $hora = '06:30:00';
                                          //for($i = 0; $i < 35; $i++){
                                          $hora = date('H:i:s', strtotime('+30 minute', strtotime($hora)));
                                          //echo "<option value=''>$hora</option>";

												 
										  ?>
                                            <tr ><!-- color: #20aee3; --
											    <td class="text-left">< echo $hora;?></td>
                                                <td class="text-center">< echo $row['descricao'];?></td>
                                            </tr>
										  < $b = 1;
										  
										  //} 
										  
										  if($b == 0)
										  {
											 echo '<tr ><!-- color: #20aee3; --
											    <td colspan="4" class="text-center"> Nenhum registro encontrado.</td>
                                            </tr>';
										  }
										  ?>
                                            </tbody>
                                        </table>
                                    </div>-->
										
                                </div>
<!--<div class="form-group col-md-12 m-t-20" style="clear: both;">
<div class="wrapper">
  <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
</div>

<button id="save-png">Save as PNG</button>
<button id="save-jpeg">Save as JPEG</button>
<button id="save-svg">Save as SVG</button>
<button id="draw">Draw</button>
<button id="erase">Erase</button>
<button id="clear">Clear</button></div>-->
                
				<!-- BEGIN MODAL -->

				<div class="modal none-border" id="my-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add Event</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
							
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Category Name</label>
                                            <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Choose Category Color</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                <option value="success">Success</option>
                                                <option value="danger">Danger</option>
                                                <option value="info">Info</option>
                                                <option value="primary">Primary</option>
                                                <option value="warning">Warning</option>
                                                <option value="inverse">Inverse</option>
                                            </select>
                                        </div>
                                    </div>
                                
							</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
				<script>
				function testesc()
				{
					var inicio = sessionStorage.getItem("inicio");
                    var termino = sessionStorage.getItem("termino");
					
					//var inicio = $("#calendar").fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    //var termino = $("#calendar").fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
			
					var cliente = document.getElementById('cliente').value;
					var produto = document.getElementById('produto').value;
					var descricao = document.getElementById('descricao').value;

					ajaxLoader('?br=atu_agendamento&cliente='+ cliente +'&produto='+ produto +'&descricao='+ descricao +'&start='+ inicio +'&end='+ termino +'&ap=1','sucessdsd','GET');
					
					//$('#ModalAdd').modal('hide');
					
				}			
				</script>
				<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
							<form class="form-horizontal" method="POST" action="addEvent.php">							
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Agendamento</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">	
                                        <div id="sucessdsd"></div>									
										<div class="row form-group">
											<label for="cliente" class="col-sm-2 control-label">Cliente</label>
												<div class="col-sm-10">
												  <select name="cliente" id="cliente"class="select2 form-control custom-select" style="width: 100%; height:36px;"  >
													<?
													$SQL = "SELECT codigo,nome FROM Clientes where sistema='".$_SESSION['sistema']."'";
													$RES = mysqli_query($db3,$SQL);
													while($row = mysqli_fetch_array($RES))
													{
													?>
													    <option style="color:#008000;"  value="<?=$row['codigo'];?>"><?=$row['nome'];?></option>
												  <?}?>
												</select>
												</div>
										</div>
                                        <div class="row form-group">
											<label for="produto" class="col-sm-2 control-label">Produto</label>
												<div class="col-sm-10">
												  <select name="produto" id="produto"class="select2 form-control custom-select" style="width: 100%; height:36px;"  >
													<?
													$SQL = "SELECT codigo,descricao FROM produtos where sistema='".$_SESSION['sistema']."'";
													$RES = mysqli_query($db3,$SQL);
													while($row = mysqli_fetch_array($RES))
													{
													?>
													    <option style="color:#008000;"  value="<?=$row['codigo'];?>"><?=$row['descricao'];?></option>
												  <?}?>
												</select>
												</div>
										</div>	
										<textarea class="form-control" name="descricao" id="descricao" rows="10" placeholder="Escreva aqui descrição..." required="required"></textarea>									
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
										<a href="javascript: Web(0);" onclick="testesc();" class="btn btn-primary">Salvar</a>
									</div>
							</form>
						</div>
					  </div>
				</div>
				<div class="modal fade none-border" id="add-new-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add</strong> a category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
							    <div id="add"></div>
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Category Name</label>
                                            <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Choose Category Color</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                <option value="success">Success</option>
                                                <option value="danger">Danger</option>
                                                <option value="info">Info</option>
                                                <option value="primary">Primary</option>
                                                <option value="warning">Warning</option>
                                                <option value="inverse">Inverse</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Add Category -->
                <div class="modal fade none-border" id="add-new-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Add</strong> a category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Category Name</label>
                                            <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Choose Category Color</label>
                                            <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                <option value="success">Success</option>
                                                <option value="danger">Danger</option>
                                                <option value="info">Info</option>
                                                <option value="primary">Primary</option>
                                                <option value="warning">Warning</option>
                                                <option value="inverse">Inverse</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

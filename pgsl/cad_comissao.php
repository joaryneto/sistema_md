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
<div class="container-fluid bg-template mb-4">
            <div class="row hn-154 position-relative">
			<div class="background opac heightset">
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Gerar Comissão";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
              <div class="row">
			                    <script>
								$('.t-gravar').on('click',function()
		                        {
									var profissional = document.getElementById('profissional').value;
									var inicio = document.getElementById('inicio').value;
									var cfinal = document.getElementById('final').value;
									//var datav = document.getElementById('dataagenda2').value;
				
									if(profissional == "")
									{
										 swal({   
										    title: "Atenção",   
										    text: "Campo Serviço em branco.",   
										    timer: 1500,   
										    showConfirmButton: false 
									     });
									}
									else if(inicio == "")
									{
										 swal({   
										    title: "Atenção",   
										    text: "Campo Serviço em branco.",   
										    timer: 1500,   
										    showConfirmButton: false 
									     });
									}
									else if(final == "")
									{
										 swal({   
										    title: "Atenção",   
										    text: "Campo Serviço em branco.",   
										    timer: 1500,   
										    showConfirmButton: false 
									     });
									}
									else
									{
									      requestPage('?br=atu_comissao&profissional='+ profissional +'&inicio='+ inicio +'&final='+ cfinal +'&ap=1&load=1','u_load','GET');
									}
								});
								
								$('.t-viewer').on('click',function()
		                        {
									var profissional = document.getElementById('profissional').value;
									var inicio = document.getElementById('inicio').value;
									var cfinal = document.getElementById('final').value;
									//var datav = document.getElementById('dataagenda2').value;
				
									if(profissional == "")
									{
										 swal({   
										    title: "Atenção",   
										    text: "Campo Serviço em branco.",   
										    timer: 1500,   
										    showConfirmButton: false 
									     });
									}
									else if(inicio == "")
									{
										 swal({   
										    title: "Atenção",   
										    text: "Campo Serviço em branco.",   
										    timer: 1500,   
										    showConfirmButton: false 
									     });
									}
									else if(cfinal == "")
									{
										 swal({   
										    title: "Atenção",   
										    text: "Campo Serviço em branco.",   
										    timer: 1500,   
										    showConfirmButton: false 
									     });
									}
									else
									{
										  $('#modalap').modal('show');
									      requestPage2('?br=rel_extratocomissao&profissional='+ profissional +'&inicio='+ inicio +'&final='+ cfinal +'','modals','GET');
									}
								});
								
								function co_excluir(codigo)
								{
									 requestPage2('?br=atu_comissao&codigo='+ codigo +'&ap=2&load=1','u_load','GET');
								}
								
								function viewer(profissional,inicio,cfinal)
								{
									$('#modalap').modal('show');
									requestPage2('?br=rel_extratocomissao2&profissional='+ profissional +'&inicio='+ inicio +'&final='+ cfinal +'','modals','GET');
								}
								
								$('.t-buscar').on('click',function()
		                        {
								    requestPage2('?br=atu_comissao&load=1','u_load','GET');
								});
								
								jQuery('.data').datepicker({
									format: 'dd/mm/yyyy',
								    autoclose: true,
								    todayHighlight: true
								});
								</script>
				                <div class="form-group col-md-6 m-t-20"><label>Profissional :</label>
				                <select name="profissional" id="profissional" class="form-control" autocomplete="off" required="required">
				                	<option value="">Selecionar</option>
				                		<?
		
				                		$SQL1 = "SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and tipo in (2,3,4) and status=1;";
				                		$RES1 = mysqli_query($db3,$SQL1);
				                		while($row = mysqli_fetch_array($RES1))
				                		{
				                			echo "<option value='".$row['codigo']."'>".$row['nome']."</option>";
				                		}
 				                    ?>
				                	</select>
				                </div>
				                <div class="form-group col-md-2 m-t-20"><label>Data Inicio :</label>
								<input type="text" name="inicio" id="inicio" value="" readonly class="form-control data">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Data Fim :</label>
								<input type="text" name="final" id="final" value="" readonly class="form-control data">
								</div>
								<!--< } ?> -->
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="button" class="btn btn-info t-buscar"><i class="fa fa-plus-circle"></i> Filtrar</button>
								<button type="button" class="btn btn-info t-viewer"><i class="fa fa-plus-circle"></i> Pré-Extrato</button>
								<button type="button" class="btn btn-info t-gravar"><i class="fa fa-plus-circle"></i> Gerar</button>
								</div></div>
								<script>
								requestPage2('?br=atu_comissao&load=1','u_load','GET');
								</script>
								<div class="col-md-12">
					            <div class="component-box">
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							        <table class="table pmd-table">
                                            <thead>
                                                <tr>
                                                    <th>Cod.</th>
													<th>Profissional</th>
													<th>Periodo</th>
                                                    <th>Valor R$</th>
													<th>Opçôes</th>
                                                </tr>
                                            </thead>
                                            <tbody id="u_load">
                                            </tbody>
                                        </table>
                                    </div>
									</div>
									</div>
							
					</div>
				</div>
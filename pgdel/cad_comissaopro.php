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
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Comissões";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
              <div class="row">
			                    <script>
								
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
						
								function viewer(codigo,profissional,inicio,cfinal)
								{
									$('#modalap').modal('show');
									requestPage2('?br=rel_extratocomissao2&codigo='+ codigo +'&profissional='+ profissional +'&inicio='+ inicio +'&final='+ cfinal +'&aprovar=1','modals','GET');
								}
								
								jQuery('.data').datepicker({
									format: 'dd/mm/yyyy',
								    autoclose: true,
								    todayHighlight: true
								});
								</script>
								<script>
								   requestPage2('?br=atu_comissao&load=2','u_load','GET');
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
                                                    <th>Total R$</th>
													<th>Situação</th>
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
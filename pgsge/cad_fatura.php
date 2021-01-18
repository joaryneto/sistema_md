<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

if(@$_SESSION['menu12'] == false)
{
   //print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   //print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}


?>		
<div class="container-fluid bg-template mb-4">
            <div class="row hn-154 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Contas a Receber";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
<script>
								
								$('.fc-fatura').on('click',function()
								{	
				                   var faturavenc = document.getElementById('faturavenc').value;
								   var tipo = document.getElementById('tipo').value;
								   
								   var i = 0;
								   $.each($("input[name='check[]']:checked"),function()
								   {
								       //swal("Cancelled", $(this).val());
								   	   i++;
								   });
								   
								   if(i == 0)
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Selecione a fatura para visualizar os itens em cobrança.",   
									       timer: 2000,   
									        showConfirmButton: false 
									   });
								   }
								   else if(faturavenc == "")
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Campo Vencimento de Fatura em branco.",   
									       timer: 1500,   
									        showConfirmButton: false 
									   });
								   }
								   else if(tipo == "")
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Campo Tipo de Fatura em branco.",   
									       timer: 1500,   
									        showConfirmButton: false 
									   });
								   }
								   else								   
								   {
									   var alunos = [];
									   $.each($("input[name='check[]']:checked"),function()
									   {
									        alunos.push($(this).val());
									   });
	   
									   var codigo = alunos.join(",");
									   
								       requestPage2('?br=atu_fatura&codigo='+ codigo +'&faturavenc='+ faturavenc +'&tipo='+ tipo +'&ap=3','list2','GET');
								   }
								   
								});
								
								$('.fc-boleto').on('click',function()
								{	
								   
								   var i = 0;
								   $.each($("input[name='check[]']:checked"),function()
								   {
								       //swal("Cancelled", $(this).val());
								   	   i++;
								   });
								   
								   if(i == 0)
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Selecione a fatura para visualizar os itens em cobrança.",   
									       timer: 2000,   
									        showConfirmButton: false 
									   });
								   }
								   else if(i > 1)
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Selecione apenas uma fatura para visualização.",   
									       timer: 2000,   
									        showConfirmButton: false 
									   });
								   }
								   else								   
								   {
									   var alunos = [];
									   $.each($("input[name='check[]']:checked"),function()
									   {
									        alunos.push($(this).val());
									   });
	   
									   var codigo = alunos.join(",");
									   
									   $('#modalap').modal('show');
								       requestPage2('?br=atu_fatura&codigo='+ codigo +'&ap=4','modals','GET');
								   }
								   
								});
								
								$('.cc-f').on('keydown',function()
								{	
								   var texto = document.getElementById('pesquisa2').value;
								   var mes = document.getElementById('mes2').value;
								   
								   if(mes == "")
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Escolha o mês.",   
									       timer: 1500,   
									        showConfirmButton: false 
									   });
								   }
								   else								   
								   {
								       requestPage2('?br=atu_fatura&pesquisa='+ texto +'&mes='+ mes +'&load=1','list2','GET');
								   }
								   
								});
								
								$('.cc-m').on('change',function()
								{	
								   var texto = document.getElementById('pesquisa2').value;
								   var mes = document.getElementById('mes2').value;
								   
								   if(mes == "")
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Escolha o mês.",   
									       timer: 1500,   
									        showConfirmButton: false 
									   });
								   }
								   else								   
								   {
								       requestPage2('?br=atu_fatura&pesquisa='+ texto +'&mes='+ mes +'&load=1','list2','GET');
								   }
								   
								});
								
								$('.gc-filtrar').on('keydown',function()
								{	
								   var texto = document.getElementById('pesquisa1').value;
								   var mes = document.getElementById('mes1').value;
								   
								   if(mes == "")
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Escolha o mês.",   
									       timer: 1500,   
									        showConfirmButton: false 
									   });
								   }
								   else								   
								   {
								       requestPage2('?br=atu_fatura&pesquisa='+ texto +'&mes='+ mes +'&load=2','list1','GET');
								   }
								   
								});
								
								$('.ms-filtrar').on('change',function()
								{	
								   var texto = document.getElementById('pesquisa1').value;
								   var mes = document.getElementById('mes1').value;
								   
								   if(mes == "")
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Escolha o mês.",   
									       timer: 1500,   
									        showConfirmButton: false 
									   });
								   }
								   else								   
								   {
								       requestPage2('?br=atu_fatura&pesquisa='+ texto +'&mes='+ mes +'&load=2','list1','GET');
								   }
								   
								});
								
								jQuery('.data').datepicker({
									format: 'mm/yyyy',
								    autoclose: true,
									viewMode: "months",
									minViewMode: "months",
								    todayHighlight: true
								});
								
								jQuery('.data2').datepicker({
									format: 'yyyy',
								    autoclose: true,
									viewMode: "years",
									minViewMode: "years",
									language: "pt-BR",
								    todayHighlight: true
								});
								
								</script>
                     <div class="pmd-card pmd-z-depth">
					  <div class="pmd-tabs" style="line-height: 52px;">
						  <div class="pmd-tab-active-bar" style="width: 279px; left: 0px;"></div><ul role="tablist" class="nav nav-tabs nav-justified" style="width: 100%;">
							<li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#vfaturas" aria-expanded="true">Cobranças</a></li>
							<li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="profile" href="#gfaturas" aria-expanded="false">Emitir Cobranças</a></li>
						  </ul>
					  </div>
					  <div class="pmd-card-body">
					  <div class="tab-content">
						  	<div role="tabpanel" class="tab-pane active" id="vfaturas"> <!-- TAB 1 -->
							    <div class="form-material m-t-40 row">
								<div class="form-group col-md-12 m-t-20">
								<h4>Lista de Cobranças</h4>
								</div>
								<div class="form-group col-md-12 m-t-20">
								<input type="text" name="pesquisa1" id="pesquisa1" value="" placeholder="Pesquisar Faturas" class="form-control gc-filtrar">
								<select name="mes1" id="mes1" class="form-control btnadd-us ms-filtrar" style="width: 30%; height: calc(2.3em + .75rem + 2px) !important;">
								   <option value="01">Janeiro</option>
								   <option value="02">Fevereiro</option>
								   <option value="03">Março</option>
								   <option value="04">Abril</option>
								   <option value="05">Maio</option>
								   <option value="06">Junho</option>
								   <option value="07">Julho</option>
								   <option value="08">Agosto</option>
								   <option value="09">Setembro</option>
								   <option value="10">Outubro</option>
								   <option value="11">Novembro</option>
								   <option value="12">Dezembro</option>
								</select> 
								</div>
								<div class="form-group col-md-12 m-t-20">
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
                                   <table class="table pmd-table">
                                         <thead>
                                              <tr>
											    <th><input type="checkbox" value="" disabled></th>
                                                <th>Fatura</th>
                                                <th>Nome</th>
												<th>Turma</th>
												<th>Valor</th>
												<th>Data</th>
                                             </tr>
                                        </thead>
                                   <tbody>
                                        <tbody id="list1">
                                        </tbody>
                                    </table>
                                   </div>
								  </div>
                                </div> 
								</div> <!-- FIM TAB 1 -->
								
								<div role="tabpanel" class="tab-pane" id="gfaturas"> <!-- TAB 2 -->
								
								<div class="form-material m-t-40 row">
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">* Quando irá vencer? :</label>
                                    <input type="text" name="faturavenc" id="faturavenc" value="" autocomplete="off" class="form-control  data">
                                </div>
								<!--<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Mês Faturado :</label>
                                    <input type="text" name="faturame" id="faturame" value="" autocomplete="off" class="form-control  data">
                                </div>
								<div class="form-group col-md-3 m-t-20"><label>Qtd Mensalidade :</label>
								<select name="qtd" id="qtd" class="form-control"  style="width: 100%; height:36px;">
                                  <option value="">Escolher Qtd</option>
								  <option value="1">01</option>
								  <option value="2">02</option>
								  <option value="3">03</option>
								  <option value="4">04</option>
								  <option value="5">05</option>
								  <option value="6">06</option>
								  <option value="7">07</option>
								  <option value="8">08</option>
								  <option value="9">09</option>
								  <option value="10">10</option>
								  <option value="11">11</option>
								  <option value="12">12</option>
                                </select></div>-->
								<div class="form-group col-md-3 m-t-20"><label>Tipo :</label>
								<select name="tipo" id="tipo" class="form-control" style="width: 100%; height:36px;">
                                  <option value="">Escolher Tipo</option>
								  <option value="1">Rematricula</option>
								  <option value="2">Mensalidade</option>
                                </select></div>
								<!--<div class="form-group col-md-2 m-t-20"><label>&nbsp;&nbsp;</label>
							    <div class="form-actions">
								 <button type="button" class="btn btn-info" Onclick=""><i class="fa fa-plus-circle"></i> Filtrar</button>
								</div></div>-->
								<div class="form-group col-md-3 m-t-20"><label>&nbsp;&nbsp;</label>
								<div class="form-actions">
								<button type="button" class="btn btn-info fc-fatura" style="margin: 2px;"><i class="fa fa-plus-circle"></i> Emitir Cobranças</button>
								</div></div>
								<div class="form-group col-md-12 m-t-20">
								<h4>Lista de Clientes</h4>
								</div>
								<div class="form-group col-md-12 m-t-20">
								<input type="text" name="pesquisa2" id="pesquisa2" value="" placeholder="Pesquisar Clientes" class="form-control cc-f">
								<select name="mes2" id="mes2" class="form-control btnadd-us cc-m" style="width: 30%; height: calc(2.3em + .75rem + 2px) !important;">
								   <option value="01">Janeiro</option>
								   <option value="02">Fevereiro</option>
								   <option value="03">Março</option>
								   <option value="04">Abril</option>
								   <option value="05">Maio</option>
								   <option value="06">Junho</option>
								   <option value="07">Julho</option>
								   <option value="08">Agosto</option>
								   <option value="09">Setembro</option>
								   <option value="10">Outubro</option>
								   <option value="11">Novembro</option>
								   <option value="12">Dezembro</option>
								</select> 
								</div>
								<div class="form-group col-md-12 m-t-20">
								<script>
								$('#checkal2').change(function () {
								    $('.all2').prop('checked',this.checked);
								});
								</script>
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
                                   <table class="table pmd-table">
                                         <thead>
                                              <tr>
											    <th><input type="checkbox" value="" id="checkal2"></th>
                                                <th>Matricula</th>
                                                <th>Nome</th>
												<th>Turma</th>
												<th>Ano</th>
                                             </tr>
                                        </thead>
                                   <tbody>
                                        <tbody id="list2">
                                        </tbody>
                                    </table>
                                </div>
								</div>
								</div>
								</div>
                              </div> 								
                            </div>
							 </div>
                        </div>
					</div>
				</div>
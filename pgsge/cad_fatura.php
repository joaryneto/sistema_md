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
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Usuarios";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">

                     <div class="pmd-card pmd-z-depth">
					  <div class="pmd-tabs pmd-tabs-bg" style="line-height: 52px;">
						  <div class="pmd-tab-active-bar" style="width: 279px; left: 0px;"></div><ul role="tablist" class="nav nav-tabs nav-justified" style="width: 100%;">
							<li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#vfaturas" aria-expanded="true">Contas a Receber</a></li>
							<li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="profile" href="#gfaturas" aria-expanded="false">Gerar Fatura</a></li>
						  </ul>
					  </div>
					  <div class="pmd-card-body">
					  <div class="tab-content">
						  	<div role="tabpanel" class="tab-pane active" id="vfaturas">
                                </div>
								<div role="tabpanel" class="tab-pane" id="gfaturas">
								<script>
								
								$('.fc-gerar').on('click',function()
								{	
				                   var vencimento = document.getElementById('nome').value;
								   var nome = document.getElementById('nome').value;
								   
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
								   else if(nome == "")
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Campo Nome em branco.",   
									       timer: 1500,   
									        showConfirmButton: false 
									   });
								   }
								   else if(nome == "")
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Campo Nome em branco.",   
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
									   
								       requestPage2('?br=atu_fatura&codigo='+ codigo +'&','list','GET');
								   }
								   
								});
								
								$('.fc-filtrar').on('keypress',function()
								{	
								   var nome = document.getElementById('nome').value;
				   
								   if(nome.lenght < 4)
								   {
									   swal({   
									       title: "Atenção",   
									       text: "Campo Nome em branco.",   
									       timer: 1500,   
									        showConfirmButton: false 
									   });
								   }
								   else								   
								   {
								       requestPage2('?br=atu_fatura&pesquisa='+ nome +'&load=1','list','GET');
								   }
								   
								});
								
								jQuery('.data').datepicker({
									format: 'dd/mm/yyyy',
								    autoclose: true,
								    todayHighlight: true
								});
								</script>
								<div class="form-material m-t-40 row">
								<div class="form-group col-md-4 m-t-20"><label>Nome :</label>
								<input type="text" name="nome" id="nome" value="" class="form-control fc-filtrar">
								<button type="button" class="btn btn-info btnadd-us fc-filtrar"><i class="fa fa-search"></i></button>
								</div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Ano Letivo :</label>
                                    <input type="text" name="faturavenc" id="faturavenc" data-mask="99/9999" value="" class="form-control  data" required="required">
                                </div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Mês de Vencimento :</label>
                                    <input type="text" name="faturavenc" id="faturavenc" data-mask="99/9999" value="" class="form-control  data" required="required">
                                </div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Mês Faturado :</label>
                                    <input type="text" name="faturame" id="faturame" data-mask="99/9999" value="" class="form-control  data" required="required">
                                </div>
								<!--<div class="form-group col-md-2 m-t-20"><label>&nbsp;&nbsp;</label>
							    <div class="form-actions">
								 <button type="button" class="btn btn-info" Onclick=""><i class="fa fa-plus-circle"></i> Filtrar</button>
								</div></div>-->
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<!--<button type="button" class="btn btn-info"><i class="fa fa-plus-circle" ></i> Extrato pré-fatura</button>-->
								<button type="button" class="btn btn-info fc-gerar"><i class="fa fa-plus-circle"></i> Gerar Fatura</button>
								</div></div>
								<div class="form-group col-md-12 m-t-20">
								<h4>Lista de Alunos</h4>
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
                                   <table class="table pmd-table">
                                         <thead>
                                              <tr>
											    <th><input type="checkbox" value="" disabled></th>
                                                <th>Matricula</th>
                                                <th>Nome</th>
												<th>Turma</th>
												<th>Ano</th>
                                             </tr>
                                        </thead>
                                   <tbody>
                                        <tbody id="list">
                                            <tr>
                                                <td></td>
												<td></td>
                                                <td></td>
                                            </tr>
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
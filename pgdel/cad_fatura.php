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

//if($_SESSION['menu12'] == false)
//{
//   print("<script>swal('Atenção', 'Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

if(isset($_GET['codigo']))
{
	$sucess = mysqli_query($db,"SELECT desconto FROM tabelaexames where codigo='".$_GET['codigo']."'");
	
	if($sucess)
	{
      while($row = mysqli_fetch_array($sucess))
	  {
		 $valorA = $row['desconto'];
		 //print("<script>swal("Cancelled", 'TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>swal('Atenção', 'Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if(isset($_GET['exame']))
{
	$sucess = mysqli_query($db,"SELECT descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['exame']."'");
	
	if($sucess)
	{
      while($row = mysqli_fetch_array($sucess))
	  {
		 $descricao = $row['descricao'];
		 $valorB = $row['valor_padrao'];
		 //print("<script>swal("Cancelled", 'TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>swal('Atenção', 'Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if($_GET['ap'] == "1")
{
	$sucess = mysqli_query($db,"SELECT * FROM tabelaexames where exame='".$_POST['exame']."' and empresa='".$_POST['cnpj']."'");
	
	if($sucess)
	{
	    print("<script>swal('Atenção', 'Exame ja existe')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelaempresa&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into tabelaexames(empresa,exame,desconto) values('".$_POST['cnpj']."','".$_POST['exame']."','".$_POST['valor']."')";
	   $sucess = mysqli_query($db,$SQL1);
	   
	   if($sucess)
	   {
		   print("<script>swal('Atenção', 'Exame Adiconado com sucess')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_tabelaempresa&cnpj=".$_POST['cnpj']."';</script>");
	   }
	   else
	   {
		   print("<script>swal('Atenção', 'Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL2 = "UPDATE tabelaexames SET desconto=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucess = mysqli_query($db,$SQL2);
	
	if($sucess)
	{
        print("<script>swal('Atenção', 'Alterado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelaempresa&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
		print("<script>swal('Atenção', 'Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

?>		
<script>
function Itens(){

var fatura = document.getElementById('fatura').value;
var situacao = document.getElementById('situacao').value;
var venc = document.getElementById('faturavenc').value;

var i = 0;
$.each($("input[name='check[]']:checked"),function()
{
	//swal("Cancelled", $(this).val());
	i++;
});

 if(i == 0)
 {
	 swal("Atenção", "Selecione a fatura para visualizar os itens em cobrança.");
	 return true;
 }	 
 else if(i > 1)
 {
	swal("Atenção", "Selecione apenas uma fatura para visualização.");
    return true;
 }
 else
 {
	 $('#faturelatorio').modal('show');
	 
	 //var i = 0;
	 var b = "";
     $.each($("input[name='check[]']:checked"),function()
    {
	   b = $(this).val();
	   //i++;
    });

	 ajaxLoader('?br=itensfaturados&codigo='+ b +'&contestado=1' ,'relatorio','GET');
 }
}

function extrato(){

var fatura = document.getElementById('fatura').value;
var situacao = document.getElementById('situacao').value;
var venc = document.getElementById('faturavenc').value;

var i = 0;
$.each($("input[name='check[]']:checked"),function()
{
	//swal("Cancelled", $(this).val());
	i++;
});

 if(i == 0)
 {
	 swal("Atenção", "Selecione a fatura para visualizar os itens em cobrança.");
	 return true;
 }	 
 else if(i > 1)
 {
	swal("Atenção", "Selecione apenas uma fatura para visualização.");
    return true;
 }
 else if(situacao == "")
 {
	swal("Atenção", "Informe a data limite para faturamento.");
    return true;
 }
 else
 {
	 $('#faturelatorio').modal('show');
	 
	 //var i = 0;
	 var b = "";
     $.each($("input[name='check[]']:checked"),function()
    {
	   b = $(this).val();
	   //i++;
    });

	 ajaxLoader('?br=faturaextrato&codigo='+ b +'&ap=1','relatorio','GET');
 }
}

function excluir(){

var fatura = document.getElementById('fatura').value;
var situacao = document.getElementById('situacao').value;
var venc = document.getElementById('faturavenc').value;

var i = 0;
$.each($("input[name='check[]']:checked"),function()
{
	//swal("Cancelled", $(this).val());
	b = $(this).val();
	i++;
});

 if(i == 0)
 {
	 swal("Atenção", "Selecione a fatura para excluir os itens em cobrança.");
	 return true;
 }
 else if(situacao == 0)
 {
	swal("Atenção", "Fatura ja foi paga.");
    return true;
 }
 else if(i > 1)
 {
	swal("Atenção", "Selecione apenas uma fatura para exclusão.");
    return true;
 }
 else
 {
	 //$('#faturelatorio').modal('show');
	 
	 
	swal({   
            title: "Atenção!",   
            text: "Deseja realmente excluir essa fatura ?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Não, Cancelar!", 			
            closeOnConfirm: true 
        }, function()
	{   
		
		    ajaxLoader('?br=cad_listagerarfatura&codigo='+ b +'&faturavenci='+ venc +'&situacao='+ situacao +'&excluir=1','relatorio','GET');
            //swal("Excluido!", "Excluido com sucesso."); 
			//window.alert('Escolha a fatura para exclusão!');
			
   });
 }
}

function baixar()
{

var fatura = document.getElementById('fatura').value;
var situacao = document.getElementById('situacao').value;
var venc = document.getElementById('faturavenc').value;

var i = 0;
var b = "";
$.each($("input[name='check[]']:checked"),function()
{
	//swal("Cancelled", $(this).val());
	b = $(this).val();
	i++;
});

 if(i == 0)
 {
	 swal("Atenção", "Selecione a fatura para baixar os itens em cobrança.");
	 return true;
 }	 
 else if(i > 1)
 {
	swal("Atenção", "Selecione apenas uma fatura para baixar.");
    return true;
 }
 else
 {
	 	swal({   
            title: "Atenção!",   
            text: "Deseja realmente baixar essa fatura ?",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, baixar!",
            cancelButtonText: "Não, Cancelar!", 			
            closeOnConfirm: true 
        }, function()
		{   
		
		    ajaxLoader('?br=cad_confirmarsenha&codigo='+ b +'&confir=1','senhass','GET');
	        $('#confirmar').modal('show');
            //swal("Excluido!", "Excluido com sucesso.", "success"); 
			
        });
	/*var txt;
    var r = confirm("Deseja realmente baixar essa fatura ?");
    if (r == true) 
	{
	   ajaxLoader('?br=cad_confirmarsenha&codigo='+ b +'&confir=1','senhass','GET');
	   
	   $('#confirmar').modal('show');
	 
	}*/
 }
}
function altvencimento()
{

var fatura = document.getElementById('fatura').value;
var situacao = document.getElementById('situacao').value;
var venc = document.getElementById('faturavenc').value;

var i = 0;
var b = "";
$.each($("input[name='check[]']:checked"),function()
{
	//swal("Cancelled", $(this).val());
	b = $(this).val();
	i++;
});

 if(i == 0)
 {
	 swal("Atenção", "Selecione a fatura para alterar o vencimento da cobrança.");
	 //swal("Atenção", "Selecione a fatura para alterar o vencimento da cobrança.");
	 //return true;
 }	 
 else if(i > 1)
 {
	//swal("Atenção", "Selecione apenas uma fatura para alterar.");
	swal("Atenção", "Selecione apenas uma fatura para alterar.");
    //return true;
 }
 else
 {
	 	swal({   
            title: "Atenção!",   
            text: "Deseja realmente alterar o vencimento dessa fatura ?",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, Alterar!",
            cancelButtonText: "Não, Cancelar!", 			
            closeOnConfirm: true 
        }, function()
		{   
		
		    ajaxLoader('?br=cad_confirmarsenha&codigo='+ b +'&confir=3','senhass','GET');
	        $('#confirmar').modal('show');
            //swal("Excluido!", "Excluido com sucesso.", "success"); 
			
        });
		
	/*var txt;
    var r = confirm("Deseja realmente alterar o vencimento dessa fatura ?");
    if (r == true) 
	{
	   ajaxLoader('?br=cad_confirmarsenha&codigo='+ b +'&confir=3','senhass','GET');
	   
	   $('#confirmar').modal('show');
	 
	}*/
 }
}
function teste(valor)
{
	if(valor == "0")
	{
		$("#Bbaixar").html("Liberar Fatura");
		$("#faturasgeradas").html('<table class="display nowrap table table-hover table-striped table-bordered"><thead><tr><th>codigo</th><th>CNPJ</th><th>Razão</th><th>Data Vencimento</th><th>Valor R$</th></tr></thead><tbody><tr><td></td><td class="hid"></td><td></td><td class="hid"></td><td></td><td></td></tr></tbody></table>');
	}
	else if(valor == "1")
	{
		$("#Bbaixar").html("Baixar Fatura");
		$("#faturasgeradas").html('<table class="display nowrap table table-hover table-striped table-bordered"><thead><tr><th>codigo</th><th>CNPJ</th><th>Razão</th><th>Data Vencimento</th><th>Valor R$</th></tr></thead><tbody><tr><td></td><td class="hid"></td><td></td><td class="hid"></td><td></td><td></td></tr></tbody></table>');
	}
}

function filtrar()
{
	ajaxLoader('?br=cad_listagerarfatura&fatura='+ document.getElementById('fatura').value +'&situacao='+ document.getElementById('situacao').value +'&faturavenci='+ document.getElementById('faturavenc').value +'&ap=2','faturasgeradas','GET');
}
</script>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Faturas geradas";?></h4>
								<form name="laudo" class="form-material m-t-40 row" method="post" action="<? if($_GET['codigo'] ==""){ echo "iniciado.php?url=cad_tabelaempresa&ap=1";}else { echo "iniciado.php?url=cad_tabelaempresa&ap=2&codigo=".$_GET['codigo']."";} ?>">
								<div class="form-group col-md-2 m-t-20"><label>Client N° / Fat. :</label>
								<input type="text" name="fatura" id="fatura" class="form-control" required="required"></div>
								<div class="form-group col-md-2 m-t-20"><label>Situação:</label>
								<select name="situacao" id="situacao" onchange="teste(this.value);" class="form-control" style="width: 100%; height:36px;">
								    <option value="0">Paga</option>
									<option value="1" Selected>Aberta</option>
                                </select></div>
								<div class="form-group col-md-2 m-t-20">
                                <label for="message-text" class="control-label">Mês de Vencimento :</label>
                                    <input type="text" name="faturavenci" id="faturavenc" value="<? echo date('m/Y');?>" class="form-control" required="required">
                                </div>
								<div class="form-group col-md-4 m-t-20">
								<div class="form-actions">
								<br>
								<a href="javascript: WEB(0)" class="btn btn-info" Onclick="filtrar();"><i style="font-size:14px" class="fa fa-search"></i> Filtrar</a>
								</div></div>
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<a href="javascript: WEB(0)" class="btn btn-info" Onclick="Itens();"><i style="font-size:14px" class="fa fa-search"></i> Itens em Cob.</a>
								<a href="javascript: WEB(0)" class="btn btn-info" Onclick="extrato();"><i style="font-size:14px" class="fa fa-print"></i> Extrato</a>
								<a href="javascript: WEB(0)" id="Bbaixar" class="btn btn-info" Onclick="baixar();"><i style="font-size:14px" class="fa fa-search"></i> Baixar Fatura</a>
								<a href="javascript: WEB(0)" id="Bbaixar" class="btn btn-info" Onclick="altvencimento();"><i style="font-size:14px" class="fa fa-search"></i> Alt. Vencimento</a>
								<a href="javascript: WEB(0)" class="btn btn-info" Onclick="excluir();"><i style="font-size:14px" class="fa fa-search"></i> Excluir Fatura</a>	
						
								</div></div>
								<div class="form-group col-md-12 m-t-20" id="faturasgeradas" style="overflow: auto;height: 400px;">
                                    <table class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
											    <th><i class="fa fa-check-square-o"></i></th>
                                                <th>Codigo</th>
												<th>CNPJ</th>
                                                <th>RAZÃO</th>
												<th>Valor R$</th>
												<th>Justificativa de baixa manual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  //if(isset($_GET['cnpj']))
										  //{
										     $sql = "select faturas.codigo,faturas.valor,empresas.razao,empresas.cnpj from faturas inner join empresas on empresas.cnpj=faturas.cliente b order by codigo desc";
										     $res = mysqli_query($db,$sql); 
											 $x = 0;
										     while($row = mysqli_fetch_array($res))
										     {
												 
												 $SQL2 = "select count(laudos_enviados.tipolaudo) as qtd, tipo_exame.descricao, laudos_enviados.valor_empresa, sum(laudos_enviados.valor_empresa-laudos_enviados.desconto_empresa) as total , laudos_enviados.desconto_empresa, (laudos_enviados.valor_empresa-laudos_enviados.desconto_empresa) as totalsoma from laudos_enviados inner join tipo_exame on laudos_enviados.tipolaudo = tipo_exame.codigo
												 where laudos_enviados.fatura = '".$row['codigo']."' and (valor_empresa - desconto_empresa) > 0 and laudos_enviados.status=2 
												 order by descricao asc";
		
												 $count = 0;		
												 $res2 = mysqli_query($db,$SQL2); 
												 $row2 = mysqli_fetch_array($res2);
												 
										     ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
												<td><? echo $row['cnpj'];?></td>
                                                <td><? echo $row['razao'];?></td>
												<td><? echo number_format($row2['total'],2,",",".");?></td>
												<td><? echo number_format($row2['total'],2,",",".");?></td>
												
                                            </tr>
										    <? 
											    $x = 1;
											 } 
											 //} 
											 
											 if($x == 0)
											 {
												 echo '<tr><td></td><td></td><td></td><td></td><td></td></tr>';
											 }
											 ?>
                                        </tbody>
                                    </table>
                                </div>
								<div id="faturelatorio" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="card">
											<div class="card-body">
											
											<div id="relatorio" >
											
											</div>
											</div>
											</div>
											</div>
											</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
										
                                        <!-- /.modal-content -->
                                    </div>
									
                                    <!-- /.modal-dialog -->
                                </div>
								<div id="confirmar" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
										<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="card">
											<div class="card-body">
											
											<div id="senhass">
											
											</div>
											</div>
											</div>
											</div>
											</div>
                                            </div>
                                        </div>
										
                                        <!-- /.modal-content -->
                                    </div>
									
                                    <!-- /.modal-dialog -->
                                </div>
                             </form>						
                            </div>
                        </div>
					</div>
				</div>
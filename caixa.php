<?

ob_start();

session_start();

require_once("./load/load.php");

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

date_default_timezone_set('America/Cuiaba');
$data = date('Y-m-d');
$hora = date('H:i:s');

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

//echo $_SESSION['sistema'];
?>
<!doctype html>
<html lang="en" class="color-theme-blue">


<!-- Mirrored from maxartkiller.com/website/Lemux/lemux-HTML/framworkElements/modal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:57:02 GMT -->
<head>
<? include 'css.php';?>
<style>
.tableFixHead          { 
  overflow-y: auto; 
  height: auto;
  border: 1px solid;
  border-color: lightgray;
  }
.tableFixHead thead th { position: sticky; top: 0; }
.tableFixHead thead th { background:#fff; }

.form-control 
{
    height: calc(2.5em + .75rem + 2px) !important;
}

.fab {
    bottom: 10px !important;
}
</style>
</head>

<body>
    <!-- Loader -->
    <div class="row no-gutters vh-100 loader-screen">
        <div class="bg-template background-overlay"></div>
        <div class="col align-self-center text-white text-center">
            <img style="height:50px" src="template/images/logo.png" alt="logo">
            <h1 class="mb-0 mt-3">EC</h1><p class="text-mute subtitle"> Tecnologia</p>
            <div class="loader-ractangls">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Loader ends -->

    <!-- wrapper starts -->
    <div class="wrapper">

        <!-- header -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn btn-link" onclick="window.history.go(-1); return false;" ><i class="material-icons">arrow_back</i><span class="new-notification"></span></button>
                </div>
                <div class="col text-left">
                    <div class="header-logo">
                        <img style="height:50px" src="template/images/logo.png" alt="" class="header-logo">
                        <h4>EC<br><small class="text-mute">Tecnologia</small></h4>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="notification.html" class="btn btn-link"><i class="material-icons">notifications_none</i><span class="counts">9+</span></a>
                </div>
            </div>
        </div>
        <!-- header ends -->

<?
					
					
	$data = date('Y-m-d');
    $hora = date('H:i:s');
    $datatime = date('Y-m-d H:i:s');

    $y = 0;
    $SQL1 = "select codigo from vendas_op where status = 1 and usuario = '".$_SESSION['usuario']."' and data_ab='".$data."' and status=1 order by codigo desc limit 1";
	$RES1 = mysqli_query($db3,$SQL1);
	while($row1 = mysqli_fetch_array($RES1))
	{
		$y = 1;
		$_SESSION['caixa'] = $row1['codigo'];
	}

    if($y == 0)
	{
		$SQL3 = "SELECT data_ab FROM vendas_op where usuario='".$_SESSION['usuario']."' and status=1";
		$RES = mysqli_query($db3,$SQL3);
		while($row3 = mysqli_fetch_array($RES))
		{
				$SQL1 = "UPDATE vendas_op SET data_fe='".$row3['data_ab']."',hora_fe='23:59:59',status=0 where usuario='".$_SESSION['usuario']."' and status=1";
				mysqli_query($db3,$SQL1);
		}
									 
	   $SQL1 = "insert into vendas_op(sistema,data_ab,hora_ab,usuario,status) values ('".$_SESSION['sistema']."','".$data."','".$hora."','".$_SESSION['usuario']."',1)";
	   mysqlI_query($db3,$SQL1);
									 
       $SQL2 = "select codigo from vendas_op where usuario = '".$_SESSION['usuario']."' and status = 1 order by codigo desc limit 1;";
	   $RES2 = mysqlI_query($db3,$SQL2);
	   $ROW2 = mysqli_fetch_array($RES2);
									 
	   $_SESSION['caixa'] = $ROW2['codigo'];
    }
								
    $x = 0;
    $SQL2 = "select codigo from vendas where status = 1 and usuario = '".$_SESSION['usuario']."' and caixa='".$_SESSION['caixa']."' order by codigo desc limit 1";
	$RES2 = mysqli_query($db3,$SQL2);
	while($row2 = mysqli_fetch_array($RES2))
	{
		$x = 1;
		$_SESSION['venda'] = $row2['codigo'];
		
		}

    if($x == 0)
	{
							 
		$SQL1 = "insert into vendas(sistema,caixa,usuario,status) values ('".$_SESSION['sistema']."','".$_SESSION['caixa']."','".$_SESSION['usuario']."',1)";
		mysqlI_query($db3,$SQL1);
									 
        $SQL2 = "select codigo from vendas where usuario = '".$_SESSION['usuario']."' order by codigo desc limit 1;";
		$RES2 = mysqlI_query($db3,$SQL2);
		$ROW2 = mysqli_fetch_array($RES2);
									 
		$_SESSION['venda'] = $ROW2['codigo'];
		
	}
	
	$SQL3 = "SELECT sum(total) as total FROM vendas_mov where venda='".$_SESSION['venda']."'";
	$RES3 = mysqli_query($db3,$SQL3);
	$ROW3 = mysqli_fetch_array($RES3);
								
	$_SESSION['vtotal'] = number_format($ROW3['total'],2,",",".");
	
								
	?>
<script>

function itens(descricao,codigo,preco)
{
	$('#coditem').val();
	$('#qtd').val();
	$('#descricao').val();
	$('#desc').val();
	$('#preco').val();
	$('#total').val();
	$('#totals').val();
		
	$('#coditem').val(codigo);
	$('#qtd').val('1');
	$('#descricao').val(descricao + ' - ( Clique aqui )');
	$('#desc').val('');
	$('#preco').val(preco);
	$('#total').val(preco);
	$('#totals').val(preco);
	$('#itens').modal('hide');

	//document.getElementById("descricao").disabled = true;								

}

function empty(str)
{
    if (typeof str == 'undefined' || !str || str.length === 0 || str === "" || !/[^\s]/.test(str) || /^\s*$/.test(str) || str.replace(/\s/g,"") === "")
    {
        return true;
    }
    else
    {
        return false;
    }
}
							
function lancar() 
{
	//var caixa = document.getElementById('caixa').value;
	var coditem = document.getElementById('coditem').value;
	var descricao = document.getElementById('descricao').value;
	var qtd = document.getElementById('qtd').value;
	var desc = document.getElementById('desc').value;
	var preco = document.getElementById('preco').value;
	var total = document.getElementById('totals').value;
	
	
	
	if(descricao == "")
	{
		swal('Atenção', 'Nenhum produto encontrato');
	}
	if(coditem == "")
	{
		swal('Atenção', 'Nenhum produto encontrato');
	}
	if(qtd == "")
	{
		swal('Atenção', 'Nenhuma quantidade estipulado');
	}
	if(total == "")
	{
		swal('Atenção', 'Nenhum valor encontrado');
	}
	else
	{
		//$("#itenss").append('<tr><td>'+ descricao +'</td><td>1x'+ preco +'</td><td>'+ total +'</td><td>.</td></tr>');
	
	    ajaxLoader('?br=atu_caixa&produto='+ coditem +'&desc='+ desc +'&preco='+ preco +'&total='+ total +'&quantidade='+ qtd +'&ap=1','itenss','GET');
	 
	     
	    $('#coditem').val('');
		$('#qtd').val('');
	    $('#descricao').val('');
		$('#desc').val('');
	    $('#preco').val('');
	    $('#total').val('');
		$('#totals').val('');
		//document.getElementById("descricao").disabled = false;	
		
		//localStorage.setItem("total",''+ parseInt(total) +'');
		
		//document.getElementById('vtotal').innerHTML = teste;
	}
}

function pagar()
{
	var dinheiro = document.getElementById('dinheiro').value;
	var ctdebito = document.getElementById('ctdebito').value;
	var ctcredito = document.getElementById('ctcredito').value;
	var ted = document.getElementById('ted').value;
	
	ajaxLoader('?br=atu_caixa&dinheiro='+ dinheiro +'&ctdebito='+ ctdebito +'&ctcredito='+ ctcredito +'&ted='+ ted +'&ap=2','loading','GET');
}

function loadtotal()
{
	var qtd = document.getElementById('qtd').value;
	var desc = document.getElementById('desc').value;
	var qtd = document.getElementById('qtd').value;
	var preco = document.getElementById('preco').value;
	var total = document.getElementById('total').value;
	
	ajaxLoader('?br=atu_caixa&preco='+ preco +'&desc='+ desc +'&qtd='+ qtd +'&total='+ total +'&quantidade='+ qtd +'&load=1','loading','GET');
}

function loadpg()
{
	//if (event.keyCode === 13) 
	//{
		
	var dinheiro = parseFloat(document.getElementById('dinheiro').value.replace(',', '.'));
	//var credito = document.getElementById('credito').value;
	var ctdebito = parseFloat(document.getElementById('ctdebito').value.replace(',', '.'));
	var ctcredito = parseFloat(document.getElementById('ctcredito').value.replace(',', '.'));
	var ted = parseFloat(document.getElementById('ted').value.replace(',', '.'));
	
	//var total = parseFloat(dinheiro.replace(',', '.'))-+parseFloat(ctdebito.replace(',', '.'))-+parseFloat(ctcredito.replace(',', '.'))-+parseFloat(ted.replace(',', '.'));
	//var numbers = [dinheiro, ctdebito, ctcredito, ted];

	//swal('Valor: '+ dinheiro +'');

       ajaxLoader('?br=atu_caixa&dinheiro='+ dinheiro +'&ctdebito='+ ctdebito +'&ctcredito='+ ctcredito +'&ted='+ ted +'&load=2','loading','GET');
    //}
}

function atualizar()
{
	//var dinheiro = document.getElementById('totals').value;
	
	$('#dinheiro').val('');
	$('#ctdebito').val('');
	$('#ctcredito').val('');
	$('#ted').val('');
		
	ajaxLoader('?br=atu_caixa&load=3','loading','GET');
}

function quantidadeitem(produto) 
{
	
	$('#quantidade').modal('show');
	ajaxLoader('?br=atu_caixa&produto='+ produto +'&ap=2','quantidaeitem','GET');
	
	//var caixa = document.getElementById('caixa').value;
	//var codigo = document.getElementById('codigo').value;

	//$("#itenss").append('<tr><td>'+ descricao +'</td><td>1x'+ preco +'</td><td>'+ total +'</td><td>.</td></tr>');
	
	/*swal({   
            title: "Atenção!",   
            text: "Gostaria de cancelar este item?",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim",
            cancelButtonText: "Não", 			
            closeOnConfirm: true 
    }, function()
    { 
	      
		ajaxLoader('?br=atu_caixa&item='+ codigo +'&excluir=1&ap=1','itenss','GET');
		
    });*/
}

function excluir(produto,total) 
{

	//var caixa = document.getElementById('caixa').value;
	//var codigo = document.getElementById('codigo').value;

	//$("#itenss").append('<tr><td>'+ descricao +'</td><td>1x'+ preco +'</td><td>'+ total +'</td><td>.</td></tr>');

	swal({   
            title: "Atenção!",   
            text: "Gostaria de cancelar este item?",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim",
            cancelButtonText: "Não", 			
            closeOnConfirm: true 
    }, function()
    { 
	      
		ajaxLoader('?br=atu_caixa&codigo='+ produto +'&total='+ total +'&excluir=1&ap=1','itenss','GET');
		
    });
}

function excluir2(produto) 
{

	//var caixa = document.getElementById('caixa').value;
	//var codigo = document.getElementById('codigo').value;

	//$("#itenss").append('<tr><td>'+ descricao +'</td><td>1x'+ preco +'</td><td>'+ total +'</td><td>.</td></tr>');
	
	var i = 0;
    $.each($("input[name='check[]']:checked"),function()
    {
	   //swal('Atenção', '$(this).val());
	   i++;
    });

	if(i == 0)
    {
	swal('Atenção', 'Selecione os itens para excluir.');
    return true;	
    }
	else
	{
		
        var codigos = [];
	    $.each($("input[name='check[]']:checked"),function()
        {
		     codigos.push($(this).val());
	    });
	   
	    var codigo = codigos.join(", ");
	
	    ajaxLoader('?br=atu_caixa&codigo='+ codigo +'&excluir=1&ap=1','itenss','GET');
	    ajaxLoader('?br=atu_caixa&produto='+ produto +'&ap=2','quantidaeitem','GET'); 
	}
}

function auto()
{
  document.getElementById("codigo").focus();
}
 
</script>			
<div class="container-fluid bg-template mb-4">
            <div class="row hn-154 position-relative">
                <!-- use hn-60 if there is no page specific name required as below and remove below container -->
                <div class="container align-self-end">
                    <h3 class="font-weight-light"><? echo $_SESSION["PAGINA"] = "Venda caixa (PDV)"; ?></h3>
                    <p class="text-mute mb-4"><? echo $_SESSION["PAGINA2"] = "(PDV)";?></p>
                </div>
            </div>
        </div>
 <div class="container">              
           <div class="row">			
                    <div class="col-12">
								<div class="m-t-40 row" style="display: flex;" id="forcaixa">
								<div class="input-group col-md-12 m-t-20">
								 <div class="input-group mb-3">
                                  <input type="text" class="form-control form-control-lg" autocomplete="off"   name="descricao" onMouseOver="auto();" id="descricao" data-toggle="modal" data-target="#itens" placeholder="Descrição do produto - ( Clique aqui )" aria-invalid="false" readonly="readonly">
                                    <div class="input-group-append">
                                         <span class="input-group-text" id="basic-addon2">Desc.  </span>
                                    </div>
                                   </div>    
								</div>
								<div class="input-group col-md-5 m-t-20">
								 <div class="input-group mb-3">
                                  <input type="text" class="form-control form-control-lg" autocomplete="off" autofocus="true" name="codigo" id="codigo" placeholder="Codigo de barra">
                                    <div class="input-group-append">
                                         <span class="input-group-text" id="basic-addon2">Cod.  </span>
                                    </div>
                                   </div>    
								</div>
								<div class="input-group col-md-2 m-t-20">
								<div class="input-group mb-3">
								<input type="text" name="qtd" id="qtd" class="form-control form-control-lg" autocomplete="off" placeholder="Qtd" onMouseOver="auto();" value="" onkeyup="loadtotal();">
                                    <div class="input-group-append">
                                         <span class="input-group-text" id="basic-addon2"> Qtd.</span>
                                    </div>
                                   </div> 
								</div>
								
								<input type="hidden" name="coditem" autocomplete="off" id="coditem" value="" class="form-control">
								<input type="hidden" name="preco" id="preco" placeholder="Preço R$ " disabled value="" class="form-control form-control-lg" >
								
								<div class="input-group col-md-2 m-t-20" style="display: none">
								<div class="input-group mb-3">
								<input type="text" name="desc" autocomplete="off" id="desc" placeholder="Desc." onMouseOver="testE();" onchange="loadtotal();" value="" class="form-control form-control-lg" >
                                    <div class="input-group-append">
                                         <span class="input-group-text" id="basic-addon2">Desc.</span>
                                    </div>
                                   </div> 
								</div>
								<div class="input-group col-md-2 m-t-20">
								<div class="input-group mb-3">
								<input type="hidden" name="total" id="total" disabled value="" class="form-control">
								<input type="text" name="totals" autocomplete="off" id="totals" placeholder="Total R$ " value="" class="form-control form-control-lg">
                                    <div class="input-group-append">
                                         <span class="input-group-text" id="basic-addon2">Total</span>
                                    </div>
                                   </div> 
								</div>
								<div class="form-group col-md-2 m-t-20">
								 <div class="row">
                                   <div class="col">
								   <button class="btn pmd-btn-outline pmd-ripple-effect btn-primary" onclick="lancar();" type="button">Lançar <i class="material-icons pmd-sm">add</i></button>
								   </div>
								 </div>
								</div>
								</div>
								<div class="m-t-40 row">
								<div class="input-group col-md-12 m-t-20">
                                <div class="help-block"></div></div>
								<div class="form-group col-md-12 m-t-20" style="clear:">
									<div class="pmd-card pmd-table-card-responsive" id="dtable" style="display:none;">
						<div class="pmd-table-card">  
							<table class="table pmd-table table-hover">
								<thead>
									<tr>
										<tr>
                                                    <th class="text-center">Descrição</th>
                                                    <th class="text-right">Qtd/C. Uni.</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
									</tr>
								</thead>
								<tbody id="itenss">
									<? 
										  
										  $data = date('Y');
										  $sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.total) as totals, count(vendas_mov.produto) as quantidade from vendas_mov inner join produtos on produtos.codigo=vendas_mov.produto where vendas_mov.venda='".$_SESSION['venda']."' GROUP BY vendas_mov.total,vendas_mov.produto";
										  $res = mysqli_query($db3,$sql); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res))
										  {
												 
										  ?>
                                            <tr ><!-- color: #20aee3; -->
                                                <td class="text-center">(<? echo $row['codigo'];?>) - <? echo $row['descricao'];?></td>
												<td class="text-right"><? echo $row['quantidade'];?>x<? echo number_format($row['total'],2,",",".");?></td>
												<td class="text-right">R$ <? echo number_format($row['totals'],2,",",".");?>  <a href="javascript: Web(0);" onclick="excluir(<?=$row['produto'];?>,<?=$row['total'];?>)"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="font-size: 150%; color: red;"></i></a></td>
                                            </tr>
										  <? $b = 1;
										  
										  } 
										  
										  if($b == 0)
										  {
											 echo '<tr ><!-- color: #20aee3; -->
											    <td colspan="4" class="text-center"> Nenhum registro encontrado.</td>
                                            </tr>';
										  }
										  ?>
								</tbody>
							</table>
						</div>
					</div>
								</div>
								<div class="input-group col-md-12 m-t-20">
								<input type="hidden" class="form-control" name="totalvenda" id="totalvenda" value="" required="" aria-invalid="false">
								<h1 style="color: green;font-weight: bold;">Total: R$ <span id="vtotal"><?=$_SESSION['vtotal'];?></span></h1></div>
								<div class="form-group col-md-12 m-t-20">
								 <div class="row">
                                   <div class="col">
								   <button class="btn pmd-btn-raised btn pmd-btn-outline pmd-ripple-effect btn-warning" onclick="slow();" id="btncarrinho" data-title="Itens do Carrinho"> 
                                     <b id="qtdbgd"><?=$_SESSION['qtditens'];?></b> Itens<i class="material-icons">add_shopping_cart</i></button>
								   </div>
								 </div>
								</div>
								<div class="form-group col-md-12 m-t-20">
								<button class="btn btn-lg btn pmd-btn-raised btn-primary btn-block pmd-ripple-effect" type="button" onclick="atualizar();" data-toggle="modal" data-target="#pagamento">Confirmar pagamento</button>
								</div>
								<div class="input-group col-md-10 m-t-20">
								<div id="gravar"></div></div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
    </div>
	                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Atenção!</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="loading"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <a href="iniciado.php?url=cad_diario&fechar=1" class="btn btn-primary">Continuar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div id="itens" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Lista de Produtos : </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="form-group col-md-12 m-t-20"><label>Busca:</label>
                                             <input name="user" type="text" class="form-control" onkeyup="javascript: ajaxLoader('?br=listusuarios&pesquisa='+ this.value +'&ap=2','listusuarios','GET');" />
											</div>
											
											<div class="form-group col-md-12 m-t-20" id="">
											<table class="display nowrap table table-hover table-striped table-bordered">
											<thead>
											  <tr>
											<th>Codigo</th>
											<th>Descrição</th>
											<th>Preço R$</th>
											<th>Estoque</th>
											</tr>
											 </thead>
											   <tbody>
											   <?
											   $data = date('Y');
										       $sql = "select * from produtos ";
											   $res = mysqli_query($db3,$sql); 
											   $x = 0;
											   while($row = mysqli_fetch_array($res))
											   {
											   ?>
											   <tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="itens('<? echo $row['descricao'];?>',<? echo $row['codigo'];?>,'<? echo number_format($row['preco'],2,",",".");?>');">
											   <td><? echo $row['codigo'];?></td>
											   <td><? echo $row['descricao'];?></td>
											   <td><? echo $row['preco'];?></td>
											   <td><? echo $row['b'];?></td>
											   </tr>
											   <? $x = 1;
											   }

 											    if($x == 0)
 											    {
											   	 echo "<tr><td colspan='4'>Nenhum resultado encontrado.</td></tr>";
 											   
 											   }
											   ?>
											 </tbody>
											
                                            </table>											 
											</div>
											</div>
											</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger rounded mb-2" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
										
                                        <!-- /.modal-content -->
                                    </div>
									
                                    <!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade" id="pagamento" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1"><b>Receber </b></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>">
											<div class="input-group col-md-12 m-t-20">
								            <h1 class="pmd-display1" style="color: green; font-weight: bold;">Total: R$ <span id="vtotalp"></span></h1></div>
											<div class="input-group col-md-12 m-t-20">
								            <div id="gravar"></div>
											</div>
											<div class="input-group col-md-12 m-t-20">
											<div class="form-group col-md-12 m-t-20 pmd-textfield pmd-textfield-floating-label"><label for="first-name">Dinheiro</label>
											<input type="text" name="dinheiro" id="dinheiro" placeholder="0" onchange="loadpg();" class="form-control mat-input form-control">
											</div>
											<div class="form-group col-md-12 m-t-20 pmd-textfield pmd-textfield-floating-label"><label for="first-name">Cartão de Débito</label>
											<input type="text" name="cdebito" id="cdebito" placeholder="0" onchange="loadpg();" class="form-control mat-input form-control">
											</div>
											<div class="form-group col-md-12 m-t-20 pmd-textfield pmd-textfield-floating-label"><label for="first-name">Cartão de Crédito</label>
											<input type="text" name="ccredito" id="ccredito" placeholder="0" onchange="loadpg();" class="form-control mat-input form-control">
											</div>
											<div class="form-group col-md-12 m-t-20 pmd-textfield pmd-textfield-floating-label"><label for="first-name">Transferencia ( Ted, doc, tev)</label>
											<input type="text" name="ted" id="ted" placeholder="0" onchange="loadpg();" class="form-control mat-input form-control">
											</div>
											</div>
											<div class="form-group col-md-12 m-t-20" id="recebpagamento">
											
											</div>
											<div class="input-group col-md-1 m-t-20">
								</div>
											<div class="form-group col-md-12 m-t-20">
											<table id="formpagamento">
											</table>
											</div>
											<div class="input-group col-md-12 m-t-20">
											<h1 class="pmd-display1" style="font-weight: bold;" id="vtroco"></h1>
											</div>
											</form>
											</div>
											</div>
                                            </div>
                                            <div class="modal-footer">
											<div class="row">
                                                 <div class="col">
											    <button type="button" onclick="pagar();"  class="btn pmd-btn-outline pmd-ripple-effect btn-primary">Concluir</button>
                                                <button type="button" class="btn pmd-btn-outline pmd-ripple-effect btn-danger" data-dismiss="modal">Sair</button>
												</div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<script>
							    function slow()
								{
								  if($('#dtable').css('display') == 'none' )
								  {
									 $("#forcaixa" ).hide( "slow" );
                                     $("#dtable" ).show( "slow" );
									 $("#btncarrinho").attr("data-title","Add Produtos");
								  }
								  else
								  {
									 $("#forcaixa" ).show( "slow" );
									 $("#dtable" ).hide( "slow" );
									 $("#btncarrinho").attr("data-title","Itens do Carrinho");
								  }
								}
                                </script>
	
<? include 'scripts.php'?>

</body>


<!-- Mirrored from maxartkiller.com/website/Lemux/lemux-HTML/framworkElements/modal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2019 13:57:05 GMT -->
</html>

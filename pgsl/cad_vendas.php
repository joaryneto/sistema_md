<?
//$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
//$PageName = strtolower(basename( __FILE__ ));
//if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


//if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
//{
//	exit();
//}

//if($_SESSION['menu3'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

			
	$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);
	
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
	
	$agendamento = @$inputb['agendamento'];
	
	if(isset($agendamento))
    {
	  $data = date("Y-m-d");
	  $SQL5 = "SELECT produtos.preco,produtos.codigo as produto,agendamento_servicos.codigo, agendamento.cliente,clientes.nome, clientes.celular,agendamento_servicos.data,agendamento_servicos.hora,agendamento_servicos.profissional FROM agendamento 
	  inner join clientes on clientes.codigo=agendamento.cliente 
	  inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo
	  inner join produtos on produtos.codigo=agendamento_servicos.servico
	  where agendamento.sistema='".$_SESSION['sistema']."' and agendamento_servicos.codigo='".$agendamento."' and agendamento.status=1 ORDER BY agendamento.codigo desc";
	  $RESS3 = mysqli_query($db3,$SQL5);
	  while($row = mysqli_fetch_array($RESS3))
	  {
		
		$SQL = "DELETE FROM vendas_mov where sistema='".$_SESSION['sistema']."' and venda='".$_SESSION['venda']."'";
		mysqli_query($db3,$SQL);
		
		$data = date("Y-m-d");
		$SQL = "INSERT vendas_mov(sistema,cliente,produto,venda,caixa,data,preco,total,usuario,status) values('".$_SESSION['sistema']."','".$row['cliente']."','".$row['produto']."','".$_SESSION['venda']."','".$_SESSION['caixa']."','".$data."','".$row['preco']."','".$row['preco']."','".$_SESSION['usuario']."',1)";
        $RES = mysqli_query($db3,$SQL);
		
		print('<script>
		$("#forcaixa" ).show( "slow" );
		$("#dtable" ).hide( "slow" );
		$("#dt" ).show( "slow" );
		$("#c_nome" ).show( "slow" );    
		$("#c_codigo").val(codigo);
	    document.getElementById("nome").innerHTML = "'.$row['nome'].'";
		</script>');
	  }
	}
	
	$SQL3 = "SELECT sum(preco) as total, count(codigo) as qtd FROM vendas_mov where venda='".$_SESSION['venda']."'";
	$RES3 = mysqli_query($db3,$SQL3);
	$ROW3 = mysqli_fetch_array($RES3);
		
    $_SESSION['qtditens'] = $ROW3['qtd'];		
	$_SESSION['vtotal'] = number_format($ROW3['total'],2,",",".");

	?>
<script>
function btn_cexit()
{
	if($('#c_nome').css('display') == 'flex' )
	{
		$("#c_nome" ).hide( "slow" );
		$('#c_codigo').val("");
	    document.getElementById('nome').innerHTML = '';
	}
}

function m_agendamento(agendamento)
{
	if(codigo == "" && nome == "")
	{
		swal('Atenção', 'Escolha um cliente');
	}
	else
	{
		
		$('#modalap').modal('hide');
		requestPage('?br=cad_vendas&agendamento='+ agendamento +'&ch=true&load=1','conteudo','GET');
	}
}

function SL_cliente(codigo,nome)
{
	if(codigo == "" && nome == "")
	{
		swal('Atenção', 'Escolha um cliente');
	}
	else
	{
		$("#forcaixa" ).show( "slow" );
		$("#dtable" ).hide( "slow" );
		$("#dt" ).show( "slow" );
		$("#c_nome" ).show( "slow" );    
		$('#c_codigo').val(codigo);
	    document.getElementById('nome').innerHTML = ''+ nome +'';
		$('#modalap').modal('hide');
	}
}

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
	var codigo = document.getElementById('c_codigo').value;
	var coditem = document.getElementById('coditem').value;
	var descricao = document.getElementById('descricao').value;
	var qtd = document.getElementById('qtd').value;
	var desc = document.getElementById('desc').value;
	var preco = document.getElementById('preco').value;
	var total = document.getElementById('totals').value;
	
	if(descricao == "")
	{
		swal('Atenção', 'Selecione um produto.');
	}
	else if(coditem == "")
	{
		swal('Atenção', 'Selecione um produto.');
	}
	else if(qtd == "")
	{
		swal('Atenção', 'Quantidade em branco.');
	}
	else if(total == "")
	{
		swal('Atenção', 'Valor em branco.');
	}
	else
	{
	    ajaxLoader('?br=atu_caixa&codigo='+ codigo +'&produto='+ coditem +'&desc='+ desc +'&preco='+ preco +'&total='+ total +'&quantidade='+ qtd +'&ap=1&load=1','itenss','GET');

	    $('#coditem').val('');
		$('#qtd').val('');
	    $('#descricao').val('');
		$('#desc').val('');
	    $('#preco').val('');
	    $('#total').val('');
		$('#totals').val('');
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
		
	var dinheiro = document.getElementById('dinheiro').value;
	//var credito = document.getElementById('credito').value;
	var ctdebito = document.getElementById('ctdebito').value;
	var ctcredito = document.getElementById('ctcredito').value;
	var ted = document.getElementById('ted').value;
	
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
	      
		ajaxLoader('?br=atu_caixa&codigo='+ produto +'&total='+ total +'&excluir=1&ap=1&load=1','itenss','GET');
		
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
                    <p class="text-mute mb-4">List Caixa</p>
                </div>
            </div>
        </div>
 <div class="container">              
           <div class="row">			
                    <div class="col-12">
								<div class="m-t-40 row" style="display: flex;" id="forcaixa">
								<div class="input-group col-md-12 m-t-20" id="c_nome" style="display: none;">
								<div class="input-group mb-3">
								   <h5><i class="material-icons pmd-sm" style="font-size: 140%;position: relative;top:  3px;">person</i> <span id="nome"></span> <a href="javascript: Web(0);" onclick="btn_cexit();"><i class="fa fa-times-circle" style="font-size: 110%; color: red;"></i></a></h5>  
								   <input type="hidden" name="c_codigo" id="c_codigo" placeholder="" value="" class="form-control form-control-lg" >
                                   </div>								   
								</div>
								<div class="input-group col-md-12 m-t-20">
								 <div class="input-group mb-3">
                                  <input type="text" class="form-control form-control-lg" autocomplete="off"   name="descricao" onMouseOver="auto();" id="descricao" data-toggle="modal" data-target="#itens" placeholder="Descrição do produto - ( Clique aqui )" aria-invalid="false" readonly="readonly">
                                    <div class="input-group-append">
                                         <span class="input-group-text" id="basic-addon2">Desc.</span>
                                    </div>
                                   </div>    
								</div>
								<div class="input-group col-md-5 m-t-20" style="display: none">
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
								
								<div class="input-group col-md-2 m-t-20" id="c_desc" style="display: none">
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
								   <button class="btn pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" onclick="lancar();" type="button"><i class="material-icons pmd-sm">add_circle</i></button>
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
										<th>#</th>
										<th>Descrição</th>
										<th>Qtd/C. Uni.</th>
										<th>Total</th>
								    </tr>
								 </thead>
								 <tbody id="itenss">
									<? 
										  $d_count = 1;  
										  $data = date('Y');
										  $sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.preco) as totals, count(vendas_mov.produto) as quantidade from vendas_mov inner join produtos on produtos.codigo=vendas_mov.produto where vendas_mov.venda='".$_SESSION['venda']."' GROUP BY vendas_mov.total,vendas_mov.produto order by produtos.codigo asc";
										  $res = mysqli_query($db3,$sql); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res))
										  {
												 
										  ?>
                                            <tr onclick="excluir(<?=$row['produto'];?>,<?=$row['total'];?>)"><!-- color: #20aee3; -->
											    <td data-title="#"><? echo $row['codigo'];?></td>
                                                <td data-title="Descrição"><? echo $row['descricao'];?></td>
												<td data-title="Qtd/C. Uni."><? echo $row['quantidade'];?>x<? echo number_format($row['preco'],2,",",".");?></td>
												<td data-title="Total">R$ <? echo number_format($row['totals'],2,",",".");?></td>
                                            </tr>
										  <? $b = 1;
										     $d_count ++;
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
								<button class="btn btn-lg btn pmd-btn-raised btn-primary btn-block pmd-ripple-effect" type="button" onclick="atualizar();" data-toggle="modal" data-target="#pagamento">Confirmar pagamento</button>
								</div>
								<div class="input-group col-md-10 m-t-20">
								<div id="gravar"></div></div>
                            </div>
                        </div>
					</div>
				</div>
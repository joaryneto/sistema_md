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
								
function lancar() 
{
	//var caixa = document.getElementById('caixa').value;
	var coditem = document.getElementById('coditem').value;
	var descricao = document.getElementById('descricao').value;
	var qtd = document.getElementById('qtd').value;
	var desc = document.getElementById('desc').value;
	var preco = document.getElementById('preco').value;
	var total = document.getElementById('total').value;
	
	if(descricao == "")
	{
		swal('Atenção', 'Nenhum produto encontrato');
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
	}
}

function pagar()
{
	var dinheiro = document.getElementById('dinheiro').value;
	var ctdebito = document.getElementById('ctdebito').value;
	var ctcredito = document.getElementById('ctcredito').value;
	var ted = document.getElementById('ted').value;
	
	ajaxLoader('?br=atu_caixa&dinheiro='+ dinheiro +'&ctdebito='+ ctdebito +'&ctcredito='+ ctcredito +'&ted='+ ted +'&ap=3','loading','GET');
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
	var dinheiro = document.getElementById('dinheiro').value;
	//var credito = document.getElementById('credito').value;
	var ctdebito = document.getElementById('ctdebito').value;
	var ctcredito = document.getElementById('ctcredito').value;
	var ted = document.getElementById('ted').value;
	
	if (event.keyCode === 13) 
	{
      ajaxLoader('?br=atu_caixa&dinheiro='+ dinheiro +'&ctdebito='+ ctdebito +'&ctcredito='+ ctcredito +'&ted='+ ted +'&load=2','loading','GET');
    }
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
</script>	
                <div class="row">
				
                    <div class="col-12">
					
                        <div class="card">
                            <div class="card-body">
							    <?
								
								$SQL3 = "SELECT sum(total) as total FROM vendas_mov where caixa='".$_SESSION['caixa']."'";
								$RES3 = mysqli_query($db3,$SQL3);
								$ROW3 = mysqli_fetch_array($RES3);
								
								$vtotal = number_format($ROW3['total'],2,",",".");
								
								?>
								<h1 class="card-title"><? echo $_SESSION["PAGINA"] = "Caixa Atual";?></h1>
								<form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>">
								<div class="form-group col-md-12 m-t-20" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Descrição</th>
                                                    <th class="text-right">Qtd/C. Uni.</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="itenss">
                                                <? 
										  
										  $data = date('Y');
										  echo $sql = "select vendas_mov.codigo,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.total) as totals, count(vendas_mov.produto) as quantidade from vendas 
										  inner join vendas_mov on vendas_mov.venda=vendas.codigo
										  inner join produtos on produtos.codigo=vendas_mov.produto 
										  where vendas_mov.caixa='".$_SESSION['caixa']."' GROUP BY vendas_mov.total,vendas_mov.codigo";
										  $res = mysqli_query($db3,$sql); 
										  $b = 0;
										  while($row = mysqli_fetch_array($res))
										  {
												 
										  ?>
                                            <tr ><!-- color: #20aee3; -->
											    <td class="text-center"><? echo $row['codigo'];?></td>
                                                <td class="text-center"><? echo $row['descricao'];?></td>
												<td class="text-right"><? echo $row['quantidade'];?>x<? echo $row['preco'];?></td>
												<td class="text-right">R$ <? echo number_format($row['totals'],2,",",".");?></td>
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
								<div class="input-group col-md-12 m-t-20">
								<input type="hidden" class="form-control" name="totalcaixa" id="totalcaixa" value="" required="" aria-invalid="false">
								<h1 style="color: green;font-weight: bold;">Total: R$ <span id="vtotal"><?=$vtotal;?></span></h1></div><div class="input-group col-md-10 m-t-20">
								<div id="gravar"></div></div>
							
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
										       $sql = "select * from produtos where sistema='".$_SESSION['cliente']."';";
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
											   	 echo "<tr><td>Nenhum resultado encontrado.</td><td></td><td></td><td></td></tr>";
 											   
 											   }
											   ?>
											 </tbody>
											
                                            </table>											 
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
							  </form>
                            </div>
                        </div>
					</div>
				</div>
<?
ob_start();
session_start();

?>
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

if(isset($_GET['codigo']))
{
	$SQL = "SELECT diario.turma,diario.materia,diario.periodo,diario.data,diario.conteudo,diario.texto,materias.descricao as mdescricao,turmas.descricao as tdescricao,periodo.descricao as pdescricao FROM diario 
	inner join materias on materias.codigo=diario.materia 
	inner join turmas on turmas.codigo=diario.turma
	inner join periodo on periodo.codigo=diario.periodo
	where diario.codigo='".$_GET['codigo']."'";
	
	$sucesso = mysqli_query($db,$SQL);
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $turma = $row['turma'];
		 $disciplina = $row['materia'];
		 $periodo = $row['periodo'];
		 $data = $row['data'];
		 $conteudo = $row['conteudo'];
		 $texto = $row['texto'];
		 $pdescricao = $row['pdescricao'];
		 $tdescricao = $row['tdescricao'];
		 $mdescricao = $row['mdescricao'];
		 
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if($_GET['ap'] == "1")
{
	$sucesso = mysqli_query($db,"SELECT * FROM diario where turma='".$_POST['turma']."' and materia='".$_POST['disciplina']."' and periodo='".$_POST['periodo']."' and data='".revertedata($_POST['txtdata'])."' and conteudo like '%'".$_POST['conteudo']."'%'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Conteudo ja cadastrada!')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into diario(turma,materia,periodo,data,conteudo,texto) values('".$_POST['turma']."','".$_POST['disciplina']."','".$_POST['periodo']."','".revertedata($_POST['txtdata'])."','".$_POST['conteudo']."','".$_POST['txtobs']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   print("<script>window.alert('Conteudo Cadastrada com sucesso...')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE diario SET conteudo='".$_POST['conteudo']."', texto='".$_POST['txtobs']."' where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Atualizado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

if($_GET['fechar'] == "3")
{
	$SQL1 = "UPDATE diario SET status=0 where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Bimestre fechado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}
if($_GET['excluir'] == 1)
{
	$SQL1 = "DELETE FROM diario where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Excluido com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

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
<div class="container my-5">               
           <div class="row">
				
                    <div class="col-12">
					
                        <div class="card">
                            <div class="card-body">
							
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
		$_SESSION['venda'] = $row1['codigo'];
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
								<h1 class="card-title"><? echo $_SESSION["PAGINA"] = "Venda caixa (PDV)";?></h1>
								<form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>">
                                
								<div class="input-group col-md-5 m-t-20">
                                <input type="text" class="form-control" autocomplete="off" readonly="readonly" name="descricao" id="descricao" data-toggle="modal" data-target="#itens" placeholder="Descrição do produto - ( Clique aqui )" aria-invalid="false">
							    </div>
								<div class="input-group col-md-1 m-t-20">
								<input type="text" name="qtd" id="qtd" autocomplete="off" placeholder="Qtd" value="" onkeyup="loadtotal();" class="form-control" >
								</div>
								<input type="hidden" name="coditem" autocomplete="off" id="coditem" value="" class="form-control">
								<input type="hidden" name="preco" id="preco" placeholder="Preço R$ " disabled value="" class="form-control" >
								
								<div class="input-group col-md-1 m-t-20">
								<input type="text" name="desc" autocomplete="off" id="desc" placeholder="Desc." onkeyup="loadtotal();" value="" class="form-control" >
								</div>
								<div class="input-group col-md-1 m-t-20">
								<input type="hidden" name="total" id="total" disabled value="" class="form-control">
								<input type="text" name="totals" autocomplete="off" id="totals" placeholder="Total R$ " disabled value="" class="form-control">
								</div>
								<div class="input-group col-md-3 m-t-20">
								<div class="form-actions">
								<a class="btn btn-info" href="javascript: Web(0);" onclick="lancar();"><i class="fa fa-plus-circle"></i> Lançar</a>
								</div></div>
								<div class="input-group col-md-5 m-t-20">
                                <div class="help-block"></div></div>
								<div class="form-group col-md-12 m-t-20" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Descrição</th>
                                                    <th class="text-right">Qtd/C. Uni.</th>
                                                    <th class="text-right">Total</th>
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
												<td class="text-right"><? echo $row['quantidade'];?>x<? echo $row['total'];?></td>
												<td class="text-right">R$ <? echo number_format($row['totals'],2,",",".");?>  <a href="javascript: Web(0);" onclick="excluir(<?=$row['produto'];?>,<?=$row['total'];?>)"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="font-size: 150%; color: red;"></i></a></td>
                                            </tr>
										  <? $b = 1;
										  
										  } 
										  
										  if($b == 0)
										  {
											 echo '<tr ><!-- color: #20aee3; -->
											    <td colspan="5" class="text-center"> Nenhum registro encontrado.</td>
                                            </tr>';
										  }
										  ?>
                                            </tbody>
                                        </table>
                                    
								</div>
								<div class="input-group col-md-12 m-t-20">
								<input type="hidden" class="form-control" name="totalvenda" id="totalvenda" value="" required="" aria-invalid="false">
								<h1 style="color: green;font-weight: bold;">Total: R$ <span id="vtotal"><?=$_SESSION['vtotal'];?></span></h1></div><div class="input-group col-md-10 m-t-20">
								<div id="gravar"></div></div>
								<div class="input-group col-md-12 m-t-20">
								<a class="btn btn-info" href="javascript: Web(0);" onclick="atualizar();" data-toggle="modal" data-target="#pagamento"><i class="fa fa-plus-circle"></i> Concluir</a>
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
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Atenção!</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Você tem certeza que gostaria de fechar o Bimestre de <? echo $mdescricao; ?></h4>
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
										       $sql = "select * from produtos";
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
								
								<div id="quantidade" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Quantidade de Itens : </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="form-group col-md-12 m-t-20">
											
											<table class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Descrição</th>
												<th>Preço</th>
												<th>Total</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody id="quantidaeitem">
										
                                        </tbody>
                                    </table>											 
											</div>
											</div>
											</div>
                                            </div>
                                            <div class="modal-footer">
											    <a href="javascript: Web(0);" onclick="excluir(<?=$_SESSION['produto'];?>)"  class="btn btn-primary">Excluir</a>
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Sair</button>
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
											<div class="input-group col-md-12 m-t-20">
								            <h1 style="color: green;font-weight: bold;">Total: R$ <span id="vtotalp"></span></h1></div><div class="input-group col-md-10 m-t-20">
								            <div id="gravar"></div></div>
											<h4>Formas de pagamentos</h4>
											<form class="m-t-40 row" name="laudo" method="post" action="<? echo $action;?>">
											<div class="form-group col-md-12 m-t-20"><label>Dinheiro</label>
											<input type="text" name="dinheiro" id="dinheiro" placeholder="0" onkeydown="loadpg();" value="" class="form-control" >
											<!--<label>Crédito </label>
											<input type="text" name="credito" id="credito" placeholder="0" onkeyup="loadpg();" value="" class="form-control" >-->
											</div><div class="form-group col-md-12 m-t-20">
											<label>Cartão de Débito </label>
											<input type="text" name="ctdebito" id="ctdebito" placeholder="0" onkeydown="loadpg();" value="" class="form-control" >
											</div><div class="form-group col-md-12 m-t-20">
											<label>Cartão de Crédito </label>
											<input type="text" name="ctcredito" id="ctcredito" placeholder="0" onkeydown="loadpg();" value="" class="form-control" >
											</div><div class="form-group col-md-12 m-t-20">
											<label>Transferencia ( Ted, doc, tev) </label>
											<input type="text" name="ted" id="ted" placeholder="0" onkeydown="loadpg();" value="" class="form-control" >
											</div>
											<div class="input-group col-md-12 m-t-20">
											<h1 style="color: green;font-weight: bold;">Troco: R$ <span id="vtroco">0</span></h1></div><div class="input-group col-md-10 m-t-20">
											<div id="gravar"></div></div>
											<div class="input-group col-md-12 m-t-20">
											<h1 style="color: red;font-weight: bold;">Falta: R$ <span id="vdiferenca">0</span></h1></div><div class="input-group col-md-10 m-t-20">
											<div id="gravar"></div></div>
											</div>
											</div>
                                            </div>
                                            <div class="modal-footer">
											    <a href="javascript: Web(0);" onclick="pagar();"  class="btn btn-info">Confirmar pagamento</a>
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Sair</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							
							  </form>
                            </div>
                        </div>
					</div>
				</div>
			</div>
<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$_SESSION['menu99'] == false)
{
   //print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   //print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

?>		

<?
if($_GET['modal'] == 1) 
{ 

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$nome = "";
$nascimento = "";
$sexo = "";
$telefone = "";
$celular = "";
$rg = "";
$cpf = "";
$status = "";

if(@$inputb['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM produtos where sistema='".$_SESSION['sistema']."' and descricao like '%".$inputb['descricao']."%';'";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
		print('
		<script>
		swal({   
 			   title: "Atenção!",   
 			   text: "Produto já foi cadastrada, escolha outro.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
	else
	{
	   $SQL1 = "INSERT into produtos(sistema, codigob, descricao,preco, custo, estoque, tipo, status) values('".$_SESSION['sistema']."','".$inputb['codbarra']."','".$inputb['descricao']."','".$inputb['preco']."','".$inputb['custo']."','".$inputb['estoque']."','".$inputb['tipo']."','1')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   print('
		   <script>
		   swal({   
 			   title: "Info!",   
 			   text: "Gravado com sucesso.",   
 			   timer: 1000,   
 			   showConfirmButton: false 
		   });
		   </script>');
	   }
	   else
	   {
		   print('
		<script>
		swal({   
 			   title: "Atenção!",   
 			   text: "Ocorreu um erro, Entre em contato com Suporte! MSG-3",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	   }
	}
}
else if(@$inputb['ap'] == "2")
{
	$SQL1 = "UPDATE produtos SET codigob='".$inputb['codbarra']."',descricao='".$inputb['descricao']."',preco='".$inputb['preco']."',custo='".$inputb['custo']."',estoque='".$inputb['estoque']."',tipo='".$inputb['tipo']."' where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print('
		<script>
		swal({   
 			   title: "Info",   
 			   text: "Gravado com sucesso.",   
 			   timer: 1100,   
 			   showConfirmButton: false 
 		});
		</script>');
		//print("<script>window.location.href='sistema.php?url=cad_clientes';</script>");
	}
	else
	{
		print('
		<script>
		swal({   
 			   title: "Atenção!",   
 			   text: "Ocorreu um erro, Entre em contato com Suporte! MSG-3",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
}

$codigo = "";
$codbarra = "";
$descricao = "";
$preco = "";
$custo = "";
$estoque = "";
$tipo = "";
		 
if(isset($inputb['codigo']))
{
	$sucesso = mysqli_query($db,"SELECT * FROM produtos where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $codigo = $row['codigo'];
		 $codbarra = $row['codigob'];
		 $descricao = $row['descricao'];
		 $preco = number_format($row['preco'], 2, ',','.');
		 $custo = number_format($row['custo'], 2, ',','.');
		 $estoque = $row['estoque'];
		 $tipo = $row['tipo'];
		 
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}
else
{
	$codigo = "";
}

?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Cadastro de Produtos e Serviços</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12 col-sm-12"> 
<div class="component-box">
<!--Tabs with Icon example -->
            <script>
			
			$('#btn_gravar').on('click',function()
		    {
				var codbarra = document.getElementById('codbarra').value;
				var descricao = document.getElementById('descricao').value;
				var preco = document.getElementById('preco').value;
				var custo = document.getElementById('custo').value;
				var estoque = document.getElementById('estoque').value;
				var tipo = document.getElementById('tipo').value;
				
				if(descricao == "")
				{
				       swal({   
 			               title: "Atenção",   
 			               text: "Campo Descrição em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else
				{
					<? if(@$inputb['codigo'])
				   {?>
				      requestPage2('?br=modal_produtos&codigo=<?=$codigo;?>&codbarra='+ codbarra +'&descricao='+ descricao +'&preco='+ preco +'&custo='+ custo +'&estoque='+ estoque +'&tipo='+ tipo +'&modal=1&ap=2&load=1','modals','GET');
				   <? } else {?>
				      requestPage2('?br=modal_produtos&codbarra='+ codbarra +'&descricao='+ descricao +'&preco='+ preco +'&custo='+ custo +'&estoque='+ estoque +'&tipo='+ tipo +'&modal=1&ap=1&load=1','modals','GET');
				   <? } ?>
				}

			});
			
			function edit_produtos(codigo)
			{		
			   requestPage2('?br=modal_produtos&codigo=' + codigo +'&modal=1','modals','GET');
			}
			
			$('#c_novo').on('click',function()
		    {
				requestPage2('?br=modal_produtos&modal=1','modals','GET');
			});
			
			$("#preco").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
			$("#custo").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
			
			</script>
			<div class="m-t-40 row">
			<div class="form-group col-md-3 m-t-20"><label>Codigo de Barra :</label>
			<input type="text" name="codbarra" id="codbarra" value="<? if(isset($inputb['codigo'])){ echo $codbarra;} ?>" placeholder="Codigo de barra ( Se tiver )" class="form-control">
			</div>
			<div class="form-group col-md-5 m-t-20"><label>Descrição :</label>
			<input type="text" name="descricao" id="descricao" value="<? if(isset($inputb['codigo'])){ echo $descricao;} ?>" placeholder="Descrição" class="form-control" required="required">
			</div>
			<div class="form-group col-md-2 m-t-20"><label>Preço :</label>
			<input type="text" name="preco" id="preco" value="<? if(isset($inputb['codigo'])){ echo $preco;} ?>" placeholder="0,00" class="form-control" required="required">
			</div>
			<div class="form-group col-md-2 m-t-20"><label>Custo :</label>
			<input type="text" name="custo" id="custo" value="<? if(isset($inputb['codigo'])){ echo $custo;} ?>" placeholder="0,00" class="form-control">
			</div> 
			<div class="form-group col-md-3 m-t-20"><label>Estoque :</label>
			<input type="text" name="estoque" id="estoque" value="<? if(isset($inputb['codigo'])){ echo $estoque;} ?>" placeholder="0" class="form-control" required="required">
			</div>
			<div class="form-group col-md-3 m-t-20"><label>Tipo :</label>
			<select name="tipo"  id="tipo" class="form-control" style="width: 100%; height:36px;" required="required">
				<option value="">Selecionar Tipo</option>
				   <option value="1" <? if(1 == $tipo){ echo "selected"; } ?>>Produtos</option>
				   <option value="2" <? if(2 == $tipo){ echo "selected"; } ?>>Serviços</option>
			</select></div>
			<div class="form-group col-md-12 m-t-20">
			<div class="form-actions">
			<button type="button" id="btn_gravar" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($codigo)){ echo "Gravar";}else { echo "Cadastrar";} ?></button>
			<? if(!Empty($codigo)) { ?>
			<button class="btn btn-info" type="button" id="c_novo"><i class="fa fa-plus-circle"></i> Novo</button>
			<? } ?>
			</div></div>
			<div class="form-group col-md-12 m-t-20">
			<input type='text' name='pesquisa' id='pesquisa' placeholder="Pesquisar Produtos e Serviços cadastrados..." class='form-control' onkeyup="javascript: requestPage2('?br=atu_produtos&pesquisa='+ this.value +'&load=1','clistprodutos','GET');">
			</div>
			<div class="col-md-12">
			<div class="component-box">
			<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
				<table class="table pmd-table">
					<thead>
						<tr>
							<th>Codigo</th>
							<th>Descrição</th>
							<th>Preço</th>
							<th>Custo</th>
							<th>X</th>
						</tr>
					</thead>
					<tbody id="clistprodutos">
					<? 
										  
										  $sql = "select * from produtos where sistema='".$_SESSION['sistema']."' limit 5";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td data-title="Codigo"><? echo $row['codigo'];?></td>
                                                <td data-title="Descrição"><? echo $row['descricao'];?></td>
												<td data-title="Preço">R$ <? echo number_format($row['preco'], 2, ',','.');?></td>
												<td data-title="Custo">R$ <? echo number_format($row['custo'], 2, ',','.');?></td>
												<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
												<td data-title="Editar"><a class="fa fa-edit" href="javascript:void(0);" onclick="edit_produtos('<? echo $row['codigo']?>');" style="font-size: 150%;"><a></td>
                                            </tr>
										  <? } ?>
					</tbody>
				</table>
			 </div>
			 </div>
			 </div>
		   </div>
</div>
</div>
</div>
<div class="modal-footer">
</div>
<? 
// --------- FINAL CADASTRO DE CLIENTES -------------//

}
?>
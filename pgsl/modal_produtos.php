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
	$SQL = "SELECT * FROM clientes where sistema='".$_SESSION['sistema']."' and nome like '%".$inputb['nome']."%';'";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Cliente já foi cadastrada, escolha outro.')</script>");
		print("<script>window.location.href='sistema.php?url=cad_clientes';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into clientes(sistema, nome, nascimento,sexo, telefone, celular, rg, cpf, status) values('".$_SESSION['sistema']."','".$inputb['nome']."','".revertedata($inputb['nascimento'])."','".$inputb['sexo']."','".$inputb['telefone']."','".$inputb['celular']."','".$inputb['rg']."','".$inputb['cpf']."','".$inputb['status']."')";
	   $sucesso = mysqli_query($db3,$SQL1);
	   
	   if($sucesso)
	   {
		   print('
		   <script>
		   swal({   
 			   title: "Info",   
 			   text: "Gravado com sucesso.",   
 			   timer: 1000,   
 			   showConfirmButton: false 
		   });
		   </script>');
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
else if(@$inputb['ap'] == "2")
{
	$SQL1 = "UPDATE clientes SET nome='".$inputb['nome']."',nascimento='".revertedata($inputb['nascimento'])."',sexo='".$inputb['sexo']."',telefone='".$inputb['telefone']."',celular='".$inputb['celular']."',rg='".$inputb['rg']."',cpf='".$inputb['cpf']."',status='".$inputb['status']."' where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'";
	$sucesso = mysqli_query($db3,$SQL1);
	
	if($sucesso)
	{
        print('
		<script>
		swal({   
 			   title: "Info",   
 			   text: "Gravado com sucesso.",   
 			   timer: 1000,   
 			   showConfirmButton: false 
 		});
		</script>');
		//print("<script>window.location.href='sistema.php?url=cad_clientes';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
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
	$sucesso = mysqli_query($db3,"SELECT * FROM produtos where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $codigo = $row['codigo'];
		 $codbarra = $row['codigob'];
		 $descricao = $row['descricao'];
		 $preco = $row['preco'];
		 $custo = $row['custo'];
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
				swal({   
 			               title: "Atenção",   
 			               text: "Campo Custo em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });

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
			<select name="tipo" class="form-control" style="width: 100%; height:36px;" required="required">
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
			<input type='text' name='pesquisa' id='pesquisa' placeholder="Pesquisar Produtos e Serviços" class='form-control' onkeyup="javascript: requestPage2('?br=atu_produtos&pesquisa='+ this.value +'&load=1','clistprodutos','GET');">
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
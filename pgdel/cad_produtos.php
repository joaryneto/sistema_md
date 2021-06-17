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

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$codbarra = "";
$descricao = "";
$preco = "";
$custo = "";
$estoque = "";
$tipo = "";
		 
if(isset($inputb['codigo']))
{
	$sucesso = mysqli_query($db,"SELECT codigob,descricao,preco,custo,estoque,tipo FROM produtos where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
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

if(@$inputb['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM produtos where sistema='".$_SESSION['sistema']."' and descricao like '%".$_POST['descricao']."%'";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Produtos já foi cadastrada, escolha outro.')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_produtos';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into produtos(sistema,codigob, descricao, preco, custo, estoque,tipo,status) values('".$_SESSION['sistema']."','".$_POST['codbarra']."','".$_POST['descricao']."','".$_POST['preco']."','".$_POST['custo']."','".$_POST['estoque']."','".$_POST['tipo']."',1)";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   //print("<script>window.alert('Produtos Cadastrada com sucesso.')</script>");
		   print("<script>window.location.href='sistema.php?url=cad_produtos';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif(@$inputb['ap'] == "2")
{
	$SQL1 = "UPDATE produtos SET codigob='".$_POST['codbarra']."',descricao='".$_POST['descricao']."',preco='".$_POST['preco']."',custo='".$_POST['custo']."',estoque='".$_POST['estoque']."',tipo='".$_POST['tipo']."' where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        //print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='sistema.php?url=cad_produtos';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
}

?>	
<?

$input = "";

if(Empty($inputb['cadastro']))
{
  $input = "<input type='text' name='pesquisa' id='pesquisa' value='' class='form-control form-control-lg search bottom-25 position-relative border-0' onkeyup=\"javascript: requestPage2('?br=atu_produtos&pesquisa='+ this.value +'&ap=2','listaprodutos','GET');\" required='required'>";
  $valor = 290;
}
else
{
  $valor = 154;
}
?>	
<div class="container-fluid bg-template mb-4">
            <div class="row hn-<?=$valor;?> position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 150px;position: relative;left:50%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Produtos";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
					<?=$input;?>
                </div>
            </div>
        </div>   
		
<div class="container pt-5">
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
			<!--Tabs with Icon example -->
			<script>
			$('.btn-produtos').on('click',function()
			{	
			     $('#modalap').modal('show');
				 requestPage2('?br=modal_produtos&modal=1','modals','GET');
			});
			function edit_produtos2(codigo)
			{		
			   $('#modalap').modal('show');
			   requestPage2('?br=modal_produtos&codigo=' + codigo +'&modal=1','modals','GET');
			}
			</script>
			<button class='btn btn-info btn-produtos'>Adicionar categoria<i class='fa fa-plus-circle'></i></button>
								<form class="form-material m-t-40 row" name="laudo" method="post" action="<? if(@$inputb['codigo'] ==""){ echo "sistema.php?url=cad_produtos&ap=1";}else { echo "sistema.php?url=cad_produtos&ap=2&codigo=".@$inputb['codigo']."";} ?>">
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
                                        <tbody id="listaprodutos">
										<? 
										  
										  $sql = "select * from produtos where sistema='".$_SESSION['sistema']."'";
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
												<td data-title="Editar"><a class="fa fa-edit" href="javascript:void(0);" onclick="edit_produtos2('<? echo $row['codigo']?>');" style="font-size: 150%;"><a></td>
                                            </tr>
										  <? } ?>
                                        </tbody>
                                    </table>
                                 </div>
								 </div>
							   </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
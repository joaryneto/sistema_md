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


$nome =  "";
$nascimento =  "";
$sexo =  "";
$telefone =  "";
$celular = "";
$rg =  "";
$cpf = "";
$status =  "";

if(isset($inputb['codigo']))
{
	$sucesso = mysqli_query($db3,"SELECT nome,nascimento,sexo,telefone,celular,rg,cpf,status FROM clientes where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $nome = $row['nome'];
		 $nascimento = $row['nascimento'];
		 $sexo = $row['sexo'];
		 $telefone = $row['telefone'];
		 $celular = $row['celular'];
		 $rg = $row['rg'];
		 $cpf = $row['cpf'];
		 $status = $row['status'];
		 
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
	$SQL = "SELECT * FROM clientes where sistema='".$_SESSION['sistema']."' and nome like '%".$_POST['nome']."%';'";
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
	   $SQL1 = "INSERT into clientes(sistema, nome, nascimento,sexo, telefone, celular, rg, cpf, status) values('".$_SESSION['sistema']."','".$_POST['nome']."','".revertedata($_POST['nascimento'])."','".$_POST['sexo']."','".$_POST['telefone']."','".$_POST['celular']."','".$_POST['rg']."','".$_POST['cpf']."','".$_POST['status']."')";
	   $sucesso = mysqli_query($db3,$SQL1);
	   
	   if($sucesso)
	   {
		   //print("<script>window.alert('Produtos Cadastrada com sucesso.')</script>");
		   print("<script>window.location.href='sistema.php?url=cad_clientes';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif(@$inputb['ap'] == "2")
{
	$SQL1 = "UPDATE clientes SET nome='".$_POST['nome']."',nascimento='".$_POST['nascimento']."',sexo='".$_POST['sexo']."',telefone='".$_POST['telefone']."',celular='".$_POST['celular']."',rg='".$_POST['rg']."',cpf='".$_POST['cpf']."',status='".$_POST['status']."' where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'";
	$sucesso = mysqli_query($db3,$SQL1);
	
	if($sucesso)
	{
        //print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='sistema.php?url=cad_clientes';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
}

$input = "";

if(Empty($inputb['cadastro']))
{
  $input = "<input type='text' name='pesquisa' id='pesquisa' value='' class='form-control form-control-lg search bottom-25 position-relative border-0' onkeyup=\"javascript: requestPage2('?br=atu_clientes&pesquisa='+ this.value +'&ap=2','listclientes','GET');\" required='required'>
  <button class='btn btn-info btnadd-sh' onclick='window.location=\"sistema.php?url=cad_clientes&cadastro=1\"'><i class='fa fa-plus-circle'></i></button>";
  $valor = 290;
}
else
{
  $valor = 154;
}
?>	
<div class="container-fluid bg-template mb-4">
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
					<i class="material-icons md-dark pmd-md" style="font-size: 200px;position: absolute;left: 50%;top: 50px;">people</i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Clientes";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
					<input type='text' name='pesquisa' id='pesquisa' value='' class='form-control form-control-lg search bottom-25 position-relative border-0' onkeyup="javascript: requestPage2('?br=atu_clientes&pesquisa='+ this.value +'&ap=2','listclientes','GET');" required='required'>
					<button class='btn btn-info btnadd-sh' onclick="requestPage2('?br=modal_clientes&modal=3','modals','GET');" data-toggle="modal" data-target="#modalusuario" data-title="Clientes"><i class='fa fa-plus-circle'></i></button>
                </div>
            </div>
        </div>   
		
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
			<!--Tabs with Icon example -->
								<form class="form-material m-t-40 row" name="laudo" method="post" action="">
								<div class="col-md-12">
					            <div class="component-box">
                                <div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
							        <table class="table pmd-table">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
												<th>Status</th>
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listclientes">
										<? 
										  
										  $sql = "select * from clientes where sistema='".$_SESSION['sistema']."'";
										  $res = mysqli_query($db3,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td data-title="Codigo"><? echo $row['codigo'];?></td>
                                                <td data-title="Descrição"><? echo $row['nome'];?></td>
												<td data-title="Status"><? Switch($row['status'])
												       {
														   case 0:
														     echo '<span class="label label-danger">Inativo</span>';
														   break;
														   case 1:
														     echo '<span class="label label-success">Ativo</span>';
														   break;
													   }
													   ?></td>
												<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
												<td data-title="Editar"><a class="fa fa-edit" href="javascript: void(0);" onclick="edit_cliente(<?=$row['codigo'];?>);" style="font-size: 150%;"><a></td>
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
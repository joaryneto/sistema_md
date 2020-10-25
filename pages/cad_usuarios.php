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

if($_SESSION['menu99'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

function filtro($nome) 
{ 
	$array1 = array(" ","/","ç","ã","é","í","@","#",); 
	$array2 = array("_","_","c","a","e","i","_","_",);
	return str_replace($array1, $array2, $nome); 
}

if(!Empty($_GET['codigo']))
{
	$res = mysqli_query($db,"SELECT * FROM usuarios where codigo='".$_GET['codigo']."'");
	
	if($res)
	{

	  $x = 0;
      while($row = mysqli_fetch_array($res))
	  {
		 $cpf = $row['cpf'];
		 $login = $row['login'];
		 $nome = $row['nome'];
		 $senha = $row['senha'];
		 $email = $row['email'];
		 $tipo = $row['tipo'];
		 $situacao = $row['status'];
		 
		 $x = 1;
	  }
	  
	  $res2 = mysqli_query($db,"SELECT menu FROM permissoes where usuario='".$_GET['codigo']."' and status=1");
	  
	  while($row = mysqli_fetch_array($res2))
      {
		 ///print("<script>window.alert('".$row['menu']."')</script>");
		 
		 Switch($row['menu'])
		 {
			 case 0:
			 $smenu0 = true;
			 break;
			 case 1:
			 $smenu1 = true;
			 break;
			 case 2:
			 $smenu2 = true;
			 break;
			 case 3:
			 $smenu3 = true;
			 break;
			 case 4:
			 $smenu4 = true;
			 break;
			 case 5:
			 $smenu5 = true;
			 break;
			 case 6:
			 $smenu6 = true;
			 break;
			 case 7:
			 $smenu7 = true;
			 break;
			 case 8:
			 $smenu8 = true;
			 break;
			 case 9:
			 $smenu9 = true;
			 break;
			 case 10:
			 $smenu10 = true;
			 break;
			 case 11:
			 $smenu11 = true;
			 break;
			 case 12:
			 $smenu12 = true;
			 break;
			 case 13:
			 $smenu13 = true;
			 break;
			 case 14:
			 $smenu14 = true;
			 break;
			 case 15:
			 $smenu15 = true;
			 break;
			 case 16:
			 $smenu16 = true;
			 break;
			 case 99:
			 $smenu99 = true;
			 break;
		 }
	  }
	  
	  $sistema1 = false;
	  $res4 = mysqli_query($db,"SELECT * FROM usuarios where codigo='".$_GET['codigo']."' and status=1");
	  
	  while($row = mysqli_fetch_array($res4))
      {
          $sistema1 = true;
	  }
	  
	  $sistema2 = false;
	  $res4 = mysqli_query($db3,"SELECT * FROM usuarios where codigo='".$_GET['codigo']."' and status=1");
	  
	  while($row = mysqli_fetch_array($res4))
      {
          $sistema2 = true;
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}
else
{
	$cpf = "";
	$nome = "";
	$senha = "";
	$email = "";
	$tipo = "";
	$situacao = 1;
}

if(isset($_GET['exame']))
{
	//$sucess = mysqli_query($db,"SELECT descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['exame']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 //$descricao = $row['descricao'];
		 //$valorB = $row['valor_padrao'];
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		//print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if($_GET['ap'] == "1")
{
    $y = 0;
	$x = 0;
	
	//echo "</br>";
	$SQL2 = "SELECT * FROM usuarios where email='".$_POST['email']."'";
	$sucesso = mysqli_query($db2,$SQL2);
	while($rows = mysqli_fetch_array($sucesso))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Email ja cadastrado')</script>");
		//print("<script>window.location.href='iniciado.php?url=cad_usuarios&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
	   //echo "</br>";
	   
	   $SQL3 = "INSERT into usuarios(sistema,cpf,login,nome,email,senha,tipo,status) values('".$_SESSION['cliente']."','".$_POST['cpf']."','".$_POST['login']."','".$_POST['nome']."','".$_POST['email']."','".$_POST['senha']."','".$_POST['tipo']."','".$_POST['situacao']."')";
	   $sucesso = mysqli_query($db2,$SQL3);

	   if(is_dir("sign/") == false)
       {
	      mkdir("sign/", 0777);
	   }
	
	   if(!Empty($_POST['imgs']))
	   {
		
	     $output_dir = "sign/";
	     $fileName = $_FILES["img"]["name"];
	     $arquivo["name"] =  $_POST['cnpj'].".gif";	
	     //$imagem_dir = $pasta.filtro($arquivo["name"]);
	     //$nome_final = $arquivo["name"];
         $up = move_uploaded_file($_FILES["img"]["tmp_name"],$output_dir.$arquivo["name"]);
	
	   }
	
	   //echo "</br>";
	   $SQL4 = "SELECT codigo FROM usuarios where email='".$_POST['email']."'";
	   $res = mysqli_query($db2,$SQL4);
	   while($row = mysqli_fetch_array($res))
	   {    
         $cod = $row['codigo'];

	     if(isset($_POST['menu']))
	     {
		   foreach($_POST['menu'] as $menus)
	       {
			  echo "</br>";
			  echo $SQL5 = "INSERT INTO usuarios_permissoes(sistema,menu,usuario,status) values('".$menus."','".$cod."',1);";
			  $sucesso = mysqli_query($db2,$SQL5);
			  
			  if($sucesso)
			  {
				  $y = 1;
			  }
		   }
	     }
	   }
	   
	   if($y)
	   {
		    print("<script>window.alert('Usuario Cadastrado com sucess...')</script>");
		    print("<script>window.location.href='iniciado.php?url=cad_usuarios&codigo=".$cod."';</script>");
	   }
	   else
	   {
		    print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
   if(Empty($_POST['cpf']))
   {
		print("<script>window.alert('Campo em branco!');</script>");
	    print("<script>window.location.href='iniciado.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
   }
   else
   {
	
	$SQL1 = "DELETE FROM permissoes where usuario='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE usuarios SET nome='".$_POST['nome']."',login='".$_POST['login']."',email='".$_POST['email']."',senha='".$_POST['senha']."',tipo='".$_POST['tipo']."', status='".$_POST['situacao']."' where codigo=".$_GET['codigo']."";
	$sucesso = mysqli_query($db2,$SQL2);
	
	$output_dir = "sign/";
	$fileName = $_FILES["img"]["name"];
	$arquivo["name"] =  $_POST['cnpj'].".gif";	
    move_uploaded_file($_FILES["img"]["tmp_name"],$output_dir.$arquivo["name"]);
	   
	if(isset($_POST['menu']))
	{
		foreach($_POST['menu'] as $menus)
	    {
			//print("<script>window.alert('".$menus."');</script>");
			
			$SQL = "INSERT INTO permissoes(menu,usuario,status) values('".$menus."','".$_GET['codigo']."',1);";
			$sucesso = mysqli_query($db2,$SQL);
		}
	}
	
	if($sucesso)
	{
	  print("<script>window.alert('Gravado com sucesso...');</script>");
	  print("<script>window.location.href='iniciado.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
	  print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	  print("<script>window.location.href='iniciado.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
	}
  }
}
elseif($_GET['ap'] == "3")
{
	$SQL1 = "SELECT codigo FROM tipo_exame where descricao like '%RX%'";
	$sucesso = mysqli_query($db,$SQL);
	
	while($res = mysqli_fetch_array($sucesso))
	{

		$SQL2 = "SELECT * FROM laudar where cod_exame='".$res['codigo']."'";
		$sucesso = mysqli_query($db,$SQL2);

		while($row = mysqli_fetch_array($sucesso))
		{
		   if(!Empty($row['cod_exame']))
		   {
		      $SQL3 = "INSERT INTO laudar(cod_exame,cod_medico) values('".$res['codigo']."','".$_GET['codigo']."');";
		      $res2 = mysqli_query($db,$SQL3);
		   }
		}
	}
	
	if($sucesso)
	{
		print("<script>window.location.href='iniciado.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
		print('<script> window.alert("Pacote adicionado com sucesso...")</script>');		
	}
}
elseif($_GET['ap'] == "4")
{
	//$SQL1 = "DELETE FROM permissoes where usuario='".$_GET['codigo']."'";
	//$sucesso = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE internet_usuarios SET status=0 where codigo=".$_GET['codigo']."";
	$sucesso = mysqli_query($db,$SQL2);
	
	if($sucesso)
	{
	   print("<script>window.alert('Usuario desativado com sucesso...');</script>");
	   print("<script>window.location.href='iniciado.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
	}
}
?>		
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de Usuario";?></h4>
								
								<form name="laudo" class="form-material m-t-40 row" autocomplete="off" method="post" action="<? if(Empty($_GET['codigo'])){ echo "iniciado.php?url=cad_usuarios&ap=1";}else { echo "iniciado.php?url=cad_usuarios&codigo=".$_GET['codigo']."&ap=2";} ?>" enctype="multipart/form-data">
								<div class="form-group col-md-2 m-t-20"><label>CPF :</label>
								<input type="text" name="cpf" id="cpf" <? if(isset($_GET['codigo'])){ ?> value="<? echo $cpf; ?>" <? } ?> class="form-control" required="required"><a style="position: absolute;left: 80%;" class="btn btn-info" href="#" data-toggle="modal" data-target="#usuarioss"><i class="fa fa-search"></i></a></div>
								<div class="form-group col-md-2 m-t-20"><label>Login :</label>
								<input type="text" name="login" id="login" value="<? if(isset($_GET['codigo'])){ echo $login;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Nome :</label>
								<input type="text" name="nome" id="nome" value="<? if(isset($_GET['codigo'])){ echo $nome;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Email :</label>
								<input type="email" name="email" id="email" value=" <? if(isset($_GET['codigo'])){ echo $email;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Senha :</label>
								<input type="password" name="senha" id="senha" value="<? if(isset($_GET['codigo'])){ echo $senha;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Tipo :</label>
								<select name="tipo" class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar Tipo</option>
										   <option value="2" <? if(2 == $tipo){ echo "selected"; } ?>>Normal</option>
										   <option value="3" <? if(3 == $tipo){ echo "selected"; } ?>>Administrador</option>
                                </select></div>
								
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<!--<a class="btn btn-info" onclick="javascript: ajaxLoader('?br=mexames&codigo=<? echo $_GET['codigo'];?>&list=1','listaexames','GET');" data-toggle="modal" data-target="#exames"><i class="fa fa-plus-circle"></i> Exames Atendidos</a>-->
								<? //if(!Empty($_GET['codigo'])){?>
								<a href="" class="btn btn-info" data-toggle="modal" data-target="#exames"><i class="fa fa-plus-circle"></i> Sistemas </a>
								<a href="" class="btn btn-info" data-toggle="modal" data-target="#permissoes"><i class="fa fa-plus-circle"></i> Permissões</a>
								<!--<a href="" class="btn btn-info" data-toggle="modal" data-target="#assinatura"><i class="fa fa-plus-circle"></i> Assinatura</a>-->
								<? // }   ?>
								</div></div>
								<div class="form-group col-md-2 m-t-20"><label>Situação :</label>
								<select name="situacao" class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option>Selecionar Situação</option>
                                           <option value="0" <? if(0 == $situacao){ echo "selected"; } ?>>Inativa</option>
										   <option value="1" <? if(1 == $situacao){ echo "selected"; } ?>>Ativa</option>
                                </select></div>
									
								<!--< } ?> -->
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Gravar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="iniciado.php?url=cad_usuarios"><i class="fa fa-plus-circle"></i> Novo cadastro</a>
								</div></div>
								
								<div id="usuarioss" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Lista de Usuarios : </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="form-group"><label>Busca:</label>
                                             <input name="user" type="text" class="form-control" onkeyup="javascript: ajaxLoader('?br=listusuarios&pesquisa='+ this.value +'&ap=1','listusuarios','GET');" />
											</div>
											<div class="table-responsive m-t-40" id="listusuarios">
											<table class="display nowrap table table-hover table-striped table-bordered">
											<thead>
											  <tr>
											<th>Codigo</th>
											<th>Nome</th>
											<th>Email</th>
											<th>Status</th>
											</tr>
											 </thead>
											   <tbody>
											   <?
											   $sql = "SELECT * FROM usuarios";
											   $res = mysqli_query($db2,$sql); 
											   $x = 0;
											   while($row = mysqli_fetch_array($res))
											   {
											   ?>
											   <tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="javascript: window.location='sistemas.php?url=cad_usuarios&codigo=<? echo $row['codigo'];?>';">
											   <td><? echo $row['codigo'];?></td>
											   <td><? echo $row['nome'];?></td>
											   <td><? echo $row['email'];?></td>
											   <td><? Switch($row['status'])
 											         {
											   		   case 0:
											   		     echo '<span class="label label-danger">Inativo</span>';
											   		   break;
											   		   case 1:
											   		     echo '<span class="label label-success">Ativo</span>';
											   		   break;
													   case 2:
											   		     echo '<span class="label label-warning">Pre-ativo</span>';
											   		   break;
											   	   }
											   	   ?></td>
											   </tr>
											   <? $x = 1;
											   }

 											    if($x == 0)
 											    {
											   	 echo "<tr><td>Nenhum resultado encontrado.</td><td></td><td></td><td></td></tr>";
 											   
 											   }
											   ?>
											 </tbody>
											<tfoot>
											  <tr>
											<th>Codigo</th>
											<th>Nome</th>
											<th>Email</th>
											<th>Status</th>
											</tr>
											 </tfoot>	
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
								
								<!-- Modal -->
								<? //if(!Empty($_GET['codigo'])){ ?>
								<div id="exames" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mysmallModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Sistemas EC</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="card">
											<div class="card-body">
											<!--<input type="text" name="pesquisa" id="pesquisa" value="" onkeyup="javascript: ajaxLoader('?br=cad_exameusuario&codigo=< echo $_GET['codigo'];?>&pesquisa='+ document.getElementById('pesquisa').value +'&list=1','listexame','GET');" class="form-control">-->
											<div class="form-group col-md-12 m-t-20">
											<span>Sistemas :</span>
											<br>
											<input type="checkbox" name="sistema1" value="1" <? if($sistema1 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Escolar </br>
											<input type="checkbox" name="sistema2" value="2" <? if($sistema2 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Salão
								
											<div id="listaexames"></div>
											<div id="listamaterias"></div>
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
								<div id="permissoes" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Lista de permissões</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="card">
											<div class="card-body">
											
											<div class="form-group col-md-12 m-t-20">
											<h4>Menu Permissões</h4>
											<div class="switchery-demo m-b-30">
											<input type="checkbox" name="menu[]" value="13" <? if($smenu13 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Cadastro de Empresas<br />
											<input type="checkbox" name="menu[]" value="0" <? if($smenu0 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Exames Enviados<br />
											<input type="checkbox" name="menu[]" value="1" <? if($smenu1 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Cadastro de Exames<br />
											<input type="checkbox" name="menu[]" value="2" <? if($smenu2 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Tabela de Desconto<br />
											<input type="checkbox" name="menu[]" value="3" <? if($smenu3 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Tabela de pagamento a Laudadores<br />
											<input type="checkbox" name="menu[]" value="4" <? if($smenu4 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Enviar Exames<br />
											<input type="checkbox" name="menu[]" value="5" <? if($smenu5 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Laudar Exames<br />
											<input type="checkbox" name="menu[]" value="14" <? if($smenu14 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Laudos Externo<br />
											
											</div>
											
											<h4>Permissões Geral</h4>
											<div class="switchery-demo m-b-30">
											<input type="checkbox" name="menu[]" value="99" <? if($smenu99 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Permissões de Usuarios
											</div>
											
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
								<? 
								//}
								?>
								</form>
								
							
                            </div>
                        </div>
					</div>
				</div>
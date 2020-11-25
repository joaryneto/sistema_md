<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

if(@$_SESSION['menu99'] == false)
{
   //print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   //print("<script>window.location.href='iniciado.php';</script>");
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
	$res = mysqli_query($db3,"SELECT * FROM usuarios where codigo='".$_GET['codigo']."'");
	
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
	  
	  $res2 = @mysqli_query($db3,"SELECT menu FROM permissoes where usuario='".$_GET['codigo']."' and status=1");
	  while($row = @mysqli_fetch_array($res2))
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
	//$sucess = mysqli_query($db3,"SELECT descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['exame']."'");
	
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

if(@$_GET['ap'] == "1")
{
    $y = 0;
	$x = 0;
	
	//echo "</br>";
	$SQL2 = "SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and email='".$_POST['email']."'";
	$sucesso = mysqli_query($db3,$SQL2);
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
	   
	   $SQL3 = "INSERT into usuarios(sistema,cpf,login,nome,email,senha,tipo,status) values('".$_SESSION['sistema']."','".$_POST['cpf']."','".$_POST['login']."','".$_POST['nome']."','".$_POST['email']."','".$_POST['senha']."','".$_POST['tipo']."','".$_POST['situacao']."')";
	   $sucesso = mysqli_query($db3,$SQL3);

	   
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
	   $SQL4 = "SELECT codigo FROM usuarios where sistema='".$_SESSION['sistema']."' and email='".$_POST['email']."'";
	   $res = mysqli_query($db3,$SQL4);
	   while($row = mysqli_fetch_array($res))
	   {    
         $cod = $row['codigo'];
		 
	     if(isset($_POST['menu']))
	     {
		   foreach($_POST['menu'] as $menus)
	       {
			  //"</br>";
			  //$SQL5 = "INSERT INTO permissoes(sistema,menu,usuario,status) values('".$_SESSION['sistema']"','".$menus."','".$cod."',1);";
			  //$sucesso = mysqli_query($db3,$SQL5);
			  
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
		    print("<script>window.location.href='sistema.php?url=cad_usuarios&codigo=".$cod."';</script>");
	   }
	   else
	   {
		    print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif(@$_GET['ap'] == "2")
{
   if(Empty($_POST['nome']))
   {
		print("<script>window.alert('Campo em branco!');</script>");
	    print("<script>window.location.href='sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
   }
   else
   {
	
	$SQL1 = "DELETE FROM permissoes where sistema='".$_SESSION['sistema']."' and usuario='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db3,$SQL1);
	
	$SQL2 = "UPDATE usuarios SET nome='".$_POST['nome']."',login='".$_POST['login']."',email='".$_POST['email']."',senha='".$_POST['senha']."',tipo='".$_POST['tipo']."', status='".$_POST['situacao']."' where sistema='".$_SESSION['sistema']."' and codigo=".$_GET['codigo']."";
	$sucesso = mysqli_query($db3,$SQL2);
	
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
			$sucesso = mysqli_query($db3,$SQL);
		}
	}
	
	if($sucesso)
	{
	  print("<script>window.alert('Gravado com sucesso...');</script>");
	  print("<script>window.location.href='sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
	  print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	  print("<script>window.location.href='sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
	}
  }
}

?>		
<div class="container-fluid bg-template mb-4">
            <div class="row hn-154 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Usuarios";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
								<form name="laudo" class="form-material m-t-40 row" autocomplete="off" method="post" action="<? if(Empty($_GET['codigo'])){ echo "sistema.php?url=cad_usuarios&ap=1";}else { echo "sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."&ap=2";} ?>" enctype="multipart/form-data">
								<div class="form-group col-md-3 m-t-20"><label>CPF :</label>
								<input type="text" name="cpf" id="cpf" <? if(isset($_GET['codigo'])){ ?> value="<? echo $cpf; ?>" readonly <? } ?> class="form-control" required="required">
								<button type="button" class="btn btn-info btnadd-us" onclick="requestPage2('?br=modal_usuarios&amp;codigo=&amp;modal=1','modals','GET');"  data-toggle="modal" data-target="#modalusuario">
								<i class="fa fa-search" style="font-size: x-large;"></i></button></div>
								<div class="form-group col-md-3 m-t-20"><label>Login :</label>
								<input type="text" name="login" id="login" <? if(isset($_GET['codigo'])){?> value="<? echo $login;?>" readonly <? } ?>class="form-control" required="required">
								</div>
								<div class="form-group col-md-5 m-t-20"><label>Nome :</label>
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
                                       <option value="1" <? if(1 == $tipo){ echo "selected"; } ?>>Normal</option>
									   <option value="2" <? if(2 == $tipo){ echo "selected"; } ?>>Profissional</option>
									   <option value="3" <? if(3 == $tipo){ echo "selected"; } ?>>Vendas</option>
									   <option value="4" <? if(4 == $tipo){ echo "selected"; } ?>>Administrador</option>
                                </select></div>
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<!--<a class="btn btn-info" onclick="javascript: ajaxLoader('?br=mexames&codigo=<? echo $_GET['codigo'];?>&list=1','listaexames','GET');" data-toggle="modal" data-target="#exames"><i class="fa fa-plus-circle"></i> Exames Atendidos</a>-->
								<? if(!Empty($_GET['codigo']) and $tipo == 2 or !Empty($_GET['codigo']) and $tipo == 3 or !Empty($_GET['codigo']) and $tipo == 4){?>
								<button type="button" class="btn btn-info" onclick="requestPage2('?br=modal_usuarios&codigo=<?=$_GET['codigo'];?>&modal=2','modals','GET');" data-toggle="modal" data-target="#modalusuario"><i class="fa fa-plus-circle"></i> Serviços </button>
								<!--<button type="button" class="btn btn-info" onclick="requestPage2('?br=modal_usuarios&codigo=<=$_GET['codigo'];?>&modal=3','modals','GET');" data-toggle="modal" data-target="#modalusuario"><i class="fa fa-plus-circle"></i> Permissões</button>-->
								<!--<a href="" class="btn btn-info" data-toggle="modal" data-target="#assinatura"><i class="fa fa-plus-circle"></i> Assinatura</a>-->
								<?  }   ?>
								</div></div>
								<div class="form-group col-md-2 m-t-20"><label>Situação :</label>
								<select name="situacao" class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option>Selecionar Situação</option>
                                           <option value="0" <? if(0 == $situacao){ echo "selected"; } ?>>Inativa</option>
										   <option value="1" <? if(1 == $situacao){ echo "selected"; } ?>>Ativa</option>
                                </select>
								</div>
									
								<!--< } ?> -->
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Gravar";}else { echo "Cadastrar";} ?></button>
								<a class="btn btn-info" href="sistema.php?url=cad_usuarios"><i class="fa fa-plus-circle"></i> Novo</a>
								</div></div>
								
								</form>
								
							
                            </div>
                        </div>
					</div>
				</div>

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

if(isset($_GET['codigo']))
{
   $codigo = $_GET['codigo'];
}

if(@$_GET['ap'] == "1")
{
    $y = 0;
	$x = 0;
	
	//echo "</br>";
	$SQL2 = "SELECT * FROM usuarios where login='".$_GET['login']."' or nome like '%".$_GET['nome']."%'";
	$sucesso = mysqli_query($db,$SQL2);
	while($rows = mysqli_fetch_array($sucesso))
	{
		
		$x = 1;
	}
	
	if($x == 1)
	{
	    print('
		<script>
		swal({   
 			   title: "Atenção!",   
 			   text: "Usuario já foi cadastrada, escolha outro nome.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
	else
	{
	   //echo "</br>";
	   
	   $SQL3 = "INSERT into usuarios(sistema,cpf,login,nome,email,senha,tipo,nascimento,status) values('".$_SESSION['sistema']."','".$_GET['cpf']."','".$_GET['login']."','".$_GET['nome']."','".$_GET['email']."','".$_GET['senha']."','".$_GET['tipo']."','".revertedata($_GET['nascimento'])."','".$_GET['situacao']."')";
	   $sucesso = mysqli_query($db,$SQL3);

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
elseif(@$_GET['ap'] == "2")
{
	$SQL2 = "UPDATE usuarios SET nome='".$_GET['nome']."',login='".$_GET['login']."',email='".$_GET['email']."',senha='".$_GET['senha']."',nascimento='".revertedata($_GET['nascimento'])."',tipo='".$_GET['tipo']."', status='".$_GET['situacao']."' where sistema='".$_SESSION['sistema']."' and codigo=".$_GET['codigo']."";
	$sucesso = mysqli_query($db,$SQL2);
	
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
elseif(@$_GET['ap'] == "3")
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
		print("<script>window.location.href='sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
		print('<script> window.alert("Pacote adicionado com sucesso...")</script>');		
	}
}
elseif(@$_GET['ap'] == "4")
{
	//$SQL1 = "DELETE FROM permissoes where usuario='".$_GET['codigo']."'";
	//$sucesso = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE internet_usuarios SET status=0 where sistema='".$_SESSION['sistema']."' and codigo=".$_GET['codigo']."";
	$sucesso = mysqli_query($db,$SQL2);
	
	if($sucesso)
	{
	   print("<script>window.alert('Usuario desativado com sucesso...');</script>");
	   print("<script>window.location.href='sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."';</script>");
	}
}

if(isset($codigo))
{
	$SQL = "SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and codigo='".$codigo."'";
	$res = mysqli_query($db,$SQL);
	
	if($res)
	{

	  $x = 0;
      while($row = mysqli_fetch_array($res))
	  {
		 $codigo = $row['codigo'];
		 $cpf = $row['cpf'];
		 $login = $row['login'];
		 $nome = $row['nome'];
		 $senha = $row['senha'];
		 $email = $row['email'];
		 $tipo = $row['tipo'];
		 $nascimento = $row['nascimento'];
		 $situacao = $row['status'];
		 
		 $x = 1;
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
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
				    <script>
			$('.u-gravar').on('click',function()
		    {
	   
				var cpf = document.getElementById('cpf').value;
				var login = document.getElementById('login').value;
				var nome = document.getElementById('nome').value;
				var email = document.getElementById('email').value;
				var nascimento = document.getElementById('nascimento').value;
				var senha = document.getElementById('senha').value;
				var tipo = document.getElementById('tipo').value;
				var situacao = document.getElementById('situacao').value;
				
				if(login == "")
				{
				       swal({   
 			               title: "Atenção",   
 			               text: "Campo Login em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(senha == "")
				{
				       swal({   
 			               title: "Atenção",   
 			               text: "Campo Senha em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else
				{
					<? if(isset($codigo))
				   {?>
				      requestPage('?br=cad_usuarios&codigo=<?=$codigo;?>&cpf='+ cpf +'&login='+ login +'&nome='+ nome +'&email='+ email +'&nascimento='+ nascimento +'&senha='+ senha +'&tipo='+ tipo +'&situacao='+ situacao +'&ap=2','modals','GET');
				   <? } else {?>
				      requestPage('?br=cad_usuarios&cpf='+ cpf +'&login='+ login +'&nome='+ nome +'&email='+ email +'&nascimento='+ nascimento +'&senha='+ senha +'&tipo='+ tipo +'&situacao='+ situacao +'&ap=1','conteudo','GET');
				   <? } ?>
				}

			});
			
			function edit_usuarios(codigo)
			{				
			    $('#modalap').modal('hide');
				requestPage('?br=cad_usuarios&codigo=' + codigo +'','conteudo','GET');
			}
			
			$('.u-novo').on('click',function()
			{
			   requestPage('?br=cad_usuarios','conteudo','GET');
			});
			
			$('.sh-usuarios').on('click',function()
			{
			   $('#modalap').modal('show');
			   requestPage2('?br=modal_usuarios&modal=1','modals','GET');
			});
			
			</script>
								<form name="laudo" class="form-material m-t-40 row" autocomplete="off" method="post" action="<? if(Empty($_GET['codigo'])){ echo "sistema.php?url=cad_usuarios&ap=1";}else { echo "sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."&ap=2";} ?>" enctype="multipart/form-data">
								<div class="form-group col-md-3 m-t-20"><label>CPF :</label>
								<input type="text" name="cpf" id="cpf" <? if(isset($_GET['codigo'])){ ?> value="<? echo $cpf; ?>" readonly <? } ?> class="form-control" required="required">
								<button type="button" onclick="requestPage2('?br=modal_usuarios&amp;codigo=&amp;modal=1','modals','GET');" class="btn btn-info btnadd-us" data-toggle="modal" data-target="#modalap">
								<i class="fa fa-search" style="font-size: x-large;"></i></button></div>
								<div class="form-group col-md-3 m-t-20"><label>Login :</label>
								<input type="text" name="login" id="login" <? if(isset($_GET['codigo'])){?> value="<? echo $login;?>" readonly <? } ?>class="form-control" required="required">
								</div>
								<div class="form-group col-md-5 m-t-20"><label>Nome :</label>
								<input type="text" name="nome" id="nome" value="<? if(isset($_GET['codigo'])){ echo $nome;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Nascimento :</label>
								<input type="text" name="nascimento" id="nascimento" value=" <? if(isset($_GET['codigo'])){ echo $nascimento;} ?>" class="form-control">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Email :</label>
								<input type="email" name="email" id="email" value=" <? if(isset($_GET['codigo'])){ echo $email;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Senha :</label>
								<input type="password" name="senha" id="senha" value="<? if(isset($_GET['codigo'])){ echo $senha;} ?>" class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Tipo :</label>
								<select name="tipo" id="tipo" class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar Tipo</option>
                                       <option value="1" <? if(1 == $tipo){ echo "selected"; } ?>>Aluno</option>
									   <option value="2" <? if(2 == $tipo){ echo "selected"; } ?>>Professor</option>
									   <option value="3" <? if(3 == $tipo){ echo "selected"; } ?>>Administrador</option>
                                </select></div>
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<!--<a class="btn btn-info" onclick="javascript: ajaxLoader('?br=mexames&codigo=<? echo $_GET['codigo'];?>&list=1','listaexames','GET');" data-toggle="modal" data-target="#exames"><i class="fa fa-plus-circle"></i> Exames Atendidos</a>-->
								<? if(!Empty($_GET['codigo']) and $tipo == 2 or !Empty($_GET['codigo']) and $tipo == 3){?>
								<button type="button" class="btn btn-info" onclick="requestPage2('?br=modal_usuarios&codigo=<?=$_GET['codigo'];?>&modal=2','modals','GET');" data-toggle="modal" data-target="#modalap"><i class="fa fa-plus-circle"></i> Turmas </button>
								<!--<button type="button" class="btn btn-info" onclick="requestPage2('?br=modal_usuarios&codigo=<=$_GET['codigo'];?>&modal=3','modals','GET');" data-toggle="modal" data-target="#modalusuario"><i class="fa fa-plus-circle"></i> Permissões</button>-->
								<!--<a href="" class="btn btn-info" data-toggle="modal" data-target="#assinatura"><i class="fa fa-plus-circle"></i> Assinatura</a>-->
								<?  }   ?>
								</div></div>
								<div class="form-group col-md-2 m-t-20"><label>Situação :</label>
								<select name="situacao" id="situacao" class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option>Selecionar Situação</option>
                                           <option value="0" <? if(0 == $situacao){ echo "selected"; } ?>>Inativa</option>
										   <option value="1" <? if(1 == $situacao){ echo "selected"; } ?>>Ativa</option>
										   <option value="2" <? if(2 == $situacao){ echo "selected"; } ?>>Pre-Ativa</option>
                                </select>
								</div>
									
								<!--< } ?> -->
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="button" class="btn btn-info u-gravar"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Gravar";}else { echo "Cadastrar";} ?></button>
								<button type="button" class="btn btn-info u-novo" href="javascript: void(0);"><i class="fa fa-plus-circle"></i> Novo cadastro</button>
								</div></div>
								
								</form>
								
							
                            </div>
                        </div>
					</div>
				</div>

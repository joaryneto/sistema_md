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

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$cpf = "";
$login = "";
$senha = "";
$nome = "";
$email = "";
$tipo = "";
$situacao = "";

if(isset($inputb['codigo']))
{
	$codigo = $inputb['codigo'];
}

if(@$inputb['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM usuarios where login like '%".$inputb['login']."%' or nome like '%".$inputb['nome']."%';'";
	$RES = mysqli_query($db3,$SQL);
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
 			   text: "Usuario já foi cadastrada, escolha outro nome.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
	else
	{
	   
	   $senha = $inputb['senha'];
	
	   $senha = password_hash($senha, PASSWORD_DEFAULT, ['cost' => 12]);
		
	   $SQL1 = "INSERT into usuarios(sistema, cpf, login,senha, nome, email, nascimento , tipo, status, banco,agencia,conta,tipoconta) values('".$_SESSION['sistema']."','".$inputb['cpf']."','".$inputb['login']."','".$senha."','".$inputb['nome']."','".$inputb['email']."','".revertedata($inputb['nascimento'])."','".$inputb['tipo']."','".$inputb['situacao']."','".$inputb['banco']."','".$inputb['agencia']."','".$inputb['conta']."','".$inputb['tipoconta']."')";
	   $sucesso = mysqli_query($db3,$SQL1);
	   
	   if($sucesso)
	   {
		   print('
		   <script>
		   swal({   
 			   title: "Info",   
 			   text: "Cadastrado com sucesso.",   
 			   timer: 1000,   
 			   showConfirmButton: false 
		   });
		   </script>');
		   
		   $RES = mysqli_query($db3,"SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and login='".$inputb['login']."'");
		   $ROW = mysqli_fetch_array($RES);
		   $codigo = $ROW['codigo'];
		   
		   print("<script>
		      //requestPage('?br=cad_usuarios&codigo=".$row['codigo']."','conteudo','GET');
		   </script>");
		   
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
	//$hashed_password = password_hash($inputb['senha'], PASSWORD_DEFAULT);
	
	//$senha = $inputb['senha'];
	
	if(isset($inputb['senha']))
	{
		$senha = $inputb['senha'];
	
	    $senha = password_hash($senha, PASSWORD_DEFAULT, ['cost' => 12]);
	
		$whe="senha='".$senha."',";
	}
	
	$SQL1 = "UPDATE usuarios SET cpf='".$inputb['cpf']."',login='".$inputb['login']."',$whe nome='".$inputb['nome']."',email='".$inputb['email']."',nascimento='".revertedata($inputb['nascimento'])."',tipo='".$inputb['tipo']."',status='".$inputb['situacao']."',banco='".$inputb['banco']."',agencia='".$inputb['agencia']."',conta='".$inputb['conta']."',tipoconta='".$inputb['tipoconta']."' where sistema='".$_SESSION['sistema']."' and codigo='".$inputb['codigo']."'";
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

if(isset($codigo))
{
	$sucesso = mysqli_query($db3,"SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and codigo='".$codigo."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $codigo = $row['codigo'];
		 $cpf = $row['cpf'];
		 $login = $row['login'];
		 $senha = $row['senha'];
		 $_SESSION['pwe'] = $senha;
		 $nome = $row['nome'];
		 $email = $row['email'];
		 $nascimento = $row['nascimento'];
		 $tipo = $row['tipo'];
		 $situacao = $row['status'];
		 $banco = $row['banco'];
		 $agencia = $row['agencia'];
		 $conta = $row['conta'];
		 $tipoconta = $row['tipoconta'];
		 
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
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
					<i class="material-icons" style="font-size: 100px;position: absolute;left: 45%;top: 50px;">supervisor_account</i> 
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
			$('.t-gravar').on('click',function()
		    {
	   
				var cpf = document.getElementById('cpf').value;
				var login = document.getElementById('login').value;
				var nome = document.getElementById('nome').value;
				var email = document.getElementById('email').value;
				var nascimento = document.getElementById('nascimento').value;
				var senha = document.getElementById('senha').value;
				var tipo = document.getElementById('tipo').value;
				var situacao = document.getElementById('situacao').value;
				var banco = document.getElementById('banco').value;
				var agencia = document.getElementById('agencia').value;
				var conta = document.getElementById('conta').value;
				var tipoconta = document.getElementById('tipoconta').value;
				
				if(login == "")
				{
				       swal({   
 			               title: "Atenção",   
 			               text: "Campo Login em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else
				{
					<? if(isset($inputb['codigo']))
				   {?>
				      requestPage2('?br=cad_usuarios&codigo=<?=$codigo;?>&cpf='+ cpf +'&login='+ login +'&nome='+ nome +'&email='+ email +'&nascimento='+ nascimento +'&senha='+ senha +'&tipo='+ tipo +'&situacao='+ situacao +'&banco='+ banco +'&agencia='+ agencia +'&conta='+ conta +'&tipoconta='+ tipoconta +'&modal=1&ap=2&load=1','modals','GET');
				   <? } else {?>
				      requestPage2('?br=cad_usuarios&cpf='+ cpf +'&login='+ login +'&nome='+ nome +'&email='+ email +'&nascimento='+ nascimento +'&senha='+ senha +'&tipo='+ tipo +'&situacao='+ situacao +'&banco='+ banco +'&agencia='+ agencia +'&conta='+ conta +'&tipoconta='+ tipoconta +'&modal=1&ap=1&load=1','modals','GET');
				   <? } ?>
				}

			});
			
			function c_clientes(codigo)
			{
			   $('#modalap').modal('hide');
			   requestPage('?br=cad_usuarios&codigo='+ codigo +'','conteudo','GET');
			}
			
			$('.t-novous').on('click',function()
			{
			   requestPage('?br=cad_usuarios','conteudo','GET');
			});
			
			$('.sh-usuarios').on('click',function()
			{
			   $('#modalap').modal('show');
			   requestPage2('?br=modal_usuarios&modal=1','modals','GET');
			});
						
			$('#nascimento').mask('00/00/0000');
			
			</script>
								<form name="laudo" class="form-material m-t-40 row" autocomplete="off" method="post" action="<? if(Empty($_GET['codigo'])){ echo "sistema.php?url=cad_usuarios&ap=1";}else { echo "sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."&ap=2";} ?>" enctype="multipart/form-data">
								<div class="form-group col-md-3 m-t-20"><label>CPF :</label>
								<input type="text" name="cpf" id="cpf" <? if(isset($_GET['codigo'])){ ?> value="<? echo $cpf; ?>" readonly <? } ?> class="form-control">
								<button type="button" class="btn btn-info btnadd-us sh-usuarios">
								<i class="fa fa-search"></i></button>
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Login/Usuário :</label>
								<input type="text" name="login" id="login" <? if(isset($_GET['codigo'])){?> value="<? echo $login;?>" readonly <? } ?>class="form-control">
								</div>
								<div class="form-group col-md-5 m-t-20"><label>Nome :</label>
								<input type="text" name="nome" id="nome" value="<? if(isset($_GET['codigo'])){ echo $nome;} ?>" class="form-control">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Nascimento :</label>
								<input type="text" name="nascimento" id="nascimento" value=" <? if(isset($_GET['codigo'])){ echo formatodata($nascimento);} ?>" class="form-control">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Email :</label>
								<input type="email" name="email" id="email" value=" <? if(isset($_GET['codigo'])){ echo $email;} ?>" class="form-control">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Senha :</label>
								<input type="password" name="senha" id="senha" value="" class="form-control">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Tipo :</label>
								<select name="tipo" id="tipo" class="form-control" style="width: 100%; height:36px;">
                                    <option value="">Selecionar Tipo</option>
                                       <option value="1" <? if(1 == $tipo){ echo "selected"; } ?>>Normal</option>
									   <option value="2" <? if(2 == $tipo){ echo "selected"; } ?>>Profissional</option>
									   <option value="3" <? if(3 == $tipo){ echo "selected"; } ?>>Vendas</option>
									   <option value="4" <? if(4 == $tipo){ echo "selected"; } ?>>Administrador</option>
                                  </select>
								 </div>
								 <div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<!--<a class="btn btn-info" onclick="javascript: ajaxLoader('?br=mexames&codigo=<? echo $_GET['codigo'];?>&list=1','listaexames','GET');" data-toggle="modal" data-target="#exames"><i class="fa fa-plus-circle"></i> Exames Atendidos</a>-->
								<? if(!Empty($_GET['codigo']) and $tipo == 2 or !Empty($_GET['codigo']) and $tipo == 3 or !Empty($_GET['codigo']) and $tipo == 4){?>
								<button type="button" class="btn btn-info" onclick="requestPage2('?br=modal_usuarios&codigo=<?=$_GET['codigo'];?>&modal=2','modals','GET');" data-toggle="modal" data-target="#modalap"><i class="fa fa-plus-circle"></i> Serviços </button>
								<!--<button type="button" class="btn btn-info" onclick="requestPage2('?br=modal_usuarios&codigo=<=$_GET['codigo'];?>&modal=3','modals','GET');" data-toggle="modal" data-target="#modalusuario"><i class="fa fa-plus-circle"></i> Permissões</button>-->
								<!--<a href="" class="btn btn-info" data-toggle="modal" data-target="#assinatura"><i class="fa fa-plus-circle"></i> Assinatura</a>-->
								<?  }   ?>
								</div></div>
								<div class="form-group col-md-3 m-t-20"><label>Situação :</label>
								<select name="situacao" id="situacao" class="form-control" style="width: 100%; height:36px;">
                                    <option>Selecionar Situação</option>
									       <option value="1" <? if("1" == $situacao){ echo "selected"; } ?>>Ativa</option>
                                           <option value="0" <? if("0" == $situacao){ echo "selected"; } ?>>Inativa</option>
                                </select>
								</div>
								<div class="form-group col-md-12 m-t-20"><label></label>
								<h4>Conta do Banco</h4>
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Banco :</label>
								<input type="texto" name="banco" id="banco" value="<? if(isset($_GET['codigo'])){ echo $banco;} ?>" class="form-control">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Agencia :</label>
								<input type="texto" name="agencia" id="agencia" value="<? if(isset($_GET['codigo'])){ echo $agencia;} ?>" class="form-control">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Conta :</label>
								<input type="texto" name="conta" id="conta" value="<? if(isset($_GET['codigo'])){ echo $conta;} ?>" class="form-control">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Tipo da Conta :</label>
								<select name="tipoconta" id="tipoconta" class="form-control" style="width: 100%; height:36px;">
                                 <option value="">Tipo Conta</option>
								   <option value="1" <? if("1" == $tipoconta){ echo "selected"; } ?>>Poupança</option>
                                   <option value="0" <? if("0" == $tipoconta){ echo "selected"; } ?>>Corrente</option>
                                </select>
								</div>
								<!--< } ?> -->
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="button" class="btn btn-info t-gravar"><i class="fa fa-plus-circle"></i> <? if(isset($_GET['codigo'])){ echo "Gravar";}else { echo "Cadastrar";} ?></button>
								<button type="button" class="btn btn-info t-novous"><i class="fa fa-plus-circle"></i> Novo</button>
								</div></div>
								
								</form>
								
							
                            </div>
                        </div>
					</div>
				</div>

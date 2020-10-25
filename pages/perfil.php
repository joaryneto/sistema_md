<?
ob_start();
session_start();

?>
<?

if($_GET['ap'] == "1")
{

  if(!Empty($_POST['nome']))
  {

	$s_nome     = $_POST['nome'];
	$s_email    = $_POST['email'];
	$s_senha    = $_POST['senha'];
	$s_telefone = $_POST['telefone'];
	$s_mensagem = $_POST['mensagem'];
	$s_foto     = $_POST['imgs'];

	if(!Empty($_POST['imgs']))
	{
		$logo2 = ",foto='".$s_foto."'";
	}
	
	//print('<script> window.alert("'.$s_foto.'")</script>');
	
    $SQL = "UPDATE internet_usuarios SET nome='".$s_nome."',email='".$s_email."',senha='".$s_senha."',telefone='".$s_telefone."',mensagem='".$s_mensagem."' $logo2 where cod_usuario='".$_SESSION['usuario']."'";
	$res = mysqli_query($db,$SQL);
	
	if($res)
	{
		print('<script> window.alert("Atualizado com sucesso...")</script>');
		print("<script>window.location.href='iniciado.php?url=perfil';</script>");
	}
	else
	{
		$sucesso = false;
	}
  }
}

?>		

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="template/assets/images/users/icon-member.png" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?=$nome?></h4>
                                    <h6 class="card-subtitle"><?=$funcao?></h6>
                                    <div class="row text-center justify-content-md-center">
                                        <!--<div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>-->
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <!--<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#inicio" role="tab">Mensagens</a> </li>-->
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#configuracao" role="tab">Configuração</a> </li>
                            </ul>
							
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane" id="inicio" role="tabpanel">
                                    <div class="card-body">
                                        <div class="profiletimeline">
										   <? 
										      $SQL = "SELECT mensagens.*, internet_usuarios.nome,internet_usuarios.foto FROM mensagens 
                                                           inner join internet_usuarios on internet_usuarios.cod_usuario=mensagens.d_usuario 
														   where mensagens.d_usuario=".$_SESSION['usuario']." or mensagens.p_usuario=".$_SESSION['usuario']." ORDER BY mensagens.codigo desc";
										      $res = mysqli_query($db,$SQL);
  										      while($row = mysqli_fetch_array($res))
											  {												 
											 ?>
                                            <div class="sl-item">
                                                <div class="sl-left"><? if(isset($row['foto'])){?><img src="<? echo $row['foto'];?>" alt="user" class="img-circle" /> 
												<? }else{?> 
												<img src="template/assets/images/users/icon-member.png" alt="user" class="img-circle">
												<? } ?> </div>
                                                <div class="sl-right">
                                                    <div><a href="#" class="link"><? echo $row['nome'];?> - <? echo $row['assunto'];?></a> <span class="sl-date"></span>
                                                        <p class="m-t-10"><? echo $row['mensagem'];?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
											<?
											 } 
											?>
                                        </div>
                                    </div>
                                </div>
<script>
function altfoto(input) 
{
  if (input.files && input.files[0]) 
  {
      var reader = new FileReader();

       reader.onload = function (e) 
	   {
          $('#foto').attr('src', e.target.result)
		  $('#imgs').attr('value', e.target.result)
		  //$('#mensagem').attr('value', e.target.result)
		  //$("textarea#mensagem").text(e.target.result)
       };

     reader.readAsDataURL(input.files[0]);
  }
}
</script>
                                <!--second tab-->
                                <div class="tab-pane active" id="configuracao" role="tabpanel">
                                    <div class="card-body">
                                        <form name="enviar" class="form-horizontal form-material" method="post" action="iniciado.php?url=perfil&ap=1">
										    <div class="form-group">
											<label class="col-md-12"></label>
											<? if(isset($foto)){ ?> 
											<label for="img" title="Click aqui">
											<img src="<? echo $foto;?>" class="img-circle" style="height: 150px;width: 150px;" id="foto" />
											</label>
											<? }else{?>
											<label for="img" title="Click aqui">
											  <img src="template/assets/images/users/icon-member.png" class="img-circle" style="height: 150px;width: 150px;" id="foto" />
											</label>
											<? } ?>
											<input type="file" id="img" name="img" accept="image/*" onchange="altfoto(this)" style="display: none;">
											<input type="text" id="imgs" name="imgs" accept="image/*" value="" onchange="altfoto(this)" style="display: none;">
											</div>
                                            <div class="form-group">
                                                <label class="col-md-12">Nome Completo</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Seu nome" name="nome" value="<?=$nome;?>" class="form-control form-control-line" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="Seu email" name="email" value="<?=$email;?>" class="form-control form-control-line" name="example-email" id="example-email" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Senha</label>
                                                <div class="col-md-12">
                                                    <input type="password" name="senha" value="<?=$senha?>" class="form-control form-control-line" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Telefone</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="(00)00000-0000" name="telefone" value="<?=$telefone;?>" class="form-control form-control-line" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Mensagem</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" name="mensagem" id="mensagem" class="form-control form-control-line" value="<?=$mensagem;?>" required="required"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success">Atualizar Perfil</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					</div>

                    <!-- Column -->
                
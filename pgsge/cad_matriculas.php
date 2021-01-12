<?
require_once("./template/vendor/phpmailer/class.phpmailer.php");
require_once("./template/vendor/phpmailer/class.smtp.php");

?>
<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu13'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$inputb['ap'] == "1")
{
	$mail = new PHPMailer();
	
	$matricula = @$inputb['matricula'];
    $nome = @$inputb['nome'];
    $cpf = @$inputb['cpf'];
	$sexo = @$inputb['sexo'];
    $txtNascimento = @$inputb['txtNascimento'];
    $endereco = @$inputb['endereco'];
    $numero = @$inputb['numero'];
    $bairro = @$inputb['bairro'];
    $cep = @$inputb['cep'];
    $complemento = @$inputb['complemento'];
    $estado = @$inputb['estado'];
    $cidade = @$inputb['cidade'];
    $ensino = @$inputb['ensino'];
    $turma = @$inputb['turma'];
    $email = @$inputb['email'];
    $nomemae = @$inputb['nomemae'];
    $cpfmae = @$inputb['cpfmae'];
    $rgmae = @$inputb['rgmae'];
    $emissormae = @$inputb['emissormae'];
    $telefonemae = @$inputb['telefonemae'];
    $celularmae = @$inputb['celularmae'];
    $localtrabmae = @$inputb['localtrabmae'];
    $nomepai = @$inputb['nomepai'];
    $cpfpai = @$inputb['cpfpai'];
    $rgpai = @$inputb['rgpai'];
    $emissorpai = @$inputb['emissorpai'];
    $telefonepai = @$inputb['telefonepai'];
    $celularpai = @$inputb['telefonepai'];
    $localtrabpai = @$inputb['localtrabpai'];
    $situacao = @$inputb['situacao'];
	
	$res = mysqli_query($db,"SELECT * FROM matriculas where sistema='".$_SESSION['sistema']."' and nome like '%".@$inputb['nome']."%'");
	$x = 0;
	while($row = mysqli_fetch_array($res))
	{
		$x = 1;
		$codigo = $row['codigo'];
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Aluno ja Matriculado!')</script>");
		//print("<script>window.location.href='iniciado.php?url=cad_matriculas&codigo=".$codigo."';</script>");
	}
	else
	{
	   
	   if(Empty($cpf))
	   {
		   if(Empty($cpfmae))
		   {
		      $cpf = $cpfmae;
		   }
		   else
		   {
			   $cpf = $cpfpai;
		   }
	   }
	   
	   $SQL1 = "INSERT INTO matriculas(sistema,matricula,nome,cpf,sexo,txtNascimento,endereco,numero,bairro,cep,complemento,estado,cidade,ensino,turma,email,nomemae,cpfmae,rgmae,emissormae,telefonemae,celularmae,localtrabmae,nomepai,cpfpai,rgpai,emissorpai,telefonepai,celularpai,localtrabpai,situacao) VALUES('".$_SESSION['sistema']."','".$_SESSION['matricula']."','".$nome."','".$cpf."','".$sexo."','".revertedata($txtNascimento)."','".$endereco."','".$numero."','".$bairro."','".$cep."','".$complemento."','".$estado."','".$cidade."','".$ensino."','".$turma."','".$email."','".$nomemae."','".$cpfmae."','".$rgmae."','".$emissormae."','".$telefonemae."','".$celularmae."','".$localtrabmae."','".$nomepai."','".$cpfpai."','".$rgpai."','".$emissorpai."','".$telefonepai."','".$celularpai."','".$localtrabpai."','".$situacao."');";
	   
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $senha = date('His');
	
	   $SQL2 = "INSERT INTO usuarios(sistema,nome,login,matricula,email,senha,tipo,status) values('".$_SESSION['sistema']."','".@$inputb['nome']."','".$_SESSION['matricula']."','".$_SESSION['matricula']."','".$email."','".$senha."',1,2)";
	   $sucesso = mysqli_query($db,$SQL2);
	   
	   if($sucesso)
	   {
	   # Define os dados do servidor e tipo de conexão
	   $mail->IsSMTP(); // Define que a mensagem será SMTP
	   $mail->Host = "smtp.ectecnologia.com.br"; # Endereço do servidor SMTP
	   $mail->Port = 587; // Porta TCP para a conexão
	   $mail->SMTPAutoTLS = true; // Utiliza TLS Automaticamente se disponível
	   $mail->SMTPAuth = true; # Usar autenticação SMTP - Sim
	   $mail->Username = 'info@ectecnologia.com.br'; # Usuário de e-mail
	   $mail->Password = '@#neto2907@#'; // # Senha do usuário de e-mail

	   # Define o remetente (você)
	   $mail->From = "info@ectecnologia.com.br"; # Seu e-mail
	   $mail->FromName = "MUNDO DO SABER"; // Seu nome

	   # Define os destinatário(s)
	   $mail->AddAddress(''.$email.'', ''.$nome.''); # Os campos podem ser substituidos por variáveis
	   //$mail->AddAddress('administrativo@hismet.com.br'); # Caso queira receber uma copia
	   #$mail->AddCC('ciclano@site.net', 'Ciclano'); # Copia
	   #$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); # Cópia Oculta

	   # Define os dados técnicos da Mensagem
	   $mail->IsHTML(true); # Define que o e-mail será enviado como HTML
	   #$mail->CharSet = 'iso-8859-1'; # Charset da mensagem (opcional)

	   # Define a mensagem (Texto e Assunto)
	   $mail->Subject = "DADOS DO ALUNO - MUNDO DO SABER"; # Assunto da mensagem

	   include('pages/email/template04.php');

	   # Define os anexos (opcional)
	   #$mail->AddAttachment("c:/temp/documento.pdf", "documento.pdf"); # Insere um anexo

	   # Envia o e-mail
	   $enviado = $mail->Send();

	   # Limpa os destinatários e os anexos
	   $mail->ClearAllRecipients();
	   $mail->ClearAttachments();
	   
	   $res = mysqli_query($db,"SELECT * FROM matriculas where sistema='".$_SESSION['sistema']."' and nome like '%".@$inputb['nome']."%'");
	   $rowx = mysqli_fetch_array($res);
	   
	   
		   print("<script>window.alert('Matricula de ".$nome." realizada com sucesso')</script>");
		   //print("<script>window.location.href='iniciado.php?url=cad_matriculas&codigo=".$rowx['codigo']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif(@$inputb['ap'] == 2)
{
	$matricula = @$inputb['matricula'];
    $nome = @$inputb['nome'];
    $cpf = @$inputb['cpf'];
	$sexo = @$inputb['sexo'];
    $txtNascimento = @$inputb['txtNascimento'];
    $endereco = @$inputb['endereco'];
    $numero = @$inputb['numero'];
    $bairro = @$inputb['bairro'];
    $cep = @$inputb['cep'];
    $complemento = @$inputb['complemento'];
    $estado = @$inputb['estado'];
    $cidade = @$inputb['cidade'];
    $ensino = @$inputb['ensino'];
    $turma = @$inputb['turma'];
    $email = @$inputb['email'];
    $nomemae = @$inputb['nomemae'];
    $cpfmae = @$inputb['cpfmae'];
    $rgmae = @$inputb['rgmae'];
    $emissormae = @$inputb['emissormae'];
    $telefonemae = @$inputb['telefonemae'];
    $celularmae = @$inputb['celularmae'];
    $localtrabmae = @$inputb['localtrabmae'];
    $nomepai = @$inputb['nomepai'];
    $cpfpai = @$inputb['cpfpai'];
    $rgpai = @$inputb['rgpai'];
    $emissorpai = @$inputb['emissorpai'];
    $telefonepai = @$inputb['telefonepai'];
    $celularpai = @$inputb['telefonepai'];
    $localtrabpai = @$inputb['localtrabpai'];
    $situacao = $_GET['situacao'];
	
	if(@$inputb['situacao'] == 2)
	{
		$situacao = 1;
	}
	else
	{
		$situacao = @$inputb['situacao'];
	}
	
    $SQL1 = "UPDATE matriculas SET nome = '".@$inputb['nome']."',cpf='".@$inputb['cpf']."',sexo = '".@$inputb['sexo']."',txtNascimento = '".revertedata(@$inputb['txtNascimento'])."',endereco = '".@$inputb['endereco']."',numero = '".@$inputb['numero']."',bairro = '".@$inputb['bairro']."',cep = '".@$inputb['cep']."',complemento = '".@$inputb['complemento']."',estado = '".@$inputb['estado']."',cidade = '".@$inputb['cidade']."',ensino = '".@$inputb['ensino']."',turma = '".@$inputb['turma']."',email = '".@$inputb['email']."',nomemae = '".@$inputb['nomemae']."',cpfmae = '".@$inputb['cpfmae']."',rgmae = '".@$inputb['rgmae']."',emissormae = '".@$inputb['emissormae']."',telefonemae = '".@$inputb['telefonemae']."',celularmae = '".@$inputb['celularmae']."',localtrabmae = '".@$inputb['localtrabmae']."',nomepai = '".@$inputb['nomepai']."',cpfpai = '".@$inputb['cpfpai']."',rgpai = '".@$inputb['rgpai']."',emissorpai = '".@$inputb['emissorpai']."',telefonepai = '".@$inputb['telefonepai']."',celularpai = '".@$inputb['telefonepai']."',localtrabpai = '".@$inputb['localtrabpai']."',status = '".$inputb['situacao']."' where sistema='".$_SESSION['sistema']."' and codigo='".@$inputb['codigo']."'";
	
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print('
		<script>
		swal({   
 			   title: "Info",   
 			   text: "Gravado com sucesso. '.$SQL1.'",   
 			   timer: 1000,   
 			   showConfirmButton: false 
 		});
		</script>');
		//print("<script>window.location.href='iniciado.php?url=cad_matriculas&codigo=".@$inputb['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
}

      $matricula = "";
       $nome = "";
	   $cpf = "";
       $sexo = "";
       $txtNascimento = "";
       $endereco = "";
       $numero = "";
       $bairro = "";
       $cep = "";
       $complemento = "";
       $estado = "";
       $cidade = "";
       $ensino = "";
       $turma = "";
       $email = "";
       $nomemae = "";
       $cpfmae = "";
       $rgmae = "";
       $emissormae = "";
       $telefonemae = "";
       $celularmae = "";
       $localtrabmae = "";
       $nomepai = "";
       $cpfpai = "";
       $rgpai = "";
       $emissorpai = "";
       $telefonepai = "";
       $celularpai = "";
       $localtrabpai = "";
       $situacao = "";
	   
if(isset($inputb['codigo']))
{
	$SQL = "SELECT * FROM matriculas where sistema='".$_SESSION['sistema']."' and codigo='".@$inputb['codigo']."'";
	$sucesso = mysqli_query($db,$SQL);
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
 
       $codigo = $row['codigo'];
       $matricula = $row['matricula'];
       $nome = $row['nome'];
	   $cpf = $row['cpf'];
       $sexo = $row['sexo'];
       $txtNascimento = $row['txtNascimento'];
       $endereco = $row['endereco'];
       $numero = $row['numero'];
       $bairro = $row['bairro'];
       $cep = $row['cep'];
       $complemento = $row['complemento'];
       $estado = $row['estado'];
       $cidade = $row['cidade'];
       $ensino = $row['ensino'];
       $turma = $row['turma'];
       $email = $row['email'];
       $nomemae = $row['nomemae'];
       $cpfmae = $row['cpfmae'];
       $rgmae = $row['rgmae'];
       $emissormae = $row['emissormae'];
       $telefonemae = $row['telefonemae'];
       $celularmae = $row['celularmae'];
       $localtrabmae = $row['localtrabmae'];
       $nomepai = $row['nomepai'];
       $cpfpai = $row['cpfpai'];
       $rgpai = $row['rgpai'];
       $emissorpai = $row['emissorpai'];
       $telefonepai = $row['telefonepai'];
       $celularpai = $row['telefonepai'];
       $localtrabpai = $row['localtrabpai'];
       $situacao = $row['status'];
	   
	   if(Empty($cpf))
	   {
		   if(Empty($cpfmae))
		   {
		      $cpf = $cpfmae;
		   }
		   else
		   {
			   $cpf = $cpfpai;
		   }
	   }
	   
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
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Matriculas de Alunos";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
		<div class="pmd-card pmd-z-depth">
					  <div class="pmd-tabs pmd-tabs-bg" style="line-height: 52px;">
						  <div class="pmd-tab-active-bar" style="width: 279px; left: 0px;"></div><ul role="tablist" class="nav nav-tabs nav-justified" style="width: 100%;">
							<li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#home-fixed" aria-expanded="true">Informações do Aluno</a></li>
							<li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="profile" href="#about-fixed" aria-expanded="false">Responsaveis</a></li>
						  </ul>
					  </div>
					  <div class="pmd-card-body">
						  <div class="tab-content">
						  	<div role="tabpanel" class="tab-pane active" id="home-fixed">
								<div class="m-t-40 row">
								<script>
								
								
								function responsavel(codigo)
								{
									$('#modalap').modal('show');
									requestPage2('?br=modal_matriculas&codigo='+ codigo +'&modal=2','modals','GET');
								}
								
								function valunos()
								{
									$('#modalap').modal('show');
									requestPage2('?br=modal_matriculas&modal=1','modals','GET');
								}
								
								$('.gravar').on('click',function()
								{	
								
								    var matricula = document.getElementById('matricula').value;
								var nome = document.getElementById('nome').value;
								var cpf = document.getElementById('cpf').value;
								var sexo = document.getElementById('sexo').value;
								var txtNascimento = document.getElementById('txtNascimento').value;
								var endereco = document.getElementById('endereco').value;
								var numero = document.getElementById('numero').value;
								var bairro = document.getElementById('bairro').value;
								var cep = document.getElementById('cep').value;
								var complemento = document.getElementById('complemento').value;
								var estado = document.getElementById('estado').value;
								var cidade = document.getElementById('cidade').value;
								var ensino = document.getElementById('ensino').value;
								var turma = document.getElementById('turma').value;
								var email = document.getElementById('email').value;
								var nomemae = document.getElementById('nomemae').value;
								var cpfmae = document.getElementById('cpfmae').value;
								var rgmae = document.getElementById('rgmae').value;
								var emissormae = document.getElementById('emissormae').value;
								var telefonemae = document.getElementById('telefonemae').value;
								var celularmae = document.getElementById('celularmae').value;
								var localtrabmae = document.getElementById('localtrabmae').value;
								var nomepai = document.getElementById('nomepai').value;
								var cpfpai = document.getElementById('cpfpai').value;
								var rgpai = document.getElementById('rgpai').value;
								var emissorpai = document.getElementById('emissorpai').value;
								var telefonepai = document.getElementById('telefonepai').value;
								var celularpai = document.getElementById('celularpai').value;
								var localtrabpai = document.getElementById('localtrabpai').value;
								var situacao = document.getElementById('situacao').value;
								
								    if(matricula == "")
								    {
								        swal({   
								            title: "Atenção",   
								            text: "Campo matricula em branco.",   
								            timer: 1000,   
								            showConfirmButton: false 
								        });
								    }
									else if(nome == "")
								    {
								        swal({   
								            title: "Atenção",   
								            text: "Campo nome em branco.",   
								            timer: 1000,   
								            showConfirmButton: false 
								        });
								    }
									else if(sexo == "")
								    {
								        swal({   
								            title: "Atenção",   
								            text: "Campo Sexo em branco.",   
								            timer: 1000,   
								            showConfirmButton: false 
								        });
								    }
									else if(txtNascimento == "")
								    {
								        swal({   
								            title: "Atenção",   
								            text: "Campo Nascimento em branco.",   
								            timer: 1000,   
								            showConfirmButton: false 
								        });
								    }
								    else
								    {
								        <? if(isset($codigo)){ ?>
										requestPage2('?br=cad_matriculas&codigo=<?=$codigo;?>&matricula='+ matricula +'&nome='+ nome +'&cpf='+ cpf +'&sexo='+ sexo +'&txtNascimento='+ txtNascimento +'&endereco='+ endereco +'&numero='+ numero +'&bairro='+ bairro +'&cep='+ cep +'&complemento='+ complemento +'&estado='+ estado +'&cidade='+ cidade +'&ensino='+ ensino +'&turma='+ turma +'&email='+ email +'&nomemae='+ nomemae +'&cpfmae='+ cpfmae +'&rgmae='+ rgmae +'&emissormae='+ emissormae +'&telefonemae='+ telefonemae +'&celularmae='+ celularmae +'&localtrabmae='+ localtrabmae +'&nomepai='+ nomepai +'&cpfpai='+ cpfpai +'&rgpai='+ rgpai +'&emissorpai='+ emissorpai +'&telefonepai='+ telefonepai +'&celularpai='+ celularpai +'&localtrabpai='+ localtrabpai +'&situacao='+ situacao +'&ap=2','conteudo','GET');
										<?}else{?>
										requestPage2('?br=cad_matriculas&matricula='+ matricula +'&nome='+ nome +'&cpf='+ cpf +'&sexo='+ sexo +'&txtNascimento='+ txtNascimento +'&endereco='+ endereco +'&numero='+ numero +'&bairro='+ bairro +'&cep='+ cep +'&complemento='+ complemento +'&estado='+ estado +'&cidade='+ cidade +'&ensino='+ ensino +'&turma='+ turma +'&email='+ email +'&nomemae='+ nomemae +'&cpfmae='+ cpfmae +'&rgmae='+ rgmae +'&emissormae='+ emissormae +'&telefonemae='+ telefonemae +'&celularmae='+ celularmae +'&localtrabmae='+ localtrabmae +'&nomepai='+ nomepai +'&cpfpai='+ cpfpai +'&rgpai='+ rgpai +'&emissorpai='+ emissorpai +'&telefonepai='+ telefonepai +'&celularpai='+ celularpai +'&localtrabpai='+ localtrabpai +'&situacao='+ situacao +'&ap=1','conteudo','GET');
										<?}?>
									}
								});
								
								$('.data').mask('00/00/0000');
								$('.cpf').mask('00000000000');
								
								</script>
								<?
								
								  if(Empty($inputb['codigo']))
								  {
								    $d = date('YdHis');
								    $matricula = $d;
								    $_SESSION['matricula'] = $matricula;
								  }
								  
								?>
						        
								<div class="form-group col-md-3 m-t-20"><label>Matricula :</label>
								<input type="text" name="matricula" id="matricula" value="<? echo $matricula; ?>" disabled class="form-control" required="required">
								<button type="button" class="btn btn-info btnadd-us" onclick="valunos();"><i class="fa fa-search"></i></button>
								</div>
								<div class="form-group col-md-12 m-t-20"><label>Nome Completo :</label>
								<input type="text" name="nome" id="nome" <? if(isset($inputb['codigo'])){ ?> value="<? echo $nome; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>CPF :</label>
								<input type="text" name="cpf" id="cpf" <? if(isset($inputb['codigo'])){ ?> value="<? echo $cpf; ?>" <? } ?> class="form-control cpf" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Sexo :</label>
								<select name="sexo" id="sexo" class="form-control" style="width: 100%; height:36px;">
                                  <option value="">Selecionar</option>
								  <option value="0" <? if($sexo == 0){ echo "selected"; } ?>>Masculino</option>
								  <option value="1" <? if($sexo == 1){ echo "selected"; } ?>>Feminino</option>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Data de Nacimento :</label>
								<input type="text" name="txtNascimento" id="txtNascimento" <? if(isset($inputb['codigo'])){ ?> value="<? echo formatodata($txtNascimento); ?>"  <? } ?> class="form-control data" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Endereço :</label>
								<input type="text" name="endereco" id="endereco" <? if(isset($inputb['codigo'])){ ?> value="<? echo $endereco; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-1 m-t-20"><label>N° :</label>
								<input type="text" name="numero" id="numero" <? if(isset($inputb['codigo'])){ ?> value="<? echo $numero; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Bairro :</label>
								<input type="text" name="bairro" id="bairro" <? if(isset($inputb['codigo'])){ ?> value="<? echo $bairro; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>CEP :</label>
								<input type="text" name="cep" id="cep" <? if(isset($inputb['codigo'])){ ?> value="<? echo $cep; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Complemento:</label>
								<input type="text" name="complemento" id="complemento" <? if(isset($inputb['codigo'])){ ?> value="<? echo $complemento; ?>"  <? } ?> class="form-control" >
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Estado :</label>
								<select name="estado" id="estado" class="form-control" onChange="javascript: ajaxLoader('?br=cad_listacidades&estado='+ this.value ,'cidades','GET');" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql = "select id_ibge,estado from estados";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['id_ibge']?>" <? if($estado == $row['id_ibge']){ echo "selected"; } ?>><? echo $row['estado']?></option>
										  <? } ?>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Cidade :</label>
								<div id="cidades">
								<select name="cidade" id="cidade"class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option></option>
									<? 
									if(!Empty($cidade))
								    {
										  $sql = "select cod_municipio,municipio from municipios";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['cod_municipio']?>" <? if($cidade == $row['cod_municipio']){ echo "selected"; } ?>><? echo $row['municipio']?></option>
									<? } } ?>
                                </select>
								</div>
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Ensino :</label>
								<select name="ensino" id="ensino" class="form-control" onChange="javascript: ajaxLoader('?br=cad_listacurso&curso='+ this.value ,'cursar','GET');"  style="width: 100%; height:36px;">
                                  <option value="">Escolher Situação</option>
								  <option value="0" <? if($ensino == 0){ echo "selected"; } ?>>Infantil</option>
								  <option value="1" <? if($ensino == 1){ echo "selected"; } ?>>Fundamental</option>
								  <option value="2" <? if($ensino == 2){ echo "selected"; } ?>>Médio</option>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Turma :</label>
								<div id="cursar">
								<select name="turma" id="turma" class="form-control" style="width: 100%; height:36px;" required="required">
                                    <option value="">Selecionar</option>
									<? 
										  $sql = "select codigo,descricao from turmas";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                           <option value="<? echo $row['codigo']?>" <? if($turma == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
										  <? } ?>
                                </select></div></div>
								<div class="form-group col-md-4 m-t-20"><label>Email :</label>
								<input type="text" name="email" id="email" <? if(isset($inputb['codigo'])){ ?> value="<? echo $email; ?>"  <? } ?> class="form-control" required="required">
								</div>								
								<div class="form-group col-md-2 m-t-20"><label>Situação :</label>
								<select name="situacao" id="situacao" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option></option>
									<option value="0" <? if($situacao == 0 ){ echo "selected"; } ?>>Inativa</option>
									<option value="1" <? if($situacao == 1 or Empty($inputb['codigo'])){ echo "selected"; } ?>>Ativa</option>
									<option value="2" <? if($situacao == 2){ echo "selected"; } ?>>Pre-Matricula</option>
                                </select></div>
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="button" class="btn btn-info gravar"><i class="fa fa-plus-circle"></i> 
								<? if(@$situacao==0 or @@$inputb['codigo'] and @$situacao==1)
								   { echo "Gravar";
							       }
								   elseif(@$situacao==2)
								   { echo "Aprovar"; }
								   else 
								   { echo "Cadastrar";} 
							       ?>
								</button>
								<button class="btn btn-info s-matriculas" type="button"><i class="fa fa-plus-circle"></i> Novo</button>
								</div></div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="about-fixed">
							    <div class="m-t-40 row">
							    <div class="form-group col-md-12 m-t-20"><h4>Informações da Mãe</h4></div>
								<div class="form-group col-md-3 m-t-20"><label>Nome Mãe :</label>
								<input type="text" name="nomemae" id="nomemae" <? if(isset($inputb['codigo'])){ ?> value="<? echo $nomemae; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>CPF :</label>
								<input type="text" name="cpfmae" id="cpfmae" <? if(isset($inputb['codigo'])){ ?> value="<? echo $cpfmae; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>RG :</label>
								<input type="text" name="rgmae" id="rgmae" <? if(isset($inputb['codigo'])){ ?> value="<? echo $rgmae ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-1 m-t-20"><label>Emissor :</label>
								<input type="text" name="emissormae" id="emissormae" <? if(isset($inputb['codigo'])){ ?> value="<? echo $emissormae ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Telefone :</label>
								<input type="text" name="telefonemae" id="telefonemae" <? if(isset($inputb['codigo'])){ ?> value="<? echo $telefonemae; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Celular :</label>
								<input type="text" name="celularmae" id="celularmae" <? if(isset($inputb['codigo'])){ ?> value="<? echo $celularmae; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-12 m-t-20"><label>Local de Trabalho Mãe :</label>
								<input type="text" name="localtrabmae" id="localtrabmae" <? if(isset($inputb['codigo'])){ ?> value="<? echo $localtrabmae; ?>"  <? } ?> class="form-control" required="required">
								</div>	
								<div class="form-group col-md-12 m-t-20"><h4>Informações do Pai</h4></div>
								<div class="form-group col-md-3 m-t-20"><label>Nome Pai :</label>
								<input type="text" name="nomepai" id="nomepai" <? if(isset($inputb['codigo'])){ ?> value="<? echo $nomepai; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>CPF :</label>
								<input type="text" name="cpfpai" id="cpfpai" <? if(isset($inputb['codigo'])){ ?> value="<? echo $cpfpai; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>RG :</label>
								<input type="text" name="rgpai" id="rgpai" <? if(isset($inputb['codigo'])){ ?> value="<? echo $rgpai; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-1 m-t-20"><label>Emissor :</label>
								<input type="text" name="emissorpai" id="emissorpai" <? if(isset($inputb['codigo'])){ ?> value="<? echo $emissorpai ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Telefone :</label>
								<input type="text" name="telefonepai" id="telefonepai" <? if(isset($inputb['codigo'])){ ?> value="<? echo $telefonepai; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Celular :</label>
								<input type="text" name="celularpai" id="celularpai" <? if(isset($inputb['codigo'])){ ?> value="<? echo $celularpai; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-12 m-t-20"><label>Local de Trabalho Pai :</label>
								<input type="text" name="localtrabpai" id="localtrabpai" <? if(isset($inputb['codigo'])){ ?> value="<? echo $localtrabpai; ?>"  <? } ?> class="form-control" required="required">
								</div>
                                <? if(!Empty($inputb['codigo'])){?>
								<div class="form-group col-md-12 m-t-20">
								<button type="button" class="btn btn-info" onclick="responsavel(<?=@@$inputb['codigo'];?>);">
								<i class="fa fa-plus-circle"></i> Responsaveis </button>
								</div>
								<?  }   ?>
								</div>
							</div>
							<!--<div role="tabpanel" class="tab-pane" id="work-fixed">
							</div>-->
						  </div>
					  </div>
					</div>

                            </div>
                        </div>
					</div>
				</div>
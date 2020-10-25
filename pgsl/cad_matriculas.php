<?
ob_start();
session_start();

require_once("phpmailer/class.phpmailer.php");
require_once("phpmailer/class.smtp.php");

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

$mail = new PHPMailer();

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}
    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
	$sexo = $_POST['sexo'];
    $txtNascimento = $_POST['txtNascimento'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $complemento = $_POST['complemento'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $ensino = $_POST['ensino'];
    $turma = $_POST['turma'];
    $email = $_POST['email'];
    $nomemae = $_POST['nomemae'];
    $cpfmae = $_POST['cpfmae'];
    $rgmae = $_POST['rgmae'];
    $emissormae = $_POST['emissormae'];
    $telefonemae = $_POST['telefonemae'];
    $celularmae = $_POST['celularmae'];
    $localtrabmae = $_POST['localtrabmae'];
    $nomepai = $_POST['nomepai'];
    $cpfpai = $_POST['cpfpai'];
    $rgpai = $_POST['rgpai'];
    $emissorpai = $_POST['emissorpai'];
    $telefonepai = $_POST['telefonepai'];
    $celularpai = $_POST['telefonepai'];
    $localtrabpai = $_POST['localtrabpai'];
    $situacao = $_POST['situacao'];
	
if(isset($_GET['codigo']))
{
	$SQL = "SELECT * FROM matriculas where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL);
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
 
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

if($_GET['ap'] == "1")
{
	$res = mysqli_query($db,"SELECT * FROM matriculas where nome like '%".$_POST['nome']."%'");
	$x = 0;
	while($row = mysqli_fetch_array($res))
	{
		$x = 1;
		$codigo = $row['codigo'];
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Aluno ja Matriculado!')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_matriculas&codigo=".$codigo."';</script>");
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
	   
	   $SQL1 = "INSERT INTO matriculas(matricula,nome,cpf,sexo,txtNascimento,endereco,numero,bairro,cep,complemento,estado,cidade,ensino,turma,email,nomemae,cpfmae,rgmae,emissormae,telefonemae,celularmae,localtrabmae,nomepai,cpfpai,rgpai,emissorpai,telefonepai,celularpai,localtrabpai,situacao) VALUES('".$_SESSION['matricula']."','".$nome."','".$cpf."','".$sexo."','".revertedata($txtNascimento)."','".$endereco."','".$numero."','".$bairro."','".$cep."','".$complemento."','".$estado."','".$cidade."','".$ensino."','".$turma."','".$email."','".$nomemae."','".$cpfmae."','".$rgmae."','".$emissormae."','".$telefonemae."','".$celularmae."','".$localtrabmae."','".$nomepai."','".$cpfpai."','".$rgpai."','".$emissorpai."','".$telefonepai."','".$celularpai."','".$localtrabpai."','".$situacao."');";
	   
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $senha = date('His');
	
	   $SQL2 = "INSERT INTO usuarios(nome,login,matricula,email,senha,tipo,status) values('".$_POST['nome']."','".$_SESSION['matricula']."','".$_SESSION['matricula']."','".$email."','".$senha."',1,2)";
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
	   
	   $res = mysqli_query($db,"SELECT * FROM matriculas where nome like '%".$_POST['nome']."%'");
	   $rowx = mysqli_fetch_array($res);
	   
	   
		   print("<script>window.alert('Matricula de ".$nome." realizada com sucesso')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_matriculas&codigo=".$rowx['codigo']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	if($_POST['situacao'] == 2)
	{
		$situacao = 1;
	}
	else
	{
		$situacao = $_POST['situacao'];
	}
	
	$SQL1 = "UPDATE matriculas SET nome = '".$_POST['nome']."',cpf='".$_POST['cpf']."',sexo = '".$_POST['sexo']."',txtNascimento = '".revertedata($_POST['txtNascimento'])."',endereco = '".$_POST['endereco']."',numero = '".$_POST['numero']."',bairro = '".$_POST['bairro']."',cep = '".$_POST['cep']."',complemento = '".$_POST['complemento']."',estado = '".$_POST['estado']."',cidade = '".$_POST['cidade']."',ensino = '".$_POST['ensino']."',turma = '".$_POST['turma']."',email = '".$_POST['email']."',nomemae = '".$_POST['nomemae']."',cpfmae = '".$_POST['cpfmae']."',rgmae = '".$_POST['rgmae']."',emissormae = '".$_POST['emissormae']."',telefonemae = '".$_POST['telefonemae']."',celularmae = '".$_POST['celularmae']."',localtrabmae = '".$_POST['localtrabmae']."',nomepai = '".$_POST['nomepai']."',cpfpai = '".$_POST['cpfpai']."',rgpai = '".$_POST['rgpai']."',emissorpai = '".$_POST['emissorpai']."',telefonepai = '".$_POST['telefonepai']."',celularpai = '".$_POST['telefonepai']."',localtrabpai = '".$_POST['localtrabpai']."',status = '".$situacao."' where codigo='".$_GET['codigo']."'";
	
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Gravado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_matriculas&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
}

?>		
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Matricular aluno";?></h4>
								<form name="laudo" class="m-t-40 row" method="post" action="<? if($_GET['codigo'] ==""){ echo "iniciado.php?url=cad_matriculas&ap=1";}else { echo "iniciado.php?url=cad_matriculas&ap=2&codigo=".$_GET['codigo']."";} ?>">
								
								<script>
								
								function orcnpj(cnp)
								{
									window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=' + cnp;					
								}
								
								function exames(codigo,exame)
								{
									window.location.href='iniciado.php?url=cad_tabelalaudador&codigo=' + codigo + "&exame=" + exame;					
								}
								
								function valores(valor)
							    {
									var x =  "<? echo $valorB; ?>"-+valor;
									$("#sub").text("Total R$ "+ x);
								}
								
								</script>
								<?
								
								  if(Empty($_GET['codigo']))
								  {
								    $d = date('YdHis');
								    $matricula = $d;
								    $_SESSION['matricula'] = $matricula;
								  }
								  
								?>
						        <? if(!Empty($_GET['codigo'])){?>
								<div class="form-group col-md-12 m-t-20">
								<a href="" class="btn btn-info" data-toggle="modal" data-target="#responsavel">
								<i class="fa fa-plus-circle"></i> Responsaveis </a>
								</div>
								<?  }   ?>
								<div class="form-group col-md-2 m-t-20"><label>Matricula :</label>
								<input type="text" name="matricula" id="matricula" value="<? echo $matricula; ?>" disabled class="form-control" required="required"><a style="position: absolute;left: 80%;" class="btn btn-info" href="#" data-toggle="modal" data-target="#alunos" ><i class="fa fa-search"></i></a>
								</div>
								<div class="form-group col-md-6 m-t-20"><label>Nome :</label>
								<input type="text" name="nome" id="nome" <? if(isset($_GET['codigo'])){ ?> value="<? echo $nome; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-6 m-t-20"><label>CPF :</label>
								<input type="text" name="cpf" id="cpf" <? if(isset($_GET['codigo'])){ ?> value="<? echo $cpf; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Sexo :</label>
								<select name="sexo" class="form-control" style="width: 100%; height:36px;">
                                  <option value="">Selecionar</option>
								  <option value="0" <? if($sexo == 0){ echo "selected"; } ?>>Masculino</option>
								  <option value="1" <? if($sexo == 1){ echo "selected"; } ?>>Feminino</option>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Data de Nacimento :</label>
								<input type="text" name="txtNascimento" id="txtNascimento" <? if(isset($_GET['codigo'])){ ?> value="<? echo formatodatahora($txtNascimento); ?>"  <? } ?> class="form-control" data-mask="99/99/9999" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Endereço :</label>
								<input type="text" name="endereco" id="endereco" <? if(isset($_GET['codigo'])){ ?> value="<? echo $endereco; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-1 m-t-20"><label>N° :</label>
								<input type="text" name="numero" id="numero" <? if(isset($_GET['codigo'])){ ?> value="<? echo $numero; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Bairro :</label>
								<input type="text" name="bairro" id="bairro" <? if(isset($_GET['codigo'])){ ?> value="<? echo $bairro; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>CEP :</label>
								<input type="text" name="cep" id="cep" <? if(isset($_GET['codigo'])){ ?> value="<? echo $cep; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Complemento:</label>
								<input type="text" name="complemento" id="complemento" <? if(isset($_GET['codigo'])){ ?> value="<? echo $complemento; ?>"  <? } ?> class="form-control" >
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Estado :</label>
								<select name="estado" class="form-control" onChange="javascript: ajaxLoader('?br=cad_listacidades&estado='+ this.value ,'cidades','GET');" style="width: 100%; height:36px;" required="required">
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
								<select name="ensino" class="form-control" onChange="javascript: ajaxLoader('?br=cad_listacurso&curso='+ this.value ,'cursar','GET');"  style="width: 100%; height:36px;">
                                  <option></option>
								  <option value="0" <? if($ensino == 0){ echo "selected"; } ?>>Infantil</option>
								  <option value="1" <? if($ensino == 1){ echo "selected"; } ?>>Fundamental</option>
								  <option value="2" <? if($ensino == 2){ echo "selected"; } ?>>Médio</option>
                                </select></div>
								<div class="form-group col-md-2 m-t-20"><label>Turma :</label>
								<div id="cursar">
								<select name="turma" class="form-control" style="width: 100%; height:36px;" required="required">
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
								<input type="text" name="email" id="email" <? if(isset($_GET['codigo'])){ ?> value="<? echo $email; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Nome Mãe :</label>
								<input type="text" name="nomemae" id="nomemae" <? if(isset($_GET['codigo'])){ ?> value="<? echo $nomemae; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>CPF :</label>
								<input type="text" name="cpfmae" id="cpfmae" <? if(isset($_GET['codigo'])){ ?> value="<? echo $cpfmae; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>RG :</label>
								<input type="text" name="rgmae" id="rgmae" <? if(isset($_GET['codigo'])){ ?> value="<? echo $rgmae ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-1 m-t-20"><label>Emissor :</label>
								<input type="text" name="emissormae" id="emissormae" <? if(isset($_GET['codigo'])){ ?> value="<? echo $emissormae ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Telefone :</label>
								<input type="text" name="telefonemae" id="telefonemae" <? if(isset($_GET['codigo'])){ ?> value="<? echo $telefonemae; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Celular :</label>
								<input type="text" name="celularmae" id="celularmae" <? if(isset($_GET['codigo'])){ ?> value="<? echo $celularmae; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-12 m-t-20"><label>Local de Trabalho Mãe :</label>
								<input type="text" name="localtrabmae" id="localtrabmae" <? if(isset($_GET['codigo'])){ ?> value="<? echo $localtrabmae; ?>"  <? } ?> class="form-control" required="required">
								</div>	
								<div class="form-group col-md-3 m-t-20"><label>Nome Pai :</label>
								<input type="text" name="nomepai" id="nomepai" <? if(isset($_GET['codigo'])){ ?> value="<? echo $nomepai; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>CPF :</label>
								<input type="text" name="cpfpai" id="cpfpai" <? if(isset($_GET['codigo'])){ ?> value="<? echo $cpfpai; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>RG :</label>
								<input type="text" name="rgpai" id="rgpai" <? if(isset($_GET['codigo'])){ ?> value="<? echo $rgpai; ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-1 m-t-20"><label>Emissor :</label>
								<input type="text" name="emissorpai" id="emissorpai" <? if(isset($_GET['codigo'])){ ?> value="<? echo $emissorpai ?>" <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Telefone :</label>
								<input type="text" name="telefonepai" id="telefonepai" <? if(isset($_GET['codigo'])){ ?> value="<? echo $telefonepai; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Celular :</label>
								<input type="text" name="celularpai" id="celularpai" <? if(isset($_GET['codigo'])){ ?> value="<? echo $celularpai; ?>"  <? } ?> class="form-control" required="required">
								</div>
								<div class="form-group col-md-12 m-t-20"><label>Local de Trabalho Pai :</label>
								<input type="text" name="localtrabpai" id="localtrabpai" <? if(isset($_GET['codigo'])){ ?> value="<? echo $localtrabpai; ?>"  <? } ?> class="form-control" required="required">
								</div>									
								<div class="form-group col-md-2 m-t-20"><label>Situação :</label>
								<select name="situacao" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option></option>
									<option value="0" <? if($situacao == 0 ){ echo "selected"; } ?>>Inativa</option>
									<option value="1" <? if($situacao == 1 or Empty($_GET['codigo'])){ echo "selected"; } ?>>Ativa</option>
									<option value="2" <? if($situacao == 2){ echo "selected"; } ?>>Pre-Matricula</option>
                                </select></div>
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> 
								<? if($situacao==0 or $_GET['codigo'] and $situacao==1)
								   { echo "Gravar";
							       }
								   elseif($situacao==2)
								   { echo "Aprovar"; }
								   else 
								   { echo "Cadastrar";} 
							       ?>
								</button>
								<a class="btn btn-info" href="iniciado.php?url=cad_matriculas"><i class="fa fa-plus-circle"></i> Novo Cadastro</a>
								</div></div>
								</form>
								
                                <div id="alunos" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Lista de Alunos : </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="form-group"><label>Pesquisar :</label>
                                             <input name="user" type="text" class="form-control" onkeyup="javascript: ajaxLoader('?br=cad_listadealunos&pesquisa='+ this.value +'&ap=1','listaralunos','GET');" />
											</div>
											<div class="table-responsive m-t-40" id="listaralunos">
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
							    <div id="responsavel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Responsaveis : </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											
											<div class="form-group col-md-5 m-t-20"><label>Nome :</label>
											<input type="text" name="rnome" id="rnome" class="form-control" required="required">
											</div>
											<div class="form-group col-md-2 m-t-20"><label>CPF :</label>
											<input type="text" name="rcpf" id="rcpf" class="form-control" required="required">
											</div>
											<div class="form-group col-md-2 m-t-20"><label>RG :</label>
											<input type="text" name="rrg" id="rrg" class="form-control" required="required">
											</div>
											<div class="form-group col-md-2 m-t-20"><label>Telefone :</label>
											<input type="text" name="rtelefone" id="rtelefone" class="form-control" required="required">
											</div>
											<div class="form-group col-md-5 m-t-20"><label>Parentesco :</label>
											<input type="text" name="parentesco" id="parentesco" class="form-control" required="required">
											</div>
											<div class="form-group col-md-5 m-t-20"><label>Autorização para buscar :</label>
											<select class="form-control" name="autorizacao" id="autorizacao" required="required">
											     <option value="">Selecionar</option>
      											 <option value="0">NÃO</option>
     											 <option value="1">SIM</option>
											</select>
											</div>
											<div class="form-group col-md-2 m-t-20">
											<br>
											<div class="form-actions">
											<a class="btn btn-info" href="javascript: WEB(0);" Onclick="javascript: ajaxLoader('?br=cad_listaresponsavel&codigo=<? echo $_GET['codigo'];?>&nome='+ document.getElementById('rnome').value +'&cpf='+ document.getElementById('rcpf').value +'&rg='+ document.getElementById('rrg').value +'&telefone='+ document.getElementById('rtelefone').value +'&parentesco='+ document.getElementById('parentesco').value +'&autorizacao='+ document.getElementById('autorizacao').value +'&ap=1&list=1','ltresponsavel','GET');"><i class="fa fa-plus-circle"></i> Adicionar </a>
											</div></div>
											<div class="col-12">
											<div class="table-responsive m-t-40" id="ltresponsavel">
											<table class="display nowrap table table-hover table-striped table-bordered">
                                            <thead>
                                               <tr>
                                                <th>Responsavel</th>
                                                <th>Aluno</th>
												<th>X</th>
                                               </tr>
                                             </thead>
                                            <tbody>
											<? 
											  $SQL = "SELECT responsavel.codigo,responsavel.nome as resp,matriculas.nome as aluno FROM responsavel inner join matriculas on matriculas.codigo=responsavel.matricula where responsavel.matricula='".$_GET['codigo']."'"; 
											  $RESB = mysqli_query($db,$SQL);
											  $b = 0;
											  while($rowb = mysqli_fetch_array($RESB))
											  {
												  
											?>
											   <tr>
                                                <td><? echo $rowb['resp'];?></td>
                                                <td><? echo $rowb['aluno'];?></td>
												<td><a class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir" style="font-size: 150%; color: red;" href="javascript: WEB(0);" Onclick="javascript: ajaxLoader('?br=cad_listaresponsavel&codigo=<? echo $_GET['codigo'];?>&codres=<? echo $rowb['codigo'];?>&excluir=1&list=1','ltresponsavel','GET');"><a></td>
                                            </tr>
											       
											<? $b = 1; }
  											?>
											<?
											if($b == 0)
											{
												echo "<tr>
   											       <td>Nenhum encontrado</td>
   											       <td>.</td>
													  <td>.</td>
   											         </tr>";
											}
											?>
										    </tbody>
                                             <tfoot>
                                               <tr>
                                                <th>Responsavel</th>
                                                <th>Aluno</th>
												<!--<th>Valor Total</th>-->
												<th>X</th>
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
                            </div>
                        </div>
					</div>
				</div>
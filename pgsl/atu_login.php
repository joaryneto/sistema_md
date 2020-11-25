<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$login = @$inputb['login'];
$senha = @$inputb['senha'];

/*function gerarprotocolo()
{
    global $protocolo ;
    $characters = '0123456789';
    $protocolo = '';
    for ($i = 0; $i < 5; $i++) {
        $protocolo .= $characters[rand(0, strlen($characters))];
    }
    return $protocolo;
}

if(@$inputb['ap'] == 1)
{
  
  require_once("./template/vendor/phpmailer/class.phpmailer.php");
  require_once("./template/vendor/phpmailer/class.smtp.php");
  
  $mail = new PHPMailer();

  $email = $inputb['email'];
  $b1 = mysqli_query($db3,"SELECT email, senha ,nome FROM usuarios where email='".$email."'");
  $b2 = mysqli_fetch_array($b1);
 
  if($b2) 
  {
	gerarprotocolo();
	
	echo $SQL = "UPDATE usuarios SET protocolo_recovery='".$protocolo."' where email='".$email."'";
	
	$b3 = mysqli_query($db3,$SQL); 

	if($b3)
	{
	   $nome = $b2['nome'];
	   $senha = $b2['senha'];
	   
	   
	   
	   # Define os dados do servidor e tipo de conexão
	   $mail->IsSMTP(); // Define que a mensagem será SMTP
	   $mail->Host = "smtp.umbler.com"; # Endereço do servidor SMTP
	   $mail->Port = 587; // Porta TCP para a conexão
	   $mail->SMTPAutoTLS = true; // Utiliza TLS Automaticamente se disponível
	   $mail->SMTPAuth = true; # Usar autenticação SMTP - Sim
	   $mail->Username = 'recovery@app.ectecnologia.com.br'; # Usuário de e-mail
	   $mail->Password = 'u@SR+nXR+55'; // # Senha do usuário de e-mail

	   # Define o remetente (você)
	   $mail->From = "recovery@app.ectecnologia.com.br"; # Seu e-mail
	   $mail->FromName = "EC TECNOLOGIA"; // Seu nome

	   # Define os destinatário(s)
	   $mail->AddAddress(''.$b2['email'].'', ''.$b2['nome'].''); # Os campos podem ser substituidos por variáveis
	   //$mail->AddAddress('administrativo@hismet.com.br'); # Caso queira receber uma copia
	   #$mail->AddCC('ciclano@site.net', 'Ciclano'); # Copia
	   #$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); # Cópia Oculta

	   # Define os dados técnicos da Mensagem
	   $mail->IsHTML(true); # Define que o e-mail será enviado como HTML
	   #$mail->CharSet = 'iso-8859-1'; # Charset da mensagem (opcional)

	   # Define a mensagem (Texto e Assunto)
	   $mail->Subject = "RECUPERA��O DE SENHA - EC TECNOLOGIA"; # Assunto da mensagem

	   include('./load/email/recuperar.php');

	   # Define os anexos (opcional)
	   #$mail->AddAttachment("c:/temp/documento.pdf", "documento.pdf"); # Insere um anexo

	   # Envia o e-mail
	   $enviado = $mail->Send();

	   # Limpa os destinatários e os anexos
	   $mail->ClearAllRecipients();
	   $mail->ClearAttachments();
		
	   print "<script> swal('Atenção', 'Acesse seu email para confirmar recuperação.'); </script>";
		
	}
	else
	{
		print "<script> swal('Atenção', 'Ocorreu um erro, tente novamente.'); </script>";
	}
  }
}
else
{
*/
    $x = 0;
    $SQL = "select usuarios.sistema,usuarios.codigo,usuarios.nome,usuarios.tipo from usuarios where usuarios.cpf='".$login."' and usuarios.senha='".$senha."' or usuarios.email='".$login."' and usuarios.senha='".$senha."' or usuarios.login='".$login."' and usuarios.senha='".$senha."'";
    $ress = mysqli_query($db3,$SQL);

    while($res = @mysqli_fetch_array($ress))
    {
     	//echo 'Logado com sucesso...';
	
	    $x = 1;
        $_SESSION['usuario'] = $res['codigo'];
		$_SESSION['login'] = $login;
	    $_SESSION['sistema'] = $res['sistema'];
	    $_SESSION['nome'] = $res['nome'];
	    $_SESSION['permissao'] = $res['tipo'];
	
	    $_SESSION['menu'] = 3;
	    $_SESSION['pages'] = 3;
		
  }


  if($x == 1)
  {
	 print "<script> window.location='sistema.php?url=inicio'; </script>"; 
  }
  else
  {
	  
	$_SESSION['usuario'] = "";
	$_SESSION['login'] = "";
	$_SESSION['sistema'] = "";
	$_SESSION['nome'] = "";
	$_SESSION['permissao'] = "";
		
	print "<script> swal('t', 'Login ou senha invalido.'); </script>";
    //print "<script> window.location='login.php'; </script>";
  }
//}
?>
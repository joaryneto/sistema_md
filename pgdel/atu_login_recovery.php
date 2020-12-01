<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$login = @$inputb['login'];
$senha = @$inputb['senha'];

function gerarprotocolo()
{
    global $protocolo ;
    $characters = '0123456789';
    $protocolo = '';
    for ($i = 0; $i < 5; $i++) {
        $protocolo .= $characters[rand(0, strlen($characters))];
    }
    return $protocolo;
}

if(@$inputb['recovery'] == "true")
{
  
  require_once("./template/vendor/phpmailer/class.phpmailer.php");
  require_once("./template/vendor/phpmailer/class.smtp.php");
  
  $mail = new PHPMailer();

  $email = $inputb['email'];
  
  
  if(!isset($email))
  {
	  print("<script>swal('Atenção', 'Campo email em branco.');</script>");
  }
  else
  {
  
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
}
?>
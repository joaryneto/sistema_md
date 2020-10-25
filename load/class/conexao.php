<?
session_start();
//ini_set("display_errors",false);

  //executa a conexão com a base de dados
    

	$dbname_bd="villesistemas13"; // Indique o nome do banco de dados que será aberto
	$usuario_bd="villesistemas13"; // Indique o nome do usuário que tem acesso
	$password_bd="hismet2015"; // Indique a senha do usuário
				
				if(!$db = mysqli_connect("192.168.1.252",$usuario_bd,$password_bd))
				{
?>
<script>
window.location='manutencao.php';
</script>
<?				
				}
				else
				{				
				//mysql_select_db($dbname_bd,$db);
				//mysqli_set_charset( $db, 'utf8');
				@mysqli_select_db($db, $dbname_bd);
				@mysqli_set_charset($db,'UTF8');
				}
			
				//fim da conexão com a base de dados
				
			
				
?>

<?php
    //O tipo de caracteres a ser usado
    //header('Content-Type: text/html; charset=utf-8');

   //Depois da tua conexão a base de dados insere o seguinte código abaixo.
   //Esta parte vai resolver o teu problema!
    //@mysqli_query($db,"SET NAMES 'latin1'");
    //@mysqli_query($db,'SET character_set_connection=latin1');
    //@mysqli_query($db,'SET character_set_client=latin1');
    //@mysqli_query($db,'SET character_set_results=latin1');
?>
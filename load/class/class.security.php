<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

// by xamaee fodao :D
class security {	
	function strings_invalidas($str) {
    	$str2 = $str;
		$str = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$str);
		$str = @str_replace(addslashes("'"), "", $str);
		$str = @str_replace(addslashes("\""), "", $str);
		$str = @str_replace("/[^a-z0-9]+/i", "", $str);
		//$str = @str_replace("--dbs", "", $str);
		//$str = @str_replace(array('.', '/'), "", $str);
		//$str = @str_replace("'", "", $str);
		//$str = @str_replace("\"", "", $str);
		//$str = @str_replace("\\", "", $str);
		//$str = @str_replace(":", "", $str);
		$str = @str_replace("--", "", $str);
		//$str = @str_replace(";", "", $str);
		$str = @str_replace("\$", "", $str);
		$str = @str_replace("gif.php", "", $str);
		$str = @str_replace("jpg.php", "", $str);
		$str = @str_replace("png.php", "", $str);
		$str = @str_replace("*/*", "", $str);
		$str = @str_replace("1'", "", $str);
		$str = @str_replace("-u", "", $str);
		$str = @str_replace("$", "", $str);
		$str = @str_replace("#", "", $str);
		$str = @str_replace("(", "", $str);
		$str = @str_replace(")", "", $str);
		$str = @str_replace("=", "", $str);
		$str = @str_replace(";", "", $str);
		$str = @str_replace("'' OR 1", "", $str);
		$str = @str_replace("''", "", $str);
		$str = @str_replace("OR 1", "", $str);
		$str = @str_replace("OR", "", $str);
		$str = @str_replace("'1'", "", $str);
		$str = @str_replace("1'1'", "", $str);
		$str = @str_replace("/*", "", $str);
		$str = @str_replace("*", "", $str);
		$str = @str_replace("'", "", $str);
		$str = @str_replace("'", "", $str);
		$str = @str_replace("html", "", $str);
		$str = @str_replace("sql", "", $str);
		$str = @str_replace("http", "", $str);
		if($str2 <> $str) {
			security::registrar_tentativa();
			}
	return	$str;
	}
   function ReversoInject( $obj ) 
   {
   $obj = preg_replace("/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|*|--|\\)/i", "", $obj);
   $obj = trim($obj);
   $obj = strip_tags($obj);
   if(!get_magic_quotes_gpc()) {
      $obj = addslashes($obj);
      return $obj;
   }
   }
   function StringsInject($sql) 
   {
    $sql = get_magic_quotes_gpc() == 0 ? addslashes($sql) : $sql;
    $sql = trim($sql);
    $sql = strip_tags($sql);
    $sql = mysql_escape_string($sql);
   return preg_replace("@(�|#|*|;|=)@s", "", $sql);
   }
   function registrar_tentativa() {
		$data = date("d/m/Y G:i");
		$navegador = $_SERVER['HTTP_USER_AGENT'];
		$solicitada = $_SERVER['REQUEST_URI'];
		$metodo = $_SERVER['REQUEST_METHOD'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$ses = $_SESSION['ses_login'] == false ? "N�o Logado " : $_SESSION['ses_login'];
		$log = " Login: {$ses} ";
		$log.= "IP: {$ip} \r\n ";
		$log.= "IP Reverso: {$host} \r\n ";
		$log.= "Data: {$data} \r\n ";
		$log.= "Navegador: {$navegador} \r\n ";
		$log.= "Pagina: {$solicitada} \r\n ";
		$log.= "Metodo: {$metodo} \r\n\r\n ";
		$log.= "--------------------\r\n\r\n";

		$fp = fopen("modules/logs/security_logs.txt", "a");
		fwrite($fp, $log);
		fclose($fp);
	}
	function checar_strings($str) {
		if (is_array($str)) {
        	foreach($str as	$id	=> $value) 
		{
            $str[$id] = security::checar_strings($value);
        }
    } else
        $str = security::strings_invalidas($str);
		return $str;
	}
}	
	

// M�todo url
$metodo = array_keys($_GET);
$i=0;
while($i < count($metodo)) {
    $_GET[ $metodo[$i]] = security::checar_strings($_GET[$metodo[$i]]);
    $i++;
}
unset($metodo); // apaga os dados da variavel $metodo
unset($i);	//	apaga a contagem
	
// M�todo formul�rio
$metodo = array_keys($_POST);
$i=0;
while($i < count($metodo))
{
    $_POST[$metodo[$i]] = security::checar_strings($_POST[$metodo[$i]]);
    $i++;
}
?>
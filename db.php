<?php 
// Dados da conexão com o banco de dados
define('SERVER', 'robb0478.publiccloud.com.br');
define('DBNAME', 'netinhobr_g148');
define('USER', 'netin_g148');
define('PASSWORD', 'zIa7j06!');

// Recebe os parâmetros enviados via GET
$acao = (isset($_GET['acao'])) ? $_GET['acao'] : '';
$parametro = (isset($_GET['parametro'])) ? $_GET['parametro'] : '';

// Configura uma conexão com o banco de dados
$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
$conexao = new PDO("mysql:host=".SERVER."; dbname=".DBNAME, USER, PASSWORD, $opcoes);



	//$where = (!empty($parametro)) ? 'WHERE cpf LIKE ? LIMIT 1' : '';
	//$sql = "SELECT cpf,nome,DATE_FORMAT(nascimento, '%d/%m/%Y') As nascimento FROM pessoas " . $where;
	$sql = "SELECT id,regiao,comentario,imagem,Latitude,Longitude FROM teste ";

	$stm = $conexao->prepare($sql);
	$stm->bindValue(1, '%'.$parametro.'%');
	$stm->execute();
	$dados = $stm->fetchAll(PDO::FETCH_OBJ);

	$json = json_encode($dados);
	echo $json;

?>
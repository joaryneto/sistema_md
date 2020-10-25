<?
  
  class dbControle {

				//função de leitura
				function begin($db){
    				$res = @mysqli_query($db,"SET autocommit=0");
					$res = @mysqli_query($db,"START TRANSACTION");
					//$res = @mysql_query("BEGIN",$db);
					return $res;
				}

				function commit($db){
    				$res = @mysqli_query($db,"COMMIT");
					return $res;
				}
				
				function roolback($db){
    				$res = @mysqli_query($db,"ROLLBACK");
					return $res;
				}				

				//função de leitura
				function lerdbFuncao($db,$instrucao){
				    $sql = "$instrucao";
    				$res = @mysqli_query($db,$sql);
					return $res;
				}
				//fim da função de leitura
   				
				//função de leitura
				function lerdb($db, $campos, $tabelas, $instrucao){
				    $sql = "SELECT $campos FROM $tabelas $instrucao";
    				$res = @mysqli_query($db,$sql);
					return $res;
				}
				//fim da função de leitura
				
				//função de inserção
			  	function inserir($db, $tabelas, $campos, $valores) {
              		$sql = "INSERT INTO $tabelas ($campos) VALUES ($valores)";
              		$res = @mysqli_query($db,$sql);
			   		return $res;
			 	}
				//fim da função de inserção

				//função close db
			 function FecharDB($result) {
             $rclose = @mysqli_query($result);
             return $rclose;
        		}
				//fim da função
				
				//função de exclusão
			  function apagar($tabelas, $chave, $db) {
              $sql = "DELETE FROM $tabelas WHERE $chave";
              $ret = mysqli_query($db,$sql);
			  return $ret;	  
			  }
				//fim da função de exclusão
				
				//função de atualização
			  function atualiza($db, $tabelas, $campos, $chave) {
              $sql = "UPDATE $tabelas SET $campos WHERE $chave";
              $ret = @mysqli_query($db,$sql);
			  return $ret;	  
		      }
				//fim da função
}		


?>
<?php 

//require_once("pages/gerar_xml.php");

function gerar_xml($codigoLaudo, $instrucaoXML){
	
	$dom = new DOMDocument("1.0", "ISO-8859-1");
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$root = $dom->createElement("dados");
	$instrucaoIntXml = $dom->createElement("sql", utf8_encode($instrucaoXML));
	$root->appendChild($instrucaoIntXml);
	$dom->appendChild($root);
	$outXML = $dom->save("./xml/".$codigoLaudo.".xml");
	//header("Content-Type: text/xml");
	//print $dom->saveXML();
	
	return $outXML;
	

}

$SQL_res = "SELECT * FROM laudos_enviados where exportado = 1 and codigo = ".$_GET['codigo']." order by codigo asc";
$res_exp = mysqli_query($db,$SQL_res);
while ($row_exp = mysqli_fetch_array($res_exp)) 
{
	print("<script>window.alert('PASSO 2')</script>");
	
	$instrucaoPronta="";
	$instrucaoPronta = "insert into laudos_enviados(codigo, protocolo, empresa, cpf, paciente, dataenvio, status, laudador, datainiciolaudo, dataterminolaudo, tipolaudo, solicitantelaudo, valor_laudador, valor_empresa, desconto_empresa, cpf_laudador)values('".$row_exp['codigo']."','".$row_exp['protocolo']."','".$row_exp['empresa']."','".retiraacentos($row_exp['rg'])."','".$row_exp['paciente']."','".$row_exp['dataenvio']."','".$row_exp['status']."','".$row_exp['laudador']."','".$row_exp['datainiciolaudo']."','".$row_exp['dataterminolaudo']."','".$row_exp['tipolaudo']."','".$row_exp['solicitantelaudo']."','".$row_exp['valor_laudador']."','".$row_exp['valor_empresa']."','".$row_exp['desconto_empresa']."','".$row_exp['cpf_laudador']."');";
		
	$tamanho=gerar_xml($row_exp['codigo'],$instrucaoPronta);
				
	if(file_exists("./xml/".$row['codigo'].".xml"))
	{			
		    $xml = simplexml_load_file("./xml/".$row['codigo'].".xml");			
			if(!empty($xml->sql))
			{ 									
				//$class->begin($db);
				//$tab_exp = "laudos_enviados";		
				//$chave_exp = "codigo = ".$row['codigo'];
				//$campos_exp = "exportado = 0";
				//$atualizacao = $class->atualiza($db, $tab_exp, $campos_exp, $chave_exp);					
				//$class ->commit($db);		
				
				$SQL_a = "UPDATE laudos_enviados SET exportado = 0 where codigo = ".$row['codigo']."";
				mysqli_query($db,$SQL_a);
			}			   
   		}						   
}
?>
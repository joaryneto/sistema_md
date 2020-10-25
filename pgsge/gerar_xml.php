<?php

//echo gerar_xml("1252","select * from laudos_enviados");

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

?>

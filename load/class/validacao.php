<?

#===================================================================================== 
# Autor: Marcello R. Gonçalves 
# E-mail: marcellorg@yahoo.com.br 
# Site: http://www.gracaamorevida.com.br 
# Data: 24/11/2004 
# MS VALIDATE 
# Versão: 1.0 
# Licença: GNU 
# "DEUS NÃO ESCOLHE OS CAPACITADOS, E SIM CAPACITA OS ESCOLHIDOS" 
#==================================================================================== 

function vazio($data){
$data=trim($data);
if(!empty($data)){
	return false;
	}else{
	return true;
	}

}

function validaTel($numero){
if(stripos($numero, "(") !="" or stripos($numero, ")") !=""){return false;}
if(strlen($numero)<10 or strlen($numero)>10){return false;}
if(stripos($numero, "-") !=""){return false;}

 	else{
	
	return true;
	
	}
}

function validaHora($time)
{
   list($hour,$minute) = explode(':',$time);
 
   if ($hour > -1 && $hour < 24 && $minute > -1 && $minute < 60)
   {
      return true;
   }else{
   
     return false;
	 
   }
} 


function valData($Data) 
{ 

	if(strlen($Data)==10){

	list($Dia,$Mes,$Ano)= preg_split ('[/.-]', $Data, 3); 
	return @checkdate ( $Mes, $Dia, $Ano); 
	
	}else{
	
		return false;
	
	}
} 

function valFundacao($Data) 
{ 

	if(strlen($Data)==7){

		$Data= preg_split ('/', $Data); 
	
			if(count($Data)!=2){return false;}
			if($Data[0]>12){return false;}
			if(strlen($Data[1])<4 or strlen($Data[1])>4){return false;}
			if($Data[1]<1800){return false;}
			else
			
			{ return true; }	
			
	}
} 

function valData2($Data) 
{ 
 
  if (isdate ) 
  { 
     return TRUE; 
  } 
  
  return FALSE; 
}

function validaCep($Data) 
{ 
 if(strlen($Data)==9){
  { 
     return TRUE; 
  } 
  
  return FALSE; 
  
  }
} 


function valNumero($Numero) 
{ 
return preg_match ("/^([0-9]+)$/", $Numero); 
} 

function valEmail($email) 
{ 
eregi("^([0-9a-zA-Z]+)([0-9a-zA-Z.,_-]+)*[@]([0-9a-zA-Z]+)([.]([0-9a-zA-Z]+))*[.]([0-9a-zA-Z]){2}([0-9a-zA-Z])?$",$email,$match); 
//Divide os valores dos casamentos da ER e separa em variáveis, $email_comp é o email completo para você verificar, portanto se a variável $email_comp for igual a $email o e-mail será válido 
list($email_comp,$login,$domain,$sufixies) = $match; 
//Inicia a verificação do email, conforme dito, se $email_comp for igual a $email, o email será válido 

if ($email_comp == $email) 
{ 
return TRUE; 
/** Instruções caso o e-mail seja válido aqui **/ 
}else{ 
return FALSE; 
/** Instruções caso o e-mail seja INválido aqui **/ 
} 
} 

#--------------------------------------------------------------------------------------------------------------------------------------------- 

//Validar CPF 
function valCpf($Cpf) 
{ 
$RecebeCPF=$Cpf; 
//Retirar todos os caracteres que não sejam 0-9 
$s=""; 
for ($x=1; $x<=strlen($RecebeCPF); $x=$x+1) 
{ 
$ch=substr($RecebeCPF,$x-1,1); 
if (ord($ch)>=48 && ord($ch)<=57) 
{ 
$s=$s.$ch; 
} 
} 

$RecebeCPF=$s; 
if ($RecebeCPF=="00000000000" or strlen($RecebeCPF)<11) 
{ 
$then; 
return FALSE; 
}else{ 
$Numero[1]=intval(substr($RecebeCPF,1-1,1)); 
$Numero[2]=intval(substr($RecebeCPF,2-1,1)); 
$Numero[3]=intval(substr($RecebeCPF,3-1,1)); 
$Numero[4]=intval(substr($RecebeCPF,4-1,1)); 
$Numero[5]=intval(substr($RecebeCPF,5-1,1)); 
$Numero[6]=intval(substr($RecebeCPF,6-1,1)); 
$Numero[7]=intval(substr($RecebeCPF,7-1,1)); 
$Numero[8]=intval(substr($RecebeCPF,8-1,1)); 
$Numero[9]=intval(substr($RecebeCPF,9-1,1)); 
$Numero[10]=intval(substr($RecebeCPF,10-1,1)); 
$Numero[11]=intval(substr($RecebeCPF,11-1,1)); 

$soma=10*$Numero[1]+9*$Numero[2]+8*$Numero[3]+7*$Numero[4]+6*$Numero[5]+5* 
$Numero[6]+4*$Numero[7]+3*$Numero[8]+2*$Numero[9]; 
$soma=$soma-(11*(intval($soma/11))); 

if ($soma==0 || $soma==1) 
{ 
$resultado1=0; 
} 
else 
{ 
$resultado1=11-$soma; 
} 

if ($resultado1==$Numero[10]) 
{ 
$soma=$Numero[1]*11+$Numero[2]*10+$Numero[3]*9+$Numero[4]*8+$Numero[5]*7+$Numero[6]*6+$Numero[7]*5+ 
$Numero[8]*4+$Numero[9]*3+$Numero[10]*2; 
$soma=$soma-(11*(intval($soma/11))); 

if ($soma==0 || $soma==1) 
{ 
$resultado2=0; 
}else{ 
$resultado2=11-$soma; 
} 

if ($resultado2==$Numero[11]) 
{ 
return TRUE; 
}else{ 
return FALSE; 
} 
}else{ 
return FALSE; 
} 
} 
}// Fim do validar CPF 

#--------------------------------------------------------------------------------------------------------------------------------------------- 

//Validar Cnpj 
function valCnpj($Cnpj) 
{ 
$RecebeCNPJ=${"Cnpj"}; 
$s=""; 
for ($x=1; $x<=strlen($RecebeCNPJ); $x=$x+1) 
{ 
$ch=substr($RecebeCNPJ,$x-1,1); 
if (ord($ch)>=48 && ord($ch)<=57) 
{ 
$s=$s.$ch; 
} 
} 

$RecebeCNPJ=$s; 
if ($RecebeCNPJ=="00000000000000") 
{ 
$then; 
return FALSE; 
}else{ 
$Numero[1]=intval(substr($RecebeCNPJ,1-1,1)); 
$Numero[2]=intval(substr($RecebeCNPJ,2-1,1)); 
$Numero[3]=intval(substr($RecebeCNPJ,3-1,1)); 
$Numero[4]=intval(substr($RecebeCNPJ,4-1,1)); 
$Numero[5]=intval(substr($RecebeCNPJ,5-1,1)); 
$Numero[6]=intval(substr($RecebeCNPJ,6-1,1)); 
$Numero[7]=intval(substr($RecebeCNPJ,7-1,1)); 
$Numero[8]=intval(substr($RecebeCNPJ,8-1,1)); 
$Numero[9]=intval(substr($RecebeCNPJ,9-1,1)); 
$Numero[10]=intval(substr($RecebeCNPJ,10-1,1)); 
$Numero[11]=intval(substr($RecebeCNPJ,11-1,1)); 
$Numero[12]=intval(substr($RecebeCNPJ,12-1,1)); 
$Numero[13]=intval(substr($RecebeCNPJ,13-1,1)); 
$Numero[14]=intval(substr($RecebeCNPJ,14-1,1)); 

$soma=$Numero[1]*5+$Numero[2]*4+$Numero[3]*3+$Numero[4]*2+$Numero[5]*9+$Numero[6]*8+$Numero[7]*7+ 
$Numero[8]*6+$Numero[9]*5+$Numero[10]*4+$Numero[11]*3+$Numero[12]*2; 

$soma=$soma-(11*(intval($soma/11))); 

if ($soma==0 || $soma==1) 
{ 
$resultado1=0; 
}else{ 
$resultado1=11-$soma; 
} 

if ($resultado1==$Numero[13]) 
{ 
$soma=$Numero[1]*6+$Numero[2]*5+$Numero[3]*4+$Numero[4]*3+$Numero[5]*2+$Numero[6]*9+ 
$Numero[7]*8+$Numero[8]*7+$Numero[9]*6+$Numero[10]*5+$Numero[11]*4+$Numero[12]*3+$Numero[13]*2; 
$soma=$soma-(11*(intval($soma/11))); 
if ($soma==0 || $soma==1) 
{ 
$resultado2=0; 
}else{ 
$resultado2=11-$soma; 
} 

if ($resultado2==$Numero[14]) 
{ 
return TRUE; 
}else{ 
return FALSE; 
} 
}else{ 
return FALSE; 
} 
} 
} 
//Fim do validar CNPJ 

function file_exists_2($filePath)
{
    return ($ch = curl_init($filePath)) ? @curl_close($ch) || true : false;
}

?> 
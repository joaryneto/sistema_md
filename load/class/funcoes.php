<?
function data_completa($data_consulta, $tipo) {
$data = $data_consulta;
$anos = substr($data,0,4);
$mess = substr($data,5,2);
$dias = substr($data,8,2);

// pega o dia da semana de qualquer mкs
$semana = date("l", mktime(0, 0, 0, $mess, $dias, $anos));
if ($semana == "Sunday") {
$semana_ext = "Domingo";
} elseif ($semana == "Monday") {
$semana_ext = "Segunda-feira";
} elseif ($semana == "Tuesday") {
$semana_ext = "Terзa-feira";
} elseif ($semana == "Wednesday") {
$semana_ext = "Quarta-feira";
} elseif ($semana == "Thursday") {
$semana_ext = "Quinta-feira";
} elseif ($semana == "Friday") {
$semana_ext = "Sexta-feira";
} elseif ($semana == "Saturday") {
$semana_ext = "Sбbado";
}
 
// Pega o mкs
$mes= number_format($mess,0);// + 1;
if ($mes == "01") {
$mes_ext = "Janeiro";
} elseif ($mes == "02") {
$mes_ext = "Fevereiro";
} elseif ($mes == "03") {
$mes_ext = "Marзo";
} elseif ($mes == "04") {
$mes_ext = "Abril";
} elseif ($mes == "05") {
$mes_ext = "Maio";
} elseif ($mes == "06") {
$mes_ext = "Junho";
} elseif ($mes == "07") {
$mes_ext = "Julho";
} elseif ($mes == "08") {
$mes_ext = "Agosto";
} elseif ($mes == "09") {
$mes_ext = "Setembro";
} elseif ($mes == "10") {
$mes_ext = "Outubro";
} elseif ($mes == "11") {
$mes_ext = "Novembro";
} elseif ($mes == "12") {
$mes_ext = "Dezembro";
}
//Agrupa o resultado
if($tipo == "completo"){
$data_final = $semana_ext." - ".$dias." de ".$mes_ext." de ".$anos;
}else{
$data_final = $semana_ext." - ".$dias." de ".$mes_ext;
}
return $data_final;
}

function formatodatahora($data){

	if($data != ""){
		
		$data_bd = substr($data,0,10);
		$hora_bd = substr($data,10,6);
		
		$sep_data = explode("-",$data_bd);
		$data = $sep_data[2]."/".$sep_data[1]."/".$sep_data[0];
		
		
	}
			return $data." ".$hora_bd;


}


// funcao de data
function formatodata($data){

		$rel1 = substr($data,8,2);
		$rel2 = substr($data,5,2);
		$rel3 = substr($data,0,4);
		if($rel1!=""){
			$data = $rel1."/".$rel2."/".$rel3;
		}
		
		return $data;
}
function formatodata2($data){

		//$rel1 = substr($data,8,2);
		//$rel2 = substr($data,5,2);
		//$rel3 = substr($data,0,4);
		//$data = $rel2."/".$rel1."/".$rel3;

		$rel1 = substr($data,8,2);
		$rel2 = substr($data,5,2);
		$rel3 = substr($data,0,4);
		$data = $rel1."/".$rel2."/".$rel3;

		
		return $data;
}
function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

function retiraacentos($texto) { 
$array1 = array("б", "а", "в", "г", "д", "й", "и", "к", "л", "н", "м", "о", "п", "у", "т", "ф", "х", "ц", "ъ", "щ", "ы", "ь", "з", "Б", "А", "В", "Г", "Д", "Й", "И", "К", "Л", "Н", "М", "О", "П", "У", "Т", "Ф", "Х", "Ц", "Ъ", "Щ", "Ы", "Ь", "З", "-", ".", ",","/","(",")","'","`"); 
$array2 = array("A", "A", "A", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "", "", "","","","`","`");
return str_replace($array1, $array2, $texto); 
}

function convertecxalta($texto) { 
$array1 = array("б", "а", "в", "г", "д", "й", "и", "к", "л", "н", "м", "о", "п", "у", "т", "ф", "х", "ц", "ъ", "щ", "ы", "ь", "з"); 
$array2 = array("Б", "А", "В", "Г", "Д", "Й", "И", "К", "Л", "Н", "М", "О", "П", "У", "Т", "Ф", "Х", "Ц", "Ъ", "Щ", "Ы", "Ь", "З");
return str_replace($array1, $array2, $texto); 
}

function retirainvalidos($texto) { 
$array1 = array("'","`"); 
$array2 = array("`","`");
return str_replace($array1, $array2, $texto); 
}
	
function caracteres_invalidos($nome) { 
	$array1 = array("'"); 
	$array2 = array("ґ");
	return str_replace($array1, $array2, $nome); 
	}	

function moeda_grava($numero_moeda){
if($numero_moeda != ""){
	$caracteres = array(",",".");
	$numero_filtrado = str_replace($caracteres, "", $numero_moeda);
		$qtd_car = strlen($numero_filtrado);
		 $ca1 = ($qtd_car - 2);
		  $bloco1 = substr($numero_filtrado, 0, $ca1 );
		  $bloco2 = substr($numero_filtrado, $ca1, 2 );
      $monta = $bloco1.".".$bloco2;
	return $monta;
	}
} 

function adiciona($numero,$qtde) {
	if($numero != ""){
	$x = strlen($numero); 
	 if ($x <= $qtde) {
	   $y = $qtde - $x;
	    $ext_f = str_repeat("0",$y);	
	   $num_cheio = $ext_f.$numero;
	 }
	 return $num_cheio;
}
}

function difdata($from, $to) {  
  list($from_year, $from_month, $from_day ) = explode("-", $from); 
  list($to_year, $to_month, $to_day ) = explode("-", $to); 
          
  $from_date = mktime(0,0,0,$from_month,$from_day,$from_year); 
  $to_date = mktime(0,0,0,$to_month,$to_day,$to_year); 
          
  $days = ($to_date - $from_date)/86400; 
   
/*Adicionado o ceil($days) para garantir que o resultado seja sempre um nъmero inteiro */ 

  return ceil($days); 
}


function somadata($quant, $date, $return_format = FALSE)
 {
  // Verifica erros
  $operation = "sum";
  $where = "day";
  $warning = "<br>Warning! Date Operations Fail… ";
  if(!$date || !$operation) {
   return "$warning invalid or inexistent arguments<br>";
  }else{
   if(!($operation == "sub" || $operation == "-" || $operation == "sum" || $operation == "+")) return "<br>$warning Invalid Operation…<br>";
   else {
    // Separa dia, mкs e ano
    list($day, $month, $year) = preg_split("/", $date);

    // Determina a operaзгo (Soma ou Subtraзгo)
    ($operation == "sub" || $operation == "-") ? $op = "-": $op = "";

    // Determina aonde serб efetuada a operaзгo (dia, mкs, ano)
    if($where == "day")   $sum_day  = $op."$quant";
    if($where == "month") $sum_month = $op."$quant";
    if($where == "year")  $sum_year  = $op."$quant";

    // Gera o timestamp
    $date = mktime(0, 0, 0, $month + $sum_month, $day + $sum_day, $year + $sum_year);

    // Retorna o timestamp ou extended
    ($return_format == "timestamp" || $return_format == "ts") ? $date = $date : $date = date("d/m/Y", "$date");

    // Retorna a data
    return $date;
   }
  }
 }


/*
Retorna diferenзa entre as datas em Dias, Horas ou Minutos

Function Diferenca(data maior, [data menos],[dias horas ou minutos])

Primeiro parametro, Data de inicio, no formato 04/05/2006 12:00
Se nгo passado o seundo parametro, dб o valor da data atual
Terceiro parametro, diferenзa a ser retornada:

 "m" Minutos
 "H" Horas
 "h": Horas arredondada
 "D": Dias 
 "d": Dias arredontados

Gambiarra.com.br
Bozo@gambiarra.com.br
*/

Function Diferenca($data1, $data2="",$tipo=""){

if($data2==""){
$data2 = date("d/m/Y H:i");
}

if($tipo==""){
$tipo = "h";
}

for($i=1;$i<=2;$i++){
${"dia".$i} = substr(${"data".$i},0,2);
${"mes".$i} = substr(${"data".$i},3,2);
${"ano".$i} = substr(${"data".$i},6,4);
${"horas".$i} = substr(${"data".$i},11,2);
${"minutos".$i} = substr(${"data".$i},14,2);
}

$segundos = mktime($horas2,$minutos2,0,$mes2,$dia2,$ano2) - mktime($horas1,$minutos1,0,$mes1,$dia1,$ano1);

switch($tipo){

 case "m": $difere = $segundos/60;    break;
 case "H": $difere = $segundos/3600;    break;
 case "h": $difere = round($segundos/3600);    break;
 case "D": $difere = $segundos/86400;    break;
 case "d": $difere = round($segundos/86400);    break;
}

return $difere;
}

function calc_idade($data_nasc){

$data_nasc = explode("/", $data_nasc);

$data = date("d-m-Y");
$data = explode("-", $data);
$anos = $data[2] - $data_nasc[2];

//echo $data_nasc[1] .">=". $data[1];

if ((int)$data_nasc[1] <= (int)$data[1]){

	if ( $data_nasc[0] >= $data[0] ){

		return $anos; 
		//break;
	
	}else{
		return $anos-1;
		//break;
	} 
	
}else{
	
	return $anos-1;

} 
} 


#$data1 = "01/02/2006 08:00";
#$data2 = "04/02/2006 11:30";
#echo Diferenca($data1,$data2,"D"); 
#echo " dias exatos.<br>";
#echo Diferenca($data1,$data2,"d"); 
#echo " dias arredondados.<br>";
#echo Diferenca($data1,$data2,"H"); 
#echo " horas exatas.<br>";
#echo Diferenca($data1,$data2,"h"); 
#echo " horas arredondadas.<br>";
#echo Diferenca($data1,$data2,"m"); 
#echo " minutos <br>";

function mt_rand_str ($l, $c = '1234567890') {
    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
    return $s;
}

?>
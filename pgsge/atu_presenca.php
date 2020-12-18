<?
ob_start();
session_start();

?>
<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu3'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}
if($_GET['ap'] == 1)
{
   $diario = $_GET['diario'];
   //$check = $_GET['diario'];
   $disciplina = $_GET['disciplina'];
   $matricula = $_GET['matricula'];
   $periodo = $_GET['periodo'];
   $data = $_GET['data'];
	
   $count = 0;
   $x = 0;
   $SQL1 = "SELECT * FROM frequencia where diario=".$diario." and matricula=".$matricula." and disciplina=".$disciplina." and periodo=".$periodo."";
   $sucesso = mysqli_query($db,$SQL1);

   while($row = mysqli_fetch_array($sucesso))
   {
	   $x = 1;
	   $count++;
   }
	
   if($x == 1)
   {
     
	 if($_GET['check'] == "true")
	 {
		$valor = 0;
	 }
	  else
	 {
		$valor = 1; 
	 }
	   //echo "<br>";
       $SQL = "UPDATE frequencia SET falta='$valor' where diario='".$diario."' and periodo=".$periodo." and matricula=".$matricula." and disciplina=".$disciplina."";
       $sucesso = mysqli_query($db,$SQL);
	   
	   //$SQL 

     }
}
/*if($_GET['gravar'] == 1)
{
	
    $diario = $_GET['diario'];
	$disciplina = $_GET['disciplina'];
	$periodo = $_GET['periodo'];
	$data = $_GET['data'];
	
	$teste = explode(",",$_GET['matricula']);
	$nots = explode(",",$_GET['nots']);
    
	
	if(!Empty($_GET['matricula']))
	{

	
	foreach($teste as $i)
    {
	   $count = 0;
	   $x = 0;
	   $SQL1 = "SELECT * FROM frequencia where diario=".$diario." and matricula=".$i." and disciplina=".$disciplina." and periodo=".$periodo."";
	   $sucesso = mysqli_query($db,$SQL1);
	
	   while($row = mysqli_fetch_array($sucesso))
	   {
		   $x = 1;
		   $count++;
	   }
	
	   if($x == 1)
	   {
		   //echo "<br>";
           $SQL = "UPDATE frequencia SET falta='0' where diario='".$diario."' and periodo=".$periodo." and matricula=".$i." and disciplina=".$disciplina."";
     	   $sucesso = mysqli_query($db,$SQL);
	   }
	   else
	   {
		   //echo "<br>";
		   $SQL = "INSERT INTO frequencia(diario,matricula,disciplina,periodo,data,falta) values('".$diario."','".$i."','".$disciplina."','".$periodo."','".$data."','0');";
		   $sucesso = mysqli_query($db,$SQL);
	   }
	   
	 }
	}
	
	if(!Empty($_GET['nots']))
	{
	  foreach($nots as $o)
      {
	    $count = 0;
	    $x = 0;
	    $SQL1 = "SELECT * FROM frequencia where diario=".$diario." and matricula=".$o." and disciplina=".$disciplina." and periodo=".$periodo."";
	    $sucesso = mysqli_query($db,$SQL1);
	
	    while($row = mysqli_fetch_array($sucesso))
	    {
		   $x = 1;
		   $count++;
	    }
	
	    if($x == 1)
	    {
		   //echo "<br>";
           $SQL = "UPDATE frequencia SET falta='1' where diario='".$diario."' and periodo=".$periodo." and matricula=".$o." and disciplina=".$disciplina."";
     	   $sucesso = mysqli_query($db,$SQL);
	    }
	    else
	    {
		   //echo "<br>";
		   $SQL = "INSERT INTO frequencia(diario,matricula,disciplina,periodo,data,falta) values('".$diario."','".$o."','".$disciplina."','".$periodo."','".$data."','1');";
		   $sucesso = mysqli_query($db,$SQL);
	    }
	  }
    }
	
		?>
	<script> 
		//alert('TESTE');
		//swal('Atenção', 'Gravado com sucesso...'); 
		window.location.href='sistema.php?url=cad_diario&codigo=<? echo $diario; ?>&frequencia=1&disciplina=<? echo $disciplina;?>';
	</script>
	<?
}
else
{
	
    function formatodatahora($data)
	{
      return date("d/m/Y", strtotime($data));
    }
	
	function revertedata($data)
	{

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
    }

    $check = $_GET['check'];
    $diario = $_GET['diario'];
    $matricula = $_GET['matricula'];
	$disciplina = $_GET['disciplina'];
	$periodo = $_GET['periodo'];
	$data = $_GET['data'];


	$total = 0;
	$b = 1;
	$y = 0;
	$SQL = "SELECT falta as qtd FROM frequencia where matricula='".$matricula."' and disciplina=".$disciplina." and periodo=".$periodo." and falta=1";
	$RES = mysqli_query($db,$SQL);
	
	while($rows2 = mysqli_fetch_array($RES))
	{
		//echo "The number is: $b <br>";
		$y = 1;
		$total = $b++;
	}
	
	if($y == 1)
	{
		if($_GET['check'] == "true")
		{
	       //$total = $total+1; 
		   //echo $total-1;
		}
		else
		{
		   //$total = $total+1; 
		   //echo $total;
		}
	}
	else
	{
		if($_GET['check'] == "true")
		{
		   //echo "0";
		}
		else
		{
		   //echo "1";
		}
	}

}*/
?>	
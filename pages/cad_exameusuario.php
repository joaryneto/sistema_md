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

$SQL1 = "SELECT * FROM internet_usuarios where codigo='".$_GET['codigo']."'";
$pessoa = mysqli_query($db,$SQL1);
while($rows = mysqli_fetch_array($pessoa))
{
   if(Empty($rows['cod_usuario']))
   {
      $coduser = $rows['codigo'];
   }
   else
   {
      $coduser = $rows['cod_usuario'];
   }
}
	  
if($_GET['ap'] == "1")
{
	$x = 0;
	$SQL1 = "SELECT * FROM laudar where cod_exame=".$_GET['exame']." and cod_medico=".$coduser."";
	$sucesso = mysqli_query($db,$SQL1);
	
	while($row = mysqli_fetch_array($sucesso))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
        $SQL2 = "DELETE FROM laudar where cod_exame='".$_GET['exame']."'  and cod_medico=".$coduser."";
     	$sucesso = mysqli_query($db,$SQL2);
	}
	else
	{
		$SQL2 = "INSERT INTO laudar(cod_exame,cod_medico) values('".$_GET['exame']."','".$coduser."');";
     	$sucesso = mysqli_query($db,$SQL2);
		
		//print('<script> window.alert("Exame cadastrado com sucesso...")</script>');
	}
}

if($_GET['list'] == 1)
{									
   if(!Empty($_GET['codigo']))
   {
         $SQL2 = "SELECT tipo_exame.codigo,tipo_exame.descricao FROM tipo_exame LEFT join laudar on laudar.cod_exame=tipo_exame.codigo where tipo_exame.status=1 and tipo_exame.descricao like '%".$_GET['pesquisa']."%' GROUP BY descricao order by tipo_exame.descricao ASC";
		 
         $RES2 = mysqli_query($db,$SQL2);									 
         while($rowss = mysqli_fetch_array($RES2))
         {

           $SQL4 = "SELECT cod_exame FROM laudar where cod_exame=".$rowss['codigo']." and cod_medico=".$coduser."";
           $RES4 = mysqli_query($db,$SQL4);
		   $row = mysqli_fetch_array($RES4);
?>
           <br><input type="checkbox" name="<? echo $rowss['codigo'];?>" OnClick="javascript: ajaxLoader('?br=cad_exameusuario&codigo=<? echo $_GET['codigo'];?>&exame=<? echo $rowss['codigo'];?>&ap=1','listaexames','GET');" value="<? echo $rowss['codigo'];?>" <? if($rowss['codigo'] == $row['cod_exame']) { echo 'checked="checked"'; } ?> class="js-switch" data-color="#009efb" /> <b><? echo $rowss['descricao']; ?> </b>
<?  
         }
    }
}
?>
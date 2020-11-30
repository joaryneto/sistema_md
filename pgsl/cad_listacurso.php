<?

$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

if($_SESSION["donoSessao"]  != $tokenUser){
    header("location:login.php");
}

?>

<select name="cidade" id="cidade"class="form-control" style="width: 100%; height:36px;">
<option value=""> Selecionar </option>
<?

		echo $SQL2 = "select codigo,descricao from turmas where curso='".$_GET['curso']."'";	
		$res_pc = mysqli_query($db,$SQL2);

		if($res_pc)
		{
			$valido = true;
		}
		else
		{
			$valido = false;
		}
					 
   //Exibe as linhas encontradas na consulta
      while ($row = mysqli_fetch_array($res_pc)) 
      {   
  ?>
      <option value="<? echo $row['codigo']?>" <? if($cidade == $row['codigo']){ echo "selected"; } ?>><? echo $row['descricao']?></option>
	  
   <? } 
	  
	  if($valido == false)
	  {
		?>
			<option value="">Nenhum curso encontrado.</option>
		<?
	  }				   
?>
 </select>
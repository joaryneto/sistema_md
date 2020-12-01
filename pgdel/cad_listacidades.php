<select name="cidade" id="cidade"class="form-control" style="width: 100%; height:36px;">
<option value=""> Selecionar </option>
<?

		echo $SQL2 = "select cod_municipio,municipio from municipios where codigo_uf='".$_GET['estado']."'";	
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
      <option value="<? echo $row['cod_municipio']?>" <? if($cidade == $row['cod_municipio']){ echo "selected"; } ?>><? echo $row['municipio']?></option>
	  
   <? } 
	  
	  if($valido == false)
	  {
		?>
			<option value="">Nenhuma cidade encontrada.</option>
		<?
	  }				   
?>
 </select>
<select name="turma" id="turma"class="form-control" style="width: 100%; height:36px;">
<option value=""> Selecionar </option>
<?

  $SQL2 = "select turmas.codigo,turmas.descricao from turmas inner join turmas_professor on turmas_professor.turma=turmas.codigo where turmas.curso='".$_GET['curso']."' and turmas_professor.usuario='".$_SESSION['usuario']."'";	
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
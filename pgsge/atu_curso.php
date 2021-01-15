
<?

if(@$_GET['load'] == 1)
{
	  $x = 0;
      $SQL2 = "select turmas.codigo,turmas.descricao from turmas where sistema='".$_SESSION['sistema']."' and turmas.curso='".$_GET['curso']."' order by descricao asc";	
      $res_pc = mysqli_query($db,$SQL2);	 
      while ($row = mysqli_fetch_array($res_pc)) 
      {   
	      $x = 1;
  ?>
         <option value="<? echo $row['codigo']?>"><? echo $row['descricao']?></option>
	  
   <? } 
	  
	  if($x == 0)
	  {
		?>
			<option value="">Nenhum curso encontrado.</option>
		<?
	  }			
}	  
?>
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

if(isset($_GET['codigo']))
{
	$sucesso = mysqli_query($db,"SELECT valor,laudador FROM tabelapg where laudador='".$_GET['empresa']."' and codigo='".$_GET['codigo']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $valorA = $row['valor'];
		 $laudador = $row['laudador'];
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if(isset($_GET['exame']))
{
	$sucesso = mysqli_query($db,"SELECT descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['exame']."'");
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $descricao = $row['descricao'];
		 $valorB = $row['valor_padrao'];
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if($_GET['ap'] == "1")
{
	$sucesso = mysqli_query($db,"SELECT * FROM tabelapg where exame='".$_POST['exame']."' and laudador='".$_POST['cnpj']."'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Exame ja existe')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=".$_POST['cnpj']."';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into tabelapg(laudador,exame,valor) values('".$_POST['cnpj']."','".$_POST['exame']."','".$_POST['valor']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $SQL2 = "INSERT into tabelapg(laudador,exame,valor) values('".$_POST['cnpj']."','".$_POST['exame']."','".$_POST['valor']."')";
	   $sucesso = mysqli_query($db3,$SQL2);
	   
	   if($sucesso)
	   {
		   print("<script>window.alert('Exame Adiconado com sucess')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=".$_POST['cnpj']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE tabelapg SET valor=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE tabelapg SET valor=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db3,$SQL2);
	
	if($sucesso)
	{
        print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_tabelalaudador&empresa=".$_POST['cnpj']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

if(isset($_POST["submit"]))
{
          $file = $_FILES['file']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 1000, ";")) !== false)
          {
			  
			 if(Empty($filesop[0]) or $filesop[0] == "CPF" or $filesop[1] == "NOME")
			 {
               
             }
			 else
			 {
				$fname = $filesop[0];
                $lname = $filesop[1];
                echo $sql = "insert into excel(fname,lname) values ('$fname','$lname')";
			 }
             
			 $c = $c + 1;
          }

          if($sql)
	      {
               echo "Sucesso";
          } 
		  else
		  {
               echo "Sorry! Unable to impo.";
          }

}

?>		
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de pagamento a Laudadores";?></h4>
								<form enctype="multipart/form-data" method="post" role="form">
  								  <div class="form-group">
 								       <label for="exampleInputFile">File Upload</label>
 								       <input type="file" name="file" id="file" size="150">
 								       <p class="help-block">Only Excel/CSV File Import.</p>
 								   </div>
 								   <button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>
								</form>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
                                                <th>Valor Unitario</th>
												<th>Desconto</th>
												<!--<th>Valor Total</th>-->
												<th>X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<? 
										  if(isset($_GET['empresa']))
										  {
										  $sql = "select tabelapg.codigo,tabelapg.valor,tipo_exame.descricao,tipo_exame.valor_padrao,tabelapg.exame from tabelapg inner join tipo_exame on tipo_exame.codigo=tabelapg.exame where tabelapg.laudador='".$_GET['empresa']."' order by descricao ASC";
										  $res = mysqli_query($db,$sql); 
										  while($row = mysqli_fetch_array($res))
										  {
										  ?>
                                            <tr>
                                                <td><? echo $row['codigo'];?></td>
                                                <td><? echo $row['descricao'];?></td>
                                                <td><? echo $row['valor_padrao'];?></td>
												<td><? echo $row['valor'];?></td>
												<!--<td>< echo $numero = number_format($row['valor_padrao']-+$row['valor'], 2, ',','.');?></td>-->
												<td><a class="fa fa-edit" href="iniciado.php?url=cad_tabelalaudador&empresa=<? echo $_GET['empresa']?>&exame=<?echo $row['exame']?>&codigo=<? echo $row['codigo']?>"> Editar<a></td>
                                            </tr>
										  <? } } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descrição</th>
                                                <th>Valor Unitario</th>
												<th>Desconto</th>
												<!--<th>Valor Total</th>-->
												<th>X</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
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

if($_SESSION['menu99'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}


if($_GET['ap'] == 1)
{
	//Gerar();
	
	//if(is_dir("laudos_enviados/".$_SESSION['proto']."/") == false)
    //{
	//   mkdir("laudos_enviados/".$_SESSION['proto']."/", 0777);
	//}
	
	if(is_dir("sign/") == false)
    {
	   mkdir("sign/", 0777);
	}
	
	$output_dir = "sign/";

	$fileName = $_FILES["file"]["name"];
	
	$arquivo["name"] =  $_SESSION['proto']."_".$randn.".". substr($fileName,-5);	
	$imagem_dir = $pasta.filtro($arquivo["name"]);
	$nome_final = $arquivo["name"];
		
    move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir.$imagem_dir);
	
	//$SQL = "INSERT into imagens(protocolo, imagem) values('".$_SESSION['proto']."','".$nome_final."');";
	//$sucesso = mysqli_query($db,$SQL);
}
?>		
<script>
function altfoto(input) 
{
  if (input.files && input.files[0]) 
  {
      var reader = new FileReader();

       reader.onload = function (e) 
	   {
          $('#foto').attr('src', e.target.result)
		  $('#imgs').attr('value', e.target.result)
		  //$('#mensagem').attr('value', e.target.result)
		  //$("textarea#mensagem").text(e.target.result)
       };

     reader.readAsDataURL(input.files[0]);
  }
}
</script>
<label for="img" title="Click aqui">
<img src="template/assets/images/users/icon-member.png" class="img-circle" style="height: 150px;width: 150px;" id="foto" />
</label>
<input type="file" id="img" name="img" accept="image/*" onchange="altfoto(this)" style="display: none;">
<input type="text" id="imgs" name="imgs" accept="image/*" value="" onchange="altfoto(this)" style="display: none;">
<button class="btn btn-info" href="javascript: WEB(0)" type="submit" OnClick="javascript: requestPage('iniciado','?br=up_usuarios&codigo=2&cpf=<? echo ?>&faturavenci='+ document.getElementById('faturavenci').value +'&ap=1','relatorio2','GET'" data-toggle="modal" data-target="#naofaturado"><i class="fa fa-plus-circle"></i> Gravar</button>
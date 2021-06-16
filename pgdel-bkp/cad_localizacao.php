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

/*if($_SESSION['menu10'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}*/

$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

if($_SESSION["donoSessao"]  != $tokenUser){
    header("location:login.php");
}

if(isset($_GET['codigo']))
{
	$sucess = mysqli_query($db,"SELECT desconto FROM tabelaexames where codigo='".$_GET['codigo']."'");
	
	if($sucess)
	{
      while($row = mysqli_fetch_array($sucess))
	  {
		 $valorA = $row['desconto'];
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
	$sucess = mysqli_query($db,"SELECT descricao,valor_padrao FROM tipo_exame where codigo='".$_GET['exame']."'");
	
	if($sucess)
	{
      while($row = mysqli_fetch_array($sucess))
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
	if(Empty($_POST['cnpj']) || Empty($_POST['exame1']) || Empty($_POST['exame2']))
	{
		print("<script>window.alert('Preencha todos os campos!')</script>");
	}
    else
	{
	$SQL = "SELECT * FROM exames_empresa where cod_exame='".$_POST['exame2']."' and empresa='".$_POST['cnpj']."'";
	$sucess = mysqli_query($db,$SQL);
	
	$x = 0;
	
	while($row = mysqli_fetch_array($sucess))
	{
	   $x = 1;
	}
	
	if($x == 1)
	{
	    print("<script>window.alert('Exame ja foi cadastrado')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_exameempresa&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into exames_empresa(empresa,cod_exame,cod_exame_empresa) values('".$_POST['cnpj']."','".$_POST['exame1']."','".$_POST['exame2']."')";
	   $sucess = mysqli_query($db,$SQL1);
	   
	   //$SQL2 = "INSERT into exames_empresa(empresa,cod_exame,cod_exame_empresa) values('".$_POST['cnpj']."','".$_POST['exame1']."','".$_POST['exame2']."')";
	   //$sucess2 = mysqli_query($db3,$SQL2);
	   
	   if($sucess)
	   {
		   print("<script>window.alert('Exame Adiconado com sucess')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_exameempresa&cnpj=".$_POST['cnpj']."';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
	}
}
elseif($_GET['ap'] == "2")
{
	$SQL1 = "UPDATE tabelaexames SET desconto=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucess = mysqli_query($db,$SQL1);
	
	$SQL2 = "UPDATE tabelaexames SET desconto=".$_POST['valor']." where codigo='".$_GET['codigo']."'";
	$sucess2 = mysqli_query($db3,$SQL2);
	
	if($sucess and $sucess2)
	{
        print("<script>window.alert('Alterado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_exameempresa&cnpj=".$_POST['cnpj']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}
elseif($_GET['ap'] == "3")
{
	$SQL2 = "DELETE FROM exames_empresa where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL2);
	
	if($sucesso)
	{
        print("<script>window.alert('Excluido com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_exameempresa&cnpj=".$_GET['cnpj']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

?>		
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

								<h4 class="card-title"><? echo $_SESSION["PAGINA"] = "Cadastro de tabela por Empresa";?></h4>
								
<p id="demo">Clique no botão para obter sua localização:</p>
<button onclick="getLocation()">Clique aqui</button>
<div id="mapholder"></div>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
  else{x.innerHTML="Geolocalização não é suportada nesse browser.";}
  }
 
function showPosition(position)
  {
  lat=position.coords.latitude;
  lon=position.coords.longitude;
  latlon=new google.maps.LatLng(lat, lon)
  mapholder=document.getElementById('mapholder')
  mapholder.style.height='250px';
  mapholder.style.width='500px';
 
  var myOptions={
  center:latlon,zoom:14,
  mapTypeId:google.maps.MapTypeId.ROADMAP,
  mapTypeControl:false,
  navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
  var marker=new google.maps.Marker({position:latlon,map:map,title:"Você está Aqui!"});
  }
 
function showError(error)
  {
  switch(error.code)
    {
    case error.PERMISSION_DENIED:
      x.innerHTML="Usuário rejeitou a solicitação de Geolocalização."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML="Localização indisponível."
      break;
    case error.TIMEOUT:
      x.innerHTML="O tempo da requisição expirou."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML="Algum erro desconhecido aconteceu."
      break;
    }
  }
</script>
                                </div>
                            </div>
                        </div>
					</div>
				</div>			
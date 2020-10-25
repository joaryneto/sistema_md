<?

$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu0'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

if($_GET['bloquear']==1 and $menu7 == 1 or $_GET['bloquear']==1 and $menu99 == 1)
{
  $SQL = "UPDATE laudos_enviados SET laudador=NULL , status=-1 where codigo=".$_GET['codigo']."";
  $sucesso = mysqli_query($db,$SQL);

  $SQL = "UPDATE laudos_enviados SET laudador=NULL , status=-1 where codigo=".$_GET['codigo']."";
  $sucesso = mysqli_query($db3,$SQL);
 
  $SQL = "INSERT INTO laudos_enviados_logs (codigo,cod_usuario,data,alteracao) values('".$_GET['codigo']."','".$_SESSION['usuario']."',NOW(),'Bloqueio de exame')";
  $sucesso = mysqli_query($db,$SQL);
  
  if($sucesso)
  {
	 print "<script> window.alert('Laudo bloqueado com sucesso...'); </script>";
	 print "<script> window.location='iniciado.php?url=inicio';</script>"; 
  }
}

if($_GET['excluir']==1 and $menu8 == 1)
{
  
  $SQL = "UPDATE laudos_enviados SET laudador=NULL , status=-2 where codigo=".$_GET['codigo']."";
  $sucesso = mysqli_query($db,$SQL);
  
  $SQL = "UPDATE laudos_enviados SET laudador=NULL , status=-2 where codigo=".$_GET['codigo']."";
  $sucesso = mysqli_query($db3,$SQL);
 
  $SQL = "INSERT INTO laudos_enviados_logs (codigo,cod_usuario,data,alteracao) values('".$_GET['codigo']."','".$_SESSION['usuario']."',NOW(),'Exame Excluido')";
  $sucesso = mysqli_query($db,$SQL);
  
  if($sucesso)
  {
	 print "<script> window.alert('Laudo excluido com sucesso...'); </script>";
	 print "<script> window.location='iniciado.php?url=inicio';</script>"; 
  }
  
  //$SQL = "DELETE FROM laudos_enviados where codigo=".$_GET['codigo']."";
  //$sucesso = mysqli_query($db,$SQL);
  
  //if($sucesso)
  //{
	// print "<script> window.alert('Laudo excluido com sucesso...'); </script>";
	// print "<script> window.location='iniciado.php?url=inicio';</script>"; 
  //}
}

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

if(isset($_POST['button']))
{
	$mes=$_POST['mes'];
	$ano=$_POST['ano'];
	//$tipo=$_POST['tipo'];
}
else
{
	$mes=date("m");
	$ano=date("Y");
}

?>                
<div class="row" id="con">	
</div>

<!--<script type="text/javascript">
        //cria uma lista com os vídeos do canal especificado
        function funcaoCallback(json){
            var videos = json.items; //array com os vídeos
            var youtubeUrl = 'https://www.youtube.com/embed/'; //padrão de URL do YouTube
            var output_html = "";
            for(i = 0; i < videos.length; i++){
				output_html += "<div class=\"col-lg-3 col-md-6\">";
                output_html += "<div class=\"card\">";
				output_html += "<iframe class=\"card-img-top img-responsive\" width=\"1262\" height=\"710\" src=\"" + youtubeUrl + videos[i].id.videoId + "\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                output_html += "<div class=\"card-body\">";
                output_html += "<h4 class=\"card-title\">";                
                output_html += videos[i].snippet.title.substr(0, 70);
                output_html += "</h4>";
                output_html += "<p>";
                output_html += videos[i].snippet.description.substr(0, 90);
                output_html += "</p>";
                output_html += "</div>";
                output_html += "</div>";
				output_html += "</div>";
            }
            document.getElementById("con").innerHTML = output_html;
        }        
    </script>
    <script async src="https://www.googleapis.com/youtube/v3/search?part=id%2Csnippet&channelId=UCUAAvHAah0JHWMvUWr8fTvA&key=AIzaSyB00hBcujCfpNOsgkL3eGbSSggkoXa_eJg&maxResults=50&type=video&order=date&fields=items(id(videoId)%2Csnippet(title%2Cdescription%2Cthumbnails(medium)))&prettyPrint=false&callback=funcaoCallback"></script>	-->
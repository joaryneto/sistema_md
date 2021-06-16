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

<?
if($_GET['autoload'] == 1)
{
	$SQL = "INSERT INTO chat(de,para,conteudo,status) VALUES('".$usuario."','".$_SESSION['para']."','".$_GET['conteudo']."',1)";
	$RES = mysqli_query($db,$SQL);
	?>
	<script>
	
	</script>
	<?
}
elseif($_GET['autoload'] == 2)
{
	$SQL = "SELECT * FROM chat inner join  where ";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		
	}
}
elseif($_GET['autoload'] == 3)
{
	//print("<script> $('#visa".$_SESSION['para']."').removeClass('active');</script>");
	
	//print("<script>window.alert('".$_SESSION['para']." Usuario desativado com sucesso...');</script>");
		?>
	<script>
	  $('.item-menu').click(function(e) {
      $('.item-menu').removeClass('active');
      $(this).addClass('active');
    });

    // verificar via JS:
    const href = [location.pathname, location.search].join('?');
    $('.item-menu[href="' + href + '"]').addClass('active');
	</script>
	<?
	
	echo $_SESSION['para'] = $_GET['codigo'];
}
?>
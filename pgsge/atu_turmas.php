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

if($_GET['ap'] == "1")
{
    $codigo = $_GET['codigo'];
    $check = $_GET['check'];
    $turma = $_GET['turma'];
	
	//$count = 0;
	$x = 0;
	$SQL1 = "SELECT * FROM turmas_professor where sistema='".$_SESSION['sistema']."' usuario=".$codigo." and turma=".$turma."";
	$sucesso = mysqli_query($db,$SQL1);
	
	while($row = mysqli_fetch_array($sucesso))
	{
		$x = 1;
		
		//$count++;
	}
	
	if($x == 1)
	{
		//echo "<br>";
        $SQL = "DELETE FROM turmas_professor where sistema='".$_SESSION['sistema']."' and usuario='".$codigo."' and turma=".$turma."";
     	$sucesso = mysqli_query($db,$SQL);
	}
	else
	{
		//print("<script>window.alert('Aluno não esteve presente!');</script>");
		//echo "<br>";
		$SQL = "INSERT INTO turmas_professor(sistema,usuario,turma) values('".$_SESSION['sistema']."','".$codigo."','".$turma."');";
		$sucesso = mysqli_query($db,$SQL);
	}	
}

if($_GET['load'] == 1)
{
	if(isset($_GET['pesquisa']))
	{
		$whe = " and descricao like '%".$_GET['pesquisa']."%'";
	}

										  								  
	  $sql = "select * from turmas where sistema='".$_SESSION['sistema']."' $whe order by codigo desc;";
	  $res = mysqli_query($db,$sql); 
	  while($row = mysqli_fetch_array($res))
	  {
	  ?>
		<tr>
			<td data-title="Descrição"><? echo $row['descricao'];?></td>
			<td data-title="Status"><? 
			Switch($row['status'])
			{
			 case 0:
			 { echo "Inativo";}
			 break;
			 case 1:
			 { echo "Ativo";}
			 break;
			 case 2:
			 { echo "Pre-Ativa";}
			 break;
			 case 3:
			 { echo "Transferido";}
			 break;
			}
									 ?></td>
			<td data-title="Editar">
			<a class="fa fa-edit" href="javascript: void(0);" onclick="edit_turmas('<?=$row['codigo'];?>');" style="font-size: 150%;"><a>
			</td>
		</tr>
	  <? } 
}
?>	
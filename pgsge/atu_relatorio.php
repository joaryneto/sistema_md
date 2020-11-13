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

$codigo = $_GET['codigo'];

if($_GET['ap'] == 1)
{
  $x = 0;
  $SQL1 = "SELECT turmas.codigo,turmas.descricao FROM turmas_professor 
  inner join turmas on turmas.codigo=turmas_professor.turma
  where turmas_professor.usuario=".$codigo."";
  $sucesso = mysqli_query($db,$SQL1);
  ?>
  <option value="">Escolher</option>
  <?
  while($row = mysqli_fetch_array($sucesso))
  {
 ?>
   <option value="<?=$row['codigo'];?>"><?=$row['descricao'];?></option>
 <?
  }
}
if($_GET['ap'] == 2)
{
  $x = 0;
  $SQL1 = "SELECT materias.codigo,materias.descricao FROM materias_professor 
  inner join materias on materias.codigo=materias_professor.materia
  where materias_professor.usuario=".$codigo."";
  $sucesso = mysqli_query($db,$SQL1);
  ?>
  <option value="">Escolher</option>
  <?
  while($row = mysqli_fetch_array($sucesso))
  {
  ?>
   <option value="<?=$row['codigo'];?>"><?=$row['descricao'];?></option>
  <?
  }
}

?>	
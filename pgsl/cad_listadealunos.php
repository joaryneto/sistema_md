<?

$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

if($_SESSION["donoSessao"]  != $tokenUser){
    header("location:login.php");
}

if($_GET['ap'] == 1)
{
?>
<table id="example23" class="display nowrap table table-hover table-striped table-bordered">
<thead>
<tr>
<th>Matricula</th>
<th>Aluno</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<? 

$sql = "SELECT * FROM matriculas where nome like '%".$_GET['pesquisa']."%' or nomepai like '%".$_GET['pesquisa']."%' or nomemae like '%".$_GET['pesquisa']."%'";
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr onclick="javascript: window.location='iniciado.php?url=cad_matriculas&codigo=<? echo $row['codigo'];?>';">
<td><? echo $row['matricula'];?></td>
<td><? echo $row['nome'];?></td>
<td><? Switch($row['status'])
            {
				case 0:
				echo "Inativo";
				break;
				case 1:
				echo "Ativo";
				break;
				case 2:
				echo "Pre-matricula";
				break;
			}?></td>
</tr>
<? 
}

if($res == false)
{
	echo "Nenhum resultado encontrado.";
}
	
?>
</tbody>
<tfoot>
<tr>
<th>Matricula</th>
<th>Aluno</th>
<th>Status</th>
</tr>
</tfoot>
</table>

<?
}
?>
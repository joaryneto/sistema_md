<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

if($_SESSION['menu11'] == false)
{
   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

if($_SESSION["donoSessao"]  != $tokenUser){
    header("location:login.php");
}

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

if(Empty($_GET['faturalimit']))
{
	print("<script>window.alert('Informe a data limite para faturamento.')</script>");
	$nada = true;
}
elseif(Empty($_GET['faturavenci']))
{
	print("<script>window.alert('Informe o mês de vencimento da faturamento.')</script>");
	$nada = true;
}
elseif(Empty($_GET['faturames']))
{
	print("<script>window.alert('Informe o mês de faturamento.')</script>");
	$nada = true;
}
else
{
	 
if($_GET['ap'] == 1)
{
?>
<table id="example23" class="display nowrap table table-hover table-striped table-bordered">
<thead>
<tr>
<th>X</th>
<th>CNPJ</th>
<th>Fantasia</th>
<th>Razão</th>
<th>Qtd</th>
</tr>
</thead>
<tbody>
<? 

if(Empty($_GET['cnpj']))
{
	$emp = " ";
}
else
{
	$emp = " and (empresa = '".$_GET['cnpj']."')";
}
	
$sql = "select empresas.*, count(laudos_enviados.codigo) as qtd_ex from laudos_enviados 
inner join empresas on laudos_enviados.empresa = empresas.cnpj 
where laudos_enviados.fatura = 0 and laudos_enviados.dataenvio <='".revertedata($_GET['faturalimit'])."' and laudos_enviados.status = 2 $emp group by empresas.cnpj";
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr>
<td><input type="checkbox" name="check[]" value="<? echo $row['cnpj'];?>" id="check[]"/></td>
<td><? echo $row['cnpj'];?></td>
<td><? echo $row['fantasia'];?></td>
<td><? echo $row['razao'];?></td>
<td><? echo $row['qtd_ex'];?></td>
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
<th>X</th>
<th>CNPJ</th>
<th>Fantasia</th>
<th>Razão</th>
<th>Qtd</th>
</tr>
</tfoot>
</table>

<?
}
}

if($nada == true)
{
	?>
<table id="example23" class="display nowrap table table-hover table-striped table-bordered">
<thead>
<tr>
<th>X</th>
<th>CNPJ</th>
<th>Fantasia</th>
<th>Razão</th>
<th>Qtd</th>
</tr>
</thead>
<tbody>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</tbody>
<tfoot>
<tr>
<th>X</th>
<th>CNPJ</th>
<th>Fantasia</th>
<th>Razão</th>
<th>Qtd</th>
</tr>
</tfoot>
</table>
	<?
}
?>
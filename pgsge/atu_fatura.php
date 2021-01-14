<?

require __DIR__.'/../link/api/vendor/autoload.php'; // caminho relacionado a SDK
 
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

if(@$_GET['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM matriculas left join usuarios on usuarios.matricula=matriculas.matricula where matriculas.nome like '%".$_GET['nome']."%' or usuarios.nome like '%".$_GET['nome']."%' limit 1;";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}

	if($x == 1)
	{
	    print('<script> swal("Atenção", "Aluno(a) ja cadastrado!"); </script>');
		//print("<script>window.location.href='sistema.php?url=cad_alunos&cadastro=1';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into matriculas(matricula,nome,estado,cidade,ensino,turma,status) values('".$_SESSION['matricula']."','".$_GET['nome']."','".$_GET['estado']."','".$_GET['cidade']."','".$_GET['ensino']."','".$_GET['turma']."','".$_GET['situacao']."');";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   $SQL2 = "INSERT into usuarios(login,senha,matricula,nome,tipo,status) values('".$_SESSION['matricula']."','".$_SESSION['matricula']."','".$_SESSION['matricula']."','".$_GET['nome']."',1,1);";
	   $sucesso = mysqli_query($db,$SQL2);
	   
	   if($sucesso)
	   {
		   print("<script> swal('Atenção', 'Aluno(a) Cadastrado com sucesso.'); </script>");
		   print("<script>window.location.href='sistema.php?url=cad_alunos';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
else if(@$_GET['ap'] == "2")
{
	$x = 0;
	$SQL = "SELECT * FROM matriculas 
	inner join usuarios on usuarios.matricula=matriculas.matricula 
	inner join turmas_professor on turmas_professor.turma=matriculas.turma 
	where matriculas.matricula='".$_GET['matricula']."' or usuarios.matricula='".$_GET['matricula']."' turmas_professor.usuario='".$_SESSION['usuario']."' limit 1;";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
    $SQL1 = "UPDATE matriculas SET nome='".$_GET['nome']."',estado='".$_GET['estado']."',cidade='".$_GET['cidade']."',ensino='".$_GET['ensino']."',turma='".$_GET['turma']."',status='".$_GET['situacao']."' where matricula='".$_GET['matricula']."';";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Atualizado com sucesso.');</script>");
		print("<script>window.location.href='sistema.php?url=cad_alunos';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
}
else if(@$_GET['ap'] == "3")
{

//$teste = explode(",",$_GET['codigo']);
	
//foreach($teste as $i)
//{
	
$faturavenc = revertemes($_GET['faturavenc']);
$faturames = revertemes($_GET['faturames']);
$qtd = $_GET['qtd'];
$tipo = $_GET['tipo'];	

   $clientId = 'Client_Id_1d8fb8f88da5df061405de8f9d9b4972f324f624';// insira seu Client_Id, conforme o ambiente (Des ou Prod)
   $clientSecret = 'Client_Secret_61e5960ca320869c108e7cf3f68037bf34fffe40'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)

    $options = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = producao)
    ];
    
$charge_id = '1226863';

// $charge_id refere-se ao ID da transação gerada anteriormente
$params = [
  'id' => $charge_id
];
 
$customer = [
  'name' => 'Gorbadoc Oldbuck', // nome do cliente
  'cpf' => '94271564656', // cpf válido do cliente
  'phone_number' => '5144916523' // telefone do cliente
];
 
$bankingBillet = [
  'expire_at' => '2021-01-17' // data de vencimento do boleto (formato: YYYY-MM-DD)
  'customer' => $customer
];
 
$payment = [
  'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
];
 
$body = [
  'payment' => $payment
];
 
try {
    $api = new Gerencianet($options);
    $charge = $api->payCharge($params, $body);
 
    print_r($charge);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}

 //}
}


if($_GET['load'] == 1)
{
	      if(isset($_GET['pesquisa']))
		  {
			  $whe1 = " and matriculas.nome like '%".$_GET['pesquisa']."%'";
		  }
		  
		  if(isset($_GET['ano']))
		  {
			  $whe2 = " and YEAR(matriculas.ano)='".$_GET['ano']."'";
		  }
		  
		  $sql = "select matriculas.codigo, matriculas.matricula,matriculas.ano,matriculas.nome,matriculas.nome,turmas.descricao,matriculas.status from matriculas 
		  inner join  turmas on turmas.codigo=matriculas.turma  
		  where matriculas.status=1 and YEAR(matriculas.ano)='2020' $whe1 $whe1 limit 20";
		  $res = mysqli_query($db,$sql); 
		  while($row = mysqli_fetch_array($res))
		  {
			  
			  
		  ?>
		    <tr>
			  <td data-title="CheckBox"><input type="checkbox" name="check[]" id="check[]" value=""></td>
              <td data-title="Matricula"><?=$row['matricula'];?></td>
              <td data-title="Nome do Aluno"><?=$row['nome'];?></td>
			  <td data-title="Turma"><?=$row['descricao'];?></td>
			  <td data-title="Ano Letivo"><?=date('Y', strtotime($row['ano']));?></td>
			</tr>
	<? } ?>
<?
}

?>
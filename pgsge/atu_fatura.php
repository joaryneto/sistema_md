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

   $clientId = 'informe_seu_client_id';// insira seu Client_Id, conforme o ambiente (Des ou Prod)
   $clientSecret = 'informe_seu_client_secret'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)

    $options = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = producao)
    ];
    
   $item_1 = [
       'name' => 'Item 1', // nome do item, produto ou serviço
       'amount' => 1, // quantidade
       'value' => 1000 // valor (1000 = R$ 10,00) (Obs: É possível a criação de itens com valores negativos. Porém, o valor total da fatura deve ser superior ao valor mínimo para geração de transações.)
   ];
   $items = [
       $item_1
   ];
   $metadata = array('notification_url'=>'sua_url_de_notificacao_.com.br'); //Url de notificações
   $customer = [
       'name' => 'Gorbadoc Oldbuck', // nome do cliente
       'cpf' => '94271564656', // cpf válido do cliente
       'phone_number' => '5144916523', // telefone do cliente
   ];
   $discount = [ // configuração de descontos
       'type' => 'currency', // tipo de desconto a ser aplicado
       'value' => 599 // valor de desconto 
   ];
   $configurations = [ // configurações de juros e mora
       'fine' => 200, // porcentagem de multa
       'interest' => 33 // porcentagem de juros
   ];
   $conditional_discount = [ // configurações de desconto condicional
       'type' => 'percentage', // seleção do tipo de desconto 
       'value' => 500, // porcentagem de desconto
       'until_date' => '2021-08-30' // data máxima para aplicação do desconto
   ];
   $bankingBillet = [
       'expire_at' => '2021-07-01', // data de vencimento do titulo
       'message' => 'teste\nteste\nteste\nteste', // mensagem a ser exibida no boleto
       'customer' => $customer,
       'discount' =>$discount,
       'conditional_discount' => $conditional_discount
   ];
   $payment = [
       'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
   ];
   $body = [
       'items' => $items,
       'metadata' =>$metadata,
       'payment' => $payment
   ];
   try {
     $api = new Gerencianet($options);
     $pay_charge = $api->oneStep([],$body);
     echo '<pre>';
     print_r($pay_charge);
     echo '<pre>';
     
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
<?

require __DIR__.'/../link/api/vendor/autoload.php'; // caminho relacionado a SDK
 
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

if(@$_GET['ap'] == "3")
{

$faturavenc = revertemes($_GET['faturavenc']);
$tipo = @$_GET['tipo'];	

$teste = explode(",",$_GET['codigo']);
	
foreach($teste as $i)
{
	
	
$SQL = "SELECT v_matricula,v_rematricula,f_vencimento FROM matriculas where sistema='".$_SESSION['sistema']."' and codigo='".$i."'";
$RES = mysqli_query($db,$SQL);
while($row = mysqli_fetch_array($RES))
{
  $diavcm = $row['f_vencimento'];
  $tipo = $_GET['tipo'];
  
  $clientId = 'Client_Id_1d8fb8f88da5df061405de8f9d9b4972f324f624'; // insira seu Client_Id, conforme o ambiente (Des ou Prod)
  $clientSecret = 'Client_Secret_61e5960ca320869c108e7cf3f68037bf34fffe40'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)
 
  $options = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = producao)
  ];
  
  if($tipo == 1)
  {
	  $descri = "Matrícula";
	  $valor = ''.$row['v_matricula'].'';
  }
  else if($tipo == 2)
  {
	  $descri = "Rematricula";
	  $valor = ''.$row['v_rematricula'].'';
  }
 
  $item_1 = [
     'name' => $descri, // nome do item, produto ou serviço
     'amount' => 1, // quantidade
     'value' => intval($valor) // valor (1000 = R$ 10,00) (Obs: É possível a criação de itens com valores negativos. Porém, o valor total da fatura deve ser superior ao valor mínimo para geração de transações.)
  ];
 
  $items =  [
     $item_1
  ];

   // Exemplo para receber notificações da alteração do status da transação.
   // $metadata = ['notification_url'=>'sua_url_de_notificacao_.com.br']
   // Outros detalhes em: https://dev.gerencianet.com.br/docs/notificacoes

   // Como enviar seu $body com o $metadata
   // $body  =  [
   //    'items' => $items,
   //    'metadata' => $metadata
   // ];

   $metadata = array('notification_url'=>'http://escola.ectecnologia.com.br/notificacao.php');

   $body  =  [
      'items' => $items,
	  'metadata' => $metadata
   ];

   try {
	
     $api = new Gerencianet($options);
     $charge = $api->createCharge([], $body);

     if($charge["code"] == "200")
	 {
	    $id = $charge["data"]["charge_id"];
	    $status = $charge["data"]["status"];
	    $criado = $charge["data"]["created_at"];

	    switch($status)
	    {
		    case "new":
		    $st = 1; // Novo
	    	break;
		    case "waiting":
	     	$st = 2; // Aguardando
		    break;
		    default:
	    	break;
     	}
	
	    $faturavenc = $faturavenc."-".$diavcm;
	    // '".."',
	    $SQL = "insert into faturas(sistema,usuario,cliente,valor,data,vencimento,charge_id,tipo,status) values('".$_SESSION['sistema']."','".$_SESSION['usuario']."','".$i."','".$valor."','".$criado."','".$faturavenc."','".$id."','".$tipo."','".$st. "');";
	    $RES = mysqli_query($db,$SQL);
		
		?>
		<script>
		swal({   
			title: "Atenção",   
			text: "Faturas geradas com sucesso...",   
			timer: 1500,   
			showConfirmButton: false 
		});
		
		requestPage2('?br=atu_fatura&load=2','list1','GET');
		</script>
		<?
	 }
    } catch (GerencianetException $e) 
    {
       print_r($e->code);
       print_r($e->error);
       print_r($e->errorDescription);
    } catch (Exception $e) 
    { 
       print_r($e->getMessage());
    }
   }
  }
}
else if(@$_GET['ap'] == "4")
{

$teste = explode(",",$_GET['codigo']);
	
foreach($teste as $i)
{

$SQL = "SELECT faturas.linkboleto,faturas.pdfboleto,faturas.vencimento, matriculas.cpf, matriculas.nome,faturas.charge_id FROM faturas 
inner join matriculas on matriculas.codigo=faturas.cliente
where faturas.sistema='".$_SESSION['sistema']."' and faturas.charge_id='".$i."'";
$RES = mysqli_query($db,$SQL);
$RESS = mysqli_fetch_array($RES);

if(isset($RESS['linkboleto']))
{
	$link = $RESS["linkboleto"];
    $pdf = $RESS["pdfboleto"];
	
	?>
<script>
$('.bl-abrir').on('click',function()
{
   open("<?=$link;?>");
});

$('.bl-baixar').on('click',function()
{
   open("<?=$pdf;?>");
});
</script>
<div class="modal-header">
<h2 class="pmd-card-title-text">Boleto </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="form-group col-md-12 m-t-20">
<button type="button" class="btn btn-info bl-abrir" style="margin: 2px;"><i class="fa fa-plus-circle" ></i> Visualizar Boleto</button>
<button type="button" class="btn btn-info bl-baixar" style="margin: 2px;"><i class="fa fa-plus-circle" ></i> Baixar Boleto</button>
</div>
<div>
</div>
</form>										 
<div class="modal-footer">
</div>
	
	<?

}
else
{

$clientId = 'Client_Id_1d8fb8f88da5df061405de8f9d9b4972f324f624';// insira seu Client_Id, conforme o ambiente (Des ou Prod)
$clientSecret = 'Client_Secret_61e5960ca320869c108e7cf3f68037bf34fffe40'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)

$options = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = producao)
];
    
$charge_id = ''.$RESS['charge_id'].'';

// $charge_id refere-se ao ID da transação gerada anteriormente
$params = [
  'id' => $charge_id
];
 
$customer = [
  'name' => $RESS['nome'], // nome do cliente
  'cpf' => $RESS['cpf'], // cpf válido do cliente
  'phone_number' => '65999999104' // telefone do cliente
];
 
$bankingBillet = [
  'expire_at' => $RESS['vencimento'], // data de vencimento do boleto (formato: YYYY-MM-DD)
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

	$charge_id = $charge["data"]["charge_id"];
	$status = $charge["data"]["status"];
	$link = $charge["data"]["link"];
	$pdf = $charge["data"]["pdf"]["charge"];
	
	switch($status)
	    {
		    case "new":
		    $st = 1; // Novo
	    	break;
		    case "waiting":
	     	$st = 2; // Aguardando
		    break;
		    default:
	    	break;
     	}
	
	$SQL = "UPDATE faturas SET linkboleto='".$link."', pdfboleto='".$pdf."', status='".$st."' where sistema='".$_SESSION['sistema']."' and charge_id='".$charge_id."'";
	$RES = mysqli_query($db,$SQL);
	
	?>
<script>
$('.bl-abrir').on('click',function()
{
   open("<?=$link;?>");
});

$('.bl-baixar').on('click',function()
{
   open("<?=$pdf;?>");
});
</script>
<div class="modal-header">
<h2 class="pmd-card-title-text">Boleto </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="form-group col-md-5 m-t-20">
<button type="button" class="btn btn-info bl-abrir" style="margin: 2px;"><i class="fa fa-plus-circle" ></i> Visualizar Boleto</button>
<button type="button" class="btn btn-info bl-baixar" style="margin: 2px;"><i class="fa fa-plus-circle" ></i> Baixar Boleto</button>
</div>
<div>
</div>
</form>										 
<div class="modal-footer">
</div>
	
	<?

  } catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
  } catch (Exception $e) 
  {
    print_r($e->getMessage());
  }

  }
 }
}
else if(@$_GET['ap'] == "5")
{

$_SESSION['charge_id'] = @$_GET['codigo'];

if(@$_GET['alter'] == 1)
{
	
$_SESSION['vencimento'] = revertedata(@$_GET['venc']); 
$charge_id = $_SESSION['charge_id'];

$clientId = 'Client_Id_1d8fb8f88da5df061405de8f9d9b4972f324f624';// insira seu Client_Id, conforme o ambiente (Des ou Prod)
$clientSecret = 'Client_Secret_61e5960ca320869c108e7cf3f68037bf34fffe40'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)

$options = [
  'client_id' => $clientId,
  'client_secret' => $clientSecret,
  'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = producao)
];
 
// $charge_id refere-se ao ID da transação gerada anteriormente
$params = [
  'id' => $charge_id
];

$body = [
  'expire_at' => ''.$_SESSION['vencimento'].''
];

    $SQL = "UPDATE faturas SET vencimento='".$_SESSION['vencimento']."' where sistema='".$_SESSION['sistema']."' and charge_id='".$charge_id."'";
	mysqli_query($db,$SQL);

try {
      $api = new Gerencianet($options);
      $charge = $api->updateBillet($params, $body);
      print_r($charge);
    } catch (GerencianetException $e) {
      print_r($e->code);
      print_r($e->error);
      print_r($e->errorDescription);
    } catch (Exception $e) {
      print_r($e->getMessage());
    }
}
else
{
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Alterar vencimento </h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<script>

$('.at-vcm').on('click',function()
{	
   var venc = document.getElementById('venc').value;
   var mes = document.getElementById('mes1').value;
   
   if(venc == "")
   {
	   swal({   
		   title: "Atenção",   
		   text: "Informe uma data de vencimento.",   
		   timer: 2000,   
			showConfirmButton: false 
	   });
   }
   else								   
   {
	   $('#modalap').modal('hide');
	   requestPage2('?br=atu_fatura&venc='+ venc +'&mes='+ mes +'&ap=5&alter=1&load=2','list1','GET');
   }
});
								
$('.data').mask('00/00/0000');

jQuery('.data').datepicker({
      format: 'dd/mm/yyyy',
	  autoclose: true,
	  todayHighlight: true,
	  orientation: "bottom left",
	  startDate: "-0d"
});
</script>
<form class="form-horizontal">
<div class="form-group col-md-6 m-t-20">
<label for="message-text" class="control-label">* Quando irá vencer? :</label>
   <input type="text" name="venc" id="venc" value="" autocomplete="off" class="form-control  data">
</div>
<div class="form-group col-md-12 m-t-20">
<button type="button" class="btn btn-info at-vcm" style="margin: 2px;"><i class="fa fa-plus-circle" ></i> Confirmar</button>
</div>
<div>
</div>
</form>										 
<div class="modal-footer">
</div>
 <?
 }
}

if(@$_GET['load'] == 1)
{
	$mes = $_GET['mes'];
	$tipo = $_GET['tipo'];
	
	if(isset($_GET['pesquisa']))
	{
			  $whe1 = " and matriculas.nome like '%".$_GET['pesquisa']."%'";
	}
		  
	if(isset($_GET['mes']))
	{
		$whe2 = " and month(matriculas.ano)='".$_GET['mes']."' and YEAR(matriculas.ano)='".$ano."'";
	}
		  
	$sql = "select matriculas.codigo, matriculas.matricula,matriculas.ano,matriculas.nome,matriculas.nome,turmas.descricao,matriculas.status from matriculas 
	inner join  turmas on turmas.codigo=matriculas.turma  
	where matriculas.status=1 and YEAR(matriculas.ano)='2020' $whe1 $whe1 limit 20";
	$res = mysqli_query($db,$sql); 
	while($row = mysqli_fetch_array($res))
	{  
		$x = 0;
		$SQL = "SELECT * FROM faturas where cliente='".$row['codigo']."' and YEAR(data)='".$ano."' and MONTH(data)='".$mes."' and tipo='".$tipo."'";
		$RES = mysqli_query($db,$SQL);
		while($row2 = mysqli_fetch_array($RES))
		{
			$x = 1;
		}

        if($x == 0)
		{
		  ?>
		    <tr>
			  <td data-title="CheckBox"><input type="checkbox" name="check[]" id="check[]" class="all2" value="<?=$row['codigo'];?>"></td>
              <td data-title="Matricula"><?=$row['matricula'];?></td>
              <td data-title="Nome do Aluno"><?=$row['nome'];?></td>
			  <td data-title="Turma"><?=$row['descricao'];?></td>
			  <td data-title="Ano Letivo"><?=date('Y', strtotime($row['ano']));?></td>
			</tr>
    <? 
		}	
	} ?>
<?
}
else if(@$_GET['load'] == 2)
{
	$whe1 = "";
	$whe2 = "";

	$mes = $_GET['mes'];

	if(isset($_GET['pesquisa']))
	{
		$whe1 = " and matriculas.nome like '%".$_GET['pesquisa']."%'";
	}
		  
	if(isset($_GET['mes']))
	{
		$whe2 = " month(faturas.data)='".$_GET['mes']."' and YEAR(faturas.data)='".$ano."'";
	}
  
	$sql = "select faturas.codigo,faturas.charge_id, faturas.data, faturas.vencimento, faturas.valor, faturas.status, faturas.tipo, matriculas.nome, matriculas.matricula,turmas.descricao, matriculas.ano from faturas 
	inner join matriculas on matriculas.codigo=faturas.cliente 
	inner join turmas on turmas.codigo=matriculas.turma  
	where $whe2 $whe1";
	$res = mysqli_query($db,$sql); 
	while($row = mysqli_fetch_array($res))
	{  
		  Switch($row['tipo'])
		  {
			  case 1:
			  $tipo = "Matrícula";
			  break;
			  case 2:
			  $tipo = "Rematricula";
			  break;
		  }
		  
		  Switch($row['status'])
		  {
			  case 1:
			  $status = '<span style="color:blue;">Novo</span>';
			  break;
			  case 2:
			  $status = '<span style="color:blue;">Aguardando</span>';
			  break;
			  case 3:
			  $status = '<span style="color:green;">Pago</span>';
			  break;
			  case 4:
			  $status = "Não Pago";
			  break;
		  }
		  
		  ?>
		    <tr>
			  <td data-title="CheckBox"><input type="checkbox" name="check[]" id="check[]" class="all1" value="<?=$row['charge_id'];?>"></td>
              <td data-title="Fatura"><?=$row['codigo'];?></td>
              <td data-title="Nome do Aluno"><?=$row['nome'];?></td>
			  <td data-title="Turma"><?=$row['descricao'];?></td>
			  <td data-title="Valor R$"><? 
			  echo valor($row['valor']/100,2);
			  ?></td>
			  <td data-title="Vencimento"><?=formatodata($row['vencimento']);?></td>
			  <td data-title="Data Criado"><?=formatodata($row['data']);?></td>
			  <td data-title="Tipo"><?=$tipo;?></td>
			  <td data-title="Status"><?=$status;?></td>
			  <td data-title="Opções">
			  <div class="dropdown">
                  <button class="btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary pmd-dropdown-hover" type="button" title="Boleto" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
              <span class="pmd-floating-hidden">Cadastrar</span> 
                 <i class="material-icons">view_column</i> 
             </button>
                 <span class="caret"></span>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
					  <li><div class="dropdown-divider"><?=$row['codigo'];?></div></li>
                       <li><a class="dropdown-item" href="javascript:void(0);" onclick="viwer(<?=$row['charge_id'];?>,4);"> Visualizar Boleto</a></li>
                       <li><a class="dropdown-item" href="javascript:void(0);"> Cancelar Cobrança</a></li>
					   <li><div class="dropdown-divider"></div></li>
                       <li><a class="dropdown-item" href="javascript:void(0);"> Reenviar cobrança por Email</a></li>
                       <li><div class="dropdown-divider"></div></li>
					   <li><a class="dropdown-item" href="javascript:void(0);" onclick="viwer(<?=$row['charge_id'];?>,5);"> Emitir nova cobrança</a></li>
                       <li><a class="dropdown-item" href="javascript:void(0);"> Marcar como Paga</a></li>
                     </ul>
               </div></td>
			</tr>
    <? 
		
	} ?>
<?
}
else if(@$_GET['load'] == 3)
{

	$sql = "select faturas.codigo,faturas.charge_id, faturas.data, faturas.vencimento, faturas.valor, faturas.status, faturas.tipo, matriculas.nome, matriculas.matricula,turmas.descricao, matriculas.ano from faturas 
	inner join matriculas on matriculas.codigo=faturas.cliente 
	inner join turmas on turmas.codigo=matriculas.turma  
	where faturas.cliente='".$_GET['codigo']."'";
	$res = mysqli_query($db,$sql); 
	while($row = mysqli_fetch_array($res))
	{  
		  Switch($row['tipo'])
		  {
			  case 1:
			  $tipo = "Todos";
			  break;
			  case 2:
			  $tipo = "";
			  break;
		  }
		  
		  Switch($row['status'])
		  {
			  case 1:
			  $status = '<span style="color:blue;">Novo</span>';
			  break;
			  case 2:
			  $status = '<span style="color:blue;">Aguardando</span>';
			  break;
			  case 3:
			  $status = '<span style="color:green;">Pago</span>';
			  break;
			  case 4:
			  $status = "Não Pago";
			  break;
		  }
		  ?>
		    <tr>
			  <td data-title="CheckBox"><input type="checkbox" name="check[]" id="check[]" class="all" value="<?=$row['charge_id'];?>"></td>
              <td data-title="Fatura"><?=$row['codigo'];?></td>
              <td data-title="Nome do Aluno"><?=$row['nome'];?></td>
			  <td data-title="Turma"><?=$row['descricao'];?></td>
			  <td data-title="Valor R$"><? 
			  echo valor($row['valor']/100,2);
			  ?></td>
			  <td data-title="Vencimento"><?=formatodata($row['vencimento']);?></td>
			  <td data-title="Data Criado"><?=formatodata($row['data']);?></td>
			  <td data-title="Tipo"><?=$tipo;?></td>
			  <td data-title="Status"><?=$status;?></td>
			  <td data-title="Opções">
			  <button class="btn btn-sm pmd-btn-fab pmd-btn-raised pmd-ripple-effect btn-primary" type="button" onclick="viwer(<?=$row['charge_id'];?>);" title="Boleto"> 
                <span class="pmd-floating-hidden">Cadastrar</span> 
                   <i class="material-icons">payment</i> 
              </button></td>
			</tr>
    <? 
		
	} ?>
<?
}

?>
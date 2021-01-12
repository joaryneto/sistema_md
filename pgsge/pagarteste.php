<?php
 
require __DIR__.'/../link/api/vendor/autoload.php'; // caminho relacionado a SDK
 
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;
 
$clientId = 'Client_Id_1d8fb8f88da5df061405de8f9d9b4972f324f624'; // insira seu Client_Id, conforme o ambiente (Des ou Prod)
$clientSecret = 'Client_Secret_61e5960ca320869c108e7cf3f68037bf34fffe40'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)
 
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
 
$item_2 = [
    'name' => 'Item 2', // nome do item, produto ou serviço
    'amount' => 2, // quantidade
    'value' => 2000 // valor (2000 = R$ 20,00)
];
 
$items =  [
    $item_1,
    $item_2
];

// Exemplo para receber notificações da alteração do status da transação.
// $metadata = ['notification_url'=>'sua_url_de_notificacao_.com.br']
// Outros detalhes em: https://dev.gerencianet.com.br/docs/notificacoes

// Como enviar seu $body com o $metadata
// $body  =  [
//    'items' => $items,
//    'metadata' => $metadata
// ];

//$metadata = array('notification_url'=>'http://sua_url_aqui');

$body  =  [
    'items' => $items
	//'metadata' => $metadata
];

try {
    $api = new Gerencianet($options);
    $charge = $api->createCharge([], $body);
 
    print_r($charge);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}
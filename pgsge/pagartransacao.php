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

// $charge_id refere-se ao ID da transação gerada anteriormente

$charge_id = '1226531';

$params = [
  'id' => $charge_id
];

$body = [
  'billet_discount' => 1000, // desconto, em reais, caso o pagador escolha boleto (5000 equivale a R$ 50,00)
  'card_discount' => 1000, // desconto, em reais, caso o pagador escolha cartão (3000 equivale a R$ 30,00)
  'message' => '', // mensagem para o pagador com até 80 caracteres
  'expire_at' => '2021-01-20', // data de vencimento da tela de pagamento e do próprio boleto
  'request_delivery_address' => false, // solicitar endereço de entrega do comprador?
  'payment_method' => 'all' // formas de pagamento disponíveis
];

try {
  $api = new Gerencianet($options);
  $response = $api->linkCharge($params, $body);
  print_r($response);
} catch (GerencianetException $e) {
  print_r($e->code);
  print_r($e->error);
  print_r($e->errorDescription);
} catch (Exception $e) {
  print_r($e->getMessage());
}



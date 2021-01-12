<?php

require __DIR__ . '/../api/vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$clientId = 'Informe_aqui_seu_Client_Id'; // informe seu Client_Id
$clientSecret = 'Informe_aqui_seu_Client_Secret'; // informe seu Client_Secret

$options = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = produção)
];

if (isset($_POST)) {

    $item_1 = [
        'name' => $_POST["descricao"],
        'amount' => (int) $_POST["quantidade"],
        'value' => (int) $_POST["valor"]
    ];

    $items = [
        $item_1
    ];

    $body = ['items' => $items];

    try {
        $api = new Gerencianet($options);
        $charge = $api->createCharge([], $body);


        if ($charge["code"] == 200) {

            $params = ['id' => $charge["data"]["charge_id"]];

            $body = [
              //'billet_discount' => 1,
              //'card_discount' => 1,
              'message' => $_POST["message"],
              'expire_at' => $_POST["vencimento"],
              //'request_delivery_address' => (boolean) $_POST["request"],
			  'request_delivery_address' => (boolean) $_POST["request"],
              'payment_method' => $_POST["method"]
            ];

            //$body = ['payment' => $payment];

            $api = new Gerencianet($options);
            $response = $api->linkCharge($params, $body);
            echo json_encode($response);
            
        } else {

        }
    } catch (GerencianetException $e) {
        print_r($e->code);
        print_r($e->error);
        print_r($e->errorDescription);
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
}
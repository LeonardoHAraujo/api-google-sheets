<?php

require 'vendor/autoload.php';

use Source\Controllers\SheetController;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$app->post('/', function($req, $res) {

    /*
    // Valid key and url
    $validKey = "kfhk@dhfkl@hdkfh@kl18855091e23kfhk@dhfklahdkfhakldhfaklh8318051218855091e23";
    $validUrl = "https://cnu-portal.touchpoint.privally.global/";
    
    // Source key and url
    $keySource = $req->getQueryParams();
    $urlSource = $_SERVER["HTTP_REFERER"];

    // Validate key and url
    if(!isset($keySource['key']) || !isset($urlSource) || 
        $keySource['key'] !== $validKey || 
        $urlSource !== $validUrl) {

        $info = [
            "Status" => 403,
            "Success" => false,
            "Message" => "Url ou chave de acesso não autorizada!"
        ];

        return $res->withJson($info);

    }
    */
    
    $inputs = $req->getParsedBody();

    if(count($inputs) != 19 || empty($inputs)) {
        return $res->withJson([ 'message' => 'Dados preenchidos incorretamente' ]);
    }

    return SheetController::saveData($inputs);
    
});

$app->run();
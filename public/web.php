<?php

require '../vendor/autoload.php';

set_error_handler("customError", E_ALL);

$response = \Coreproc\HealthChecks\UncacheableResponse::create();

$return = [
    'status'  => 200,
    'message' => 'OK'
];

$response->headers->set('Content-Type', 'application/json');
$response->setContent(json_encode($return));
$response->setStatusCode(200);

$response->send();
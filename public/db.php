<?php

require '../vendor/autoload.php';

// set custom error handler for ALL erros
set_error_handler("customError", E_ALL);

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$dbHost = getenv('DB_HOST');
$dbDatabase = getenv('DB_DATABASE');
$dbUsername = getenv('DB_USERNAME');
$dbPassword = getenv('DB_PASSWORD');

$response = \Coreproc\HealthChecks\UncacheableResponse::create();

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbDatabase);

// Check if there are connection errors
if ($conn->connect_error) {
    $return = [
        'status'      => '500',
        'message'     => 'Internal Server Error',
        'description' => $conn->connect_error
    ];

    $response->setContent(json_encode($return));
    $response->headers->set('Content-Type', 'application/json');
    $response->setStatusCode(500);

    $response->send();
    return;
}

$return = [
    'status'  => 200,
    'message' => 'OK'
];

$response->setContent(json_encode($return));
$response->headers->set('Content-Type', 'application/json');
$response->setStatusCode(200);

$response->send();
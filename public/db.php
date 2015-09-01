<?php

// Turn off PHP warning if we can't connect to the database server
error_reporting(E_ERROR | E_PARSE);

require '../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$dbHost = getenv('DB_HOST');
$dbDatabase = getenv('DB_DATABASE');
$dbUsername = getenv('DB_USERNAME');
$dbPassword = getenv('DB_PASSWORD');

$response = new \Symfony\Component\HttpFoundation\Response();

// We set headers so it definitely does not cache
$response->headers->set('Cache-Control', [
    'no-store',
    'no-cache',
    'must-revalidate',
    'max-age=0',
]);
$response->headers->set('Cache-Control', [
    'post-check=0',
    'pre-check=0',
], false);
$response->headers->set('Pragma', [
    'no-cache',
]);

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
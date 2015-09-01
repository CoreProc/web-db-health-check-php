<?php

require '../vendor/autoload.php';

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

$return = [
    'status'  => 200,
    'message' => 'OK'
];

$response->setContent(json_encode($return));
$response->headers->set('Content-Type', 'application/json');
$response->setStatusCode(200);

$response->send();
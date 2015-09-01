<?php

if ( ! function_exists('customError')) {

    function customError($errorNo, $errorString)
    {
        $response = \Coreproc\HealthChecks\UncacheableResponse::create();

        $return = [
            'status'      => 500,
            'message'     => 'Internal Server Error',
            'description' => "[{$errorNo}] {$errorString}"
        ];

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($return));
        $response->setStatusCode(500);

        $response->send();
        die();
    }

}
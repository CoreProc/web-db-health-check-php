<?php

namespace Coreproc\HealthChecks;

use Symfony\Component\HttpFoundation\Response;

class UncacheableResponse
{

    /**
     * @return Response
     */
    public static function create()
    {
        $response = new Response();

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

        return $response;
    }

}
<?php

namespace App\ResponseResolver;

use App\System\Request;
use App\System\Response;

class TestResponseResolver
{
    public function getAction(Request $request): Response
    {
        return new Response('hello from test controller method get', '200');
    }
}
<?php

namespace App\System;

class RequestFactory
{
    public function create(string $uri, string $method, ?array $get, ?array $post)
    {
        return new Request($uri, $method, new RequestParameters($get ?? [], $post ?? []));
    }
}
<?php

namespace App\System;

class Request
{
    private $uri;
    private $method;
    private $parameters;

    public function __construct(string $uri, string $method, RequestParameters $parameters)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->parameters = $parameters;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParameters(): RequestParameters
    {
        return $this->parameters;
    }
}
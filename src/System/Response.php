<?php

namespace App\System;

class Response
{
    private $body;
    private $code;

    public function __construct(string $body, string $code)
    {
        $this->code = $code;
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
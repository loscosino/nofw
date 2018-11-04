<?php

namespace App\System;

class RequestParameters
{
    private $get;
    private $post;

    public function __construct(array $get, array $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function getGet(string $key)
    {
        return $this->get[$key];
    }

    public function hasGet(string $key): bool
    {
        return isset($this->get[$key]);
    }

    public function getPost(string $key)
    {
        return $this->post[$key];
    }

    public function hasPost(string $key): bool
    {
        return isset($this->post[$key]);
    }
}
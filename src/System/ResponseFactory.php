<?php

namespace App\System;

use App\ResponseResolver\SpaceResponseResolver;
use DI\Container;

class ResponseFactory
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function create(Request $request): Response
    {
        $routing = [//todo do osobnego pliku
            '/test' => [
                'class' => \App\ResponseResolver\TestResponseResolver::class,
                'GET' => 'getAction',
            ],
            '/vehicle' => [
                'class' => \App\ResponseResolver\VehicleResponseResolver::class,
                'GET' => 'getAction',
                'POST' => 'addAction',
                'DELETE' => 'deleteAction',
            ],
            '/park' => [
                'class' => SpaceResponseResolver::class,
                'POST' => 'takeAction',
            ]
        ];

        if (
            !isset($routing[$request->getUri()]) ||
            !isset($routing[$request->getUri()]['class']) ||
            !isset($routing[$request->getUri()][$request->getMethod()])
        ) {
            return new Response('not found', 404);
        }

        $class = $routing[$request->getUri()]['class'];
        $method = $routing[$request->getUri()][$request->getMethod()];

        return $this->container->get($class)->{$method}($request);
    }
}
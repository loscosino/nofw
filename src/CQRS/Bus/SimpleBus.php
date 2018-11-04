<?php

namespace App\CQRS\Bus;

use DI\Container;

class SimpleBus
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function handle($intention): void
    {
        $class = get_class($intention);
        $handler = $this->resolveHandler($class);
        $handler->handle($intention);
    }

    private function resolveHandler(string $intentionClass)
    {
        $bus = [
            \App\CQRS\Intention\AddVehicleIntention::class => \App\CQRS\Handler\AddVehicleHandler::class,
            \App\CQRS\Intention\DeleteVehicleIntention::class => \App\CQRS\Handler\DeleteVehicleHandler::class,
            \App\CQRS\Intention\ParkIntention::class => \App\CQRS\Handler\ParkHandler::class,
        ];

        $handlerClass = $bus[$intentionClass] ?? null;

        if (null !== $handlerClass && $this->container->has($handlerClass)) {
            return $this->container->get($handlerClass);
        }
        throw new \Exception('could not resolve handler');
    }
}
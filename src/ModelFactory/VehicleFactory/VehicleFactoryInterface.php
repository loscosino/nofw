<?php

namespace App\ModelFactory\VehicleFactory;

interface VehicleFactoryInterface
{
    public function create(string $id, string $number);
    public function isSupported(string $type): bool;
}
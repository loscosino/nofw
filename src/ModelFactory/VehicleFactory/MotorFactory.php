<?php

namespace App\ModelFactory\VehicleFactory;

use App\Model\Motor;

class MotorFactory implements VehicleFactoryInterface
{
    public function isSupported(string $type): bool
    {
        return Motor::TYPE === $type;
    }

    public function create(string $id, string $number): Motor
    {
        return new Motor($id, $number);
    }
}
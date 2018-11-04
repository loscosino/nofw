<?php

namespace App\ModelFactory\VehicleFactory;

use App\Model\Car;

class CarFactory implements VehicleFactoryInterface
{
    public function isSupported(string $type): bool
    {
        return Car::TYPE === $type;
    }

    public function create(string $id, string $number): Car
    {
        return new Car($id, $number);
    }
}
<?php

namespace App\ModelFactory\VehicleFactory;

use App\Model\Bus;

class BusFactory implements VehicleFactoryInterface
{
    public function isSupported(string $type): bool
    {
        return Bus::TYPE === $type;
    }

    public function create(string $id, string $number): Bus
    {
        return new Bus($id, $number);
    }
}
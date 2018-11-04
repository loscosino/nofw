<?php

namespace App\ModelFactory;

use App\Model\VehicleInterface;
use App\ModelFactory\VehicleFactory\BusFactory;
use App\ModelFactory\VehicleFactory\CarFactory;
use App\ModelFactory\VehicleFactory\MotorFactory;

class VehicleFactory
{
    private $busFactory;
    private $carFactory;
    private $motorFactory;

    public function __construct(BusFactory $busFactory, CarFactory $carFactory, MotorFactory $motorFactory)
    {
        $this->busFactory = $busFactory;//todo inject whole collection and iterate over it
        $this->carFactory = $carFactory;
        $this->motorFactory = $motorFactory;
    }

    public function create(string $id, string $type, string $number): VehicleInterface
    {
        if ($this->busFactory->isSupported($type)) {
            return $this->busFactory->create($id, $number);
        }
        if ($this->carFactory->isSupported($type)) {
            return $this->carFactory->create($id, $number);
        }
        if ($this->motorFactory->isSupported($type)) {
            return $this->motorFactory->create($id, $number);
        }

        throw new \Exception();
    }
}
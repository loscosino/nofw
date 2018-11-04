<?php

namespace App\CQRS\Handler;

use App\CQRS\Intention\AddVehicleIntention;
use App\ModelFactory\VehicleFactory;
use App\Storage\VehicleShelf;

class AddVehicleHandler
{
    private $vehicleShelf;
    private $vehicleFactory;

    public function __construct(VehicleShelf $vehicleShelf, VehicleFactory $vehicleFactory)
    {
        $this->vehicleShelf = $vehicleShelf;
        $this->vehicleFactory = $vehicleFactory;
    }

    public function handle(AddVehicleIntention $intention): void
    {
        $model = $this->vehicleFactory->create($intention->getId(), $intention->getType(), $intention->getRegistrationNumber());
        $this->vehicleShelf->add($model);
    }
}
<?php

namespace App\CQRS\Handler;

use App\CQRS\Intention\ParkIntention;
use App\Storage\SpaceShelf;
use App\Storage\VehicleShelf;

class ParkHandler
{
    private $vehicleShelf;
    private $spaceShelf;

    public function __construct(VehicleShelf $vehicleShelf, SpaceShelf $spaceShelf)
    {
        $this->vehicleShelf = $vehicleShelf;
        $this->spaceShelf = $spaceShelf;
    }

    public function handle(ParkIntention $parkIntention): void
    {
        $vehicle = $this->vehicleShelf->take($parkIntention->getVehicleId());
        $space = $this->spaceShelf->takeOneBy('code', $parkIntention->getPlaceCode(), '=');
        $space->setVehicle($vehicle);
    }
}
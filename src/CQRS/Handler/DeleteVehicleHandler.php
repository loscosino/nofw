<?php

namespace App\CQRS\Handler;

use App\CQRS\Intention\DeleteVehicleIntention;
use App\Storage\VehicleShelf;

class DeleteVehicleHandler
{
    private $shelf;

    public function __construct(VehicleShelf $shelf)
    {
        $this->shelf = $shelf;
    }

    public function handle(DeleteVehicleIntention $intention)
    {
        $vehicle = $this->shelf->take($intention->getId());
        $this->shelf->remove($vehicle);
    }
}
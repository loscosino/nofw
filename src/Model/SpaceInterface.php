<?php

namespace App\Model;

interface SpaceInterface
{
    public function setVehicle(VehicleInterface $vehicleInterface): void;
}
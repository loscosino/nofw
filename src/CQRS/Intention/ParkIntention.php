<?php

namespace App\CQRS\Intention;

class ParkIntention
{
    private $vehicleId;
    private $placeCode;

    public function __construct(string $vehicleId, string $placeCode)
    {
        $this->vehicleId = $vehicleId;
        $this->placeCode = $placeCode;
    }

    public function getVehicleId(): string
    {
        return $this->vehicleId;
    }

    public function getPlaceCode(): string
    {
        return $this->placeCode;
    }
}
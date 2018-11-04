<?php

namespace App\Model;

interface VehicleInterface
{
    public function getCapacity(): int;
    public function getRegistrationNumber(): string;
}
<?php

namespace App\CQRS\Intention;

class AddVehicleIntention
{
    private $id;
    private $registrationNumber;
    private $type;

    public function __construct(string $id, string $registrationNumber, string $type)
    {
        $this->id = $id;
        $this->registrationNumber = $registrationNumber;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
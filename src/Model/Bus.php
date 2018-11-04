<?php

namespace App\Model;

class Bus implements VehicleInterface, \JsonSerializable
{
    public const TYPE = 'bus';
    private $id;
    private $registrationNumber;
    private $capacity = 4;

    public function __construct(string $id, string $registrationNumber)
    {
        $this->id = $id;
        $this->registrationNumber = $registrationNumber;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'registrationNumber' => $this->registrationNumber,
            'capacity' => $this->capacity,
            'type' => self::TYPE,
        ];
    }
}
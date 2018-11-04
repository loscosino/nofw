<?php

namespace App\Model;

class Car implements VehicleInterface, \JsonSerializable
{
    public const TYPE = 'car';
    private $id;
    private $registrationNumber;
    private $capacity = 1;

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
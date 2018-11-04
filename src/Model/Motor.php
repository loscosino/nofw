<?php

namespace App\Model;

class Motor implements VehicleInterface, \JsonSerializable
{
    public const TYPE = 'motor';
    private $id;
    private $capacity = 0;
    private $registrationNumber;

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

    public function jsonSerialize():array
    {
        return [
            'id' => $this->id,
            'registrationNumber' => $this->registrationNumber,
            'capacity' => $this->capacity,
            'type' => self::TYPE,
        ];
    }
}
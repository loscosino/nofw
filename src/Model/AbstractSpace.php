<?php

namespace App\Model;

abstract class AbstractSpace implements \JsonSerializable
{
    protected $id;
    protected $vehicle;
    protected $code;

    public function __construct(string $id, string $code, ?VehicleInterface $vehicle = null)
    {
        $this->vehicle = $vehicle;
        $this->code = $code;
        $this->id = $id;
    }

    public function setVehicle(VehicleInterface $vehicle): void
    {
        if (null !== $vehicle) {
            throw new \Exception(\sprintf('Place: "%s" already has vehicle', $this->id));
        }

        if ($vehicle->getCapacity() > static::CAPACITY) {
            throw new \Exception(\sprintf('Not enough capacity, place id: "%s"', $this->id));
        }
        $this->vehicle = $vehicle;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'isFree' => null === $this->vehicle,
            'code' => $this->code,
            'capacity' => static::CAPACITY,
        ];
    }
}
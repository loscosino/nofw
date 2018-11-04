<?php

namespace App\Storage\Hydrator;

use App\Model\Bus;
use App\Model\Car;
use App\Model\Motor;
use App\Model\VehicleInterface;

class VehicleHydrator
{
    public function hydrate(array $data): array
    {
        $result = [];
        if (array_key_exists('id', $data)) {
            $result[] = $this->hydrateSingle($data);
        } else {
            foreach ($data as $item) {

                $result[] = $this->hydrateSingle($item);
            }
        }

        return $result;
    }

    private function hydrateSingle(array $data): ?VehicleInterface
    {
        switch ($data['type']) {
            case 'car':
                return new Car($data['id'], $data['number']);
            case 'motor':
                return new Motor($data['id'], $data['number']);
            case 'bus':
                return new Bus($data['id'], $data['number']);
        }
        throw new \Exception();
    }
}
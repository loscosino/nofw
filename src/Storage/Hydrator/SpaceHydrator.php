<?php

namespace App\Storage\Hydrator;

use App\Model\AbstractSpace;
use App\Model\LargeSpace;
use App\Model\MediumSpace;
use App\Model\SmallSpace;

class SpaceHydrator
{
    private $vehicleHydrator;

    public function __construct(VehicleHydrator $vehicleHydrator)
    {
        $this->vehicleHydrator = $vehicleHydrator;
    }

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

    private function hydrateSingle(array $data): ?AbstractSpace
    {
        switch ($data['capacity']) {
            case 1:
                return new SmallSpace($data['id'], $data['code']);
            case 2:
                return new MediumSpace($data['id'], $data['code']);
            case 4:
                return new LargeSpace($data['id'], $data['code']);
        }
        throw new \Exception();
    }

    private function hydrateVehicle()
    {

    }
}
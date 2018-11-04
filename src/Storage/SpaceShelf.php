<?php

namespace App\Storage;

use App\Model\VehicleInterface;
use App\Storage\Db\ConnectionManager;
use App\Storage\Hydrator\SpaceHydrator;
use App\Storage\Hydrator\VehicleHydrator;

class SpaceShelf extends AbstractShelf implements ShelfInterface
{
    private $hydrator;

    public function __construct(ConnectionManager $connection, SpaceHydrator $hydrator)
    {
        parent::__construct($connection);
        $this->hydrator = $hydrator;
    }

    public function take(string $id): ?VehicleInterface
    {
        $query = 'select * from space left join vehicle v on space.vehicle_id = v.id where space.id = :id';
        $parameters = ['id' => $id];
        $result = $this->connection->execute($query, $parameters);
        $hydratedCollection = $this->hydrator->hydrate($result);

        return $hydratedCollection[0] ?? null;
    }

    public function takeOneBy(string $field, $value, string $operator = null)
    {
        $query = \sprintf(
        'select space.id,
                space.code,
                space.capacity,
                v.id as vehicle_id, 
                v.type,
                v.number from space 
                left join vehicle v on space.vehicle_id = v.id 
                where %s %s :%s',
            $field, $operator, $field
        );
        $parameters = [$field => $value];

        $result = $this->connection->execute($query, $parameters);
        $hydratedCollection = $this->hydrator->hydrate($result);

        return $hydratedCollection[0] ?? null;
    }

    public function takeAll(): array
    {
        $query = 'select * from space left join vehicle v on space.vehicle_id = v.id where space.id = :id';
        $result = $this->connection->execute($query, []);

        return $this->hydrator->hydrate($result);
    }

    public function add($object): void
    {
        throw new \Exception('Readonly');
    }

    public function remove($object): void
    {
        throw new \Exception('Readonly');
    }
}
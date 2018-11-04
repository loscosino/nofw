<?php

namespace App\Storage;

use App\Model\VehicleInterface;
use App\Storage\Db\ConnectionManager;
use App\Storage\Hydrator\VehicleHydrator;

class VehicleShelf extends AbstractShelf implements ShelfInterface
{
    private $hydrator;

    public function __construct(ConnectionManager $connection, VehicleHydrator $hydrator)
    {
        parent::__construct($connection);
        $this->hydrator = $hydrator;
    }

    public function take(string $id): ?VehicleInterface
    {
        $query = 'select * from vehicle where id = :id';
        $parameters = ['id' => $id];
        $result = $this->connection->execute($query, $parameters);
        $hydratedCollection = $this->hydrator->hydrate($result);

        return $hydratedCollection[0] ?? null;
    }

    public function takeOneBy(string $field, $value, string $operator = null)
    {
        // TODO: Implement takeBy() method.
    }

    public function takeAll(): array
    {
        $query = 'select * from vehicle';
        $result = $this->connection->execute($query, []);

        return $this->hydrator->hydrate($result);
    }

    public function add($object): void
    {
        $query = 'insert into vehicle values(:id, :type, :number)';
        $parameters = [
                'id' => $object->getId(),
                'type' => \constant(\sprintf('%s::%s', \get_class($object), 'TYPE')),
                'number' => $object->getRegistrationNumber()
            ];
        $this->connection->execute($query, $parameters);
    }

    public function remove($object): void
    {
        $query = 'delete from vehicle where id = :id';
        $parameters = [
            'id' => $object->getId(),
        ];
        $this->connection->execute($query, $parameters);
    }
}
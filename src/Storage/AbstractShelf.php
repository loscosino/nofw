<?php

namespace App\Storage;

use App\Storage\Db\ConnectionManager;

class AbstractShelf
{
    protected $connection;

    public function __construct(ConnectionManager $connection)
    {
        $this->connection = $connection;
    }
}
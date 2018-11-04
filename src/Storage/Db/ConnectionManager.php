<?php

namespace App\Storage\Db;

class ConnectionManager
{
    public function execute(string $sql, array $params): array
    {
        $host = '127.0.0.1';
        $db   = 'parking';
        $user = 'postgres';
        $pass = 'postgres';

        $dsn = "pgsql:host=$host;dbname=$db;";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $pdo = new \PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
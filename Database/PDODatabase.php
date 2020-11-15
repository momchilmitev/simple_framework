<?php

namespace Database;

class PDODatabase implements DatabaseInterface
{

    private \PDO $pdo;

    /**
     * PDODatabase constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $query
     * @return StatementInterface
     */
    public function query(string $query): StatementInterface
    {
        $stmt = $this->pdo->prepare($query);

        return new PDOStatement($stmt);
    }
}
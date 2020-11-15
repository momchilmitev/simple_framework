<?php

namespace Database;

class PDOStatement implements StatementInterface
{
    private \PDOStatement $pdoStatement;

    /**
     * PDOStatement constructor.
     * @param \PDOStatement $PDOStatement
     */
    public function __construct(\PDOStatement $PDOStatement)
    {
        $this->pdoStatement = $PDOStatement;
    }

    /**
     * @param array $params
     * @return ResultSetInterface
     */
    public function execute(array $params = []): ResultSetInterface
    {
        $this->pdoStatement->execute($params);

        return new PDOResultSet($this->pdoStatement);
    }
}
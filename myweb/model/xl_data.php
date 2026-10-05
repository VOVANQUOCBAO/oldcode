<?php
include __DIR__ . '/database.php';

class xl_data extends database
{
    public function readitem(string $sql, array $params = []): array
    {
        $statement = $this->connection_database()->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll();
    }

    public function execute_item(string $sql, array $params = []): bool
    {
        $statement = $this->connection_database()->prepare($sql);
        return $statement->execute($params);
    }
}

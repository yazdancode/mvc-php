<?php
namespace Application\Model;

use PDO;
use PDOException;
use PDOStatement;

class Model
{
    protected ?PDO $connection = null;

    public function __construct(string $dbHost, string $dbName, string $dbUsername, string $dbPassword)
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ];

        try {
            $this->connection = new PDO(
                "mysql:host=$dbHost;dbname=$dbName",
                $dbUsername,
                $dbPassword,
                $options
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    protected function query(string $query, array $values = null): ?PDOStatement
    {
        try {
            if ($values === null) {
                return null;
            }

            $stmt = $this->connection->prepare($query);
            $stmt->execute($values);
            return null;
        } catch (PDOException $e) {
            echo "Query error: " . $e->getMessage();
            return null;
        }
    }

    protected function execute(string $query, array $values = null): bool
    {
        try {
            if ($values === null) {
                $this->connection->exec($query);
            } else {
                $stmt = $this->connection->prepare($query);
                $stmt->execute($values);
            }
            return true;
        } catch (PDOException $e) {
            echo "Execution error: " . $e->getMessage();
            return false;
        }
    }

    protected function closeConnection(): void
    {
        $this->connection = null;
    }
}

<?php
namespace Application\Model;

use PDO;
use PDOException;
use PDOStatement;

class Model
{
    protected ?PDO $connection = null;

    public function __construct()
    {
        if ($this->connection === null) {
            global $dbHost, $dbName, $dbUsername, $dbPassword;

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ];

            try {
                $this->connection = new PDO(
                    "mysql:host={$dbHost};dbname={$dbName}",
                    $dbUsername,
                    $dbPassword,
                    $options
                );
            } catch (PDOException $e) {
                error_log("Database connection error: " . $e->getMessage());
                echo "Database connection failed.";
            }
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    /**
     * Execute a SELECT query and return results.
     */
    protected function query(string $query, array $values = []): ?PDOStatement
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($values);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            echo "Query execution failed.";
            return null;
        }
    }

    /**
     * Execute an INSERT, UPDATE, or DELETE query.
     */
    protected function execute(string $query, array $values = []): bool
    {
        try {
            $stmt = $this->connection->prepare($query);
            return $stmt->execute($values);
        } catch (PDOException $e) {
            error_log("Execution error: " . $e->getMessage());
            echo "Query execution failed.";
            return false;
        }
    }

    /**
     * Close the database connection.
     */
    protected function closeConnection(): void
    {
        $this->connection = null;
    }
}

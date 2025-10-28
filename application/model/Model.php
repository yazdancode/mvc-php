<?php

namespace Application\Model;

use PDO;
use PDOException;

class Model {

    protected $connection;

    public function __construct() {
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
        die("❌ اتصال به پایگاه داده برقرار نشد: " . $e->getMessage());
    }
}

    protected function query($query, $values = null) {
        if ($this->connection === null) {
            die("❌ اتصال به پایگاه داده برقرار نشده است.");
        }

        try {
            if ($values === null) {
                return $this->connection->query($query);
            } else {
                $stmt = $this->connection->prepare($query);
                $stmt->execute($values);
                return $stmt;
            }
        } catch (PDOException $e) {
            die("❌ خطا در اجرای کوئری: " . $e->getMessage());
        }
    }

    protected function execute($query, $values = null) {
        if ($this->connection === null) {
            die("❌ اتصال به پایگاه داده برقرار نشده است.");
        }

        try {
            if ($values === null) {
                $this->connection->exec($query);
            } else {
                $stmt = $this->connection->prepare($query);
                $stmt->execute($values);
            }
            return true;
        } catch (PDOException $e) {
            echo "❌ خطا در اجرای دستور: " . $e->getMessage();
            return false;
        }
    }

    protected function closeConnection() {
        $this->connection = null;
    }

    public function __destruct() {
        $this->closeConnection();
    }
}

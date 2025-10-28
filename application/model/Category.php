<?php 

namespace Application\Model;

use PDOException;

class Category extends Model
{
    public function all(): array
    {
        $query = "SELECT * FROM `categories`;";
        try {
            $stmt = $this->query($query);
            $result = $stmt ? $stmt->fetchAll() : [];
        } catch (PDOException $e) {
            error_log("Error in fetching categories:" . $e->getMessage());
            $result = [];
        }
        $this->closeConnection();
        return $result;
    }

    public function articles($cat_id): array
    {
        $query = "SELECT * FROM `categories` WHERE `cat_id` = ?;";
        try {
            $stmt = $this->query($query, [$cat_id]);
            $result = $stmt ? $stmt->fetchAll() : [];
        } catch (PDOException $e){
            error_log("Error fetching articles for category $cat_id: " . $e->getMessage());
            $result = [];
        }
        $this->closeConnection();
        return $result;
    }

    public function find($id): array|null
    {
        $query = "SELECT * FROM `categories` WHERE `id` = ?;";
        try {
            $stmt = $this->query($query, [$id]);
            $result = $stmt?->fetch();
        } catch (PDOException $e){
            error_log("Error fetching categories with ID $id: " . $e->getMessage());
            $result = null;
        }
        $this->closeConnection();
        return $result;
    }

    public function insert($values): void
    {
        $query = "INSERT INTO `categories` (`name`, `description`, `created_at`) VALUES (?, ?, NOW());";
        $this->execute($query, array_values($values));
        $this->closeConnection();
    }

    public function update($id, $values): void
    {
        $query = "UPDATE `categories` SET `name` = ?, `description` = ?, `updated_at` = NOW() WHERE `id` = ?;";
        $params = array_merge(array_values($values), [$id]);
        $this->execute($query, $params);
        $this->closeConnection();

    }

    public function delete($id): void
    {
        $query = "DELETE FROM `categories` WHERE `id` = ?;";
        $this->execute($query, [$id]);
        $this->closeConnection();

    }

}
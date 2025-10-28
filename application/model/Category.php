<?php

namespace Application\Model;

use PDOException;

class Category extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function all(): array
    {
        $query = "SELECT * FROM `categories`;";
        try {
            $stmt = $this->query($query);
            return $stmt ? $stmt->fetchAll() : [];
        } catch (PDOException $e) {
            error_log("Error in fetching categories: " . $e->getMessage());
            return [];
        }
    }

    public function articles($cat_id): array
    {
    $query = "SELECT * FROM `articles` WHERE `cat_id` = ?;";
    try {
        $stmt = $this->query($query, [$cat_id]);
        return $stmt ? $stmt->fetchAll() : [];
    } catch (PDOException $e){
        error_log("Error fetching articles for category $cat_id: " . $e->getMessage());
        return [];
    }
    }



    public function find($id): array|null
    {
        $query = "SELECT * FROM `categories` WHERE `id` = ?;";
        try {
            $stmt = $this->query($query, [$id]);
            return $stmt ? $stmt->fetch() : null;
        } catch (PDOException $e){
            error_log("Error fetching category with ID $id: " . $e->getMessage());
            return null;
        }
    }

    public function insert($values): void
    {
        $query = "INSERT INTO `categories` (`name`, `description`, `created_at`) VALUES (?, ?, NOW());";
        $this->execute($query, array_values($values));
    }

    public function update($id, $values): void
    {
        $query = "UPDATE `categories` SET `name` = ?, `description` = ?, `updated_at` = NOW() WHERE `id` = ?;";
        $params = array_merge(array_values($values), [$id]);
        $this->execute($query, $params);
    }

    public function delete($id): void
    {
        $query = "DELETE FROM `categories` WHERE `id` = ?;";
        $this->execute($query, [$id]);
    }
}

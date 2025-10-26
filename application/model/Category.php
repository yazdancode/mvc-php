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

    public function articles($cat_id): void
    {

    }

    public function find($id): void
    {

    }

    public function insert($values): void
    {

    }

    public function update($id, $values): void
    {

    }

    public function delete($id): void
    {

    }

}
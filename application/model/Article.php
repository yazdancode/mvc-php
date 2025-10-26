<?php 

namespace Application\Model;
use PDOException;

class Article extends Model
{
    public function all(): array
    {
        $query = "SELECT * FROM `articles`;";
        try {
            $stmt = $this->query($query);
            $result = $stmt ? $stmt->fetchAll() : [];
        } catch (PDOException $e) {
            error_log("Database error in all(): " . $e->getMessage());
            $result = [];
        }
        $this->closeConnection();
        return $result;
    }

    public function find($id)
    {
        $query = "SELECT *, (SELECT `name` FROM `categories` WHERE `categories`.`id` = `articles`.`cat_id`) AS `category` FROM `articles` WHERE `id` = ? LIMIT 1;";
        try {
            $stmt = $this->query($query, [$id]);
            $result = $stmt ? $stmt->fetch() : null;
        } catch (PDOException $e) {
            error_log("Database error in find(): " . $e->getMessage());
            $result = null;
        }
        $this->closeConnection();
        return $result;
    }

    public function insert($values):void
    {
        $query = "INSERT INTO `articles` (`title`, `cat_id`, `body`, `created_at`) VALUES (?, ?, ?, NOW());";
        $this->execute($query, array_values($values));
        $this->closeConnection();
    }

    public function update($id, $values):void
    {
        $query = "UPDATE `articles` SET `title` = ?, `cat_id` = ?, `body` = ?, `updated_at` = NOW() WHERE `id` = ?;";
        $params = array_merge(array_values($values), [$id]);
        $this->execute($query, $params);
        $this->closeConnection();
    }

    public function delete($id):void
    {
        $query = "DELETE FROM `articles` WHERE `id` = ?;";
        $this->execute($query, [$id]);
        $this->closeConnection();
    }
}
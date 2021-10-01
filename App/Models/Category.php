<?php
namespace App\Models;

use App\Interfaces\ISubscriber;

class Category extends Model implements ISubscriber{
    public function getCategories(){
        $query = "SELECT *
                  FROM categories";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
    public function getSingleCategory($id){
        $query = "SELECT  id, category_name
                  FROM categories
                  WHERE id = ?";
        return $this->preparedQuery($query, [$id], true);
    }
    public function getPosts($id){
        $query = 'SELECT id, title
                  FROM posts
                  WHERE category_id = ?
                  ORDER BY created_at DESC';
        return $this->preparedQuery($query, [$id]);
    }
    public function getSubscribers($id){
        $query = "SELECT email 
                  FROM subscribers 
                  WHERE category_id = ?";
        return $this->preparedQuery($query, [$id]);
    }
    public function subscribe($email, $id){
        $query = "INSERT INTO subscribers(id, email, category_id) VALUES (?,?,?)";
        $prepare = $this->db->prepare($query);
        return $prepare->execute([NULL, $email, $id]);
    }
}
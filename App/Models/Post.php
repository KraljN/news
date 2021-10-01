<?php
namespace App\Models;

use App\Interfaces\ISubscriber;

class Post extends Model implements ISubscriber{
    public function getPosts($where = ""){
        $where = "%" . $where . "%";
        $query = 'SELECT id, title
                  FROM posts
                  WHERE title LIKE ?
                  ORDER BY created_at DESC';
        return $this->preparedQuery($query, [$where]);
    }
    public function getSinglePost($id){
        $query = "SELECT  p.title AS title, p.text AS text, c.category_name, p.created_at, p.id, c.id AS category_id, p.updated_at
                  FROM posts p INNER JOIN categories c ON p.category_id = c.id
                  WHERE p.id = ?";
        return $this->preparedQuery($query, [$id], true);
    }
    public function subscribe($email, $id){
        $query = "INSERT INTO subscribers(id, email, post_id) VALUES (?,?,?)";
        $prepare = $this->db->prepare($query);
        return $prepare->execute([NULL, $email, $id]);
    }
    public function getSubscribers($id){
        $query = "SELECT email 
                  FROM subscribers 
                  WHERE post_id = ?";
        return $this->preparedQuery($query, [$id]);
    }
    public function updatePost($data, $id){
        $queryParams = [];
        $query = "UPDATE posts
                  SET ";
        $numItems = count($data);
        $i = 0;
        foreach($data as $column => $value){
            $query .= $column . " = ?";
            if(++$i < $numItems) {
                $query .= ", ";
            }
            $queryParams[] = $value;
        }
        $query .= " WHERE id = ?";
        $queryParams[] = $id;
        $prepare = $this->db->prepare($query);
        return $prepare->execute($queryParams);

    }
    public function insertPost($title, $text, $category_id){
        $query = "INSERT INTO posts(id, title, text, category_id, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $prepare = $this->db->prepare($query);
        return $prepare->execute([NULL, $title, $text, $category_id, date("Y-m-d H:i:s", time()), NULL]);
    }
}
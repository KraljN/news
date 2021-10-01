<?php

namespace App\Models;

use Exception;
use PDO;
use App\Config;

abstract class Model{

    protected $db;

    public function __construct()
    {
        try{
            // $this->db = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbName, $this->username, $this->password);
            $this->db = new PDO('mysql:host=' . Config::getConfig('SERVER') . ';dbname=' . Config::getConfig('DB_NAME'), Config::getConfig('USERNAME'), Config::getConfig('PASSWORD'));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            echo($e->getMessage());
        }
        
    }
    public function preparedQuery($query, $queryParams, $singleObject = false){
        $prepare = $this->db->prepare($query);
        $prepare->execute($queryParams);
        return  $singleObject ? $prepare->fetch() : $prepare->fetchAll();
    }
}

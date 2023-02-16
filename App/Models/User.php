<?php

namespace App\Models;

use PDO;

class User extends \Core\Model{

    public function __construct($data){
        // $data to wartości z tablicy $_POST
        // wartości tablicy trzeba zamienić na atrybuty obiektu $user
         foreach($data as $key => $value){
            $this->$key = $value;
         }
    }

    public function save(){
        //hashowanie hasła przed zapisem do bazy danych:
        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (name, email, password_hash) 
                VALUES (:name, :email, :password_hash)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

        $stmt->execute();
    }
    
}


?>
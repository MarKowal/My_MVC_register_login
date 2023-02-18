<?php

namespace App\Models;

use PDO;

class User extends \Core\Model{

    public $errors = []; 

    public function __construct($data){
        // $data to wartości z tablicy $_POST
        // wartości tablicy trzeba zamienić na atrybuty obiektu $user
         foreach($data as $key => $value){
            $this->$key = $value;
         };
    }

    public function save(){

        $this->validate();

        if (empty($this->errors)){
            //hashowanie hasła przed zapisem do bazy danych:
            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO users (name, email, password_hash) 
                    VALUES (:name, :email, :password_hash)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }

    public function validate(){

        if ($this->name == ''){
            $this->errors[] = 'Name is required.';
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) == false){
            $this->errors[] = 'Invalid email.';
        }

        if ($this->password != $this->password_confirm){
            $this->errors[] = 'Password must match confirmation.';
        }

        if (strlen($this->password) < 6){
            $this->errors[] = 'Password must have at least 6 characters.';
        }        

        if (preg_match('/.*[a-z]+.*/i', $this->password) == 0){
            $this->errors[] = 'Password needs at least one letter.';
        }

        if (preg_match('/.*\d+.*/i', $this->password) == 0){
            $this->errors[] = 'Password needs at least one number.';
        }

    }
    
}


?>
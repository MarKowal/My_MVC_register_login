<?php

namespace App\Models;

use PDO;

class User extends \Core\Model{

    public $errors = []; 

    public function __construct($data = []){
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

        if (static::emailExists($this->email)){
            $this->errors[] = 'Email already exists in the data base.';
        }

        /*if ($this->password != $this->password_confirm){
            $this->errors[] = 'Password must match confirmation.';
        }*/

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

    //dla walidacji w Account w AJAX trzeba było ustawić public static:
    //protected function emailExists($email){
    public static function emailExists($email){
        /*$sql = 'SELECT * FROM users WHERE email = :email';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch() !== false;*/

        return static::findByEmail($email) !== false;
    }
    
    public static function findByEmail($email){
        $sql = 'SELECT * FROM users WHERE email = :email';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        //standardowo fetch zwraca tablicę
        //teraz chcę żeby zwróciło obiekt:
        //$stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\User');

        //zamiast hard-coded App\Models\User używam funkcji:
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function authenticate($email, $password){

        //czy user z takim emailem istnieje?
        $user = static::findByEmail($email);
        //jeżeli tak to
        //czy user z takim hasłem istnieje?
        if($user){
            if (password_verify($password, $user->password_hash)){
                return $user;
            }
        }
        return false;
    }
}


?>
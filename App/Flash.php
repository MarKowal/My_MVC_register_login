<?php

namespace App;

class Flash{

    public static function addMessages($message){

        if(! isset($_SESSION['flash_notifications'])){
            $_SESSION['flash_notifications'] = [];
        }

        $_SESSION['flash_notifications'][] = $message;
    }

    public static function getMessages(){
        if(isset($_SESSION['flash_notifications'])){
            $message = $_SESSION['flash_notifications'];
            unset($_SESSION['flash_notifications']);
            
            return $message;
        }
    }


}


?>
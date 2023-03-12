<?php

namespace App;

use \App\Models\User;

class Auth{

    public static function login($user){
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user->id;
    }

    public static function logout(){
        //https://www.php.net/manual/en/function.session-destroy.php
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], 
                $params["domain"],
                $params["secure"], 
                $params["httponly"]
            );
        }
        session_destroy();
    }
    /*
    public static function isLoggedIn(){
        return isset($_SESSION['user_id']);
    }
    */

    public static function rememberRequestedPage(){
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }

    public static function getReturnPage(){
        //zwraca zapamiętany URL lub home-page jeżeli takiego URL nie ma:
        return $_SESSION['return_to'] ?? '/';
    }

    public static function getUser(){
        if(isset($_SESSION['user_id'])){
            return User::findByID($_SESSION['user_id']);
        }
    }


}



?>
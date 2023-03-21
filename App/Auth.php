<?php

namespace App;

use \App\Models\User;

class Auth{

    public static function login($user, $remember_me){
        //nadaję nowe ID sesji
        session_regenerate_id(true);
        //ID zalogowanego usera robię globalnym bo się przyda
        $_SESSION['user_id'] = $user->id;

        //jeżeli przeglądarka ma zapamiętać usera
        if($remember_me){
            //generuje nowy token i zapisuje w DB
            if($user->rememberLogin()){
                //ustawiam ciasteczko
                setcookie(
                    'remember_me', 
                    $user->remember_token, 
                    $user->expiry_timestamp,
                    '/'
                );
            }
        }

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
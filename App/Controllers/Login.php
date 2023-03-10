<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;

class Login extends \Core\Controller{

    public function newAction(){
        View::renderTemplate('Login/new.html');

    }

    public function createAction(){

        //$user = User::findByEmail($_POST['email']);
        //var_dump($user);

        $user = User::authenticate($_POST['email'], $_POST['password']);

        if($user){

            //generowanie nowego Session ID w razie gdyby hacker miał wcześniejsze
            //session_regenerate_id(true);

            //sesja przyjmuje ID usera
            //$_SESSION['user_id'] = $user->id;
            
            Auth::login($user);
            //$this->redirect('/');
            $this->redirect(Auth::getReturnPage());

        } else{
            View::renderTemplate('Login/new.html', [
                //podaję wpisany email do ponownego wyświeltenia w html w value="{{ email }}"
                'email' => $_POST['email'],
            ]);
        }
    }

    public function destroyAction(){
        /*
        //https://www.php.net/manual/en/function.session-destroy.php
        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], 
                $params["domain"],
                $params["secure"], 
                $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
        */
       
        Auth::logout();
        $this->redirect('/');
    }


}

?>
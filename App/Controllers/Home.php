<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

class Home extends \Core\Controller{

    protected function before(){

    }

    protected function after(){

    }
    
    public function indexAction(){
        /*
        tak nie muszę przekazywać Usera do view, 
        bo jest zrobiona w Twigu globalna zmienna current_user
        View::renderTemplate('Home/index.html', [
            'user' => Auth::getUser()
        ]);
        */
        View::renderTemplate('Home/index.html');
    }
}


?>
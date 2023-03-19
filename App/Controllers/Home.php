<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Token;


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

        $token = new Token();
        echo '<br>token = '.$token->getValue();
        echo '<br>token hash = '.$token->getHash();
        $token2 = new Token('123abc');
        echo '<br>token2 = '.$token2->getValue();
        echo '<br>token2 hash = '.$token2->getHash();
    }
}


?>
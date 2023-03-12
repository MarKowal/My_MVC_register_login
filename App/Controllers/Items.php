<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

class Items extends \Core\Controller{

    public function indexAction(){
        /*
        //page is restricted for logged-in users only:
        if(Auth::isLoggedIn() == false){
            //zapamiętuje wklepany URL, żeby wrócić do niego po zalogowaniu:
            Auth::rememberRequestedPage();
            
            $this->redirect('/login');
        }
        */
        $this->requireLogin();
        View::renderTemplate('Items/index.html');
    }
}


?>
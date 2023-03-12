<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

class Items extends \Core\Controller{

    public function indexAction(){
        //page is restricted for logged-in users only:
        if(Auth::isLoggedIn() == false){
            $this->redirect('/login');
        }
        View::renderTemplate('Items/index.html');
    }
}


?>
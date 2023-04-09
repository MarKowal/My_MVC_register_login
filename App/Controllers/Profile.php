<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;

//class Profile extends \Core\Controller{
//żeby user był już zalogowany to trzeba dziedziczyć po Athenticated
class Profile extends Authenticated{

    public function showAction(){
        View::renderTemplate('Profile/show.html', [
            //pobieram dane usera z Auth i przekazuję do view:
            'user' => Auth::getUser()
        ]);
    }

    public function editAction(){
        View::renderTemplate('Profile/edit.html', [
            'user' => Auth::getUser()
        ]);
    }

}



?>
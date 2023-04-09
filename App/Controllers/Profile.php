<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

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

    public function updateAction(){
        //stawiam obiekt User żeby wykonywać jego metody
        $user = Auth::getUser();

        if($user->updateProfile($_POST)){
            Flash::addMessages('Changes saved');
            $this->redirect('/profile/show');
            
        } else {
            View::renderTemplate('Profile/edit.html', [
                'user' => $user
            ]);
        }
    }

}


?>
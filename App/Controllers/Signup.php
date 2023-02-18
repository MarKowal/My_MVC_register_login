<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

class Signup extends \Core\Controller{

    public function newAction(){
        View::renderTemplate('Signup/new.html');
    }

    //jak zapisać dane z formularza do bazy danych
    public function createAction(){
        //tworzę nowego usera i przekauję mu wszystkie dane
        //skoro przekazuję dane podczas tworzenia obiektu
        //to są one odbierane przez __construct($data) w User
        $user = new User($_POST);
        if ($user->save()){
            View::renderTemplate('Signup/success.html');
        } else {
            var_dump($user->errors);
        }
    }

}
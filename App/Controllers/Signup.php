<?php

namespace App\Controllers;

use \Core\View;

class Signup extends \Core\Controller{

    public function newAction(){
        View::renderTemplate('Signup/new.html');
    }

    public function createAction(){
        var_dump($_POST);
    }

}
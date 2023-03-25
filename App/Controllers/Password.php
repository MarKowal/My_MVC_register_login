<?php

namespace App\Controllers;

use \Core\Controller;
use \Core\View;

class Password extends Controller{

    public function forgotAction(){
        View::renderTemplate('Password/forgot.html');
    }
}




?>
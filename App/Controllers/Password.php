<?php

namespace App\Controllers;

use \Core\Controller;
use \Core\View;
use App\Models\User;

class Password extends Controller{

    public function forgotAction(){
        View::renderTemplate('Password/forgot.html');
    }

    public function requestResetAction(){
        User::sendPasswordReset($_POST['email']);
        View::renderTemplate('Password/reset_requested.html');

    }

    public function resetAction(){
        //mam specjalnego routa ustawionego w index.php
        //więc korzystam z tabeli route_params[]
        $token = $this->route_params['token'];
        echo $token.'<br>';

        $user = User::findByPasswordReset($token);

        if($user){
            View::renderTemplate('Password/reset.html');

        } else {
            echo 'password reset token invalid';
        }
    }

}

    


?>
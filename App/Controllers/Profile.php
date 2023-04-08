<?php

namespace App\Controllers;

use \Core\View;

//class Profile extends \Core\Controller{
//żeby user był już zalogowany to trzeba dziedziczyć po Athenticated
class Profile extends Authenticated{

    public function showAction(){
        View::renderTemplate('Profile/show.html');
    }


}



?>
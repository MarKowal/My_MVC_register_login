<?php

namespace Core;

class View{

    public static function render($view, $args = []){

        extract($args, EXTR_SKIP);
        
        $file = "../App/Views/$view"; 
        
        if(is_readable($file)){
            require $file;
        } else{
            throw new \Exception("$file not found");
        }
    }

    public static function renderTemplate(string $template, array $args = []){
        static $twig = null;

        if($twig === null){
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            $twig = new \Twig\Environment($loader);
            //add Session to Twig:
            //$twig->addGlobal('session', $_SESSION);
            //dodawanie funkcji isLoggedIn() do Twiga:
            $twig->addGlobal('is_logged_in', \App\Auth::isLoggedIn());

        }

        echo $twig->render($template, $args);
    }
}


?>
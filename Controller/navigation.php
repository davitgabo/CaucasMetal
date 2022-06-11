<?php

class navigation extends userController
{
    private function checkSession($uri){
        if(strpos($uri,"admin")){
            if(!isset($_SESSION)) {
                session_start();
            }
            if(isset($_COOKIE['ID'])) {
                if (session_id() != $_COOKIE['ID']) {
                    $this->logout();
                }
            } else {
                $this->logout();
            }
        }
        elseif (strpos($uri, "login")){
            if(!isset($_SESSION)) {
                session_start();
            }
            if(isset($_COOKIE['ID']) && session_id() == $_COOKIE['ID']){
                header('location: /admin/category');
            } else {
                session_unset();
                session_destroy();
                setcookie("PHPSESSID", "", 1);
            }
        }
    }

    public function render($uri){
        $this->checkSession($uri);
        include_once __ROOT__."/View".$uri.".php";
    }
}
<?php

class navigation extends userController
{
    private function checkSession($uri){
        if(str_contains($uri,"admin")){
            session_start();
            if(isset($_COOKIE['ID'])) {
                if (session_id() != $_COOKIE['ID']) {
                    $this->logout();
                }
            } else {
                $this->logout();
            }
        }
        elseif (str_contains($uri, "login")){
            session_start();
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
        include_once __ROOT__."/View/".$uri.".php";
    }
}
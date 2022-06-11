<?php

require_once __ROOT__."/Routing/autoLoader.php";

class userController extends users
{
    private function startSession(){
        session_start();
        session_regenerate_id(true);
        setcookie("ID", session_id(), time()+3600);
    }

    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userData = $this->getUserData($username);
        if ($userData && password_verify($password,$userData[0]["Password"])) {
            $this->startSession();
            header('location: /admin/category');
        } else{
            echo "<script type='text/javascript'> alert('wrong credentials'); window.location.href = '/login'; </script>";
        }
    }

    public function logout(){
        session_unset();
        session_destroy();
        setcookie("PHPSESSID", "", 1);
        setcookie("ID", "", 1);
        header('location: /login');
    }

}
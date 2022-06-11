<?php

require_once __ROOT__."/Routing/autoLoader.php";

class users extends database
{
    protected function getUserData($username){
        $conn=$this->connectToDatabase();
        $sql = "SELECT Username, Password FROM CM_Users where Username='{$username}'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
        $userData[] = $row;
        }
        $conn->close();
        return $userData;
    }
}

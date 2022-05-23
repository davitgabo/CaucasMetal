<?php

class database
{
    protected function connectToDatabase()
    {
        $host = "localhost";
        $username = "root";
        $password = "Password123!";
        $dataBase = "CaucasMetal";
        $conn = new mysqli($host, $username, $password,$dataBase) or die("Connect failed: %s\n". $conn -> error);
        $conn->set_charset('utf8');
        return $conn;
    }

    protected function checkInTable($conn, $tableName, $fieldName, $valueToCheck):bool
    {
        $sql = "SELECT * FROM {$tableName} WHERE {$fieldName} = '{$valueToCheck}'";
        $result = $conn->query($sql);
        $tableData = $result->fetch_all(MYSQLI_ASSOC);
        if ($tableData){
            return true;
        } else {
            return false;
        }
    }

    protected function insertIntoTable($conn, $tableName, $fields, $values):bool
    {
        $strFields = implode(",",$fields);
        $strValues = implode("','",$values);

        $sql = "INSERT INTO $tableName ({$strFields}) VALUES ('{$strValues}')";
         if ($conn->query($sql)){
            return true;
        } else{
             return false;
         }
    }

    protected function createTable($conn, $tableName, $fields, $priceField)
    {   
        $sql = "CREATE TABLE {$tableName} ({$tableName}ID int NOT NULL AUTO_INCREMENT, ";
        $strFields = implode(' varchar(70), ', $fields);
        $sql .= $strFields." varchar(70), {$priceField[0]} FLOAT, {$priceField[1]} FLOAT, PRIMARY KEY ({$tableName}ID))";
        if ($conn->query($sql)){
           return true;
        } else {
            return false;
        }
    }

    protected function getDataFromTable($conn, $tableName, $fields)
    {
     if   (is_array($fields)){
         $fields = implode(', ', $fields);
     }
        $sql = "SELECT $fields FROM $tableName";
        $result = $conn->query($sql);
        if($result){
        $dataArr = $result->fetch_all(MYSQLI_ASSOC);
        return $dataArr;
        } else {
           return false;
        }
    }

    protected function deleteTable($conn, $tableName)
    {
       $sql = "DROP TABLE $tableName";
       if ($conn->query($sql)){
           return true;
       } else {
           return false;
       }
    }

    protected function deleteDataFromTable($conn, $tableName, $condition)
    {
        $sql = "DELETE FROM $tableName WHERE $condition";
        if ($conn->query($sql)){
            return true;
        } else {
            return false;
        }
    }

    protected function selectColumns($conn, $tableName){

        $sql = "DESC $tableName";
        if($result = $conn->query($sql)){
            return $result;
        }  else {
            return false;
        }
    }

    protected function updateTableData($conn,$tableName,$column,$value, $condition){

        $sql = "UPDATE $tableName SET $column = $value WHERE $condition";
        if ($conn->query($sql)){
            return true;
        } else {
            return false;
        }
    }

}

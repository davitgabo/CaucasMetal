<?php

require_once __ROOT__."/Routing/autoLoader.php";

class products extends database
{
    protected function addCategoryToDatabase($name, $engName, $img, $fields, $priceFieldGeo, $priceFieldEng ){
        //connect to database
        $conn = $this->connectToDatabase();

        //check if name exists
        if ($this->checkInTable($conn, 'CM_Category','Name', $name)){
            $conn->close();
            echo "<script type='text/javascript'> alert('კატეგორია უკვე არსებობს'); </script>";
            return false;
        }


       //add new table
        if ($this->createTable($conn,$engName,$fields,[$priceFieldGeo,$priceFieldEng]) == false){
            $conn->close();
            echo "<script type='text/javascript'> alert('ვერ მოხერხდა ახალი ცხრილის დამატება'); </script>";
            return false;
        }

        //insert category into database
        if ($this->insertIntoTable($conn, 'CM_Category', ['Name', 'EngName','ImagePath'], [$name,$engName,$img]) == false){
            $conn->close();
            echo "<script type='text/javascript'> alert('ვერ მოხერხდა კატეგორიის ცხრილში დამატება'); </script>";
            return false;
        } else {
            $conn->close();
            return true;
        }

    }

    protected function getCategoryData()
    {
        $conn = $this->connectToDatabase();
        $categoryArray = $this->getDataFromTable($conn, "CM_Category", "*");
        $conn->close();
        return $categoryArray;
    }

    protected function getProductData($tableName)
    {
        $conn = $this->connectToDatabase();
        $productArray = $this->getDataFromTable($conn, $tableName, "*") ?? [];
        $conn->close();
        return $productArray;
    }

    protected function getColumnData($tableName){
        $conn = $this->connectToDatabase();
        $result = $this->selectColumns($conn,$tableName);
        $dataArray = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $dataArray;
    }

    protected function addProductToTable($tableName,$fields,$values){
        $conn = $this->connectToDatabase();
        if ($this->insertIntoTable($conn,$tableName,$fields,$values)){
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }

    }

    protected function deleteCategoryfromDatabase($category){
        $conn = $this->connectToDatabase();

     if   ($this->deleteDataFromTable($conn, "CM_Category","EngName = '$category'") == false){
         $conn->close();
         return false;
     }

     if ($this->deleteTable($conn,$category)){
         $conn->close();
         return true;
     } else {
         return false;
     }

    }

    protected function deleteProductFromTable($tableName,$id){
        $conn = $this->connectToDatabase();

        if   ($this->deleteDataFromTable($conn, $tableName,"{$tableName}ID = '$id'") ){
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }
    protected function changeMainCurrency($mainCurrency){
        $conn = $this->connectToDatabase();
        $tableName = 'CM_Category';
        $column = 'Currency';
        $condition = "CategoryID > 0";
        if ($this->updateTableData($conn,$tableName,$column,$mainCurrency, $condition)){
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }

    }

    protected function updateCategoryCurrency($categoryCurrency, $categoryName){
        $conn = $this->connectToDatabase();
        $tableName = 'CM_Category';
        $column = 'Currency';
        $condition = "EngName = '$categoryName'";
        if ($this->updateTableData($conn,$tableName,$column,$categoryCurrency, $condition)){
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }

    }
}


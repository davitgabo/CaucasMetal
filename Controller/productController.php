<?php
require_once __ROOT__."/Routing/autoLoader.php";

class productController extends products
{
    public array $categoryArray;

    public array $columnArray;

    public array $productArray;

    public ?array $mainCurrency;

    public ?float $categoryCurrency;

    public ?string $sortMethod;

    private function checkAccess(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if(isset($_COOKIE['ID'])) {
            if (session_id() != $_COOKIE['ID']) {
                session_unset();
                session_destroy();
                setcookie("PHPSESSID", "", 1);
                setcookie("ID", "", 1);
                echo "<script type='text/javascript'> alert('უკანონო წვდომა'); window.location.href = '/login'; </script>";
                return false;
            } else {
                return true;
            }
        } else {
            session_unset();
            session_destroy();
            setcookie("PHPSESSID", "", 1);
            setcookie("ID", "", 1);
            echo "<script type='text/javascript'> alert('უკანონო წვდომა'); window.location.href = '/login'; </script>";
            return false;
        }
    }

    public function createNewCategory()
    {
        if (!$this->checkAccess()) { return false;}
        if(isset($_POST['uploadData']) && isset($_POST['subCategory'])){
            $name = str_replace(' ', '_', strtolower(trim($_POST['nameGeo'])));
            $engName = str_replace(' ', '_', strtolower(trim($_POST['nameEng'])));
            $descGeo = trim($_POST['DescGeo']);
            $descEng = trim($_POST['DescEng']);
            $fields = $_POST['subCategory'];
            $priceFieldGeo = str_replace([' ','.'] , ['_',''], strtolower(trim($_POST['PriceGeo'])));
            $priceFieldEng = str_replace([' ','.'] , ['_',''], strtolower(trim($_POST['PriceEng'])));
            foreach ($fields as $key=>$value){
                if (strlen($value) < 2){
                    echo "<script type='text/javascript'> alert('ველები არასწორად არის შეყვანილი'); window.location.href = '/admin/category';  </script>";
                    return false;
                }
            }
            $fields=str_replace([' ','.'] , ['_',''], $fields);
            $imgExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $imgName = $engName.".".$imgExt;

            if($this->addCategoryToDatabase($name, $engName, $imgName, $descGeo, $descEng, $fields, $priceFieldGeo, $priceFieldEng)){
                // upload image to directory
                $imgTemp = $_FILES["image"]["tmp_name"];
                $directory = "View/images/".$imgName;
                if (move_uploaded_file($imgTemp, $directory) == false) {
                    echo "<script type='text/javascript'> alert('სურათის დამატება წარუმატებელია');  </script>";
                }

                header("location: /admin/category");
            } else {
                echo "<script type='text/javascript'> window.location.href = '/admin/category'; </script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('დაამატეთ ველები'); window.location.href = '/admin/category'; </script>";
        }

    }

    public function getCategoryArray()
    {
        $this->categoryArray = $this->getCategoryData();
        $this->mainCurrency = array_shift($this->categoryArray);
    }


    public function getProductArray()
    {
        $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
        $sort = $this->sortMethod;
        if ($sort){
            $sort = "ORDER BY $sort * 1";
        }
        $tableName= end($url);
        $this->productArray = $this->getProductData($tableName, $sort) ?? [];
    }

    public function getColumnArray()
    {
        $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
        $tableName= end($url);
        $columnArray = $this->getColumnData($tableName) ?? [];
        $columnArray['tableName']=$tableName;
        $this->columnArray = $columnArray;
        array_shift($this->columnArray);
    }

    public function addNewProduct()
    {
        if (!$this->checkAccess()) { return false;}
        if(isset($_POST['uploadProduct'])){
            $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
            $tableName= end($url);
            $fieldsAndValues = $_POST['field'];
            foreach ($fieldsAndValues as $key=>$value){
                $fields[] = trim($key, "'");
                $values[] = $value;
            }
            if( !is_numeric(end($values)) || !is_numeric(prev($values)) ){
                echo "<script type='text/javascript'> alert('ფასი უნდა იყოს მხოლოდ რიცხვი'); window.location.href = '/admin/products/$tableName'; </script>";
                return false;
            }


           if($this->addProductToTable($tableName, $fields, $values)){
               header("location: /admin/products/$tableName");
           } else {
               echo "<script type='text/javascript'> alert('ოპერაცია წარუმატებელია'); window.location.href = '/admin/products/$tableName'; </script>";
           }
        }
    }

    public function deleteCategory()
    {
        if (!$this->checkAccess()) { return false;}
        $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
        $categoryName= end($url);
        if($this->deleteCategoryfromDatabase($categoryName)){
            $images = scandir('View/images');
            $imageName = $categoryName.'.';
            foreach ($images as $image) {
                if (strpos($image, $imageName) !== false) {
                    unlink("View/images/$image");
                }
            }
            header('location: /admin/category');
        } else {
            echo "<script type='text/javascript'> alert('ოპერაცია წარუმატებელია'); window.location.href = '/admin/category'; </script>";
        }

    }

    public function deleteProduct(){
        if (!$this->checkAccess()) { return false; }
        $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
        $tableName = $url[4];
        $id = $url[5];
        if ($this->deleteProductFromTable($tableName,$id)){
            header("location: /admin/products/$tableName");
        } else {
            echo "<script type='text/javascript'> alert('ოპერაცია წარუმატებელია'); window.location.href = '/admin/products/$tableName'; </script>";
        }
    }

    public function changeCurrency(){
        if (!$this->checkAccess()) { return false;}
        $mainCurrency = $_POST['mainCurrency'];
        if (is_numeric($mainCurrency) && $this->changeMainCurrency($mainCurrency)){
            header('location: /admin/category');
        } else {
            echo "<script type='text/javascript'> alert('ოპერაცია წარუმატებელია'); window.location.href = '/admin/category'; </script>";
        }

    }

    public function changeCurrencyByCategory(){
        if (!$this->checkAccess()) { return false;}
        $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
        $tableName = $url[2];
        $categoryCurrency = $_POST['CategoryCurrency'];
        if (is_numeric($categoryCurrency) && $this->updateCategoryCurrency($categoryCurrency,$tableName)){
            header("location: /admin/products/$tableName");
        } else {
            echo "<script type='text/javascript'> alert('ოპერაცია წარუმატებელია'); window.location.href = '/admin/products/$tableName'; </script>";
        }
    }

    public function changeSortMethod(){
        if (!$this->checkAccess()) { return false;}
        $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
        $tableName = $url[2];
        $sort = "'{$_POST['sort']}'";
        if ($this->updateSortMethod($sort,$tableName)){
            header("location: /admin/products/$tableName");
        } else {
            echo "<script type='text/javascript'> alert('ოპერაცია წარუმატებელია'); window.location.href = '/admin/products/$tableName'; </script>";
        }
    }

    public function getCurrency(){
        $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
        $tableName = $url[3];
        $CategoryArray = $this->getCategoryData();
        foreach($CategoryArray as $value){
            if ($value['EngName']==$tableName){
                $this->categoryCurrency = $value['Currency'];
            }
        }
    }

    public function getSortMethod(){
        $url = explode('/',urldecode($_SERVER['REQUEST_URI']));
        $tableName = $url[3];
        $CategoryArray = $this->getCategoryData();
        foreach($CategoryArray as $value){
            if ($value['EngName']==$tableName){
                $this->sortMethod = $value['sortMethod'];
            }
        }
    }

    public function declareArrays(){
        $this->getCurrency();
        $this->getSortMethod();
        $this->getCategoryArray();
        $this->getColumnArray();
        $this->getProductArray();

    }

    public function navigationBar(){
        foreach ($this->categoryArray as $value){
            echo  "<li class='admin-nav-dropdown-list-items'><a href='/admin/products/".$value['EngName']."'>".str_replace('_', ' ', $value['Name'])."</a></li>";
        }
    }

    public function tableHeader($page){
        $i = -1;
       foreach ($this->columnArray as $value) {
           $i++;
           if($page == 'en' && $i % 2 == 0 || $page == 'ge' && $i % 2 > 0 ){
               continue;
           } elseif (is_array($value)) {
               echo "<th>" . str_replace('_', ' ', $value['Field']) . "</th>";
           }
       }
    }

    public function tableInputForm(){
        echo "<tr>";
        echo "<form action='/addProduct/".$this->columnArray['tableName']."' method='post' enctype='multipart/form-data'>";
        foreach ($this->columnArray as $value){
            if (is_array($value)){
            echo "<td><input type='text' name='field[`".$value['Field']."`]' placeholder='".$value['Field']."'></td>";
            }
        }
        echo "<td><input type='submit' value='დამატება' name='uploadProduct'></td>";
        echo "</form>";
        echo "</tr>";
    }

    public function tableData($page){
        foreach($this->productArray as $dataArray){
            $productID=array_shift($dataArray);
            echo "<tr>";
            if ($page == 'admin'){
                $i=0;
                foreach ($dataArray as $key => $value){
                    if (++$i >= count($dataArray)-1){
                        echo '<td>'.str_replace('_', ' ', $value).'$'."</td>";
                    } else {
                        echo '<td>'.str_replace('_', ' ', $value)."</td>";
                    }
                }
                echo "<td><a onclick='confirmRemove(`პროდუქტი`,`/admin/products/delete/".$this->columnArray['tableName']."/".$productID."`)' >წაშლა</a></td>";
            }
            elseif ($page == 'en'){
                $i=0;
                foreach ($dataArray as $key => $value){
                    if ($i++ % 2 == 0) {
                        continue;
                    } elseif ($i == count($dataArray)){
                        echo "<td data-label='$key'>".$value*$this->categoryCurrency." GEL</td>";
                    }else {
                       echo "<td data-label='$key'>".str_replace('_', ' ', trim($value)). "</td>";
                    }
                }
            } else {
                $i=0;
                foreach ($dataArray as $key=>$value){
                    if ($i++ % 2 > 0) {
                        continue;
                    } elseif ($i == count($dataArray)-1){
                        echo "<td data-label='$key'>".$value*$this->categoryCurrency." ლარი</td>";
                    }else {
                        echo "<td data-label='$key'>".str_replace('_', ' ', trim($value)). "</td>";
                    }
                }

            }
            echo "</tr>";

        }
    }

    public function columnList(){
        foreach ($this->columnArray as $value){
            $column = $value['Field'] ?? NULL;
            if ($column) {
                echo "<option value='$column'>$column</option>";
            }
        }
        echo "<option value= 'NULL' >გასუფთავება</option>";
    }

}

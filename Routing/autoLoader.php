<?php
spl_autoload_register("autoLoader");

function autoLoader($className)
{
    $path = "Controller/".$className.".php";
    if (!file_exists($path)){
        $path = "Model/".$className.".php";
    }

    require_once $path;

}
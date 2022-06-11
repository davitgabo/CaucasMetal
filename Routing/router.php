<?php

class router
{
    public  function route($uri, $class, $callback, $argument=false)
    {

        if ($_SERVER['REQUEST_URI'] == $uri || strpos($uri,"{argument}") && strpos($_SERVER['REQUEST_URI'],rtrim($uri, '{argument}'))) {
            $obj = new $class;
            if ($argument) {
                $obj->$callback($argument);
            } else {
                $obj->$callback();
            }
        }
    }
}
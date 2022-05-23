<?php

class router
{
    public  function route($uri, $class, $callback, $argument=false)
    {
        $obj = new $class;
        if ($_SERVER['REQUEST_URI'] == $uri || str_contains($uri,"{argument}") && str_contains($_SERVER['REQUEST_URI'],trim($uri, '{argument}'))) {

            if ($argument) {
                $obj->$callback($argument);
            } else {
                $obj->$callback();
            }
        }
    }
}
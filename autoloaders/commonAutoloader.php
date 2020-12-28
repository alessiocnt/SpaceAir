<?php
    /*
        Autoloader in order to load common classes when needed 
        without having to do lots of includes o requires at the top
        of each files.

        Include this file at the top everytime a common class is 
        needed.
    */
    spl_autoload_register(function($className) {
        $fullPath = "model/common/" . $className;
        if(!file_exists($fullPath)) {
            return false;
        }
        include_once $fullPath;
    });
?>
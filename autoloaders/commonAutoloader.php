<?php
    /*
        Autoloader in order to load common classes when needed 
        without having to do lots of includes o requires at the top
        of each files.

        Include this file at the top everytime a common class is 
        needed.
    */
    spl_autoload_register(function($className) {
        $searchPath = array("/model/", "/model/handler/", "/model/common/", "/model/common/builder/", "/model/db/" , "/model/utils/", 
    "/controller/", "/controller/utils/", "/controller/api/", "/view/");
        foreach($searchPath as $path) {
            $fullPath = $_SERVER["DOCUMENT_ROOT"] . "/spaceair" . $path . $className .".php"; 
            if(file_exists($fullPath)) {
                include_once $fullPath;
                return true;
            }
        }
        return false;
    });
?>
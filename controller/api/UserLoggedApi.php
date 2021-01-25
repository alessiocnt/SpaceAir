<?php
/*
    Check login (secure) before use the API.
    Import in the api and do your staff.
    WARNING: there is yet the model object, so you don't have to create one
*/

require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

//Start secure session
Utils::sec_session_start();

$model = new ModelImpl();
if(!$model->getUserHandler()->checkLogin(UserHandler::$LOGINOKUSER)) {
    echo json_encode(array("Error" => "Not logged"));
    die();
}

?>
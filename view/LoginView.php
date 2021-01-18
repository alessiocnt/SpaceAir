<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class LoginView extends ViewBaseImpl {

    protected function renderMain($data) {
        require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/login.php";
    }
}
?>
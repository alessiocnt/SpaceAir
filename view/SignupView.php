<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class SignupView extends ViewBaseImpl {

    protected function renderMain($data) {
        require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/signup.php";
    }
}
?>
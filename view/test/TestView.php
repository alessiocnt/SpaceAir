<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/ViewBaseImpl.php";

class TestView extends ViewBaseImpl {

    protected function renderMain($data) {
        require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/test.php";
    }
}
?>
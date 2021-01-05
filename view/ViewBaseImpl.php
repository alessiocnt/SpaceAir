<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

abstract class ViewBaseImpl implements ViewBase {

    protected function renderHeader($headerInfo) {
        //In headerInfo there are all the information for the header such as: title
        require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/header.php";
    }

    protected function renderFooter() {
        require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/footer.php";
    }

    abstract protected function renderMain($data);

    public function render($data) {
        $this->renderHeader($data["header"]);
        $this->renderMain($data["data"]);
        $this->renderFooter();
    }
}

?>
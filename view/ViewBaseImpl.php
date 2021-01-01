<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/ViewBase.php";

abstract class ViewBaseImpl implements ViewBase {

    protected function renderHeader() {

    }

    protected function renderFooter() {
        
    }

    abstract protected function renderMain($data);

    public function render($data) {
        $this->renderHeader();
        $this->renderMain($data);
        $this->renderFooter();
    }
}

?>
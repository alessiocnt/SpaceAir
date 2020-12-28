<?php

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
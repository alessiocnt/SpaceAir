<?php


class GenericView extends ViewBaseImpl {
    private string $templateName;

    public function __construct(string $templateName) {
        $this->templateName = $templateName;
    }

    protected function renderMain($data) {
        require "./view/template/" . $this->templateName . ".php";
    }
}
?>
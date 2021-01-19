<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class GenericView extends ViewBaseImpl {
    private string $templateName;

    public function __construct(string $templateName) {
        $this->templateName = $templateName;
    }

    protected function renderMain($data) {
        require $_SERVER["DOCUMENT_ROOT"] . "/spaceair/view/template/" . $this->templateName . ".php";
    }
}
?>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class CartController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $data["header"]["title"] = "Carrello";
        $data["header"]["js"] = ["/spaceair/view/js/cart.js"];
        $data["header"]["css"] = [];
        $cartHandler = $this->getModel()->getCartHandler();
        $data["data"] = $cartHandler->getCart();
        $view = new GenericView("cart");
        $view->render($data);

    }
}
?>
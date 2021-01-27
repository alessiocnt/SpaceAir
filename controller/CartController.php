<?php

class CartController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        $user = new User(Utils::getUserId());
        $data["header"]["title"] = "Carrello";
        $data["header"]["js"] = ["./view/js/cart.js"];
        $data["header"]["css"] = [];
        $cartHandler = $this->getModel()->getCartHandler();
        $data["data"]["order"] = $cartHandler->getCart($user);
        $view = new GenericView("cart");
        $view->render($data);

    }
}
?>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PaymentController extends UserLoggedController {
    
    private $totalPrice;
    private $codOrder;

    public function __construct($model) {
        parent::__construct($model);
        $this->codOrder = $_POST["CodOrdine"];
        $this->totalPrice = $this->getModel()->getOrderHandler()->getTotal(new Order($this->codOrder));

    }

    public function executePage() {
        $userInfoHandler = $this->getModel()->getUserInfoHandler();
        $address = $userInfoHandler->getAddresses(new User(Utils::getUserId()));
        $data["header"]["title"] = "Pagamento";
        $data["header"]["js"] = ["/spaceair/view/js/payment.js"];
        $data["header"]["css"] = [];
        $data["data"]["Totale"] = $this->totalPrice;
        $data["data"]["addresses"] = $address;
        $data["data"]["CodOrder"] = $this->codOrder;
        $view = new GenericView("payment");
        $view->render($data); 
    }
}
?>
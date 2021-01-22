<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class PaymentController extends UserLoggedController {
    
    private $totalPrice;

    public function __construct($model) {
        parent::__construct($model);
        $this->totalPrice = explode('€ ', $_POST["Totale"])[1];
    }

    public function executePage() {
        $addressHandler = $this->getModel()->getAddressHandler();
        $address = $addressHandler->getAddress(Utils::getUserId());
        //var_dump($address);
        $data["header"]["title"] = "Pagamento";
        $data["header"]["js"] = ["/spaceair/view/js/payment.js"];
        $data["header"]["css"] = [];
        $data["data"]["Totale"] = $this->totalPrice;
        $data["data"]["Address"] = $address;
        $view = new GenericView("payment");
        $view->render($data); 
    }
}
?>
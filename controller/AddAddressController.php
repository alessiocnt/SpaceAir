<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class AddAddressController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        //Get User data
        $userInfoHandler = $this->getModel()->getUserInfoHandler();
        $currentUser = new User(Utils::getUserId());

        if(isset($_POST["address"])) {
            $data["Via"] = $_POST["address"];
            $data["Civico"] = $_POST["civico"];
            $data["Citta"] = $_POST["city"];
            $data["Provincia"] = $_POST["provincia"];
            $data["Cap"] = $_POST["cap"];

            //Create address
            $builder = new AddressBuilder();
            $address = $builder->createFromAssoc($data);
            $address->setUser($currentUser);

            $userInfoHandler->addAddress($address);
            header("Location:myaddress.php");


        } else {
            $data["data"] = "";
            //Set the title
            $data["header"]["title"] = "Aggiungi indirizzo";
            //Set custom js
            $data["header"]["js"] = [];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("addaddress");
            //Render the view
            $view->render($data); 
        }
    }

}
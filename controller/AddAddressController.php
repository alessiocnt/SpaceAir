<?php

class AddAddressController extends UserLoggedController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function executePage() {
        //Get User data
        $userInfoHandler = $this->getModel()->getUserInfoHandler();
        $currentUser = new User(Utils::getUserId());

        if(isset($_POST["address"])) {
            $data["CodAddress"] = isset($_POST["codAddress"]) ? $_POST["codAddress"] : 0;
            $data["Via"] = $_POST["address"];
            $data["Civico"] = $_POST["civico"];
            $data["Citta"] = $_POST["city"];
            $data["Provincia"] = $_POST["provincia"];
            $data["Cap"] = $_POST["cap"];

            //Create address
            $builder = new AddressBuilder();
            $address = $builder->createFromAssoc($data);
            $address->setUser($currentUser);

            if(!isset($_POST["codAddress"])) {
                $userInfoHandler->addAddress($address);
            } else {
                $userInfoHandler->updateAddress($address);
            }
            header("Location:myaddress.php");


        } else {
            if(isset($_GET["cod"])) {
                //Modify address
                $address = $userInfoHandler->getAddressInfo(new Address($_GET["cod"]));
                //Pass data
                $data["data"]["address"] = $address;
                $data["data"]["action"] = 1;
            } else {
                //Give empty address
                $data["data"]["address"] = new Address(0);
                $data["data"]["action"] = 0;
            }
            //Set the title
            $data["header"]["title"] = (isset($_GET["cod"]) ? "Modifica " : "Aggiungi "). "indirizzo";
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
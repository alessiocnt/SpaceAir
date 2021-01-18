<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class SignupController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        if(isset($_POST["password"])) {
            $data["Name"] = $_POST["name"];
            $data["Surname"] = $_POST["surname"];
            $data["Borndate"] = $_POST["borndate"];
            $data["Mail"] = $_POST["email"];
            $data["Password"] = $_POST["criptopassword"];
            $data["Newsletter"] = isset($_POST["newsletter"]);

            $builder = new UserBuilder();
            $user = $builder->createFromAssoc($data);
           

            $dataAddress["Via"] = $_POST["address"];
            $dataAddress["Civico"] = $_POST["civico"];
            $dataAddress["Citta"] = $_POST["city"];
            $dataAddress["Provincia"] = $_POST["provincia"];
            $dataAddress["Cap"] = $_POST["cap"];

            $builderA = new AddressBuilder();
            $address = $builderA->createFromAssoc($dataAddress);

            $user->setAddresses(array($address));

            $result = $this->getModel()->getUserHandler()->signup($user);

            if($result == true) {
                echo("OOOOKKKKKK");
            } else {
                echo("NOOOO");
            }

            //$data["img"] = "" ; 
        } else {
            $data["data"] = [];
            //Set the title
            $data["header"]["title"] = "Registrazione";
            //Set custom js
            $data["header"]["js"] = ["/spaceair/view/js/sha512.js","/spaceair/view/js/signup.js"];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new SignupView();
            //Render the view
            $view->render($data); 
        }
    }
}
?>
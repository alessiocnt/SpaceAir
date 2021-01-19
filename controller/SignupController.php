<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class SignupController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);

        //Start secure session
        Utils::sec_session_start();
    }

    public function execute() {
        //Check if already logged
        $userHandler = $this->getModel()->getUserHandler();
        if($userHandler->checkLogin()) {
            //Go to profile page
            header("Location:testPage.php");

        } else if(isset($_POST["password"])) {
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
            
            //$data["img"] = "" ; 
            
            $result = $userHandler->signup($user);

            if($result == true) {
                echo("OOOOKKKKKK");
            } else {
                $data["data"]["error"] = "Registrazione non andata a buon fine, assicurati di non aver gi&agrave; un altro account con la stessa mail";
                //Set the title
                $data["header"]["title"] = "Registrazione";
                //Set custom js
                $data["header"]["js"] = ["/spaceair/view/js/sha512.js","/spaceair/view/js/signup.js"];
                //Set custom css
                $data["header"]["css"] = [];
                //Create the view
                $view = new GenericView("signup");
                //Render the view
                $view->render($data); 
            }
        } else {
            $data["data"] = [];
            //Set the title
            $data["header"]["title"] = "Registrazione";
            //Set custom js
            $data["header"]["js"] = ["/spaceair/view/js/sha512.js","/spaceair/view/js/signup.js"];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("signup");
            //Render the view
            $view->render($data); 
        }
    }
}
?>
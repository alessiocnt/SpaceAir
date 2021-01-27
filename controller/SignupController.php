<?php

class SignupController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);
    }

    public function execute() {
        //Check if already logged
        $userHandler = $this->getModel()->getUserHandler();
        if($userHandler->checkLogin(UserHandler::$LOGINOKUSER)) {
            //Go to profile page
            header("Location:profile.php");
        } else if($userHandler->checkLogin(UserHandler::$LOGINOKADMIN)){
            //Go to dashboard
            header("Location:dashboardhome.php");
        } else if(isset($_POST["criptopassword"])) {
            $data["Name"] = $_POST["name"];
            $data["Surname"] = $_POST["surname"];
            $data["Borndate"] = $_POST["borndate"];
            $data["Mail"] = $_POST["email"];
            $data["Password"] = $_POST["criptopassword"];
            $data["Newsletter"] = isset($_POST["newsletter"]);
            
            if(isset($_FILES["img"])) {
                $data["ProfileImg"] = $_FILES["img"];
            }

            $builder = new UserBuilder();
            $user = $builder->createFromAssoc($data);
           

            $dataAddress["Via"] = $_POST["address"];
            $dataAddress["Civico"] = $_POST["civico"];
            $dataAddress["Citta"] = $_POST["city"];
            $dataAddress["Provincia"] = $_POST["provincia"];
            $dataAddress["Cap"] = $_POST["cap"];

            $builderA = new AddressBuilder();
            $address = $builderA->createFromAssoc($dataAddress);

            //Add signup address to user obj.
            $user->setAddresses(array($address));
        
            //Create User
            $result = $userHandler->signup($user);
            
            if($result == UserHandler::$SIGNUPOK) {
                //Log User and go to the profile page (because login will see the user already logged)
                $userHandler->login($user->getMail(), $user->getPassword());
                //Send notification
                $notificationDispatcher = $this->getModel()->getNotificationDispatcher();
                $notificationDispatcher->createGeneral("Benvenuto","Registrazione avvenuta con successo, benvenuto in spaceair! Non vediamo l'ora di volare con te!", array(new User(Utils::getUserId())));
                header("Location:login.php");
            } else {
                switch($result) {
                    case UserHandler::$MAILERRORSIGNUP:
                        $data["data"]["error"] = "Registrazione non andata a buon fine, assicurati di non aver gi&agrave; un altro account con la stessa mail";
                    break;
                    case UserHandler::$SIGNUPNO:
                        $data["data"]["error"] = "Errore, riprova";
                    break;
                    case Utils::$NOIMAGE:
                        $data["data"]["error"] = "File caricato non &egrave; un'immagine!";
                    break;
                    case Utils::$IMAGETOOBIG:
                        $data["data"]["error"] = "File caricato pesa troppo! Dimensione massima &egrave; 500 KB.";
                    break;
                    case Utils::$EXTENSIONERROR:
                        $data["data"]["error"] = "Accettate solo le seguenti estensioni: jpg, jpeg, png, gif";
                    break;
                    case Utils::$UPLOADERROR:
                        $data["data"]["error"] = "Errore nel caricamento dell'immagine.";
                    break;
                    default:
                    break;
                }
                
                //Set the title
                $data["header"]["title"] = "Registrazione";
                //Set custom js
                $data["header"]["js"] = ["./view/js/sha512.js","./view/js/signup.js"];
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
            $data["header"]["js"] = ["./view/js/sha512.js","./view/js/signup.js"];
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
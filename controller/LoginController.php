<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class LoginController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);

        //Start secure session
        Utils::sec_session_start();
    }

    public function execute() {
        $userHandler = $this->getModel()->getUserHandler();
        //Check if already logged
        if($userHandler->checkLogin(UserHandler::$LOGINOKUSER)) {
            //Go to profile page
            header("Location:profile.php");
        } else if($userHandler->checkLogin(UserHandler::$LOGINOKADMIN)){
            //Go to dashboard
            header("Location:dashboardhome.php");
        } else if(isset($_POST['email'], $_POST['criptopassword'])) { 
            $email = $_POST['email'];
            $password = $_POST['criptopassword']; // Recupero la password criptata.
            $result = $userHandler->login($email, $password);
            if($result == UserHandler::$LOGINOKUSER) {
               // Login user, go to profile page
               header("Location:profile.php");
            } else if($result == UserHandler::$LOGINOKADMIN) {
                //Login admin, go to dashboard
                //------TODO--------
                echo 'Success ADMIN: You have been logged in!';
            } else {
                // Login fallito
                switch($result) {
                    case UserHandler::$LOGINERROR:
                        $data["data"]["error"] = "Email o Password incorretta, riprova";
                    break;
                    case UserHandler::$USERDISABLED:
                        $data["data"]["error"] = "Utente momentaneamente disabilitato, riprova pi&ugrave; tardi";
                    break;
                    default:
                    break;
                }
                //Set the title
                $data["header"]["title"] = "Login";
                //Set custom js
                $data["header"]["js"] = ["/spaceair/view/js/sha512.js","/spaceair/view/js/login.js"];
                //Set custom css
                $data["header"]["css"] = [];
                //Create the view
                $view = new GenericView("login");
                //Render the view
                $view->render($data); 
            }
        } else {
            $data["data"] = [];
            //Set the title
            $data["header"]["title"] = "Login";
            //Set custom js
            $data["header"]["js"] = ["/spaceair/view/js/sha512.js","/spaceair/view/js/login.js"];
            //Set custom css
            $data["header"]["css"] = [];
            //Create the view
            $view = new GenericView("login");
            //Render the view
            $view->render($data); 
        }
    }
}
?>
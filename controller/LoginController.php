<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class LoginController extends AbstractController {
    
    public function __construct($model) {
        parent::__construct($model);

        //Start secure session
        Utils::sec_session_start();
    }

    public function execute() {
        //Check if already logged

        //Check post

        //Login check


        if(isset($_POST['email'], $_POST['password'])) { 
            $email = $_POST['email'];
            $password = $_POST['criptopassword']; // Recupero la password criptata.
            if($this->getModel()->getUserHandler()->login($email, $password)) {
               // Login eseguito
               echo 'Success: You have been logged in!';
            } else {
               // Login fallito
               //header('Location: ./login.php?error=1');
               echo 'LOGIN FALLITO';
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
            $view = new LoginView();
            //Render the view
            $view->render($data); 
        }
    }
}
?>
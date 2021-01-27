<?php 



class UserHandler extends AbstractHandler {
   //Static proprieties for message codes
   public static $LOGINERROR = 0; //Incorrect mail or password.
   public static $LOGINOKADMIN = 1; //Admin user logged.
   public static $LOGINOKUSER = 2; //Normal user logged.
   public static $USERDISABLED = 3; //User disabled for too much try.

   public static $MAILERRORSIGNUP = 0; //Another user exists with the same email.
   public static $SIGNUPOK = 1;
   public static $SIGNUPNO = 2;

   public function __construct(ModelHelper $model) {
      parent::__construct($model);
   }

   /*
      return STATIC message codes (descripted above).
   */
   public function login($email, $password) {
      $db = $this->getModelHelper()->getDbManager()->getDb();
      // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
      if ($stmt = $db->prepare("SELECT IdUser, Name, Surname, Type, Password, Salt FROM USERS WHERE Mail = ? LIMIT 1")) { 
         $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
         $stmt->execute(); // esegue la query appena creata.
         $stmt->store_result();
         $stmt->bind_result($user_id, $name, $surname, $type, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
         $username = $name . " " . $surname; //Creo username
         $stmt->fetch();
         $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.
         if($stmt->num_rows == 1) { // se l'utente esiste
            // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
            if($this->checkbrute($user_id) == true) { 
               // Account disabilitato
               // OPTIONAL: Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.
               return UserHandler::$USERDISABLED;
            } else {
               if($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                  // Password corretta!            
                  $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
      
                  $user_id = preg_replace("/[^0-9]+/", "", $user_id); // ci proteggiamo da un attacco XSS
                  $_SESSION['user_id'] = $user_id; 
                  $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                  $_SESSION['username'] = $username;
                  $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                  // Login eseguito con successo.
                  return $type == 1 ? UserHandler::$LOGINOKADMIN : UserHandler::$LOGINOKUSER;    
               } else {
                  // Password incorretta.
                  // Registriamo il tentativo fallito nel database.
                  $now = time();
                  $db->query("INSERT INTO LOGIN_ATTEMPTS (IdUser, Time) VALUES ('$user_id', '$now')");
                  return UserHandler::$LOGINERROR;
               }
            }
         } else {
            // L'utente inserito non esiste.
            return UserHandler::$LOGINERROR;
         }
      }
   }

    private function checkbrute($user_id) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        // Recupero il timestamp
        $now = time();
        // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
        $valid_attempts = $now - (2 * 60 * 60); 
        if ($stmt = $db->prepare("SELECT Time FROM LOGIN_ATTEMPTS WHERE IdUser = ? AND Time > '$valid_attempts'")) { 
           $stmt->bind_param('i', $user_id); 
           // Eseguo la query creata.
           $stmt->execute();
           $stmt->store_result();
           // Verifico l'esistenza di più di 5 tentativi di login falliti.
           if($stmt->num_rows > 5) {
              return true;
           } else {
              return false;
           }
        } else {
           die("ERROR!");
        }
    }

   /*
      @param type : type of user to check login for (1-Admin, 2-User; as in the db)
      Return true if an user of that type is logged.
   */
   public function checkLogin($type) {
      $db = $this->getModelHelper()->getDbManager()->getDb();
      // Verifica che tutte le variabili di sessione siano impostate correttamente
      if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
         $user_id = $_SESSION['user_id'];
         $login_string = $_SESSION['login_string'];
         $username = $_SESSION['username'];     
         $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
         if ($stmt = $db->prepare("SELECT password FROM USERS WHERE IdUser = ? AND Type = ? LIMIT 1")) { 
            $stmt->bind_param('ii', $user_id, $type); // esegue il bind del parametro '$user_id' e 'Type'.
            $stmt->execute(); // Esegue la query creata.
            $stmt->store_result();
   
            if($stmt->num_rows == 1) { // se l'utente esiste
               $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
               $stmt->fetch();
               $login_check = hash('sha512', $password.$user_browser);
               if($login_check == $login_string) {
                  // Login eseguito!!!!
                  return true;
               } else {
                  //  Login non eseguito
                  return false;
               }
            } else {
               // Login non eseguito
               return false;
            }
         } else {
            // Login non eseguito
            return false;
         }
      } else {
         // Login non eseguito
         return false;
      }
   }


   public function signUp($user) {
      $db = $this->getModelHelper()->getDbManager()->getDb();

      $mail = $user->getMail();
      //Check mail already exists
      $stmt = $db->prepare("SELECT Mail FROM USERS WHERE Mail = ?");
      $stmt->bind_param("s",$mail);
      $stmt->execute();
      $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      if(count($result) > 0) {
         //Another account with the same mail
         return UserHandler::$MAILERRORSIGNUP;
      }

      // Crea una chiave casuale
      $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
      // Crea una password usando la chiave appena creata.
      $password = hash('sha512', $user->getPassword().$random_salt);
      
      echo exec('whoami');
      $imageName = "";
      //First try to insert image
      if($user->getImgProfile()["name"] != "") {
         list($uploadResult, $imageName) = Utils::uploadImage("./res/upload/user/", $user->getImgProfile());
         if($uploadResult != Utils::$IMGUPLOADOK) {
            return $uploadResult;
         }
      }
      
      //"If" for clarity, but it will always succeed, because I have checked the mail before
      // Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
      // Assicurati di usare statement SQL 'prepared'.
      if ($insert_stmt = $db->prepare("INSERT INTO USERS (Name, Surname, Borndate, Phone, ProfileImg, Mail, Password, Salt, Type, Newsletter) VALUES (?,?,?,?,?,?,?,?,?,?);")) {    
         $newsletter = $user->hasNewsletter() ? 1 : 0;
         $type = 2;
         $name = $user->getName();
         $surname = $user->getSurname();
         $borndate = $user->getBornDate();
         $phone = $user->getPhone();
         $imgProfile = $imageName;
         $mail = $user->getMail();
         $insert_stmt->bind_param('ssssssssii', $name, $surname, $borndate, $phone, $imgProfile, $mail, $password, $random_salt, $type, $newsletter);
         // Esegui la query ottenuta.
         $insert_stmt->execute();
         
         //Get the insert user id
         $userId = $db->insert_id;
         $address = $user->getAddresses()[0];

         //Add the address
         if ($insert_stmt = $db->prepare("INSERT INTO ADDRESS (Via, Civico, Citta, Provincia, Cap, IdUser, Visible) VALUES(?,?,?,?,?,?,1)")) {    
               $via = $address->getVia();
               $civico = $address->getCivico();
               $citta = $address->getCitta();
               $provincia = $address->getProvincia();
               $cap = $address->getCap();
               $insert_stmt->bind_param('sssssi',$via, $civico, $citta, $provincia, $cap, $userId); 
               $insert_stmt->execute();   

               //--TODO-- Send notification
               

               return UserHandler::$SIGNUPOK;
         }
         
      }

      return UserHandler::$SIGNUPNO;
   }

   public function getUserById($userId){
      $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM USERS WHERE IdUser = ?");
        if (!$stmt->bind_param('i', $userId)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } else {
            $builder = new UserBuilder();
            $user = $builder->createFromAssoc($result[0]);
            return $user;
        }
   }
}

?>
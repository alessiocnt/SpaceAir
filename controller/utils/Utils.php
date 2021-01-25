<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

class Utils {
    public static $NOIMAGE = 3;
    public static $IMAGETOOBIG = 4;
    public static $EXTENSIONERROR = 5;
    public static $UPLOADERROR = 6;
    public static $IMGUPLOADOK = 7;

    public static function sec_session_start() {
        $session_name = 'sec_session_id'; // Imposta un nome di sessione
        $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
        $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
        ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
        $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
    }

    public static function logout() {
        //Not start the session, because when call the session is already on.
        
        // Elimina tutti i valori della sessione.
        $_SESSION = array();
        // Recupera i parametri di sessione.
        $params = session_get_cookie_params();
        // Cancella i cookie attuali.
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        // Cancella la sessione.
        session_destroy();
    }

    public static function getUserId() {
        return $_SESSION["user_id"];
    }

    public static function uploadImage($path, $image){
        $imageName = basename($image["name"]);
        $fullPath = $path.$imageName;
        
        $maxKB = 500;
        $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
        $result = Utils::$UPLOADERROR;
        $msg = "";
        //Controllo se immagine è veramente un'immagine
        $imageSize = getimagesize($image["tmp_name"]);
        if($imageSize === false) {
            $result = Utils::$NOIMAGE;
        }
        //Controllo dimensione dell'immagine < 500KB
        if ($image["size"] > $maxKB * 1024) {
            $result = Utils::$IMAGETOOBIG;
        }
    
        //Controllo estensione del file
        $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
        if(!in_array($imageFileType, $acceptedExtensions)){
            $result = Utils::$EXTENSIONERROR;
        }

        //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
        }

    
        //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
        if(strlen($msg)==0){
            if(!move_uploaded_file($image["tmp_name"], $fullPath)){
                $result = Utils::$UPLOADERROR;
            }
            else{
                $result = Utils::$IMGUPLOADOK;
                $msg = $imageName;
            }
        }
        return array($result,$imageName);
    }

    public function checkAdmin() {
        return isset($_SESSION["admin"]);
    }
}

?>
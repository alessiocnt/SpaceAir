<?php


class BaseNotificator implements NotificationSender {

    private $dbInstance;
 
    public function __construct($dbInstance) {
        $this->dbInstance = $dbInstance;
    }

    //users is an array of user
    public function send(TemplateNotification $notification, $users) {
        //Creo un template
        if($insertStmt = $this->dbInstance->prepare("INSERT INTO TEMPLATE_NOTIFICATION (DateTime, Title, Description, Type, CodPlanet, CodPacket) VALUES (?, ?, ?, ?, ?, ?);")) {
            //Get data to store
            $dateTime = $notification->getDateHour()->format('Y-m-d H:i:s');
            $title = $notification->getTitle();
            $description = $notification->getDescription();
            $type = $notification->getNotificationType();
            $codPlanet = $notification->getPlanet() != NULL ? $notification->getPlanet()->getCodPlanet() : NULL;
            $codPacket = $notification->getPacket() != NULL ? $notification->getPacket()->getCode() : NULL;

            //Store template in the db
            if(!$insertStmt->bind_param("sssiii", $dateTime, $title, $description, $type, $codPlanet, $codPacket)) {
                echo "Binding parameters failed: (" . $insertStmt->errno . ") " . $insertStmt->error;
            }
            if(!$insertStmt->execute()) {
                echo "Execute failed: (" . $insertStmt->errno . ") " . $insertStmt->error;
                die();
            }

            $notificationId = $this->dbInstance->insert_id;

            //Send notification to all users, so store in db
            if($stmt = $this->dbInstance->prepare("INSERT INTO USER_NOTIFICATION (IdUser, View, CodNotification) VALUES (?, ?, ?);")) {
                $stmt->bind_param("iii", $userId, $view, $notid);
                foreach($users as $user) {
                    $userId = $user->getId();
                    $view = 0;
                    $notid = $notificationId;
                    $stmt->execute();
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

        return true;
    }
}

?>
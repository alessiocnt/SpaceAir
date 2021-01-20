<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

/*
Le notifiche possono essere (a livello di programmazione/db): 

- General: sono notifiche che non riguardano nessun pacchetto o pianeta in particolare 
- Packet-Related: sono notifiche che riguardano un pacchetto 
- Planet-Related: sono notifihce che riguardano un pianeta 
*/

class NotificationDispatcher extends AbstractHandler{

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
     }

    public function createGeneral(string $title, string $description, User $user) {
        //Create general notification directed to user
        $dateTime = date('Y-m-d H:i:s');
        $type = NotificationType::GENERAL;

        $notificationData = array("DateTime" => $dateTime, "Title" => $title, "Description" => $description, "Type" => $type);
        $builder = new TemplateNotificationBuilder();
        $template = $builder->createFromAssoc($notificationData);


        
        /*$db = $this->getModelHelper()->getDbManager()->getDb();
        //Creo un template
        if($insertStmt = $db->prepare("INSERT INTO TEMPLATE_NOTIFICATION (DateTime, Title, Description, Type) VALUES (?, ?, ?, ?);")) {
            $insertStmt->bind_param("sssi", $dateTime, $title, $description, $type);
            $insertStmt->execute();

            $notificationId = $db->insert_id;

            if($insertStmt = $db->prepare("INSERT INTO USER_NOTIFICATION (IdUser, View, CodNotification) VALUES (?, ?, ?);")) {
                $userId = $user->getId();
                $view = 0;
                $insertStmt->bind_param("iii", $userId, $view, $notificationId);
                $insertStmt->execute();
                return true;
            }
        }

        return false;*/
    }

    //public function createPacketRelated(string $title, string $description, )
}

?>
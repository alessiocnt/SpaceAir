<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/spaceair/autoloaders/commonAutoloader.php");

/*
Le notifiche possono essere (a livello di programmazione/db): 

- General: sono notifiche che non riguardano nessun pacchetto o pianeta in particolare 
- Packet-Related: sono notifiche che riguardano un pacchetto 
- Planet-Related: sono notifihce che riguardano un pianeta 
*/

class NotificationDispatcher extends AbstractHandler{
    
    //Array of senders
    private $senders = array();

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
        array_push($this->senders, new BaseNotificator($this->getModelHelper()->getDbManager()->getDb()));
        array_push($this->senders, new EmailNotificator());
    }

    private function send($data, $users) {
        $builder = new TemplateNotificationBuilder();
        $template = $builder->createFromAssoc($data);
        foreach($this->senders as $sender) {
            $sender->send($template, $users);
        }
    }

    //Users is an array of user
    public function createGeneral(string $title, string $description, $users) {
        //Create general notification directed to users
        $dateTime = date('Y-m-d H:i:s');
        $type = NotificationType::GENERAL;
        $notificationData = array("DateTime" => $dateTime, "Title" => $title, "Description" => $description, "Type" => $type);
        $this->send($notificationData, $users);
    }

    public function createPacketRelated(string $title, string $description, Packet $packet, $users) {
        //Create general notification directed to users
        $dateTime = date('Y-m-d H:i:s');
        $type = NotificationType::PACKET;
        $notificationData = array("DateTime" => $dateTime, "Title" => $title, "Description" => $description, "Type" => $type, "CodPacket" => $packet->getCode());
        $this->send($notificationData, $users);
    }

    public function createPlanetRelated(string $title, string $description, Planet $planet, $users) {
        //Create general notification directed to users
        $dateTime = date('Y-m-d H:i:s');
        $type = NotificationType::PLANET;
        $notificationData = array("DateTime" => $dateTime, "Title" => $title, "Description" => $description, "Type" => $type, "CodPlanet" => $planet->getCodPlanet());
        $this->send($notificationData, $users);
    }

    public function getNotificationsOfUser($user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT T.DateTime, T.Title, T.CodNotification
        FROM USER_NOTIFICATION U JOIN TEMPLATE_NOTIFICATION T ON U.CodNotification = T.CodNotification
        WHERE U.IdUser = ? AND View = 0
        ORDER BY T.DateTime");
        $userId = $user->getId();
        if (!$stmt->bind_param('i', $userId)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } 
        $notificationBuilder = new TemplateNotificationBuilder();
        $notifications = array();
        foreach ($result as $notification) {
            array_push($notifications, $notificationBuilder->createFromAssoc($notification));
        }
        return $notifications;
    }

    public function getAllNotificationsOfUser($user) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT T.DateTime, T.Title, T.Description
        FROM USER_NOTIFICATION U JOIN TEMPLATE_NOTIFICATION T ON U.CodNotification = T.CodNotification
        WHERE U.IdUser = ?
        ORDER BY T.DateTime DESC");
        $userId = $user->getId();
        if (!$stmt->bind_param('i', $userId)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(count($result) == 0) {
            return false;
        } 
        $notificationBuilder = new TemplateNotificationBuilder();
        $notifications = array();
        foreach ($result as $notification) {
            array_push($notifications, $notificationBuilder->createFromAssoc($notification));
        }
        return $notifications;
    }

    public function seenNotification($user, $notification) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("UPDATE USER_NOTIFICATION SET View = 1 WHERE IdUser = ? AND CodNotification = ?");
        $userId = $user->getId();
        $codNotification = $notification->getCode();
        if (!$stmt->bind_param('ii', $userId, $codNotification)) {
            return false;
        }
        if (!$stmt->execute()) {
            return false;
        }
        return true;
    }
}

?>
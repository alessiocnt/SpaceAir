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
        //array_push($this->senders, new EmailNotificator($this->getModelHelper()->getDbManager()->getDb()));
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

    public function createPacketRelated(string $title, string $description, Packet $packet) {
        
    }
}

?>
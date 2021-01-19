<?php

class NotificationDispatcher extends AbstractHandler{

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
     }

    public function createGeneral(Notification $notification, User $user) {
        //Create general notification directed to user
        
    }
}

?>
<?php
/**
 * Class that models a user notification
 */
class UserNotification {
    private int $codNotification;
    private User $user;
    private bool $seen;


    public function __construct(int $codNotification, User $user, bool $seen = false) {
        $this->codNotification = $codNotification;
        $this->user = $user;
        $this->seen = $seen;
    }

    public function getCodNotification() : int {
        return $this->codNotification;
    }

    public function getUser() : int {
        return $this->user;
    }

    //Allowed setter
    public function setSeen(bool $seen) {
        $this->seen = $seen;
    }
}

?>
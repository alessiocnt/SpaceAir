<?php

class NotificationType {
    const GENERAL = 0;
    const INTEREST = 1;
    const FLIGHT = 2;
    const PACKAGE = 3;
    static function fromNumber($i) {
        switch ($i) {
            case '0':
                return NotificationType::GENERAL;
            
            case '1':
                return NotificationType::INTEREST;
            
            case '2':
                return NotificationType::FLIGHT;
            
            default:
                return NotificationType::PACKAGE;
        }
    }
}

?>
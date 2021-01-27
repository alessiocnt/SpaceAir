<?php


/*
    Class that represent a packet in order by a User
*/

class OrderPacket {
    private Packet $packet;
    private int $quantity;

    public function __construct(Packet $packet, int $quantity) {
        $this->packet = $packet;
        $this->quantity = $quantity;
    }

    public function getPacket() : Packet {
        return $this->packet;
    }

    public function getQuantity() : int {
        return $this->quantity;
    }
}


?>
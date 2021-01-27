<?php

/*
    Class that represent the order state
*/
class OrderState {
    private int $codState;
    private string $description;

    /*
        Base construct
    */
    public function __construct(int $codState, string $description = "") {
        $this->codState = $codState;
        $this->description = $description;
    }

    /*
        Getters
    */
    public function getCodState() : int {
        return $this->codState;
    }

    public function getDescription() : string {
        return $this->description;
    }
}
?>
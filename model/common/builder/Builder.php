<?php

/*
    Interface that represent a Builder
*/
interface Builder {
    /*
        Create the object from the associative array from the database.
    */
    public function createFromAssoc($array);
}

?>
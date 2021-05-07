<?php

class Chofer extends ChoferData {

    public function showAllChoferes(){
        $data = $this->getChoferes();
        return $data;
    }
}
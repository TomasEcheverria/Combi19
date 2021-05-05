<?php

class Chofer extends ChoferData {

    public function showAllChoferes(){
        $datas = $this->getChoferes();
        $choferes = [];
        foreach ($datas as $data) {
            array_push($choferes,$data['nombre'] );
        }
        return $choferes;
    }
}
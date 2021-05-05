<?php

class Chofer extends ChoferData {

    public function showAllChoferes(){
        $datas = $this->getChoferes();
        foreach ($datas as $data) {
            echo $data['nombre']."<br>";
            echo $data['apellido']."<br>";
            echo $data['DNI']."<br>";
        }
    }
}
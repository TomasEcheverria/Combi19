<?php

class ChoferData extends dbh {

    protected function getChoferes(){
        $sql = "SELECT * FROM usuarios WHERE activo=1 AND tipo_usuario = 'chofer'";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
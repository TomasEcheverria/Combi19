<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));


    if(isset($_POST['submit'])){
        if ((($_POST['temperatura'] + $_POST['olfato'] + $_POST['afeccion'] + $_POST['garganta']) >= 2) || ($_POST['temperatura']==1)){
            if (isset ($_GET['express'])){
                //resolver express cuando tiene covid
            }
        }else {
            //resolver express cuando compra
            $dni = $_POST['dni'];
            
            header("Location: ../vista_compra_express.php?d=".$dni);
        }
            var_dump($_POST);
        

                  
        echo "Por el momento confio, 1% probabilidades, 99% de fe (?";

    }
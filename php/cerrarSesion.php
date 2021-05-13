<?php
	session_start();
	session_unset(); //destruir todas las variables de sesion(arreglo)
	session_destroy(); //destruir la sesion(varibales de la sesion actual)s
	header("Location: ../index.php");
?>
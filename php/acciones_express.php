<?php
	include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
	$cumple= false;
	$cumple1= true;
	$mensaje= "";


	function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}


	if ((isset ($_POST['nombre'])) and (isset ($_POST['apellido']))) {
		$nombre= $_POST['nombre'];
		$apellido= $_POST['apellido'];
		if((!empty($_POST['nombre'])) and (!empty($_POST['apellido']))  and (!empty($_POST['user_mail'])) and (!empty($_POST['dni']))){
		if ((ctype_alpha($nombre)) and (ctype_alpha($apellido))){// verificacion si contiene solo caracteres alfabeticos
				
		} else {
			$mensaje= "El nombre y el apellido deben ser alfanumericos";
		}
		}else{
			$mensaje="Complete todos los campos";
		}
	} else {
		$mensaje= "Introduzca su nombre y apellido";
	}
	
	$cumple2=true;// verificacion de la existencia del nombre de usuario
	$usuario = $_POST['user_mail'];
		$query25= ("SELECT email FROM usuarios");//hacer consulta 
		$result25= mysqli_query ($link, $query25) or die ('Consulta fallida ' .mysqli_error($link));
		while ($usuarioTabla= mysqli_fetch_array ($result25)){
			if ($usuario == $usuarioTabla['email']){
				$cumple2= false;
				$mensaje="El email ya existe, por favor elija otro";
			}
		}
	
	if ($cumple2== true){
		$pass = randomPassword();
		$query31= "INSERT INTO usuarios (email, nombre, apellido, DNI,clave,tipo_usuario,suspendido,suscrito) values ('$_POST[user_mail]', '$_POST[nombre]', '$_POST[apellido]', '$_POST[dni]', '$pass','pasajero','0','0')";//falta subir la imagen y su tipo
		$result31= mysqli_query ($link, $query31) or die ('Consuluta query31 fallida: ' .mysqli_error($link) );
		$exito= true;
		echo $exito;
		var_dump($_POST);
	}
?>

	<div class="text-center"> 
	<?php
	if ((isset($exito)) and (($exito==true))){
		$dni = $_POST['dni'];
		header("Location: ../vista_formulario.php?d=".$dni."&express");
	} else {
		?>
		<div class="div_registro">
		Error al completar el formulario. <br><br>
		<?php echo ($mensaje); ?> <br><br>
		Por favor intente nuevamente <br> <br>
		<a href="../vista_express.php" class="links"> Click aqui para volver a intenar &nbsp;&nbsp;&nbsp; </a>
		</div>
	<?php
	}
	?>
	</div>
	</div>
</body>
</html>
	

<?php
	include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
	$cumple= false;
	$cumple1= false;
	$mensaje= "";
	
	if ((isset ($_POST['nombre'])) and (isset ($_POST['apellido']))) {
		$nombre= $_POST['nombre'];
		$apellido= $_POST['apellido'];
		if((!empty($_POST['nombre'])) and (!empty($_POST['apellido']))  and (!empty($_POST['user_mail'])) and (!empty($_POST['clave'])) and (!empty($_POST['dni']))){
		if ((ctype_alpha($nombre)) and (ctype_alpha($apellido))){// verificacion si contiene solo caracteres alfabeticos
					if (isset ($_POST['clave'])) {
						$contra= $_POST['clave'];
						if ((strlen($contra)) >= 6){
						
										if(isset($_POST['user_mail'])){
                                            $usuario = $_POST['user_mail'];
											$cumple1= true;
										}
										else{
										$mensaje="debe introducir un mail";
										}
						
								
							
						} else {
							$mensaje= "La contraseña debe tener 6 caracteres como minimo";
						} 
					} else {
						$mensaje="Las conntraseñas no fueron introducidas, o no coinciden";
					}					
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
	if ($cumple1 == true){
		$query25= ("SELECT email FROM usuarios");//hacer consulta 
		$result25= mysqli_query ($link, $query25) or die ('Consulta fallida ' .mysqli_error());
		while ($usuarioTabla= mysqli_fetch_array ($result25)){
			if ($usuario == $usuarioTabla['email']){
				$cumple2= false;
				$mensaje="El email ya existe, por favor elija otro";
			}
		}
	}
	
	if (($cumple1== true) and ($cumple2== true)){
		$query31= "INSERT INTO usuarios (email, nombre, apellido, dni,clave,tipo_usuario,suspendido,suscrito) values ('$_POST[user_mail]', '$_POST[nombre]', '$_POST[apellido]', '$_POST[dni]', '$_POST[clave]','0','0','0')";//falta subir la imagen y su tipo
		$result31= mysqli_query ($link, $query31) or die ('Consuluta query31 fallida: ' .mysqli_error($link) );
		$exito= true;
	}
?>
<html>
<head> 
	<title> Registro </title>
	<link rel="stylesheet" type="text/css" href= " ../css/Estilos.css" media="all" > 
</head>
<body class = "body" >
	<div class="div_body">
			<div class="div_superior" >
				<p> Combi 19 <img src="../css/images/muro.jpg" class="div_icono">
				</p>
			</div>
	<br> <br>
	<?php 
	if ((isset($exito)) and (($exito==true))){
	?>
	Usuario regitrado exitosamente <br><br>
	<a href="../index.php"> Click aqui para iniciar sesion &nbsp;&nbsp;&nbsp; </a>
	<?php
	} else {
		?>
		<div class="div_registro">
		Error al completar el formulario. <br><br>
		<?php echo ($mensaje); ?> <br><br>
		Por favor intente nuevamente <br> <br>
		<a href="../Registrarse.php" class="links"> Click aqui para volver a intenar &nbsp;&nbsp;&nbsp; </a>
		</div>
	<?php
	}
	?>
	</div>
</body>
</html>
	

<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	//$usuario -> id($id);
	$usuario -> id($id);
	$usuario -> tipoUsuario($tipo);
?>
<html>
	<head>
		<title>
			Combi 19 
		</title>
		<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" > 
		<script  src= "js/menu.js"></script>
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
	</head>
	<body class = "body" >
		<div class="div_body" id="div_body">
        <div class="div_superior" >
			 <a class = "div_superior" href="pagprincipal.php" >  
				<p> Combi 19  <img src="css/images/muro.jpg" class="div_icono">	
				</a></p>
			</div>
			<?php echo menu($tipo); ?>
		<div class= "div_superior">
				<p> Comentarios</p>
			</div>
			<div class= "div_listadomensajes">
			<div class = "div_mensaje">
				<div class="div_info_mensaje">
					<a class="div_info_usuario" href="usuario.php">
					<span> Nombre usuario </span> 
					</a>
					<span> 30/01/1969 16:00</span>  &nbsp;
					  &nbsp; 
				
					<div  class="div_textomensaje">
						<p> Don't let me down, don't let me down ... </p>
					</div>
	
					
				</div>
			</div>
			<div class = "div_mensaje">
				<div class="div_info_mensaje">
					<a class="div_info_usuario" href="usuario.php">
					<span> usuario 2  </span>
					</a>
					<span> 30/01/1969 16:00</span>
					
				
					<div  class="div_textomensaje">
						<p> Don't let me down, don't let me down ... </p>
					</div>
					
					
				</div>
			</div>
			</div>
               <div class= "div_foot">
			<p> Made by : Grupo 40 </p>
		</div> 
	</body>
</html>

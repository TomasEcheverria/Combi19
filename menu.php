<?php

 function menu($tipo){
 ?>	
    <div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<a href="pagprincipal.php">Pagina principal (home)</a>
		    <a href= "usuario.php?idu=4">Editar Perfil </a>
			<a href="vista_busqueda.php">Buscar viaje </a>
            <?php if($tipo == "pasajero") {
            ?>
            <a href="vista_suscripcion.php">Suscribirse </a>
            <?php }
			?>
            <?php if($tipo == "administrador") {
            ?>
            <a href="administracion.php">Funciones administrativas </a>
            <?php }
            ?>
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Cerrar Sesion </a>
		</div>
		<button class="btn btn-secondary" onclick="openNav()"><i class="fa fa-bars"></i> Menu</button>
 <?php  
 } 
?>
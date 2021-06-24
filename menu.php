<?php

 function menu($tipo){
 ?>	
    <div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<a href="pagprincipal.php">Pagina principal (home)</a>
			
            <a href="vista_busqueda.php">Buscar viaje </a> <!-- acordarse de hacer una pagina para solo busqueda de viajes en curso -->
            <?php if($tipo ==  "pasajero"){?>
            <a href="pasajes.php"> Mis Pasajes </a>
            <?php }else{?> 
            <a href="mis_viajes.php"> Mis Viajes </a>
                <?php }?>
            <a href="vista_perfil.php">Mi Perfil.</a>
            <?php if($tipo == "chofer"): ?>
                <a href="vista_imprevistos.php">Imprevistos</a>
            <?php endif; ?>
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
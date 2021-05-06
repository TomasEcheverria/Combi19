function editpassword() {
  var vieja = document.editarclave.clave_vieja;
  var nueva1 = document.editarclave.clave1;
  var nueva2 = document.editarclave.clave2;
  if (vieja.type === "password") {
    vieja.type = "text";
  } else {
    vieja.type = "password";
  }
    if (nueva1.type === "password") {
    nueva1.type = "text";
  } else {
    nueva1.type = "password";
  }
    if (nueva2.type === "password") {
    nueva2.type = "text";
  } else {
    nueva2.type = "password";
  }
  
}
function indexpassword(){
	var contrasena = document.iniciarsesion.cont;
	if (contrasena.type === "password") {
    contrasena.type = "text";
  } else {
    contrasena.type = "password";
  }
	
}
function registrarsepassword(){
	var pass1 = document.registro.clave;
	var pass2 = document.registro.clave1;
	if (pass1.type === "password") {
    pass1.type = "text";
  } else {
    pass1.type = "password";
  }
 if (pass2.type === "password") {
   pass2.type = "text";
  } else {
    pass2.type = "password";
  }
}
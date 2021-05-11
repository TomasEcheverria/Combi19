function esAlfabetico(str){ 
			return /^[a-zA-Z]+$/.test(str);
}
function validarnombre(){
	var valornombre = document.editar.nombre.value;// como puede editar varios campos en una sola carga
	if(valornombre){
		if(esAlfabetico(valornombre)){
			document.editar.submit();
		}
		else{
			alert('solo caracteres alfabeticos');
		}
	}
	else{
		alert('el campo nombre esta vacio')
	}
}
function validarapellido(){
	var valorapellido = document.editar.apellido.value;
	if(valorapellido){
		if(esAlfabetico(valorapellido)){
			document.editar.submit();
		}
		else{
			alert('solo caracteres alfabeticos');
		}
	}
	else{
		alert('el campo apellido esta vacio');
	}
}
function emailIsValid (email) {
  return /\S+@\S+\.\S+/.test(email);
}
function validarmail(){
	var valormail = document.editar.user_mail.value;
	if(valormail){
		if(emailIsValid(valormail)){
			document.editar.submit();
		}
		else{
			alert('el email no es valido');
		}
	}
	else{
		alert('mail esta vacio')
	}
}
function Checkfiles()
{
var fup = document.getElementById('imagen');
var fileName = fup.value;
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "doc"  || ext== "png" || ext=="PNG")
{
return true;
} 
else
{
alert("solo gifs o jpgs");
fup.focus();
return false;
}
}
function validarfoto(){
	var valorfoto = document.editar.imagen.value;
	if(valorfoto){
		if(Checkfiles){
			document.editar.submit();
		}
	}
	else{
		alert('no se cargo una foto');
	}
}
function esAlfanumerico(str){ //Es igual a esAlfabetico pero tambien le suma que tambien sea numerico;
			return /^[a-zA-Z0-9]+$/.test(str);;
}
function validarnombreusuario(){
	var valorusername = document.editar.user_name.value;
	if(valorusername){
		if(valorusername.length >= 6){
			if(esAlfanumerico(valorusername)){
				document.editar.submit();
			}
			else{
				alert('solo caracteres alfanumericos');
			}
		}
		else{
			alert('nombre de usuario debe de tener un minimo de 6 caracteres');
		}
	}
	else{
		alert('nombre de usuario esta vacio');
	}
}
function validarContrasenia(str){
			var numerosimbolo = 0; //variables para controlar
			var mayus = 0; //Que la contraseña tenga al menos
			var minus = 0; //Un caracter minuscula, mayuscula y un numero o simbolo.
			var i; //Variable i para el for, dah.
			for(i=0;i<str.length;i++){
				var caracterActual = str[i]; //Como el str es un string de caracteres (es una palabra), recorremos 
				if(!esAlfabetico(caracterActual)){  //caracter por caracter con la variable i;
					numerosimbolo++;  //Como no hay restriccion de algun caracter especial, si NO es alfabetico, significa que es un numero o un simbolo;
				}else{
					if(caracterActual == caracterActual.toUpperCase()){ //toUpperCase devuelve true si es mayuscula;
						mayus++; //Incrementamos si es mayuscula.
					}
					if(caracterActual == caracterActual.toLowerCase()){ //toLowerCase devuelve true si es minuscula;
						minus++; //Incrementamos si es minuscula;
					}
				}	//Acá significa que ya recorrimos toda la palabra recibida;
			}
			return (numerosimbolo>0 && ((mayus>0 && minus>0))); //Nos dará true si tiene numeros/simbolos Y al menos una letra mayuscula y al menos una letra minúscula. Si da false, saltará un alert.
}
function validaciones(){
	var valormail = document.editar.user_mail.value;
	var valornombre = document.editar.nombre.value;
	var valorapellido = document.editar.apellido.value;
	var varimagen = document.editar.imagen.value;
	var enviar = false;
	if(valornombre){
		if(valorapellido){
		if(esAlfabetico(valornombre) && esAlfabetico(valorapellido)){
			if(emailIsValid(valormail)){
							enviar = true;
			}
			else{
				alert('inserte un mail valido');
			}
		}
		else{
			alert('nombre y apellido deben de tener solo caracteres alfabeticos');
		}
		}
		else{
			alert('apellido esta vacio');
		}
	}
	else{
		alert('nombre esta vacio');
	}
	if(enviar){
		document.editar.submit();
	}
}
function validacion1(){
	document.editarviaje.submit;
}
function validacionesviaje(){
	var n1 = document.editarviaje.nro_viaje.value;
	var n3 = document.editarviaje.email.value;
	var n4 = document.editarviaje.codigo.value;
	if (n3){
	if(n1){
			if(emailIsValid(n3)){
				if(n4){
					document.editarviaje.submit();
				}else{
					alert('codigo esta vacio');
				}
			}else{
				alert('email es invalido');
			}
		
	}else{
		alert('numero de viaje esta vacio');
	}
}else{
	alert('el mail esta vacio');        
}
}
function validarclave(){
var valorclave = document.editarclave.clave_vieja.value;// no esta funcionando el obtener el valor.
	var valorclave1 = document.editarclave.clave1.value;
	var valorclave2 = document.editarclave.clave2.value;
	if(valorclave){
		if(valorclave1.length >=6){
			if(validarContrasenia(valorclave1)){
				if(valorclave1 == valorclave2){											
					document.editarclave.submit();
									}
								else{
									alert('las claves no coinciden');
								}
							}
							else{
								alert('la clave debe de tener mayusucalas , minusculas y un simbolo o numero');
							}
							}
						else{
							alert('la clave debe de tener 6 o mas caracteres');
						}
						}else{
							alert('no deje ningun campo en blanco');
						}
}
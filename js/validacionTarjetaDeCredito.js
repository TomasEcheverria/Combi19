function esNumerico(str){ 
	return /^[1-9]+$/.test(str);
}

function nombreEsValido(str){ 
	return /^[a-zA-Z]+\s[a-zA-Z]+$/.test(str);
}

function tarjetaEsValida(str){
	return /^\d{16}$/.test(str);	
}

function cvvEsValido(str){
	return /^\d{3}$/.test(str);	
}

function validarTarjetaDeCredito(){
	var nombre = document.formulario_suscripcion.name.value;
	var numero_tarjeta = document.formulario_suscripcion.numero_tarjeta.value;
	var cvv = document.formulario_suscripcion.numero_cvv.value;
	if(nombreEsValido(nombre)){
		if(tarjetaEsValida(numero_tarjeta)){
			if(cvvEsValido(cvv)){
				document.formulario_suscripcion.submit();
				return true;
			}
			else{
				alert("El campo CVV debe contener 3 numeros, sin espacios");
				return false;
			}
		}
		else{
			alert("El numero de tarjeta debe contener 16 numeros sin espacios")
			return false;
		};
	}
	else{
		alert("El nombre no debe contener numeros o caracteres, el nombre y apellido deben separarse por un espacio");
		return false;
	}
}

function confirmarDesuscripcion(){
	if (confirm("¿Estas seguro que quieres desuscribirte?") == false ){
		return false;
	 } else {
		document.formulario_suscripcion.submit();
		return true;
	 }
}
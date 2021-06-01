function esNumerico(str){ 
	return /^[1-9]+$/.test(str);
}

function esAlfabetico(str){ 
	return /^[a-zA-Z]+$/.test(str);
}

function validarTarjetaDeCredito(){
	var nombre = document.formulario_suscripcion.name.value;
	var numero_tarjeta = document.formulario_suscripcion.numero_tarjeta.value;
	var cvv = document.formulario_suscripcion.numero_cvv.value;
	if(esAlfabetico(nombre)){
		if(esNumerico(numero_tarjeta)){
			if(esNumerico(cvv)){
				document.formulario_suscripcion.submit();
			}
			else{
				alert("El campo CVV debe ser numerico");
			}
		}
		else{
			alert("El numero de tarjeta debe contener 8 numeros")
		};
	}
	else{
		alert("El nombre no debe contener numeros o caracteres");
	}
}
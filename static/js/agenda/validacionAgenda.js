
function validarAgenda(){

	var divMensajeError = document.getElementById("mensajeError");
    var fechaInicio = document.getElementById("fechaInicio").value;
    var fechaFinal = document.getElementById("fechaFinal").value;
  	var profesional = document.getElementById("cboProfesional").value;
    var duracion = document.getElementById("txtDuracion").value;
    var horaInicio = document.getElementById("horaInicio").value;
    var horaFinal = document.getElementById("horaFinal").value;

   

  //profesional
  if(profesional.trim() == 0){
  	alert("DEBE INDICAR EL PROFESIONAL");
  	//divMensajeError.innerHTML = "<font color 'red'> DEBE INDICAR EL PROFESIONAL</font><br><br>";
	return;
  }
//fecha inicio
if(fechaInicio.trim() == ""){
	alert("DEBE INDICAR LA FECHA DE INICIO DE LA AGENDA");
	//divMensajeError.innerHTML = "<font color 'red'> DEBE INDICAR LA FECHA DE INICIO DE LA AGENDA</font><br><br>";
	return;
}
//fecha final
if(fechaFinal.trim() == ""){
	alert("DEBE INDICAR LA FECHA FINAL DE LA AGENDA");
	//divMensajeError.innerHTML = "<font color 'red'> DEBE INDICAR LA FECHA DE INICIO DE LA AGENDA</font><br><br>";
	return;
}

//duracion

if (duracion.trim()== ""){
	alert("DEBE INDICAR LA DURACION POR SESION");
	//divMensajeError.innerHTML = "<font color 'red'> Debe indicar la duracion por turno</font><br><br>";
	return;
}	

//hora inico y final

if(horaInicio.trim() == ""){
	alert("DEBE INDICAR LA HORA INICIO");
	//divMensajeError.innerHTML = "<font color 'red'> DEBE INDICAR LA HORA INICIO</font><br><br>";
	return;
}

if(horaFinal.trim() == ""){
	alert("DEBE INDICAR HORA FINAL");
	//divMensajeError.innerHTML = "<font color 'red'> DEBE INDICAR HORA FINAL</font><br><br>";
	return;
}

var form = document.getElementById("frmDatos");
    form.submit();

}

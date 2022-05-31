function validarPaciente() {
    var divMensajeError = document.getElementById("mensajeError");
    var nombre = document.getElementById("txtNombre").value;
    var apellido =document.getElementById("txtApellido").value;
    var numeroDocumento = document.getElementById("txtNumeroDocumento").value;
    var numeroAsociado = document.getElementById("txtNumeroAsociado").value;
    var obraSocial = document.getElementById("cboObraSocial").value;
    var profesionalAsignado = document.getElementById("cboProfesional").value;
    var tipoAtencion = document.getElementById("tipoAtencion").value;
    var fechaAdimision = document.getElementById("txtFechaAdmision").value;


    //nombre
    if (nombre.trim() == "") {
        
        alert("ERROR NOMBRE VACIO");
        //divMensajeError.innerHTML = "<font color='red'>El nombre no debe estar vacio</font><br><br>";
        return;
    }else if (nombre.length < 3) {
        
        alert("El nombre debe contener al menos 3 caracteres")
        //divMensajeError.innerHTML = "<font color='red'>El nombre debe contener al menos 3 caracteres</font><br><br>";
        return;
    }
    //apellido
    if (apellido.trim() == "") {

        alert("ERROR APELLIDO VACIO");
        //divMensajeError.innerHTML = "<font color='red'>El apellido no debe estar vacio</font><br><br>";
        return;
    }



    if(obraSocial.trim() == ""){
        alert("OBRA SOCIAL NO SELECCIONADA");
        //divMensajeError.innerHTML = "<font color='red'>OBRA SOCIAL NO SELECCIONADA</font><br><br>";
        return;
    }

    //numero asociado
    if (numeroAsociado.trim() == "") {
        alert("NUMERO ASOCIADO VACIO");
        //divMensajeError.innerHTML = "NUMERO ASOCIADO VACIO";
        return;
    } 

    //profesional asignado
    if (profesionalAsignado == 0) {
        alert("DEBE SELECCIONAR EL PROFESIONAL DE ATENCION");
        //divMensajeError.innerHTML = "<font color='red'>"DEBE SELECCIONAR EL PROFESIONAL DE ATENCION</font><br><br>";
        return;
    } 

    //tipo atencion
    if (tipoAtencion == 0) {
        alert("DEBE ESPECIFICAR EL TIPO DE ATENCION");
        //divMensajeError.innerHTML = "<font color='red'>"DEBE ESPECIFICAR EL TIPO DE ATENCION</font><br><br>";
        return;
    }

    //fecha admision
    if (fechaAdimision.trim() == "") {
        alert("DEBE INDICAR LA FECHA DE ADMISION");
        //divMensajeError.innerHTML = "<font color='red'>"DEBE INDICAR LA FECHA DE ADMISION</font><br><br>";
        return;
    }  

    
    //documento
    if (numeroDocumento.trim() == "") {
        alert("NUMERO DE DOCUMENTO VACIO");
        //divMensajeError.innerHTML = "NUMERO DE DOCUMENTO VACIO";
        return;
    }else if (numeroDocumento.length < 7) {
      
        alert("EL DOCUMENTO DEBE TENER AL MENOS 8 CARACTERES");
        //divMensajeError.innerHTML = "El DNI debe contener al menos 7 carácteres *";
        return;
    }

    
    var form = document.getElementById("frmDatos");
    form.submit();
}

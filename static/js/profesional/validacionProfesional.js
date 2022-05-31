function validarProfesional() {
    var divMensajeError = document.getElementById("mensajeError");
    var nombre = document.getElementById("txtNombre").value;
    var apellido =document.getElementById("txtApellido").value;
    var numeroDocumento = document.getElementById("txtNumeroDocumento").value;
    var matricula = document.getElementById("txtMatricula").value;
    var obraSocial = document.getElementById("cboObraSocial").value;
    var especialidad = document.getElementById("cboEspecialidad").value;

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

    if(especialidad.trim() == ""){
        alert("ESPECIALIDAD NO SELECCIONADA");
        //divMensajeError.innerHTML = "<font color='red'>ESPECIALIDAD NO SELECCIONADA</font><br><br>";
        return;
    }

    if(obraSocial.trim() == ""){
        alert("OBRA SOCIAL NO SELECCIONADA");
        //divMensajeError.innerHTML = "<font color='red'>OBRA SOCIAL NO SELECCIONADA</font><br><br>";
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
    if (matricula.trim() == "") {
        alert("DEBE INGRESAR SU MATRICULA");
        //divMensajeError.innerHTML = "NUMERO DE DOCUMENTO VACIO";
        return;
    }
    
    var form = document.getElementById("frmDatos");
    form.submit();
}


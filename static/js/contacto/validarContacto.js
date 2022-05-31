function validarContacto() {
    
    var valor = document.getElementById("txtValor").value;
    var tipoContacto = document.getElementById("cboTipoContacto").value;
   
    if (valor.trim() == "") {
        alert("Debe ingresar el valor");
        //divMensajeError.innerHTML = "<font color 'red'> Debe ingresar el valor</font><br><br>";
        return;
    } 

    if(tipoContacto.trim() == 0){
    alert("DEBE INDICAR EL TIPO");
    //divMensajeError.innerHTML = "<font color 'red'> DEBE INDICAR EL TIPO</font><br><br>";
    return;
  }
    var form = document.getElementById("frmDatos");
    form.submit();
}
<?php 

require_once '../../../class/Especialidad.php';

$id= $_POST['txtId'];
$tipo= $_POST['txtTipo'];

session_start();
//VALIDACIONES
if(empty(trim($tipo))) {
	$_SESSION['mensaje_error'] = "EL TIPO SE ENCUENTRA VACIO";
	header("Location: ../modificar.php?id=$id");
	exit;
} elseif (strlen(trim($tipo)) < 3) {
	$_SESSION['mensaje_error'] = "EL CAMPO DEBE COTAR CON AL MENOS 3 CARACTERES";
	header("Location: ../modificar.php?id=$id");
	exit;
}

$especialidad=Especialidad::ObtenerPorId($id);
$especialidad->setTipo($tipo);

$especialidad->actualizar();

header('location: ../listado.php?mensaje=2');


?>
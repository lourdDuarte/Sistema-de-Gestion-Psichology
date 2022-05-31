<?php

require_once "../../../class/Especialidad.php";
require_once "../../../class/MySQL.php";


$tipo = $_POST['txtTipo'];

session_start();
//VALIDACIONES
if(empty(trim($tipo))) {
	$_SESSION['mensaje_error'] = "EL TIPO SE ENCUENTRA VACIO";
	header("Location: ../alta.php");
	exit;
} elseif (strlen(trim($tipo)) < 3) {
	$_SESSION['mensaje_error'] = "EL CAMPO DEBE COTAR CON AL MENOS 3 CARACTERES";
	header("Location: ../alta.php");
	exit;
}

function validarEspecialidad($tipo){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM especialidad WHERE tipo = '$tipo'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarEspecialidad($tipo) == 1){
 	$_SESSION['mensaje_error']= "ESPECIALIDAD YA REGISTRADA";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}


$especialidad= new Especialidad;
$especialidad->setTipo($tipo);

$especialidad->guardar();

header('location: ../listado.php?mensaje=1');

?>
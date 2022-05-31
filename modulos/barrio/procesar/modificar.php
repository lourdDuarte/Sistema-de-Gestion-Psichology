<?php

require_once "../../../class/Barrio.php";

session_start();

$id = $_POST['txtId'];
$descripcion = $_POST['txtDescripcion'];

//VALIDACIONES
if(empty(trim($descripcion))) {
	$_SESSION['mensaje_error'] = "El nombre no debe estar vacio";
	header("Location: ../modificar.php?id=$id");
	exit;
} elseif (strlen(trim($descripcion)) < 3) {
	$_SESSION['mensaje_error'] = "El nombre debe contener al menos 3 caracteres";
	header("Location: ../modificar.php?id=$id");
	exit;
}

//ACTUALIAR
$barrio = Barrio::obtenerPorId($id);
$barrio->setDescripcion($descripcion);

$barrio->actualizar();

//REDIRECCION
header("location:../listado.php?mensaje=2");
?>
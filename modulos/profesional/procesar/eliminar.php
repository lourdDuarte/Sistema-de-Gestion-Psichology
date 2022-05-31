<?php

require_once "../../../class/Profesional.php";

$id=$_GET['id'];

$profesional= Profesional::ObtenerPorId($id);

$profesional->getIdProfesional();
$profesional->getIdPersona();
$profesional->getNombre();
$profesional->getApellido();
$profesional->getMatricula();
$profesional->getFechaNacimiento();
$profesional->getIdTipoDocumento();
$profesional->getNumeroDocumento();
$profesional->getEstado();

$profesional->eliminar();

header('location:../listado.php?mensaje=3');

?>


<?php 

require_once '../../../class/PacienteObservacion.php';

$idPaciente = $_POST['txtId'];
$idFicha = $_POST['txtIdFicha'];
$modulo = $_POST['txtModulo'];
$descripcion = $_POST['txtDescripcion'];



$nuevaObservacion = new PacienteObservacion();
$nuevaObservacion->setIdPaciente($idPaciente);
$nuevaObservacion->setDescripcion($descripcion);

$nuevaObservacion->guardar();

//highlight_string(var_export($nuevaObservacion,true));
header("location: /programacion3/gestion/modulos/$modulo/detalleFicha.php?id=$idFicha&idPaciente=$idPaciente");

?>
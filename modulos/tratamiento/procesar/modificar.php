<?php

require_once '../../../class/Tratamiento.php';

$id = $_POST['txtId'];
$idPaciente= $_POST['txtLlamada'];
$idFicha = $_POST['txtFicha'];
$modulo = $_POST['txtModulo'];
$tipo = $_POST['txtTipo'];
$observacion= $_POST['txtObservacion'];

$tratamiento= Tratamiento::obtenerPorId($id);
$tratamiento->setTipo($tipo);
$tratamiento->setObservacion($observacion);

$tratamiento->actualizar();

header("location: /programacion3/gestion/modulos/$modulo/detalleFicha.php?id=$idFicha&idPaciente=$idPaciente");

//header('location:../listado.php');

?>
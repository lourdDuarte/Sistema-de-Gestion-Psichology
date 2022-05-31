<?php
require_once '../../../class/Tratamiento.php';
require_once '../../../class/Ficha.php';


session_start();

$idFicha = $_POST['txtId'];
$idLlamada = $_POST['txtIdLlamada'];
$modulo = $_POST['txtModulo'];

$tipo = $_POST['txtTipo'];
$observacion=$_POST['txtObservacion'];

$tratamiento= new Tratamiento;
$tratamiento->setTipo($tipo);
$tratamiento->setObservacion($observacion);

$tratamiento->guardar();

$ficha = Ficha::obtenerPorId($idFicha);

$ficha->setIdTratamiento($tratamiento->getIdTratamiento());

$ficha->actualizarTratamiento();

//highlight_string(var_export($ficha,true));?id=4&idPaciente=4

header("location: /programacion3/gestion/modulos/$modulo/detalleFicha.php?id=$idFicha&idPaciente=$idLlamada");


?>
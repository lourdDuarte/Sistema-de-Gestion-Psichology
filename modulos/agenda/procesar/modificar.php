<?php

require_once '../../../class/Agenda.php';
require_once '../../../class/AgendaDia.php';

$idAgenda = $_POST['txtId'];
$idPorfesional = $_POST['txtIdProfesional'];
$fechaInicio = $_POST['dtFechaInicio'];
$fechaFinal = $_POST['dtFechaFinal'];
$duracion = $_POST['txtDuracion'];
$horaInicio = $_POST['txtHoraInicio'];
$horaFinal = $_POST ['txtHoraFinal'];

session_start();

if($profesional == '0'){
    $_SESSION['mensaje_error'] = "DEBE INDICAR EL PROFESIONAL";
    header("Location: ../modificar.php?idAgenda=$idAgenda");
    exit;
}

if(empty(trim($fechaInicio))){
    $_SESSION['mensaje_error'] = "DEBE INDICAR LA FECHA DE INICIO DE LA AGENDA";
    header("Location: ../modificar.php?idAgenda=$idAgenda");
    exit;
}

if(empty(trim($fechaFinal))){
    $_SESSION['mensaje_error'] = "DEBE INDICAR LA FECHA FINAL DE LA AGENDA";
    header("Location: ../modificar.php?idAgenda=$idAgenda");
    exit;
}

if(empty(trim($duracion))){
    $_SESSION['mensaje_error'] = "DEBE INDICAR LA DURACION POR SESION";
   header("Location: ../modificar.php?idAgenda=$idAgenda");
    exit;
}


if (empty(trim($horaInicio))) {
    $_SESSION['mensaje_error']= "DEBE INDICAR LA HORA INICIO";
    header("Location: ../modificar.php?idAgenda=$idAgenda");
    
    exit;
}


if(empty(trim($horaFinal))){
    $_SESSION['mensaje_error'] = "DEBE INDICAR HORA FINAL";
    header("Location: ../modificar.php?idAgenda=$idAgenda");
    exit;
}

$agenda = Agenda::obtenerAgendaPorId($idAgenda);

$agenda->setFechaDesde($fechaInicio);
$agenda->setFechaHasta($fechaFinal);
$agenda->setDuracion($duracion);
$agenda->setHoraDesde($horaInicio);
$agenda->setHoraHasta($horaFinal);

$agenda->actualizar();

//add nuevos dias
$agenda->eliminarDiasAgenda();

$lunes= $_POST['txtLunes'];
$martes=$_POST['txtMartes'];
$miercoles =  $_POST['txtMiercoles'];
$jueves = $_POST['txtJueves'];
$viernes = $_POST['txtViernes'];

if (isset($lunes)){
	$lunes = 1;
}else{
	$lunes = 0;
}

if (isset($martes)){
	$martes = 1;
}else{
	$martes = 0;
}

if (isset($miercoles)){
	$miercoles = 1;
}else{
	$miercoles = 0;
}

if (isset($jueves)){
	$jueves = 1;
}else{
	$jueves = 0;
}

if (isset($viernes)){
	$viernes = 1;
}else{
	$viernes = 0;
}


$agendaDia= new AgendaDia();
$agendaDia->setIdAgenda($agenda->getIdAgenda());
$agendaDia->setLunes($lunes);
$agendaDia->setMartes($martes);
$agendaDia->setMiercoles($miercoles);
$agendaDia->setJueves($jueves);
$agendaDia->setViernes($viernes);



$agendaDia->guardar();



header('location:../listado.php?mensaje=2');







?>
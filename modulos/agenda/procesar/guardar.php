<?php

require_once '../../../class/Agenda.php';
require_once '../../../class/AgendaDia.php';

session_start();

$profesional= $_POST['cboProfesional'];
$horaDesde = $_POST['txtHoraInicio'];
$horaHasta = $_POST['txtHoraFinal'];
$fechaInicio = $_POST['txtFechaInicio'];
$fechaFinal = $_POST ['txtFechaFinal'];
$duracion = $_POST['txtDuracion'];


//validaciones

if($profesional == '0'){
    $_SESSION['mensaje_error'] = "DEBE INDICAR EL PROFESIONAL";
    header('location:../alta.php');
    exit;
}

if(empty(trim($fechaInicio))){
    $_SESSION['mensaje_error'] = "DEBE INDICAR LA FECHA DE INICIO DE LA AGENDA";
    header('location:../alta.php');
    exit;
}

if(empty(trim($fechaFinal))){
    $_SESSION['mensaje_error'] = "DEBE INDICAR LA FECHA FINAL DE LA AGENDA";
    header('location:../alta.php');
    exit;
}

if(empty(trim($duracion))){
    $_SESSION['mensaje_error'] = "DEBE INDICAR LA DURACION POR SESION";
    header('location:../alta.php');
    exit;
}



if (empty(trim($horaDesde))) {
    $_SESSION['mensaje_error']= "DEBE INDICAR LA HORA INICIO";
    header('location:../alta.php');
    
    exit;
}


if(empty(trim($horaHasta))){
    $_SESSION['mensaje_error'] = "DEBE INDICAR HORA FINAL";
    header('location:../alta.php');
    exit;
}


//add agenda

$agenda = new Agenda();
$agenda->setIdProfesional($profesional);
$agenda->setHoraDesde($horaDesde);
$agenda->setHoraHasta($horaHasta);
$agenda->setFechaDesde($fechaInicio);
$agenda->setFechaHasta($fechaFinal);
$agenda->setDuracion($duracion);


$agenda->guardar();



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


header('location:../listado.php?mensaje=1')



		


?>


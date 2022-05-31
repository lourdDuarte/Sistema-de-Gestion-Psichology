<?php

require_once '../../class/Agenda.php';
require_once '../../class/Profesional.php';
require_once '../../class/AgendaDia.php';
require_once '../../menu.php';

const SIN_ACCION = 0;
const AGENDA_GUARDADO = 1;
const AGENDA_MODIFICADO = 2;
const TURNO_CREADO = 3;

if (isset($_GET['mensaje'])) {
  $mensaje = $_GET['mensaje'];
} else {
  $mensaje = SIN_ACCION;
}


$listadoAgenda = Agenda::obtenerTodos();

$listaProfesionales=Profesional::obtenerTodos();

$listaDias= AgendaDia::obtenerTodos()




?>

<!DOCTYPE html>
<html>
<head>
	<title>Listado Agendas</title>

</head>
<body>
	<section id="main-content">
		<section class="wrapper">

        <?php if ($mensaje == AGENDA_GUARDADO){ ?>

          <h3 align="center"><i class="fa fa-check">Agenda guardada con exito</i></h3>

        <?php }elseif ($mensaje == AGENDA_MODIFICADO){ ?>

          <h3 align="center"><i class="fa fa-check">Agenda actualizada con exito</i></h3>

        <?php }elseif ($mensaje == TURNO_CREADO){ ?>

          <h3 align="center"><i class="fa fa-check">Turnos generados con exito</i></h3>

        <?php }?>

        <h3><i class="fa fa-address-book-o"></i> Listado Agendas</h3>
        <a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         Nueva Agenda</button></a>

        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <tr>
                  <thead>
                    <tr>
                  	
                      <th>Profesional</th>
                      <th>Fechas Disponibles</th>
                      <th>Horario de Atencion</th>
                      <th>Duracion por turno</th>
                      <th>Generador</th>
                      <th><i class=" fa fa-edit"></i> Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listadoAgenda as $agenda): ?>
                    <tr>
                        <?php 
                          foreach ($listaProfesionales as $profesionales):
                            $profesionaId = ' ';
                          
                            if ($agenda->getIdProfesional() == $profesionales->getIdProfesional()): 
                                $profesionaId = $profesionales->getIdProfesional();
                                // $agendaId = $agenda->getIdAgenda();
                                $profesional = Profesional::obtenerPorId($profesionaId);
                        ?>

                            <td> <?php echo $profesional?></td>
                            <td> 
                              <?php
                                echo "Desde: "." ". $agenda->getFechaDesde(). "<br>". "Hasta:". " ".  $agenda->getFechaHasta() 
                              ?>
                            </td>
                            <td> 
                              <?php
                                echo "Desde: "." ". $agenda->getHoraDesde(). "<br>". "Hasta:". " ".  $agenda->getHoraHasta() 
                              ?>
                            </td>
                          
                            <td>
                              <?php echo $agenda->getDuracion(). " ". "minutos"?>
                            </td>
                            <?php if($agenda->getGenerado() == 1):?>
                              <td>
                                <i class="fa fa-check"></i>
                              </td>
                            <?php endif?>
                            <?php if($agenda->getGenerado() != 1):?>
                              <td><i class="fa fa-spinner"></i></td>
                            <?php endif?>
                            <td>
                              <?php if ($agenda->getGenerado() != 1):?>
                                <a href="procesar/generarTurno.php?idAgenda=<?php echo $agenda->getIdAgenda(); ?>" title = "Generar turnos">
                                <button class="btn btn-warning btn-xs">
                                  <i class="fa fa-calendar-plus-o"></i>
                                </button>
                                </a>
                                <a href="modificar.php?idAgenda=<?php echo $agenda->getIdAgenda(); ?>" title= "actualizar">
                                  <button class="btn btn-primary btn-xs">
                                    <i class="fa fa-pencil"></i>
                                  </button>
                                </a>                                
                              <?php endif ?>
                          <?php endif?>
                    <?php endforeach?>
                        <a href="detalle.php?idAgenda=<?php echo $agenda->getIdAgenda(); ?>&idProfesional=<?php echo $agenda->getIdProfesional();?>" title="ver dias de atencion">
                          <button  class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>
                        </a>
                        <a href="procesar/eliminar.php?id=<?php echo $agenda->getIdAgenda(); ?>" title= "eliminar">
                          <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </a>
                        
                        </td>
                    </tr>
                 <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </section>
  </section>
</body>
</html>



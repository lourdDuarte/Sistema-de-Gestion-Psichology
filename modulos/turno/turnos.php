<?php

require_once '../../menu.php';
require_once '../../class/Paciente.php';
require_once ('../../class/Turno.php');

$listadoPaciente = Paciente::obtenerTodos();
?>
<br><br>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src='../../static/fullCalendar/js/main.js'></script>
    <script src='../../static/fullCalendar/js/es.js'></script>
​
    <link href='../../static/fullCalendar/main.css' rel='stylesheet' />
   
​ 
</head>
<body>
<br>
​
<section id="main-content">
  <div align="center">
    <i class="btn btn-danger"></i>Turno Cancelado &nbsp;&nbsp;&nbsp;&nbsp;
    <i class="btn btn-success"></i>Turno Atendido &nbsp;&nbsp;&nbsp;&nbsp;
    <i class="btn btn-warning"></i>Turno Confirmado &nbsp;&nbsp;&nbsp;&nbsp;
    <i class="btn btn-primary" ></i>Turno en Espera
  <section class="wrapper">
​
    <div id='calendar'></div>
    
  </section>
</section>
​
<!-- Modal Turnos -->
<div class="modal fade" id="modalCalendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" >Asignar Turno</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
        Turno N°: <input type="text" id="id_turno" >
        <br><br>
        
        Paciente:
        <select    id="id_paciente" >
        <option value="0">Ver Pacientes</option>
    ...
  <?php foreach ($listadoPaciente as $paciente): ?>
​
          <option   value="<?php echo $paciente->getIdPaciente(); ?>">
              <?php echo $paciente; ?>
          </option>
​
        <?php endforeach ?>
      </select>
      <br><br>
      Estado:
        <select id="id_estado">
          <option value="0">Seleccionar</option>
          <option value="1">Turno Cancelado</option>
          <option value="2">Turno Atendido</option>
          <option value="3">Turno Confirmado</option>
          <option value="4">Turno en espera</option>
        </select>
​
        
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary"  onclick="asignarPaciente()">Guardar </button>

      </div>
    </div>
  </div>
</div>
​
​
<!--Fin Modal Turnos -->
​
</body>
<script>
 var calendarEl = document.getElementById('calendar');
 var calendar = new FullCalendar.Calendar(calendarEl, {


      eventClick: function(info,date) {

        var eventObj = info.event;
        $('#id_turno').val(eventObj.id);

        $('#modalCalendar').modal('show');
        
        
      },

      locale:'es',
     
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      timeZone: 'local',
      initialDate: new Date(),
      
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      selectable: true,
      // your event source
      eventSources: [{
          url: '/programacion3/Gestion/modulos/turno/procesar/turnos_calendario.php',
          method: 'GET',
          extraParams: {
            idProfesional: <?php echo $_GET['idProfesional']; ?>
          },
             // a non-ajax option
          textColor: 'black'
        }]
    })
      document.addEventListener('DOMContentLoaded', function() {
          calendar.render();
      })
      function asignarPaciente(){
       $.ajax({
        type: 'GET',
        url : "/programacion3/Gestion/modulos/turno/procesar/guardar_paciente.php",
        data: { 
           'turno': $('#id_turno').val(),
           'paciente': $('#id_paciente').val(),
           'estado': $('#id_estado').val()
        },
        success: function(data){
          calendar.refetchEvents();

        }
        
      })

      $('#modalCalendar').modal('toggle');
  }

 
</script>



</html>
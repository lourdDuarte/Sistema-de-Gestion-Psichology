<?php

require_once '../../../class/MySQL.php';
require_once '../../../menu.php';
require_once '../../../class/Paciente.php';
require_once '../../../class/EstadoPago.php';

$listaPaciente = Paciente::obtenerTodos();

$listaEstado = EstadoPago::obtenerTodos();


if(isset($_GET['txtPaciente'])){
    $paciente = $_GET['txtPaciente'];
}

if(isset($_GET['estado'])){
    $estado = $_GET['estado'];
}
$datos = NULL;
if (!empty($estado) && !empty($paciente)) {

  $sql = " SELECT persona.nombre, persona.apellido, pagoOs.fecha, pagoOs.total, estadoPago.descripcion "
       . " FROM persona "
       . " INNER JOIN paciente on persona.id_persona = paciente.id_persona "
       . " INNER JOIN pagoOs on pagoOs.id_paciente = paciente.id_paciente "
       . " INNER JOIN estadoPago on pagoOs.id_estado = estadoPago.id_estado "
       . " WHERE estadoPago.id_estado = '$estado' "
       . " AND pagoOs.id_paciente = '$paciente'; ";
        echo $sql;
      $mysql = new MySQL();
      $datos = $mysql->consultar($sql);
}elseif (!empty($estado) && empty($paciente)) {
   $sql = " SELECT persona.nombre, persona.apellido, pagoOs.fecha, pagoOs.total, estadoPago.descripcion "
       . " FROM persona "
       . " INNER JOIN paciente on persona.id_persona = paciente.id_persona "
       . " INNER JOIN pagoOs on pagoOs.id_paciente = paciente.id_paciente "
       . " INNER JOIN estadoPago on pagoOs.id_estado = estadoPago.id_estado "
       . " WHERE estadoPago.id_estado = '$estado'; ";
      
      echo $sql;
      $mysql = new MySQL();
      $datos = $mysql->consultar($sql);
}




//echo $datos->num_rows;
//echo "<br><br>";
//highlight_string(var_export($datos, true));



?>
<html>
    <head></head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="/programacion3/Gestion/static/lib/select/select2.min.js"></script>
<body>
<section id="main-content">
    <section class="wrapper">
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> Estado de Registros de Pago</h4>
          <div class="form-panel">
            <div class=" form">
              <div align='center'>
                <form method='GET'>
                     Estado:
                    <select name="estado">
                      <option value="0">Seleccionar</option>
                      <?php foreach ($listaEstado as $estado):?>
                        <option value="<?php echo $estado->getIdEstado()?>"><?php echo $estado?></option>
                      <?php endforeach ?>
                    </select>
                    &nbsp;&nbsp;
                    Paciente:
                    <select class="buscar_paciente" name="txtPaciente">
                      <option value="0">Seleccionar</option>
                      <?php foreach ($listaPaciente as $paciente):?>
                        <option value="<?php echo $paciente->getIdPaciente()?>"><?php echo $paciente?></option>
                      <?php endforeach?>
                    </select>
                    <br><br>

                     <input type='submit' value='Consultar'>
                </form>
            
                <?php if (!is_null($datos)): ?>
                    <table class="table">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado Actual</th>
                        </tr>
                    <?php while($row = $datos->fetch_assoc()): ?>
                          <tr>
                            <td><?php echo $row['nombre'] ?></td>
                            <td><?php echo $row['apellido'] ?></td>
                            <td><?php echo $row['fecha'] ?></td>
                            <td><?php echo $row['total'] ?></td>
                            <td><?php echo $row['descripcion'] ?></td>
                          </tr>
                    <?php endwhile ?>
                    </table>
                 <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
<script>


  


$(document).ready(function() {
    $('.buscar_paciente').select2();
});


</script>
</body>
</html>


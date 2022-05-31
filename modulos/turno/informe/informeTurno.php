<?php

require_once '../../../class/MySQL.php';
require_once '../../../menu.php';
require_once '../../../class/Profesional.php';
require_once '../../../class/EstadoTurno.php';


$listaProfesional = Profesional::obtenerTodos();
$estadoTurnos = EstadoTurno::obtenerTodos();

if (isset($_POST['txtMes'])) {
    $fechaMes = $_POST['txtMes'];
}


if (isset($_POST['txtEstado'])) {
    $estado = $_POST['txtEstado'];
}

if (isset($_POST['txtProfesional'])) {
    $profesional = $_POST['txtProfesional'];
}

$datos = NULL;

if (!empty($fechaMes) && !empty($estado) && !empty($profesional)) {

        $sql = "SELECT turno.fecha, turno.hora, estadoTurno.descripcion, persona.nombre,persona.apellido "
                . " FROM turno "
                . " INNER JOIN estadoTurno ON turno.id_estado = estadoTurno.id_estado "
                . " INNER JOIN profesional ON profesional.id_profesional = turno.id_profesional "
                . " INNER JOIN persona ON persona.id_persona = profesional.id_persona "
                . " WHERE MONTH(turno.fecha) = '$fechaMes' "
                . " AND estadoTurno.id_estado = '$estado' "
                . " AND profesional.id_profesional = '$profesional';";

            $mysql = new MySQL();
            $datos = $mysql->consultar($sql);
    
}elseif (!empty($fechaMes) && !empty($estado) && empty($profesional)){
    
        $sql = "SELECT turno.fecha, turno.hora, estadoTurno.descripcion, persona.nombre,persona.apellido "
            . " FROM turno "
            . " INNER JOIN estadoTurno ON turno.id_estado = estadoTurno.id_estado "
            . " INNER JOIN profesional ON profesional.id_profesional = turno.id_profesional "
            . " INNER JOIN persona ON persona.id_persona = profesional.id_persona "
            . " WHERE MONTH(turno.fecha) = '$fechaMes' "
            . " AND estadoTurno.id_estado = '$estado';";


        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
    
    
}



?>

<html>
    <head>
        
        <script >
            
            function mensaje(){
                var fechaDesde = document.getElementById("txtFechaDesde").value;
                var fechaHasta =document.getElementById("txtFechaHasta").value;
                var estado = document.getElementById("txtEstado").value;

                if(fechaDesde.trim() == "" || fechaHasta.trim() == "" ){
                    alert("Las fechas y estado son campos obligatorios para el informe")
            
                }
                if(estado.value == 0)
                  {
                   alert("Selecciona Una opción")
                     
                  }
                
            }


        </script>

    </head>
<body>
<section id="main-content">
    <section class="wrapper">

    <div class="row mt">

      <div class="col-lg-12">
       <h4><i class="fa fa-angle-right"></i> Estado de turnos entre fechas </h4>
       <div class="form-panel">
       <div class=" form">
        <div align='center'>
            <form method='POST'>
                Mes:
                <select name="txtMes">
                    <option value="0">Seleccionar</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>

                </select>
               
                &nbsp;&nbsp;
                Estado: 
                <select name="txtEstado" id="txtEstado">
                    <option value="0">Seleccionar</option>
                 <?php foreach ($estadoTurnos as $estado): ?>
                    <option value="<?php echo $estado->getIdEstado();?>">
                        <?php echo $estado?>      
                    </option>
                <?php endforeach?>
                </select>
                <br><br>
                Profesional (opcional):
                <select  name="txtProfesional"  >
              <option value="0">Elegir profesional</option>
                ...
                <?php foreach ($listaProfesional as $profesional): ?>

                    <option   value="<?php echo $profesional->getIdProfesional(); ?>">
                        <?php echo $profesional; ?>
                    </option>

                <?php endforeach ?>
            </select>
                <br><br>
                <input type='submit' value='Consultar' onclick="mensaje();">
            </form>
            <br><br>
            <?php if (!is_null($datos)): ?>
                <table class="table">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Descripcion</th>
                    </tr>
                    <?php while($row = $datos->fetch_assoc()): ?>
                        <tr>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['apellido'] ?></td>
                        <td><?php echo $row['fecha'] ?></td>
                        <td><?php echo $row['hora'] ?></td>
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


</body>
</html>
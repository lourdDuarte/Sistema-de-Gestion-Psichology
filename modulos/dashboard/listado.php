<?php
require_once "../../class/Usuario.php";
require_once "../../menu.php"; 
require_once "../../consultas.php";


session_start();

if (!isset($_SESSION['usuario'])) {
	header('location: formulario_login.php');
}

$usuario = $_SESSION['usuario'];
date_default_timezone_set('America/Argentina/Buenos_Aires');


$pacientesEnElMesPorAño = pacientesEnElMesPorAño();
$estadoTurnosPorMes = estadoTurnosPorMes();
$pagosCompletosDelMes = pagosCompletosDelMes();
$agendasCreadasPorMes = agendasCreadasPorMes();
$pacientesIngresadosPorMes = pacientesIngresadosPorMes();

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="/programacion3/gestion/static/js/Chart.min.js"></script>
</head>
<body>
  <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>Dashboard</h3> 
            </div>
            <!-- /row -->
            <div class="row">
              <div class="custom-bar-chart">
                <h4><i class="fa fa-angle-right"></i> Datos del mes de <?php setlocale(LC_TIME, 'es_ES', 'esp_esp'); echo strftime(" %B "); ?></h4>
              <!-- Pagos completos en el mes -->
              <div class="col-md-4 mb">
                <div class="white-panel pn">
                  <br>
                  <div class="servicetitle">
                    <h4>Pagos Completos</h4>
                    <hr>
                  </div>
                  <div class="icn-main-container">
                    <span class="icn-container">
                    <?php foreach($pagosCompletosDelMes as $pagos):?>
                        <h3><?php echo $pagos['estadoCompleto'];?></h3>
                      <?php endforeach?>
                    </span>
                 </div>   
                </div>
              </div>
              <!-- Pacientes registrados -->
              
              <div class="col-md-4 mb">
                <div class="white-panel pn">
                  <br>
                  <div class="servicetitle">
                    <h4> Pacientes Ingresados</h4>
                    <hr>
                 </div>
                  <div class="icn-main-container">
                    <span class="icn-container">
                      <?php foreach($pacientesIngresadosPorMes as $pacientes):?>
                        <h3><?php echo $pacientes['total'];?></h3>
                      <?php endforeach?>
                    </span>
                  </div>
                </div>
              </div>
              <!-- /col-md-4 Total AGENDA ULTIMO-->
              <div class="col-md-4 mb">
                <!-- WHITE PANEL - TOP USER -->
                  <div class="white-panel pn">
                    <br>
                    <div class="servicetitle">
                      <h4> Agendas Creadas</h4>
                      <hr>
                    </div>
                    <div>
                      <div>
                        <span class="icn-container">
                        <?php foreach($agendasCreadasPorMes as $agenda):?>
                          <h3><?php echo $agenda['totalAgendas'];?></h3>
                        <?php endforeach?>
                         </span> 
                     </div>
                   </div>
                 <!-- no tocar -->
                  </div>
                </div>
              </div>
              <div class="col-md-8 mb">
              </div>
              <!-- /col-md-8  -->
            </div>
            <div class="row">
              <!--/ col-md-4 -->
              <div >
                <div>
                  <div >
                  </div>
                  <div class="custom-bar-chart">
                  <h4><i class="fa fa-angle-right"></i> Turnos Otorgados en el Año Mes a Mes</h4>
                  <canvas id="myChart" ></canvas>
              
            </div>
                  
                </div>
              </div>
              <!-- /col-md-4 -->
            </div>
            <!-- /row -->
          </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
          <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
              *********************************************************************************************************************************************************** -->
          <div class="col-lg-3 ds">
            <!--COMPLETED ACTIONS DONUTS CHART-->
           <br><br><br><br><br><br><br><br><br><br><br>
            <div class="donut-main">
              <h4>Estado de Turnos Por Mes <br><br>
               Mes Actual: <?php setlocale(LC_TIME, 'es_ES', 'esp_esp');
               echo strftime(" %B ");?>
                </h4>
              <canvas id="myChart2" height="200" width="130"></canvas>
             
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br>
          </div>
          <!-- /col-lg-3 -->

        </div>

        <!-- /row -->
      </section>
    </section>
  </body>

<script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var labels_db = [];
                var data_bd = [];
                <?php foreach($pacientesEnElMesPorAño as $pacientes):?>
                  labels_db.push("<?php echo $pacientes['mes']?>");
                  data_bd.push("<?php echo $pacientes['total']?>")
                <?php endforeach?>
                console.log(labels_db);
                console.log(data_bd);
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels_db,
                        datasets: [{
                            label: '# of Turnos',
                            data: data_bd,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
</script>

 <script>

    const CHART = document.getElementById("myChart2");
    var data = [];
    var labels = [];
    <?php foreach($estadoTurnosPorMes as $estados):?>
      data.push("<?php echo $estados['estado']?>");
      labels.push("<?php echo $estados['DESCRIPCION']?>")
    <?php endforeach?>

    console.log(labels);
    console.log(data);
    let barChart = new Chart(CHART, {
       type: 'pie',
        data:{
        labels: labels,
        datasets: [
          {
            labels: 'Points',
            backgroundColor: ['#6AD628','#E83B23', '#F1D90F', '#2980b9'],
            data: data,
            }
            ]
          },
        options: {
        cutoutPercentage: 50,
         animation: {
         animateScale: true,
            }
          }
                  
  });

</script>
</html>
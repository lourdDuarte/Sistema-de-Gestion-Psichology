<?php

require_once 'MySQL.php';
require_once 'Agenda.php';
require_once 'AgendaDia.php';

class Turno
{
	private $_idTurno;
	private $_idPaciente;
	private $_idProfesional;
	private $_fecha;
	private $_hora;
    private $_idEstado;


    /**
     * @return mixed
     */
    public function getIdTurno()
    {
        return $this->_idTurno;
    }

    /**
     * @param mixed $_idTurno
     *
     * @return self
     */
    public function setIdTurno($_idTurno)
    {
        $this->_idTurno = $_idTurno;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPaciente()
    {
        return $this->_idPaciente;
    }

    /**
     * @param mixed $_idPaciente
     *
     * @return self
     */
    public function setIdPaciente($_idPaciente)
    {
        $this->_idPaciente = $_idPaciente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdProfesional()
    {
        return $this->_idProfesional;
    }

    /**
     * @param mixed $_idProfesional
     *
     * @return self
     */
    public function setIdProfesional($_idProfesional)
    {
        $this->_idProfesional = $_idProfesional;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->_fecha;
    }

    /**
     * @param mixed $_fecha
     *
     * @return self
     */
    public function setFecha($_fecha)
    {
        $this->_fecha = $_fecha;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->_hora;
    }

    /**
     * @param mixed $_hora
     *
     * @return self
     */
    public function setHora($_hora)
    {
        $this->_hora = $_hora;

        return $this;
    }

 /**
     * @return mixed
     */
    public function getIdEstado()
    {
        return $this->_idEstado;
    }



    public function obtenerTodos(){
            /*
             obtiene todos los turnos
            */
        $mysql = new MySQL();
        $query = 'Select * from turno';
        $result = $mysql->consultar($query);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    public function obtenerPorIdProfesional($id){
        $mysql = new MySQL();
        $sql = "SELECT * FROM turno INNER JOIN profesional "
             . " ON turno.id_profesional = profesional.id_profesional "
             . " WHERE turno.id_profesional = ". $id.";";
         $result = $mysql->consultar($sql);
         return $result;
    }

    public function obtenerPorIdPaciente($id){

        $sql = " SELECT turno.id_paciente, turno.fecha, turno.hora, turno.id_estado FROM turno "
             . " INNER JOIN paciente ON paciente.id_paciente = turno.id_paciente "
             . " WHERE paciente.id_paciente = ". $id;

        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);

        $mysql->desconectar();

        $listado= self::_generarListadoTurno($datos);

        return $listado;
    }

    private function _generarListadoTurno($datos) {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) {
            $turno = new Turno();
            $turno->_idTurno = $registro['id_turno'];
            $turno->_idProfesional = $registro['id_profesional'];
            $turno->_idPaciente = $registro['id_paciente'];
            $turno->_fecha = $registro['fecha'];
            $turno->_hora = $registro['hora'];
            $turno->_idEstado = $registro['id_estado'];
                $listado[] = $turno;
        }
        return $listado;
    }
    
    public function obtenerPorIdTurno($id){
        
        $sql = " SELECT * FROM turno WHERE id_turno = ". $id;
        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $turno= self::_generarTurno($data);

        return $turno;
    }

    private function _generarTurno($data){
        $turno = new Turno();
        $turno->_idTurno = $data['id_turno'];
        $turno->_idProfesional = $data['id_profesional'];
        $turno->_idPaciente = $data['id_paciente'];
        $turno->_fecha = $data['fecha'];
        $turno->_hora = $data['hora'];
        $turno->_idEstado = $data['id_estado'];
        return $turno;

    }
    
    public function guardar(){

        $sql = " INSERT INTO turno (id_paciente,id_profesional,fecha,hora,id_estado) "
             . " VALUES (NULL, $this->_idProfesional, '$this->_fecha', '$this->_hora',NULL) ";

        echo $sql;

        $mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idTurno = $idInsertado;
    }
  
    public function calcularHorario($id){

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $agenda = Agenda::obtenerAgendaPorId($id);
        $horaInicio = new DateTime($agenda->getHoraDesde());
        $horaFin    = new DateTime($agenda->getHoraHasta());
        $intervalo = $agenda->getDuracion();
        $horaFin->modify('-1 second'); 


        // Intervalos en minutos       
        $intervalo = new DateInterval('PT'.$intervalo.'M');

         // periodo entre las horas segun los intervalos
        $periodo   = new DatePeriod($horaInicio, $intervalo, $horaFin);        

        return $periodo;
    }



    public function generar($idAgenda)
    {
    	$agenda = Agenda::obtenerAgendaPorId($idAgenda);
        $agenda->setGenerado(1);
        $agenda->actualizarGenerador();
        $calculoHorario = Turno::calcularHorario($idAgenda);
    	$agendaDia = AgendaDia::obtenerDiasPorIdAgenda($idAgenda);

        


    	date_default_timezone_set('America/Argentina/Buenos_Aires');

        $totalTurnos =0 ;
        $turnos = 0;
        $horas = 0;

        
    	$fecha1 = new DateTime($agenda->getFechaHasta());
		$fecha2 = new DateTime($agenda->getFechaDesde());
        $fecha2->modify("- 1 day");
		$diferencia = $fecha1->diff($fecha2);

        $dias = 0;
       
        $fechaActual = Date($agenda->getFechaDesde());
        $fechaHoy = date("Y-n-d");
    	while ($dias < $diferencia->days) 
    	{
            $fecha = date("Y-m-d",strtotime($fechaActual."+ $dias days")); 
            
            $day_number =  date('N', strtotime($fecha));
    		

    		foreach ($agendaDia as $dia) 
            {
                
                
    		   switch ($day_number) 
    			{


    				case '1':
                        
    					if ($dia->getLunes() == 1)
                        {
        
                        
                            foreach( $calculoHorario as $hora ) 
                            {
                                $horario = $hora->format('H:i:s');
                                
                                
                                    $turno = new Turno();
                                    $turno->setIdProfesional($agenda->getIdProfesional());
                                    $turno->setHora($horario);
                                    $turno->setFecha($fecha);

                                    $turno->guardar();
                                    
                                    //highlight_string(var_export($turno,true));
                                    
                                    
                                
                            }
                         $totalTurnos=$turnos;
                        
                        }
    				break;
    			
    				case '2':

                        if ($dia->getMartes() == 1)
                        {
                          
                        
                            foreach( $calculoHorario as $hora ) 
                            {
                                $horario = $hora->format('H:i:s');
                               
                                    $turno = new Turno();
                                    $turno->setIdProfesional($agenda->getIdProfesional());
                                    $turno->setHora($horario);
                                    $turno->setFecha($fecha);

                                    $turno->guardar();
                                   
                            }
                         $totalTurnos=$turnos;
                        
                        }
    				break;
    				case '3':

                        if ($dia->getMiercoles() == 1)
                        {
                          
                        
                            foreach( $calculoHorario as $hora ) 
                            {
                                $horario = $hora->format('H:i:s');
                               
                                    $turno = new Turno();
                                    $turno->setIdProfesional($agenda->getIdProfesional());
                                    $turno->setHora($horario);
                                    $turno->setFecha($fecha);

                                    $turno->guardar();
                                    
                            }
                         $totalTurnos=$turnos;
                        
                        }
    				break;
    				case '4':

                        if ($dia->getJueves() == 1)
                        {
                          
                        
                            foreach( $calculoHorario as $hora ) 
                            {
                                $horario = $hora->format('H:i:s');
                                
                                $turno = new Turno();
                                $turno->setIdProfesional($agenda->getIdProfesional());
                                $turno->setHora($horario);
                                $turno->setFecha($fecha);

                                $turno->guardar();
                                
                            }
                         $totalTurnos=$turnos;
                        
                        }
    				break;
    				case '5':

                        if ($dia->getViernes() == 1)
                        {
                          
                        
                            foreach( $calculoHorario as $hora ) 
                            {
                                $horario = $hora->format('H:i:s');
                               
                                    $turno = new Turno();
                                    $turno->setIdProfesional($agenda->getIdProfesional());
                                    $turno->setHora($horario);
                                    $turno->setFecha($fecha);

                                    $turno->guardar();
                                    
                            }
                         $totalTurnos=$turnos;
                        
                        }
    				break;
    			}        
            }
    		
    		
    		$dias+= 1;	
    	}
    }		

    		


   
}



?>


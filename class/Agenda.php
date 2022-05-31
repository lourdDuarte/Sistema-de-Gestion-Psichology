<?php

require_once 'Mysql.php';
require_once 'Turno.php';
//require_once 'Profesional.php';
//require_once 'EstadoAgenda.php';

require_once 'AgendaDia.php';


class Agenda{

	private $_idAgenda;
	private $_idProfesional;
	private $_horaDesde;
	private $_horaHasta;
	private $_fechaDesde ;
	private $_fechaHasta;
	private $_duracion;
    
    private $_generado;
  
	private $_arrDias;

   
    /**
     * @return mixed
     */
    public function getIdAgenda()
    {
        return $this->_idAgenda;
    }

    /**
     * @param mixed $_idAgenda
     *
     * @return self
     */
    public function setIdAgenda($_idAgenda)
    {
        $this->_idAgenda = $_idAgenda;

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
    
    /**
     * @return mixed
     */
    public function getHoraDesde()
    {
        return $this->_horaDesde;
    }

    /**
     * @param mixed $_horaDesde
     *
     * @return self
     */
    public function setHoraDesde($_horaDesde)
    {
        $this->_horaDesde = $_horaDesde;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoraHasta()
    {
        return $this->_horaHasta;
    }

    /**
     * @param mixed $_horaHasta
     *
     * @return self
     */
    public function setHoraHasta($_horaHasta)
    {
        $this->_horaHasta = $_horaHasta;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaDesde()
    {
        return $this->_fechaDesde;
    }

    /**
     * @param mixed $_fechaDesde
     *
     * @return self
     */
    public function setFechaDesde($_fechaDesde)
    {
        $this->_fechaDesde = $_fechaDesde;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaHasta()
    {
        return $this->_fechaHasta;
    }

    /**
     * @param mixed $_fechaHasta
     *
     * @return self
     */
    public function setFechaHasta($_fechaHasta)
    {
        $this->_fechaHasta = $_fechaHasta;

        return $this;
    }
        /**
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->_duracion;
    }

    /**
     * @param mixed $_duracion
     *
     * @return self
     */
    public function setDuracion($_duracion)
    {
        $this->_duracion = $_duracion;

        return $this;
    }
   

    
    public function guardar(){

    	$sql = " INSERT INTO agenda (id_agenda,id_profesional,hora_desde,hora_hasta,fecha_desde,fecha_hasta,duracion, generado) "
    		. " VALUES (NULL, $this->_idProfesional, '$this->_horaDesde', '$this->_horaHasta', "
    		. " '$this->_fechaDesde', '$this->_fechaHasta', $this->_duracion, NULL) ";

   

    	$mysql = new MySQL();

    	$idInsertado = $mysql->insertar($sql);

    	$this->_idAgenda = $idInsertado;
    }

    public function actualizar(){

        $sql= " UPDATE agenda SET hora_desde = '$this->_horaDesde', hora_hasta = '$this->_horaHasta', "
            . " fecha_desde = '$this->_fechaDesde', fecha_hasta = '$this->_fechaHasta', duracion = $this->_duracion"
            . " WHERE id_agenda = $this->_idAgenda ";
        ;

        $mysql = new MySQL();
        $mysql->actualizar($sql);
    }

    public function actualizarGenerador(){

        $sql= " UPDATE agenda SET generado = $this->_generado WHERE id_agenda = $this->_idAgenda ";
        //echo $sql;
        $mysql = new MySQL();
        $mysql->actualizar($sql);
    }

    public function eliminar(){

        $sql = " DELETE FROM agenda "
            . " INNER JOIN agendaDia ON agenda.id_agenda = agendaDia.id_agenda "
            . " WHERE agenda.id_agenda = $this->_idAgenda ";

        $mysql= new MySQL();
        $mysql->eliminar($sql);

    }


    public function obtenerTodos(){

    	$sql= " SELECT * FROM agenda ";

    	$mysql= new MySQL();
    	$datos=$mysql->consultar($sql);

    	$mysql->desconectar();

    	$listado= self::_generarListadoAgenda($datos);

    	return $listado;
    }

    private function _generarListadoAgenda($datos){

    	$listado = array();
    	while ($registro = $datos->fetch_assoc()) {
    		$agenda= new Agenda();
    		$agenda->_idAgenda = $registro['id_agenda'];
    		$agenda->_idProfesional = $registro['id_profesional'];
    		//$agenda->_idEstado = $registro['id_estado'];
    		$agenda->_horaDesde = $registro['hora_desde'];
    		$agenda->_horaHasta = $registro['hora_hasta'];
    		$agenda->_fechaDesde = $registro['fecha_desde'];
    		$agenda->_fechaHasta = $registro ['fecha_hasta'];
    		$agenda->_duracion = $registro ['duracion'];
            $agenda->_generado = $registro ['generado'];
    		$listado[] = $agenda;
    	}

    	return $listado;
    }

    public function obtenerAgendaPorId($id){
        
    	$sql= " SELECT * FROM agenda "
    		. " WHERE id_agenda = ". $id;

    	$mysql = new MySQL();
    	$result = $mysql->consultar($sql);
    	$mysql->desconectar();

    	$data = $result->fetch_assoc();
    	$agenda= self::_generarAgenda($data);

    	return $agenda;
    }



    private function _generarAgenda($data){

    	$agenda= new Agenda();
    	$agenda->_idAgenda = $data['id_agenda'];
    	$agenda->_idProfesional = $data['id_profesional'];
    	$agenda->_horaDesde = $data['hora_desde'];
    	$agenda->_horaHasta = $data['hora_hasta'];
    	$agenda->_fechaDesde = $data['fecha_desde'];
    	$agenda->_fechaHasta = $data['fecha_hasta'];
    	$agenda->_duracion = $data['duracion'];
        $agenda->_generado = $data['generado'];
        $agenda->_arrDias = AgendaDia::obtenerDiasPorIdAgenda($agenda->_idAgenda); 
    	return $agenda;

    }


    public function obtenerAgendaPorIdProfesional($idProfesional){
        $sql = "SELECT * FROM agenda "
            . " INNER JOIN profesional ON agenda.id_profesional = profesional.id_profesional "
            . " WHERE profesional.id_profesional = ". $idProfesional;

        $mysql = new MySQL();

        $datos = $mysql->consultar($sql);

        $mysql->desconectar();

        $listado = self::_generarListadoAgenda($datos);
        return $listado;
    }

    public function eliminarDiasAgenda(){
        $sql = " DELETE FROM agendaDia WHERE id_agenda = $this->_idAgenda";
        $mysql = new MySQL();
        $mysql->actualizar($sql);
    }

    public function aplicar($id)
    {
       $aplicarAgenda = Turno::generar($id);

    }
   



    public function __toString() {
        return $this->_idAgenda;
    }













    /**
     * @return mixed
     */
    public function getGenerado()
    {
        return $this->_generado;
    }

    /**
     * @param mixed $_generado
     *
     * @return self
     */
    public function setGenerado($_generado)
    {
        $this->_generado = $_generado;

        return $this;
    }
}

?>




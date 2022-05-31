<?php

require_once 'MySQL.php';

class PacienteObservacion{
	private $_idPacienteObservacion;
	private $_idPaciente;
	private $_descripcion;

    /**
     * @return mixed
     */
    public function getIdPacienteObservacion()
    {
        return $this->_idPacienteObservacion;
    }

    /**
     * @param mixed $_idPacienteObservacion
     *
     * @return self
     */
    public function setIdPacienteObservacion($_idPacienteObservacion)
    {
        $this->_idPacienteObservacion = $_idPacienteObservacion;

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
    public function getDescripcion()
    {
        return $this->_descripcion;
    }

    /**
     * @param mixed $_descripcion
     *
     * @return self
     */
    public function setDescripcion($_descripcion)
    {
        $this->_descripcion = $_descripcion;

        return $this;
    }


    public function guardar(){

    	$sql = " INSERT INTO pacienteObservacion (id_paciente_observacion, id_paciente, descripcion) "
    		 . " VALUES (NULL, $this->_idPaciente, '$this->_descripcion') ";

    	$mysql = new MySQL();

    	$idInsertado = $mysql->insertar($sql);

    	$this->_idPacienteObservacion = $idInsertado; 
    }

    public function obtenerPorIdPaciente($id){

    		$sql= " SELECT * FROM pacienteObservacion WHERE id_paciente = ". $id;

    		$mysql = new MySQL();

    		$datos = $mysql->consultar($sql);
    		$mysql->desconectar();

            $listado= self::_generarListadoObservacion($datos);

            return $listado;
    }

    private function _generarListadoObservacion($datos){
    	$listado = array();
    	 while ($registro = $datos->fetch_assoc()) {
    	 	$observacion = new PacienteObservacion();
    	 	$observacion->_idPacienteObservacion = $registro['id_paciente_observacion'];
    	 	$observacion->_idPaciente = $registro['id_paciente'];
    	 	$observacion->_descripcion = $registro['descripcion'];
    	 	$listado[] = $observacion;
    	 }
    	 return $listado;
    }


    public function __toString() {
        return $this->_descripcion;
    }

}

?>
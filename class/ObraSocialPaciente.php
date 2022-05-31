<?php

require_once 'MySQL.php';

class ObraSocialPaciente{
	private $_idObraSocialPaciente;
	private $_idObraSocial;
	private $_idPaciente;
    private $_numeroAsociado;

    /**
     * @return mixed
     */
    public function getIdObraSocialPaciente()
    {
        return $this->_idObraSocialPaciente;
    }

    /**
     * @param mixed $_idObraSocialPaciente
     *
     * @return self
     */
    public function setIdObraSocialPaciente($_idObraSocialPaciente)
    {
        $this->_idObraSocialPaciente = $_idObraSocialPaciente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdObraSocial()
    {
        return $this->_idObraSocial;
    }

    /**
     * @param mixed $_idObraSocial
     *
     * @return self
     */
    public function setIdObraSocial($_idObraSocial)
    {
        $this->_idObraSocial = $_idObraSocial;

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
    public function getNumeroAsociado()
    {
        return $this->_numeroAsociado;
    }

    /**
     * @param mixed $_numeroAsociado
     *
     * @return self
     */
    public function setNumeroAsociado($_numeroAsociado)
    {
        $this->_numeroAsociado = $_numeroAsociado;

        return $this;
    }

    public function guardar(){
    	$sql= " INSERT INTO paciente_OS (id_obra_social_paciente, id_obra_social, id_paciente, numero_asociado) "
    		. " VALUES (NULL, $this->_idObraSocial, $this->_idPaciente, $this->_numeroAsociado) ";

    	$mysql= new MySQL();

    	$idInsertado = $mysql->insertar($sql);

    	$this->_idObraSocialPaciente = $idInsertado;
    }
    public function obtenerPorIdPaciente($id){
         $sql = " SELECT paciente_OS.numero_asociado FROM paciente_OS WHERE id_paciente = ". $id;
         $mysql = new MySQL();
         $datos = $mysql->consultar($sql);

         $mysql->desconectar();

         $listado= self::_generarListadoPacienteOs($datos);

        return $listado;
    }

    private function _generarListadoPacienteOs($datos)
    {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) 
        {
            $pacienteOs = new ObraSocialPaciente();
            $pacienteOs->_idObraSocialPaciente = $registro['id_obra_social_paciente'];
            $pacienteOs->_idPaciente = $registro['id_paciente'];
            $pacienteOs->_idObraSocial = $registro['id_obra_social'];
            $pacienteOs->_numeroAsociado = $registro['numero_asociado'];
            $listado[] = $pacienteOs;
        }

    return $listado;
    }
}


?>
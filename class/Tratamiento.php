<?php

require_once 'MySQL.php';

class Tratamiento{
	private $_idTratamiento;
	private $_tipo;
	private $_observacion;

    /**
     * @return mixed
     */
    public function getIdTratamiento()
    {
        return $this->_idTratamiento;
    }

    /**
     * @param mixed $_idTratamiento
     *
     * @return self
     */
    public function setIdTratamiento($_idTratamiento)
    {
        $this->_idTratamiento = $_idTratamiento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->_tipo;
    }

    /**
     * @param mixed $_tipo
     *
     * @return self
     */
    public function setTipo($_tipo)
    {
        $this->_tipo = $_tipo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getObservacion()
    {
        return $this->_observacion;
    }

    /**
     * @param mixed $_observacion
     *
     * @return self
     */
    public function setObservacion($_observacion)
    {
        $this->_observacion = $_observacion;

        return $this;
    }


    public function guardar(){
    	$sql= " INSERT INTO tratamiento (id_tratamiento,tipo,observacion) "
    		. " VALUES (NULL,'$this->_tipo', '$this->_observacion') ";
        //echo $sql;

        $mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idTratamiento = $idInsertado;
    }

    public function actualizar(){
    	$sql= " UPDATE tratamiento SET tipo = '$this->_tipo', observacion = '$this->_observacion' ";
    	//echo $sql;

    	$mysql = new MySQL();
        $mysql->actualizar($sql);
        $mysql->desconectar();

    }


    public function obtenerTodos(){
    	$sql=" SELECT * FROM tratamiento ";

    	$mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();

        $listado=self::_generarListadoTratamiento($datos);

        return $listado;
    }

    private function _generarListadoTratamiento($datos){
    	$listado = array();
		while ($registro = $datos->fetch_assoc()) {
			$tratamiento= new Tratamiento;
			$tratamiento->_idTratamiento = $registro['id_tratamiento'];
			$tratamiento->_tipo = $registro['tipo'];
			$tratamiento->_observacion = $registro['observacion'];
			$listado[] = $tratamiento;
		}
		return $listado;
    }

    public function obtenerPorId($id){
    	$sql= "SELECT id_tratamiento, tipo, observacion FROM tratamiento "
    		." WHERE id_tratamiento = " . $id;

        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $tratamiento = self::_generarTratamiento($data);

        return $tratamiento;
    }

    private function _generarTratamiento($data){
    	$tratamiento= new Tratamiento;
    	$tratamiento->_idTratamiento = $data['id_tratamiento'];
		$tratamiento->_tipo = $data['tipo'];
		$tratamiento->_observacion = $data['observacion'];
		return $tratamiento;

    }

    public function __toString(){
    	return $this->_observacion;
    }
}


?>
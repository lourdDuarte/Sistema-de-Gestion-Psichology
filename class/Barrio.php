<?php

require_once 'MySQL.php';

class Barrio {
	private $_idBarrio;
	private $_descripcion;

    public function __construct($descripcion) {
        $this->_descripcion = $descripcion;
    }

	 /**
     * @return mixed
     */
    public function getIdBarrio()
    {
        return $this->_idBarrio;
    }

    /**
     * @param mixed $_idBarrio
     *
     * @return self
     */
    public function setIdBarrio($_idBarrio)
    {
        $this->_idBarrio = $_idBarrio;

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
     * @param mixed $_nombre
     *
     * @return self
     */
    public function setDescripcion($_descripcion)
    {
        $this->_descripcion = $_descripcion;

        return $this;
    }

    public function guardar() {
    	$sql = "INSERT INTO barrio (id_barrio, descripcion) VALUES (NULL, '$this->_descripcion') ";

    	$mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idBarrio = $idInsertado;
    }

    public function actualizar() {
        $sql = "UPDATE barrio SET descripcion = '$this->_descripcion' WHERE id_barrio = $this->_idBarrio ";

        $mysql = new MySQL();
        $mysql->actualizar($sql);
    }

    public static function obtenerTodos() {
        $sql = " SELECT * FROM barrio ";

        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();

        $listado = self::_generarListadoBarrio($datos);
        return $listado;
    }

    private function _generarListadoBarrio($datos) {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) {
            $barrio = new Barrio($registro['descripcion']);
            $barrio->_idBarrio = $registro['id_barrio'];
            $listado[] = $barrio;
        }
        return $listado;
    }


    public static function obtenerPorId($id) {
        $sql = "SELECT * FROM barrio WHERE id_barrio = ". $id;


        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $barrio = self::_generarBarrio($data);
        return $barrio;

    }

    private function _generarBarrio($data) {
        $barrio = new Barrio($data['descripcion']);
        $barrio->_idBarrio = $data['id_barrio'];
        return $barrio;
    }

    public function __toString() {
        return $this->_descripcion;
    }

   
}


?>
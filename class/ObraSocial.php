<?php
require_once 'MySQL.php';

class ObraSocial{
	private $_idObraSocial;
	private $_nombre;
	private $_coSeguro;


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
    public function getNombre()
    {
        return $this->_nombre;
    }


    /**
     * @param mixed $_nombre
     *
     * @return self
     */
    public function setNombre($_nombre)
    {
        $this->_nombre = $_nombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoSeguro()
    {
        return $this->_coSeguro;
    }

    /**
     * @param mixed $_coSeguro
     *
     * @return self
     */
    public function setCoSeguro($_coSeguro)
    {
        $this->_coSeguro = $_coSeguro;

        return $this;
    }



    public function guardar() {

        $sql = " INSERT INTO obraSocial (id_obra_social, nombre, co_seguro) "
             . " VALUES (NULL, '$this->_nombre', $this->_coSeguro)";

        echo $sql;
 
        $mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idObraSocial = $idInsertado;
    }

    public function actualizar() {

        $sql = "UPDATE obraSocial SET nombre = '$this->_nombre', co_seguro = $this->_coSeguro WHERE id_obra_social = $this->_idObraSocial";
        $mysql = new MySQL();
        $mysql->actualizar($sql);

    }

    public function eliminar(){
        $sql= "DELETE FROM obraSocial WHERE id_obra_social = $this->_idObraSocial";

        //echo $sql;

        $mysql= new MySQL;
        $mysql->eliminar($sql);

    }


    public static function obtenerTodos(){

        $sql = "SELECT id_obra_social, nombre, co_seguro "
             . " FROM obrasocial";
        //echo $sql;

        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();

        $listado = self::_generarListadoObraSocial($datos);
// 
        return $listado;
    }


    public function obtenerOsPorIdProfesional($idProfesional){
        $sql = " SELECT obraSocial.id_obra_social, obraSocial.nombre, obraSocial.co_seguro "
             . " FROM obraSocial "
             . " INNER JOIN profesional_OS ON profesional_OS.id_obra_social = obraSocial.id_obra_social "
             . " INNER JOIN profesional ON profesional.id_profesional = profesional_OS.id_profesional "
             . " WHERE profesional.id_profesional = " . $idProfesional;

        $mysql= new MySQL();
        $datos=$mysql->consultar($sql);

        $mysql->desconectar();

        $listado= self::_generarListadoObraSocial($datos);

        return $listado;
    }

    public function obtenerOsPorIdPaciente($idPaciente){
        $sql = " SELECT obraSocial.id_obra_social, obraSocial.nombre, obraSocial.co_seguro "
             . " FROM obraSocial "
             . " INNER JOIN paciente_OS ON paciente_OS.id_obra_social = obraSocial.id_obra_social "
             . " INNER JOIN paciente ON paciente.id_paciente = paciente_OS.id_paciente "
             . " WHERE paciente.id_paciente = " . $idPaciente;

        $mysql= new MySQL();
        $datos=$mysql->consultar($sql);

        $mysql->desconectar();

        $listado= self::_generarListadoObraSocial($datos);

        return $listado;
    }

  
    private function _generarListadoObraSocial($datos) {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) {
            $obraSocial = new ObraSocial;
            $obraSocial->_idObraSocial = $registro['id_obra_social'];
            $obraSocial->_nombre = $registro['nombre'];
            $obraSocial->_coSeguro = $registro['co_seguro'];
            $listado[] = $obraSocial;
        }
        return $listado;
    }
    

    public static function obtenerPorId($id) {

        $sql = "SELECT id_obra_social, nombre, co_seguro "
             ." FROM obrasocial WHERE id_obra_social = " . $id; 

        //echo $sql;

        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $obraSocial = self::_generarObraSocial($data);

        return $obraSocial;
    }
    


    private function _generarObraSocial($data) {
        $obraSocial= new ObraSocial;
        $obraSocial->_idObraSocial= $data['id_obra_social'];
        $obraSocial->_nombre = $data['nombre'];
        $obraSocial->_coSeguro = $data['co_seguro'];
        return $obraSocial;
    }


    public function __toString() {
        return $this->_nombre;
    }











}


?>
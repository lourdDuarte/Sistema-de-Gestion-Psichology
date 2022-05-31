<?php
require_once 'MySQL.php';

class Especialidad
{
	private $_idEspecialidad;
	private $_tipo;


    /**
     * @return mixed
     */
    public function getIdEspecialidad()
    {
        return $this->_idEspecialidad;
    }
    /**
     * @param mixed $_idEspecialidad
     *
     * @return self
     */
    public function setIdEspecialidad($_idEspecialidad)
    {
        $this->_idEspecialidad = $_idEspecialidad;

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


    
   public function guardar() {


        $sql = "INSERT INTO Especialidad (id_especialidad, tipo) "
             . " VALUES (NULL, '$this->_tipo')";

        echo $sql;
        $mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idEspecialidad = $idInsertado;
    }

    public function actualizar() {


        $sql = "UPDATE Especialidad SET tipo = '$this->_tipo' WHERE id_especialidad = $this->_idEspecialidad";
        $mysql = new MySQL();
        $mysql->actualizar($sql);

    }


    public static function obtenerTodos() {

        $sql = "SELECT id_especialidad, tipo "
             . " FROM especialidad ";
       
       // echo $sql;

        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();



        $listado = self::_generarListadoEspecialidad($datos);

        return $listado;
    }


    private function _generarListadoEspecialidad($datos) {
        $listado = array();

        while ($registro = $datos->fetch_assoc()) 
        {
            $especialidad = new Especialidad;
            $especialidad->_idEspecialidad = $registro['id_especialidad'];
            $especialidad->_tipo = $registro['tipo'];

            $listado[] = $especialidad;
        }
        return $listado;
    }




   public static function obtenerPorId($id) {
        $sql = " SELECT id_especialidad, tipo "
             . " FROM especialidad WHERE id_especialidad = " . $id;

        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $especialidad = self::_generarEspecialidad($data);
        return $especialidad;
    }


    private function _generarEspecialidad($data) {
        $especialidad = new Especialidad;
        $especialidad->_idEspecialidad= $data['id_especialidad'];
        $especialidad->_tipo = $data['tipo'];

        return $especialidad;
    }

    public function obtenerEspecialidadPorIdProfesional($idProfesional){

        $sql= " SELECT especialidad.id_especialidad, especialidad.tipo "
            . " FROM especialidad "
            . " INNER JOIN profesional_especialidad ON profesional_especialidad.id_especialidad = especialidad.id_especialidad "
            . " INNER JOIN profesional ON profesional.id_profesional = profesional_especialidad.id_profesional "
            . " WHERE profesional.id_profesional = " . $idProfesional;

        $mysql= new MySQL();
        $datos=$mysql->consultar($sql);

        $mysql->desconectar();

        $listado= self::_generarListadoEspecialidad($datos);

        return $listado;
    }

    public function __toString() {
        return $this->_tipo;

    }



}


?>
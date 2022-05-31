<?php
require_once 'Persona.php';
require_once 'MySQL.php';
require_once 'Especialidad.php';
require_once 'ObraSocial.php';

class Profesional extends Persona{

	private $_idProfesional;
	private $_matricula;
    private $_arrEspecialidad;
    private $_arrObraSocial;

   // private $_agendaProfesional;


	//private $_arrObraSocial = array();



    /**
     * @return mixed
     */
    public function getIdProfesional()
    {
        return $this->_idProfesional;
    }


    /**
     * @return mixed
     */
    public function getMatricula()
    {
        return $this->_matricula;
    }

    /**
     * @param mixed $_matricula
     *
     * @return self
     */
    public function setMatricula($_matricula)
    {
        $this->_matricula = $_matricula;

        return $this;
    }





   public function guardar() {
        parent::guardar();

        $sql = "INSERT INTO Profesional (id_profesional, id_persona, matricula) "
             . "VALUES (NULL, $this->_idPersona, $this->_matricula)";

        echo $sql;
        
        $mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idProfesional = $idInsertado;
    }

    public function actualizar() {
        parent::actualizar();

        $sql = "UPDATE Profesional SET matricula = '$this->_matricula' WHERE id_profesional = $this->_idProfesional";
        $mysql = new MySQL();
        $mysql->actualizar($sql);
        $mysql->desconectar();

    }


    public function eliminar() {

        parent::eliminar();

        $sql= "DELETE FROM profesional  WHERE id_profesional = $this->_idProfesional";

        echo $sql;

        $mysql= new MySQL();
        $mysql->eliminar($sql);

    }



    public static function obtenerTodos() {

        $sql = "SELECT persona.id_persona, persona.nombre, persona.apellido,"
        	 . "profesional.id_profesional, profesional.matricula"
             . " FROM persona "
             . " INNER JOIN profesional ON profesional.id_persona = persona.id_persona";
        //echo $sql;

        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();



        $listado = self::_generarListadoProfesional($datos);

        return $listado;
    }


    private function _generarListadoProfesional($datos) {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) 
        {
            $profesional = new Profesional($registro['nombre'], $registro['apellido']);
            $profesional->_idPersona = $registro['id_persona'];
            $profesional->_idProfesional = $registro['id_profesional'];
            $profesional->_matricula= $registro['matricula'];

            $listado[] = $profesional;
        }
        return $listado;
    }


   public static function obtenerPorId($id) {
        $sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, "
             . "persona.id_tipo_documento, persona.numero_documento, "
             . "persona.fecha_nacimiento, persona.id_estado, profesional.id_profesional, "
             . "profesional.matricula FROM profesional "
             . "INNER JOIN persona on persona.id_persona = profesional.id_persona "
             . "WHERE profesional.id_profesional = " . $id;

        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $profesional = self::_generarProfesional($data);
        return $profesional;
    }


    private function _generarProfesional($data) {
        $profesional = new Profesional($data['nombre'], $data['apellido']);
        $profesional->_idProfesional = $data['id_profesional'];
        $profesional->_matricula = $data['matricula'];
        $profesional->_idPersona = $data['id_persona'];
        $profesional->_fechaNacimiento = $data['fecha_nacimiento'];
        $profesional->_tipoDocumento = $data['id_tipo_documento'];
        $profesional->_numeroDocumento = $data['numero_documento'];
        $profesional->_estado = $data['id_estado'];
        $profesional->setDomicilio();
        $profesional->setContactos();
        $profesional->_arrEspecialidad = Especialidad::obtenerEspecialidadPorIdProfesional($profesional->_idProfesional);
        $profesional->_arrObraSocial = ObraSocial::obtenerOsPorIdProfesional($profesional->_idProfesional);
        //$profesional->_agendaProfesional = Agenda::obtenerAgendaPorIdProfesional($profesional->_idProfesional)

        return $profesional;
    }


    public function tieneObraSocial($idObraSocial){
        $sql = " SELECT * FROM profesional_OS "
             . " WHERE id_obra_social = $idObraSocial "
             . " AND id_profesional = $this->_idProfesional ";

        $mysql= new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        return $result->num_rows > 0;

    }

    public function eliminarObraSocial(){
        $sql= " DELETE FROM profesional_OS WHERE id_profesional = $this->_idProfesional ";
        $mysql= new MySQL();
        $mysql->actualizar($sql);
    }


    public function tieneEspecialidad($idEspecialidad){
        $sql= " SELECT * FROM profesional_especialidad "
            . " WHERE id_especialidad = $idEspecialidad "
            . " AND id_profesional = $this->_idProfesional ";
            
        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        return $result->num_rows > 0;
    }
 

        public function eliminarEspecialidad() {
        $sql = " DELETE FROM profesional_especialidad WHERE id_profesional = $this->_idProfesional";
        $mysql = new MySQL();
        $mysql->actualizar($sql);
    }

}



?>





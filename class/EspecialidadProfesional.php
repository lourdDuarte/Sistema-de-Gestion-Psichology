<?php

require_once 'MySQL.php';

class EspecialidadProfesional{
	private $_idEspecialidadProfesional;
	private $_idEspecialidad;
	private $_idProfesional;

    /**
     * @return mixed
     */
    public function getIdEspecialidadProfesional()
    {
        return $this->_idEspecialidadProfesional;
    }

    /**
     * @param mixed $_idEspecialidadProfesional
     *
     * @return self
     */
    public function setIdEspecialidadProfesional($_idEspecialidadProfesional)
    {
        $this->_idEspecialidadProfesional = $_idEspecialidadProfesional;

        return $this;
    }

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

    public function guardar(){
    	$sql= " INSERT INTO profesional_especialidad (id_especialidad_profesional, id_especialidad, id_profesional) "
    		. " VALUES (NULL, $this->_idEspecialidad, $this->_idProfesional) ";

    	$mysql = new MySQL();

    	$idInsertado = $mysql->insertar($sql);

    	$this->_idEspecialidadProfesional=$idInsertado;


    }



}


?>
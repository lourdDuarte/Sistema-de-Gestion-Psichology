<?php

require_once 'MySQL.php';

class AgendaDia{

	private $_idAgenda;
	private $_lunes;
	private $_martes;
	private $_miercoles;
	private $_jueves;
	private $_viernes;

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
    public function getLunes()
    {
        return $this->_lunes;
    }

    /**
     * @param mixed $_lunes
     *
     * @return self
     */
    public function setLunes($_lunes)
    {
        $this->_lunes = $_lunes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMartes()
    {
        return $this->_martes;
    }

    /**
     * @param mixed $_martes
     *
     * @return self
     */
    public function setMartes($_martes)
    {
        $this->_martes = $_martes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMiercoles()
    {
        return $this->_miercoles;
    }

    /**
     * @param mixed $_miercoles
     *
     * @return self
     */
    public function setMiercoles($_miercoles)
    {
        $this->_miercoles = $_miercoles;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJueves()
    {
        return $this->_jueves;
    }

    /**
     * @param mixed $_jueves
     *
     * @return self
     */
    public function setJueves($_jueves)
    {
        $this->_jueves = $_jueves;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getViernes()
    {
        return $this->_viernes;
    }

    /**
     * @param mixed $_viernes
     *
     * @return self
     */
    public function setViernes($_viernes)
    {
        $this->_viernes = $_viernes;

        return $this;
    }

	public function guardar(){

		$sql = " INSERT INTO AgendaDia (id_agenda, lunes,martes,miercoles,jueves,viernes) "
			 . " VALUES ($this->_idAgenda, $this->_lunes, $this->_martes, $this->_miercoles, "
			 . " $this->_jueves, $this->_viernes) ";

	

		$mysql= new MySQL();

		$mysql->insertar($sql);

		$mysql->desconectar();
	}
	

    

    public function obtenerTodos(){
        $sql = " SELECT * FROM agendaDia";

        echo $sql;
        $mysql= new MySQL();

        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();



        $listado = self::_generarListadoDias($datos);

        return $listado;
    }

    public function obtenerDiasPorIdAgenda($idAgenda){
        $sql = " SELECT * FROM agendaDia "
            . " INNER JOIN agenda ON agendaDia.id_agenda = agenda.id_agenda"
            . " WHERE agenda.id_agenda = ".  $idAgenda;

        //echo $sql;

        $mysql= new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();

        $listado = self::_generarListadoDias($datos);
        return $listado;

    }

    private function _generarDias($data){
        $dias= new AgendaDia();
        $dias->_lunes = $data['lunes'];
        $dias->_martes = $data['martes'];
        $dias->_miercoles = $data['miercoles'];
        $dias->_jueves = $data['jueves'];
        $dias->_viernes = $data['viernes'];
        return $dias;

    }

    public function _generarListadoDias($datos){
        $listado = array();
        while ($registro = $datos->fetch_assoc()) {
            $dias = new AgendaDia();
            $dias->_idAgenda = $registro['id_agenda'];
            $dias->_lunes = $registro['lunes'];
            $dias->_martes = $registro['martes'];
            $dias->_miercoles = $registro['miercoles'];
            $dias->_jueves = $registro['jueves'];
            $dias->_viernes = $registro['viernes'];
            $listado[] = $dias;
        }

        return $listado;
    }
}

?>



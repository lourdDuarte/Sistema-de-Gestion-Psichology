<?php


require_once 'Perfil.php';
require_once 'Persona.php';
require_once 'MySQL.php';

class Usuario extends Persona{
	private $_idUsuario;
	private $_username;
	private $_password;
    private $_fechaUltimoLogin;
    private $_estaLogueado;
    private $_idPerfil;

    public $perfil;


    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->_idUsuario;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $_username
     *
     * @return self
     */
    public function setUsername($_username)
    {
        $this->_username = $_username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $_password
     *
     * @return self
     */
    public function setPassword($_password)
    {
        $this->_password = $_password;

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->_idPerfil;
    }

    /**
     * @param mixed $_idPerfil
     *
     * @return self
     */
    public function setIdPerfil($_idPerfil)
    {
        $this->_idPerfil = $_idPerfil;

        return $this;
    }

 public static function login($username, $password) {
        $sql = "SELECT * FROM usuario "
             . " INNER JOIN persona on persona.id_persona = usuario.id_persona "
             . " WHERE username = '$username' "
             . " AND password = '$password' "
             . " AND persona.id_estado = 1";

        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        if ($result->num_rows > 0) {
            $registro = $result->fetch_assoc();
            $usuario = new Usuario($registro['nombre'], $registro['apellido']);
            $usuario->_idUsuario = $registro['id_usuario'];
            $usuario->_idPersona = $registro['id_persona'];
            $usuario->_username = $registro['username'];
            $usuario->_password = $registro['password'];
            $usuario->_fechaUltimoLogin = $registro['fecha_ultimo_login'];
            $usuario->_idPerfil = $registro['id_perfil'];
            $usuario->_estaLogueado = true;

            $usuario->perfil = Perfil::obtenerPorId($usuario->_idPerfil);
            //$usuario->setDomicilio();
        } else {
            $usuario = new Usuario('', '');
            $usuario->_estaLogueado = false;
        }

        return $usuario;
    }

    public function estaLogueado() {
        return $this->_estaLogueado;
    }


   public function guardar() {
        parent::guardar();

        $sql = "INSERT INTO Usuario (id_usuario, id_persona, username, password, id_perfil) "
             . "VALUES (NULL, $this->_idPersona, '$this->_username', '$this->_password', $this->_idPerfil)";

        echo $sql;
        $mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idUsuario = $idInsertado;
    }

    public function actualizar() {
        parent::actualizar();

        $sql = "UPDATE Usuario SET username = '$this->_username', password = '$this->_password' "
             . " WHERE id_usuario = $this->_idUsuario";
        $mysql = new MySQL();
        $mysql->actualizar($sql);

    }

    public function eliminar(){
        parent::eliminar();

        $sql= "DELETE FROM usuario WHERE id_usuario = $this->_idUsuario";

        $mysql= new MySQL;
        $mysql->eliminar($sql);
    }


    public static function obtenerTodos() {

        $sql = "SELECT persona.id_persona, persona.nombre, persona.apellido,"
             . " usuario.id_usuario, usuario.username, usuario.password"
             . " FROM persona "
             . " INNER JOIN usuario ON usuario.id_persona = persona.id_persona";
        //echo $sql;

        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();



        $listado = self::_generarListadoUsuario($datos);

        return $listado;
    }


    private function _generarListadoUsuario($datos) {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) 
        {
            $usuario = new Usuario($registro['nombre'], $registro['apellido']);
            $usuario->_idPersona = $registro['id_persona'];
            $usuario->_idUsuario = $registro['id_usuario'];
            $usuario->_username= $registro['username'];
            $usuario->_password= $registro ['password'];

            $listado[] = $usuario;
        }
        return $listado;
    }


   public static function obtenerPorId($id) {
        $sql = " SELECT * FROM usuario "
             . " INNER JOIN persona ON persona.id_persona = usuario.id_persona "
             . " WHERE id_usuario = " . $id;

        //echo $sql;

        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $usuario = self::_generarUsuario($data);
        return $usuario;
    }


    private function _generarUsuario($data) {
        $usuario = new Usuario($data['nombre'], $data['apellido']);
        $usuario->_idUsuario = $data['id_usuario'];
        $usuario->_idPersona = $data['id_persona'];
        $usuario->_username = $data['username'];
        $usuario->_password = $data['password'];
        $usuario->_fechaNacimiento = $data['fecha_nacimiento'];
        $usuario->_idTipoDocumento = $data['id_tipo_documento'];
        $usuario->_numeroDocumento = $data['numero_documento'];
        $usuario->_idPerfil = $data['id_perfil'];
        $usuario->_estado = $data['id_estado'];
        $usuario->setTipoDocumento();
        return $usuario;
    }



}

?>
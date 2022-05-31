
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_psicologia`

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int auto_increment not null,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `numero_documento` varchar(30) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_estado` int(11) NOT NULL DEFAULT '1',
  primary key (id_persona)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `persona` (`nombre`, `apellido`, `id_tipo_documento`, `numero_documento`, `fecha_nacimiento`, `id_estado`) VALUES
('Mario', 'Gamarra', NULL, NULL, NULL, 1),
('Sara', 'Rodriguez', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--
CREATE TABLE `paciente` (
  `id_paciente` int auto_increment not null,
  `id_persona` int(11) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  primary key(id_paciente)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


create table ficha (
`id_ficha` int auto_increment not null,
`id_paciente` int(11) not null,
`id_profesional` int(11) not null,
`id_tratamiento` int(11) null,
`id_tipo_atencion` int(11) not null,
`fecha_alta` date not null,
primary key (id_ficha)
);

create table `pacienteObservacion`(
`id_paciente_observacion` int auto_increment not null,
`id_paciente` int(11) not null,
`descripcion` mediumtext not null,
primary key(id_paciente_observacion)
);

CREATE TABLE `tipoAtencion` (
  `id_tipo_atencion` int auto_increment NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  primary key (id_tipo_atencion)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into tipoAtencion(`descripcion`) values 
("Familiar"),
("Individual"),
("Especial");

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `id_profesional` int auto_increment NOT NULL,
  `id_persona` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  primary key (id_profesional)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int auto_increment NOT NULL,
  `id_persona` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fecha_ultimo_login` datetime DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  primary key(id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `usuario` (`id_persona`, `username`, `password`, `fecha_ultimo_login`, `id_perfil`) VALUES
(1, 'mgamarra', '123456', NULL, 1),
(2, 'srodriguez', '123456', NULL, 2);



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `id_domicilio` int auto_increment NOT NULL,
  `calle` varchar(30) DEFAULT NULL,
  `altura` varchar(30) DEFAULT NULL,
  `piso` varchar(30) DEFAULT NULL,
  `manzana` varchar(30) DEFAULT NULL,
  `id_persona` int(11) NOT NULL,
  `id_barrio` int(11) NOT NULL,
  primary key(id_domicilio)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE `barrio`(
`id_barrio` int auto_increment not null,
`descripcion` varchar(25) not null,
primary key(id_barrio)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_contacto`
--


CREATE TABLE `persona_contacto` (
  `id_persona_contacto` int auto_increment NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_tipo_contacto` int(11) NOT NULL,
  `valor` varchar(30) NOT NULL,
  primary key(id_persona_contacto)
  );




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoContacto`
--
CREATE TABLE `tipoContacto` (
  `id_tipo_contacto` int auto_increment not null,
  `descripcion` varchar(30) not null,
  primary key(id_tipo_contacto)
);

INSERT INTO tipoContacto (`descripcion`) VALUES
("CELULAR"),
("TELEFONO"),
("CORREO ELECTRONICO");

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id_tipo_documento` int auto_increment NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  primary key(id_tipo_documento)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `tipodocumento` (`id_tipo_documento`, `descripcion`) VALUES
(1, 'Libreta de Enrolamiento'),
(2, 'D.N.I.'),
(3, 'Cedula'),
(4, 'Pasaporte');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `Especialidad` (
  `id_especialidad` int auto_increment NOT NULL,
  `tipo` varchar(25) NOT NULL,
  primary key (id_especialidad)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Especialidad`(`tipo`) VALUES 
("PSICOANALISIS"),
("ADOLESCENTES"),
("NIÑOS");

-- --------------------------------------------------------



--
-- Estructura de tabla para la tabla `profesional_especialidad`

CREATE TABLE `profesional_especialidad`(
	`id_especialidad_profesional` int auto_increment NOT NULL,
    `id_especialidad` int(11) NOT NULL,
    `id_profesional` int(11) NOT NULL,
     primary key (id_especialidad_profesional)
);




-- Estructura de tabla para la tabla `obraSocial`
--
    

CREATE TABLE `obraSocial` (
  `id_obra_social` int auto_increment NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `co_seguro` int(11) DEFAULT NULL,
  primary key (id_obra_social)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `profesional_OS`(
 `id_obra_social_profesional` int auto_increment not null,
 `id_obra_social` int (11) not null,
 `id_profesional` int(11) not null,
 primary key(id_obra_social_profesional)
 );

 CREATE TABLE `tratamiento`(
 `id_tratamiento` int auto_increment not null,
 `tipo` varchar(50) not null,
 `observacion` varchar(150) not null,
 primary key (id_tratamiento)
 );


 CREATE TABLE `paciente_OS`(
 `id_obra_social_paciente` int auto_increment not null,
 `id_obra_social` int (11) not null,
 `id_paciente` int (11) not null,
 `numero_asociado` int(11) not null,
 primary key(id_obra_social_paciente)
 );

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(11) auto_increment NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `directorio` varchar(30) NOT NULL,
  primary key(id_modulo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `modulo` (`descripcion`, `directorio`) VALUES
('Dashboard', 'dashboard'),
('Paciente','pacientes'),
('Profesional','profesional'),
('Fichas','fichaPaciente'),
('Pago','pago'),
('Turno','turno'),
('Agenda','agenda'),
('Usuarios','usuarios'),
('Perfil','perfil'),


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int auto_increment not null,
  `descripcion` varchar(30) NOT NULL,
   primary key(id_perfil)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `perfil` (`descripcion`) VALUES
('ADMINISTRADOR'),
('ASISTENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_modulo`
--

CREATE TABLE `perfil_modulo` (
  `id_perfil_modulo` int auto_increment NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  primary key(id_perfil_modulo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `perfil_modulo` (`id_perfil`,`id_modulo` ) VALUES
(1,1),
(1,2),
(1,3),
(1,4),
(1,5),
(1,6),
(1,7),
(1,8),
(1,9),
(2,2),
(2,3),
(2,4),
(2,6),
(2,7);


CREATE TABLE `agenda`(
`id_agenda` int auto_increment NOT NULL,
`id_profesional` int(11) NOT NULL,
`hora_desde` time NOT NULL,
`hora_hasta` time NOT NULL,
`fecha_desde` date NOT NULL,
`fecha_hasta` date NOT NULL,
`duracion` int(11) NOT NULL,
`generado` int(11) null,
primary key (id_agenda)
);



CREATE TABLE `agendaDia`(
`id_agenda` int(11) not null,
`lunes`  tinyint(1) default null,
`martes` tinyint(1)   null,
`miercoles` tinyint(1)  null,
`jueves` tinyint(1)  null,
`viernes` tinyint(1)  null
);


CREATE TABLE `turno`(
`id_turno` int auto_increment NOT NULL,
`id_paciente` int(11) null,
`id_profesional` int(11) not null,
`fecha` date not null,
`hora` time null,
`id_estado` int(11) null,
primary key(id_turno)
);


CREATE TABLE `estadoTurno`(
`id_estado` int auto_increment NOT NULL,
`descripcion` varchar(25) not null,
primary key(id_estado)
);

insert into estadoTurno (descripcion) VALUES
('Turno cancelado'),
('Turno atendido'),
('Turno confirmado'),
('Turno en espera');

CREATE TABLE `PagoOS`(
`id_pago` int auto_increment NOT NULL,
`id_paciente` int(11) not null,
`id_obra_social` int (11) null,
`sesiones_autorizadas` int(11) not null,
`sesiones_abonada` int(11) not null,
`monto_sesion` int(11) not null,
`fecha` date not null,
`id_estado` int(11)  null,
`total` int (11) not null,
primary key (id_pago)
);

CREATE TABLE `estadoPago`(
`id_estado` int auto_increment NOT NULL,
`descripcion` varchar (25) not null,
primary key (id_estado)
);

insert into estadoPago (descripcion) VALUES 
('Completo'),
('Incompleto');


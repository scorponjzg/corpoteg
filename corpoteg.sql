-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-01-2019 a las 05:51:06
-- Versión del servidor: 8.0.11
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `corpoteg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignado`
--
USE laveco_corpoteg;

CREATE TABLE `asignado` (
  `fk_vacante` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `asignado_activo` tinyint(4) NOT NULL DEFAULT '1',
  `asignado_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `asignado_editado` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `supervisor` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `pk_asistencia` int(11) NOT NULL,
  `fk_servicio` int(11) NOT NULL,
  `hora_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `medio_registro` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Dispositivo' COMMENT 'Si fue por la app o algún dispositivo',
  `codigo_usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Es el campo que concuerda con usuario',
  `accion_registro` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=ENTRADA LABORAL0=SALIDA COMIDA2=ENTRADA COMIDA4=SALIDA LABORAL',
  `fk_usuario` int(11) NOT NULL COMMENT 'Es la persona encargada de seleccionar la ubicación de la app en la que se toma la asistenicia',
  `nombre` varchar(100) NOT NULL COMMENT 'Del usuario para saber si se equivocan de código'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`pk_asistencia`, `fk_servicio`, `hora_registro`, `medio_registro`, `codigo_usuario`, `accion_registro`, `fk_usuario`, `nombre`) VALUES
(1, 1, '2019-01-25 23:42:03', 'App movile', NULL, 1, 1, 'Abraham Jacob Zermño García'),
(2, 1, '2019-01-25 23:47:20', 'App movile', NULL, 0, 1, 'Abraham Jacob Zermño García'),
(3, 1, '2019-01-25 23:50:11', 'App movile', NULL, 1, 1, 'SEBASTIAN VARGAS MARTINEZ'),
(4, 1, '2019-01-25 23:51:56', 'App movile', NULL, 1, 1, 'Abraham Jacob Zermño García'),
(5, 4, '2019-01-25 23:55:56', 'App movile', NULL, 0, 1, 'Abraham Jacob Zermño García'),
(6, 5, '2019-01-26 00:09:42', 'App movile', '99999999', 1, 1, 'Abraham Jacob Zermeño García'),
(7, 5, '2019-01-26 00:10:38', 'App movile', '99999999', 1, 1, 'Abraham Jacob Zermexc3xb1o Garcxc3xada'),
(8, 5, '2019-01-26 00:11:07', 'App movile', '99999999', 0, 1, 'Abraham Jacob Zermeño García'),
(9, 5, '2019-01-26 00:12:39', 'App movile', '99999999', 0, 1, 'Abraham Jacob Zermeño García'),
(10, 3, '2019-01-26 00:13:41', 'App movile', '99999999', 1, 1, 'Abraham Jacob Zermeño García'),
(11, 4, '2019-01-26 00:17:12', 'App movile', '99999999', 1, 1, 'Abraham Jacob Zermeño García'),
(12, 4, '2019-01-26 00:17:50', 'App movile', '99999999', 1, 1, 'Abraham Jacob Zermeño García'),
(13, 5, '2019-01-26 00:20:22', 'App movile', '99999999', 0, 1, 'Abraham Jacob Zermeño García'),
(14, 5, '2019-01-26 00:20:36', 'App movile', '99999999', 0, 1, 'Abraham Jacob Zermeño García'),
(15, 4, '2019-01-26 00:22:41', 'App movile', '99999999', 1, 1, 'Abraham Jacob Zermeño García'),
(16, 4, '2019-01-26 00:22:47', 'App movile', '99999999', 0, 1, 'Abraham Jacob Zermeño García'),
(17, 5, '2019-01-28 18:45:39', 'App movile', '99999999', 1, 1, 'Abraham Jacob Zermeño García'),
(18, 5, '2019-01-28 18:47:14', 'App movile', '99999999', 0, 1, 'Abraham Jacob Zermeño García');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `pk_estatus` int(11) NOT NULL,
  `estatus` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`pk_estatus`, `estatus`) VALUES
(1, 'Contratado'),
(2, 'En tramite');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `pk_log` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `responsable` varchar(100) NOT NULL,
  `accion` varchar(300) NOT NULL,
  `captura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio`
--

CREATE TABLE `medio` (
  `pk_medio` int(11) NOT NULL,
  `idmedio` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medio`
--

INSERT INTO `medio` (`pk_medio`, `idmedio`) VALUES
(1, 'Campo'),
(2, 'Occmundial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `pk_modulo` int(11) NOT NULL,
  `modulo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `pk_perfil` int(11) NOT NULL,
  `perfil` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`pk_perfil`, `perfil`) VALUES
(1, 'Admin'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `fk_perfil` int(11) NOT NULL,
  `fk_modulo` int(11) NOT NULL,
  `ver` tinyint(1) NOT NULL DEFAULT '0',
  `editar` tinyint(1) NOT NULL DEFAULT '0',
  `crear` tinyint(1) NOT NULL DEFAULT '0',
  `eliminar` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `pk_servicio` int(11) NOT NULL,
  `servicio` varchar(300) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`pk_servicio`, `servicio`, `activo`) VALUES
(1, 'Charros', 1),
(2, 'Lavandería', 1),
(3, 'Civil nuevo', 1),
(4, 'Issste', 1),
(5, 'Siteur', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `pk_turno` int(11) NOT NULL,
  `turno` varchar(150) NOT NULL,
  `personal_solicitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `pk_usuario` int(11) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `a_paterno` varchar(100) NOT NULL,
  `a_materno` varchar(100) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `observacion` varchar(500) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `nss` varchar(30) NOT NULL,
  `curp` varchar(30) NOT NULL,
  `tipo_sangre` varchar(4) NOT NULL,
  `contacto` varchar(180) DEFAULT NULL,
  `alergia` varchar(500) DEFAULT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `fk_medio` int(11) NOT NULL,
  `fk_perfil` int(11) NOT NULL,
  `fk_estatus` int(11) NOT NULL,
  `reclutador` tinyint(4) NOT NULL,
  `nombre_foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pk_usuario`, `codigo`, `usuario`, `contrasena`, `nombre`, `a_paterno`, `a_materno`, `telefono`, `observacion`, `correo_electronico`, `fecha_registro`, `fecha_modificacion`, `activo`, `nss`, `curp`, `tipo_sangre`, `contacto`, `alergia`, `direccion`, `fk_medio`, `fk_perfil`, `fk_estatus`, `reclutador`, `nombre_foto`, `usuariocol`) VALUES
(1, '999999', 'admin', 'fb5310aab58e48bb2191f7e26e6bf27eb89562f9', 'Admin', 'P_Admin', 'M_Admin', '3333333333', NULL, 'azermeno@corpoteg.mx', '2019-01-24 21:19:11', '2019-01-24 21:53:33', 1, '75038435980', 'ZEGA841115HJCRRB00', 'B+', NULL, NULL, NULL, 2, 1, 1, 3, 'admin.png', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacante`
--

CREATE TABLE `vacante` (
  `pk_vacante` int(11) NOT NULL,
  `vacante` int(11) NOT NULL COMMENT 'La cantidad de personal a solicitar',
  `fk_turno` int(11) NOT NULL,
  `fk_servicio` int(11) NOT NULL,
  `vacante_activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignado`
--
ALTER TABLE `asignado`
  ADD PRIMARY KEY (`fk_vacante`,`fk_usuario`),
  ADD KEY `fk_vacante_has_usuario_usuario1_idx` (`fk_usuario`),
  ADD KEY `fk_vacante_has_usuario_vacante1_idx` (`fk_vacante`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`pk_asistencia`,`fk_servicio`,`fk_usuario`),
  ADD KEY `fk_asistencia_servicio1_idx` (`fk_servicio`),
  ADD KEY `fk_asistencia_usuario1_idx` (`fk_usuario`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`pk_estatus`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`pk_log`),
  ADD KEY `fk_log_usuario1_idx` (`fk_usuario`);

--
-- Indices de la tabla `medio`
--
ALTER TABLE `medio`
  ADD PRIMARY KEY (`pk_medio`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`pk_modulo`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`pk_perfil`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`fk_perfil`,`fk_modulo`),
  ADD KEY `fk_perfil_has_permisos_permisos1_idx` (`fk_modulo`),
  ADD KEY `fk_perfil_has_permisos_perfil1_idx` (`fk_perfil`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`pk_servicio`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`pk_turno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`pk_usuario`,`fk_medio`,`fk_perfil`,`fk_estatus`),
  ADD KEY `fk_usuario_medio1_idx` (`fk_medio`),
  ADD KEY `fk_usuario_perfil1_idx` (`fk_perfil`),
  ADD KEY `fk_usuario_estatus1_idx` (`fk_estatus`);

--
-- Indices de la tabla `vacante`
--
ALTER TABLE `vacante`
  ADD PRIMARY KEY (`pk_vacante`),
  ADD KEY `fk_vacante_turno1_idx` (`fk_turno`),
  ADD KEY `fk_vacante_servicio1_idx` (`fk_servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `pk_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `pk_estatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `pk_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medio`
--
ALTER TABLE `medio`
  MODIFY `pk_medio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `pk_modulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `pk_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `pk_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `pk_turno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `pk_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vacante`
--
ALTER TABLE `vacante`
  MODIFY `pk_vacante` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignado`
--
ALTER TABLE `asignado`
  ADD CONSTRAINT `fk_vacante_has_usuario_usuario1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`pk_usuario`),
  ADD CONSTRAINT `fk_vacante_has_usuario_vacante1` FOREIGN KEY (`fk_vacante`) REFERENCES `vacante` (`pk_vacante`);

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_servicio1` FOREIGN KEY (`fk_servicio`) REFERENCES `servicio` (`pk_servicio`),
  ADD CONSTRAINT `fk_asistencia_usuario1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`pk_usuario`);

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_usuario1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`pk_usuario`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `fk_perfil_has_permisos_perfil1` FOREIGN KEY (`fk_perfil`) REFERENCES `perfil` (`pk_perfil`),
  ADD CONSTRAINT `fk_perfil_has_permisos_permisos1` FOREIGN KEY (`fk_modulo`) REFERENCES `modulo` (`pk_modulo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_estatus1` FOREIGN KEY (`fk_estatus`) REFERENCES `estatus` (`pk_estatus`),
  ADD CONSTRAINT `fk_usuario_medio1` FOREIGN KEY (`fk_medio`) REFERENCES `medio` (`pk_medio`),
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`fk_perfil`) REFERENCES `perfil` (`pk_perfil`);

--
-- Filtros para la tabla `vacante`
--
ALTER TABLE `vacante`
  ADD CONSTRAINT `fk_vacante_servicio1` FOREIGN KEY (`fk_servicio`) REFERENCES `servicio` (`pk_servicio`),
  ADD CONSTRAINT `fk_vacante_turno1` FOREIGN KEY (`fk_turno`) REFERENCES `turno` (`pk_turno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

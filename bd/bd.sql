-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2024 a las 23:58:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pedd`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_IniciarSesion` (IN `p_usuario` VARCHAR(255), IN `p_contrasena` VARCHAR(255), OUT `p_resultado` INT)   BEGIN
    -- Declarar una variable local para almacenar la contraseña encriptada
    DECLARE contrasena_encriptada VARCHAR(255);

    -- Obtener la contraseña encriptada del usuario
    SELECT Contrasena INTO contrasena_encriptada
    FROM docentes
    WHERE Usuario = p_usuario;

    -- Verificar si la contraseña ingresada, una vez encriptada, coincide con la almacenada
    IF contrasena_encriptada = SHA2(p_contrasena, 256) THEN
        SET p_resultado = 1; -- Login exitoso
    ELSE
        SET p_resultado = 0; -- Fallo en el login
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InsertarDocumento` (IN `p_id_docente` INT, IN `p_id_actividad` INT, IN `p_nombre_documento` VARCHAR(255), IN `p_ruta_archivo` VARCHAR(255), IN `p_fecha_subida` DATE, IN `p_categoria` VARCHAR(100), IN `p_tipo_documento` VARCHAR(20))   BEGIN
    INSERT INTO documentos (id_docente, id_actividad, nombre_documento, ruta_archivo, fecha_subida, categoria, tipo_documento)
    VALUES (p_id_docente, p_id_actividad, p_nombre_documento, p_ruta_archivo, p_fecha_subida, p_categoria, p_tipo_documento);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistrarDocente` (IN `p_Nombres` VARCHAR(255), IN `p_ApellidoPaterno` VARCHAR(255), IN `p_ApellidoMaterno` VARCHAR(255), IN `p_GradoEstudio` VARCHAR(255), IN `p_CURP` VARCHAR(18), IN `p_Sexo` CHAR(1), IN `p_RFC` VARCHAR(13), IN `p_Celular` VARCHAR(15), IN `p_EscuelaFacultad` VARCHAR(255), IN `p_NivelEducativo` VARCHAR(255), IN `p_Correo` VARCHAR(255), IN `p_Usuario` VARCHAR(255), IN `p_Contrasena` VARCHAR(255))   BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Error al registrar el docente.';
    END;

    -- Etiqueta para el bloque principal
    main_block: BEGIN
        START TRANSACTION;

        IF EXISTS (SELECT 1 FROM docentes WHERE Usuario = p_Usuario) THEN
            SELECT 'El nombre de usuario ya está en uso.' AS Mensaje;
            ROLLBACK;
            LEAVE main_block;
        END IF;

        IF EXISTS (SELECT 1 FROM docentes WHERE Correo = p_Correo) THEN
            SELECT 'El correo electrónico ya está en uso.' AS Mensaje;
            ROLLBACK;
            LEAVE main_block;
        END IF;

        IF LENGTH(p_CURP) != 18 THEN
            SELECT 'CURP no válido. Debe tener 18 caracteres.' AS Mensaje;
            ROLLBACK;
            LEAVE main_block;
        END IF;

        IF LENGTH(p_RFC) < 12 OR LENGTH(p_RFC) > 13 THEN
            SELECT 'RFC no válido. Debe tener entre 12 y 13 caracteres.' AS Mensaje;
            ROLLBACK;
            LEAVE main_block;
        END IF;

       IF EXISTS (SELECT 1 FROM docentes WHERE CURP = p_CURP) THEN
            SELECT 'La CURP ya está registrada.' AS Mensaje;
            ROLLBACK;
            LEAVE main_block;
        END IF;

        -- Verificar si el RFC ya existe
        IF EXISTS (SELECT 1 FROM docentes WHERE RFC = p_RFC) THEN
            SELECT 'El RFC ya está registrado.' AS Mensaje;
            ROLLBACK;
            LEAVE main_block;
        END IF;

        SET @hashed_password = SHA2(p_Contrasena, 256);

        INSERT INTO docentes (
            Nombres, 
            ApellidoPaterno, 
            ApellidoMaterno, 
            GradoEstudio, 
            CURP, 
            Sexo, 
            RFC, 
            Celular, 
            EscuelaFacultad, 
            NivelEducativo, 
            Correo, 
            Usuario, 
            Contrasena
        ) 
        VALUES (
            p_Nombres, 
            p_ApellidoPaterno, 
            p_ApellidoMaterno, 
            p_GradoEstudio, 
            p_CURP, 
            p_Sexo, 
            p_RFC, 
            p_Celular, 
            p_EscuelaFacultad, 
            p_NivelEducativo, 
            p_Correo, 
            p_Usuario, 
            @hashed_password
        );

        COMMIT;
        SELECT 'Docente registrado exitosamente.' AS Mensaje;
    END main_block;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL,
  `nombre_actividad` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `puntaje_maximo` int(11) DEFAULT NULL,
  `nivel` varchar(15) DEFAULT NULL,
  `subnivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `nombre_actividad`, `descripcion`, `categoria`, `puntaje_maximo`, `nivel`, `subnivel`) VALUES
(1, 'Requisitos de Inicio', 'Documentos para los requisitos de inicio', 'Requisitos de inicio', 0, '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `Nombres` varchar(255) DEFAULT NULL,
  `ApellidoPaterno` varchar(255) DEFAULT NULL,
  `ApellidoMaterno` varchar(255) DEFAULT NULL,
  `GradoEstudio` varchar(255) DEFAULT NULL,
  `CURP` varchar(18) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `RFC` varchar(13) DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `EscuelaFacultad` varchar(255) DEFAULT NULL,
  `NivelEducativo` varchar(255) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Usuario` varchar(255) DEFAULT NULL,
  `Contrasena` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `Nombres`, `ApellidoPaterno`, `ApellidoMaterno`, `GradoEstudio`, `CURP`, `Sexo`, `RFC`, `Celular`, `EscuelaFacultad`, `NivelEducativo`, `Correo`, `Usuario`, `Contrasena`) VALUES
(4, 'Nestor Alonso', 'Torres', ' Sanchez', 'Licenciatura', 'TOSN021114HMNRNSA4', 'H', 'TOSN021114UU8', '7532136299', 'Instituto Tecnológico de Lázaro Cárdenas', 'Licenciatura', 'alonso.gh234@gmail.com', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(5, 'Dulce Marlen', 'Guzman', ' Gonzalez', 'Licenciatura', 'TOSA061207MMNRNNA7', 'M', 'TOSA061207UU8', '7531390092', 'Instituto Tecnológico de Lázaro Cárdenas', 'Licenciatura', 'marlen@gmail.com', 'admin1', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `nombre_documento` varchar(255) DEFAULT NULL,
  `ruta_archivo` varchar(255) DEFAULT NULL,
  `fecha_subida` date DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `id_docente`, `id_actividad`, `nombre_documento`, `ruta_archivo`, `fecha_subida`, `categoria`, `tipo_documento`) VALUES
(9, 4, 1, 'TOSN021114HMNRNSA4_Carga Academica.pdf', '../docentes/TOSN021114HMNRNSA4/requisitosDeInicio/TOSN021114HMNRNSA4_Carga Academica.pdf', '2024-11-02', 'CategoriaEjemplo', 'Constancia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id_evaluacion` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `puntaje_obtenido` int(11) DEFAULT NULL,
  `documento_comprobacion` varchar(255) DEFAULT NULL,
  `fecha_evaluacion` date DEFAULT NULL,
  `evaluador` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_evaluacion`
--

CREATE TABLE `resultados_evaluacion` (
  `id_resultado` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `puntaje_total` int(11) DEFAULT NULL,
  `nivel_asignado` varchar(50) DEFAULT NULL,
  `fecha_resultado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `subnivel` (`subnivel`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id_evaluacion`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `resultados_evaluacion`
--
ALTER TABLE `resultados_evaluacion`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `id_docente` (`id_docente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id_evaluacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resultados_evaluacion`
--
ALTER TABLE `resultados_evaluacion`
  MODIFY `id_resultado` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`subnivel`) REFERENCES `actividades` (`id_actividad`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`),
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`);

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`),
  ADD CONSTRAINT `evaluaciones_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`);

--
-- Filtros para la tabla `resultados_evaluacion`
--
ALTER TABLE `resultados_evaluacion`
  ADD CONSTRAINT `resultados_evaluacion_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

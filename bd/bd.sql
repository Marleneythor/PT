-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2025 at 06:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pedd`
--

DELIMITER $$
--
-- Procedures
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InsertarDocumento` (IN `p_id_docente` INT, IN `p_id_actividad` INT, IN `p_nombre_documento` VARCHAR(255), IN `p_ruta_archivo` VARCHAR(255), IN `p_fecha_subida` DATE, IN `p_categoria` VARCHAR(100), IN `p_tipo_documento` VARCHAR(20), IN `p_documento` VARCHAR(50), IN `p_puntosporactividad` INT, IN `p_subdocumento` VARCHAR(50))   BEGIN
    INSERT INTO documentos (id_docente, id_actividad, nombre_documento, ruta_archivo, fecha_subida, categoria, tipo_documento, documento, puntosporactividad, subdocumento)
    VALUES (p_id_docente, p_id_actividad, p_nombre_documento, p_ruta_archivo, p_fecha_subida, p_categoria, p_tipo_documento, p_documento, p_puntosporactividad, p_subdocumento);
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
-- Table structure for table `actividades`
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
-- Dumping data for table `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `nombre_actividad`, `descripcion`, `categoria`, `puntaje_maximo`, `nivel`, `subnivel`) VALUES
(1, 'Requisitos de Inicio', 'Documentos para los requisitos de inicio', 'Requisitos de inicio', 0, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `docentes`
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
-- Dumping data for table `docentes`
--

INSERT INTO `docentes` (`id_docente`, `Nombres`, `ApellidoPaterno`, `ApellidoMaterno`, `GradoEstudio`, `CURP`, `Sexo`, `RFC`, `Celular`, `EscuelaFacultad`, `NivelEducativo`, `Correo`, `Usuario`, `Contrasena`) VALUES
(4, 'Nestor Alonso', 'Torres', ' Sanchez', 'Licenciatura', 'TOSN021114HMNRNSA4', 'H', 'TOSN021114UU8', '7532136299', 'Instituto Tecnológico de Lázaro Cárdenas', 'Licenciatura', 'alonso.gh234@gmail.com', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(5, 'Dulce Marlen', 'Guzman', ' Gonzalez', 'Licenciatura', 'TOSA061207MMNRNNA7', 'M', 'TOSA061207UU8', '7531390092', 'Instituto Tecnológico de Lázaro Cárdenas', 'Licenciatura', 'marlen@gmail.com', 'admin1', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7');

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `nombre_documento` varchar(255) NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `fecha_subida` date NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `puntosporactividad` int(11) DEFAULT NULL,
  `subdocumento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentos`
--

INSERT INTO `documentos` (`id_documento`, `id_docente`, `id_actividad`, `nombre_documento`, `ruta_archivo`, `fecha_subida`, `categoria`, `tipo_documento`, `documento`, `puntosporactividad`, `subdocumento`) VALUES
(72, 4, 1, 'TOSN021114HMNRNSA4_1.1.1_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.1/1.1.1//TOSN021114HMNRNSA4_1.1.1_1.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', '1.1.1', 5, NULL),
(73, 4, 1, 'TOSN021114HMNRNSA4_1.1.2_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.1/1.1.2//TOSN021114HMNRNSA4_1.1.2_1.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', '1.1.2', 10, NULL),
(74, 4, 1, 'TOSN021114HMNRNSA4_1.1.2_2.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.1/1.1.2//TOSN021114HMNRNSA4_1.1.2_2.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', '1.1.2', 10, NULL),
(75, 4, 1, 'TOSN021114HMNRNSA4_1.1.2_3.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.1/1.1.2//TOSN021114HMNRNSA4_1.1.2_3.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', '1.1.2', 10, NULL),
(78, 4, 1, 'TOSN021114HMNRNSA4_1.3.1_2.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1//TOSN021114HMNRNSA4_1.3.1_2.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', 'Array', 40, NULL),
(79, 4, 1, 'TOSN021114HMNRNSA4_1.3.1_3.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1//TOSN021114HMNRNSA4_1.3.1_3.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', 'Array', 50, NULL),
(80, 4, 1, 'TOSN021114HMNRNSA4_1.3.1_1.pdf', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1//TOSN021114HMNRNSA4_1.3.1_1.pdf', '2025-02-21', 'CategoriaEjemplo', 'Constancia', 'Array', 40, NULL),
(81, 4, 1, 'TOSN021114HMNRNSA4_1.3.1_4.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1//TOSN021114HMNRNSA4_1.3.1_4.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', '1.3.1.1', 20, NULL),
(82, 4, 1, 'Torres_ Sanchez_1.3.2_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.2//Torres_ Sanchez_1.3.2_1.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', '', 5, NULL),
(83, 4, 1, 'Torres_ Sanchez_1.3.1_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1//Torres_ Sanchez_1.3.1_1.jpg', '2025-02-21', 'CategoriaEjemplo', 'Constancia', '1.3.1.5', 50, NULL),
(84, 4, 1, 'Torres_ Sanchez_1.3.1_2.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1//Torres_ Sanchez_1.3.1_2.jpg', '2025-02-21', 'Categoria1.3', 'Constancia', '1.3.1.5', 50, NULL),
(85, 4, 1, 'Torres_ Sanchez_1.3.2_1.pdf', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.2//Torres_ Sanchez_1.3.2_1.pdf', '2025-02-21', 'Categoria1.3', 'Constancia', '1.3.2.1', 5, NULL),
(86, 4, 1, 'Torres_ Sanchez_1.3.1_2.pdf', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1/Torres_ Sanchez_1.3.1_2.pdf', '2025-02-21', 'Categoria1.3', 'Constancia', '1.3.1.5', 50, NULL),
(88, 4, 1, 'Torres_ Sanchez_1.1.4_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.1/1.1.4//Torres_ Sanchez_1.1.4_1.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.1.4', 19, NULL),
(89, 4, 1, 'Torres_ Sanchez_1.1.4_2.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.1/1.1.4//Torres_ Sanchez_1.1.4_2.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.1.4', 5, NULL),
(90, 4, 1, 'Torres_ Sanchez_1.1.5_1.pdf', '../../../docentes/TOSN021114HMNRNSA4/1/1.1/1.1.5//Torres_ Sanchez_1.1.5_1.pdf', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.1.5', 1, NULL),
(92, 4, 1, 'TOSN021114HMNRNSA4_RI1_1.jpg', '../docentes/TOSN021114HMNRNSA4/requisitosDeInicio//TOSN021114HMNRNSA4_RI1_1.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', 'RI1', 0, NULL),
(94, 4, 1, 'TOSN021114HMNRNSA4_RI1_2.jpg', '../docentes/TOSN021114HMNRNSA4/RI/RI1/TOSN021114HMNRNSA4_RI1_2.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', 'RI1', NULL, NULL),
(95, 4, 1, 'TOSN021114HMNRNSA4_5_1.pdf', '../docentes/TOSN021114HMNRNSA4/RI/5/TOSN021114HMNRNSA4_5_1.pdf', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '5', NULL, NULL),
(97, 4, 1, 'Torres_ Sanchez_1.3.1_5.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1/Torres_ Sanchez_1.3.1_5.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.3.1', 30, '1.3.1.4'),
(98, 4, 1, 'Torres_ Sanchez_1.3.1_6.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1/Torres_ Sanchez_1.3.1_6.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.3.1', 30, '1.3.1.4'),
(99, 4, 1, 'Torres_ Sanchez_1.3.1_7.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1/Torres_ Sanchez_1.3.1_7.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.3.1', 30, '1.3.1.4'),
(100, 4, 1, 'Torres_ Sanchez_1.3.1_8.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1/Torres_ Sanchez_1.3.1_8.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.3.1', 30, '1.3.1.4'),
(101, 4, 1, 'Torres_ Sanchez_1.3.1_9.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.3/1.3.1/Torres_ Sanchez_1.3.1_9.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.3.1', 25, '1.3.1.2'),
(102, 4, 1, 'Torres_ Sanchez_1.2.2.4_1.pdf', '../../../docentes/TOSN021114HMNRNSA4/1/1.2/1.2.2.4/Torres_ Sanchez_1.2.2.4_1.pdf', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.2.2.4', 8, NULL),
(103, 4, 1, 'Torres_ Sanchez_1.2.2.6_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.2/1.2.2.6/Torres_ Sanchez_1.2.2.6_1.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.2.2.6', 90, NULL),
(104, 4, 1, 'Torres_ Sanchez_1.2.2.7_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.2/1.2.2.7/Torres_ Sanchez_1.2.2.7_1.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.2.2.7', 100, NULL),
(105, 4, 1, 'Torres_ Sanchez_1.2.2.5_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.2/1.2.2.5/Torres_ Sanchez_1.2.2.5_1.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.2.2.5', 90, NULL),
(106, 4, 1, 'Torres_ Sanchez_1.2.1.1_1.pdf', '../../../docentes/TOSN021114HMNRNSA4/1/1.2/1.2.1.1/Torres_ Sanchez_1.2.1.1_1.pdf', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.2.1.1', 20, NULL),
(107, 4, 1, 'Torres_ Sanchez_1.2.1.1_1.jpg', '../../../docentes/TOSN021114HMNRNSA4/1/1.2/1.2.1.1/Torres_ Sanchez_1.2.1.1_1.jpg', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.2.1.1', 20, NULL),
(108, 4, 1, 'Torres_ Sanchez_1.2.1.2_1.pdf', '../../../docentes/TOSN021114HMNRNSA4/1/1.2/1.2.1.2/Torres_ Sanchez_1.2.1.2_1.pdf', '2025-02-22', 'CategoriaEjemplo', 'Constancia', '1.2.1.2', 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluaciones`
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

--
-- Dumping data for table `evaluaciones`
--

INSERT INTO `evaluaciones` (`id_evaluacion`, `id_docente`, `id_actividad`, `puntaje_obtenido`, `documento_comprobacion`, `fecha_evaluacion`, `evaluador`) VALUES
(6, 4, 1, 126, NULL, '2025-02-06', NULL),
(7, 4, 1, 202, NULL, '2025-02-06', NULL),
(8, 4, 1, 5, NULL, '2025-02-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resultados_evaluacion`
--

CREATE TABLE `resultados_evaluacion` (
  `id_resultado` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `puntaje_total` int(11) DEFAULT NULL,
  `nivel_asignado` varchar(50) DEFAULT NULL,
  `fecha_resultado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `subnivel` (`subnivel`);

--
-- Indexes for table `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indexes for table `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id_evaluacion`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indexes for table `resultados_evaluacion`
--
ALTER TABLE `resultados_evaluacion`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `id_docente` (`id_docente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id_evaluacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resultados_evaluacion`
--
ALTER TABLE `resultados_evaluacion`
  MODIFY `id_resultado` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`subnivel`) REFERENCES `actividades` (`id_actividad`);

--
-- Constraints for table `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`),
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`);

--
-- Constraints for table `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`),
  ADD CONSTRAINT `evaluaciones_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`);

--
-- Constraints for table `resultados_evaluacion`
--
ALTER TABLE `resultados_evaluacion`
  ADD CONSTRAINT `resultados_evaluacion_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

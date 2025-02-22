-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2025 at 05:41 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`),
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

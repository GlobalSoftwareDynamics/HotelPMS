-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2017 a las 17:59:14
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotelpms`
--

--
-- Volcado de datos para la tabla `caracteristica`
--

INSERT INTO `caracteristica` (`idCaracteristica`, `descripcion`) VALUES
(1, 'Tipo de Cama'),
(2, 'Número de camas'),
(3, 'Capacidad Máxima'),
(4, 'Área de Habitación');

--
-- Volcado de datos para la tabla `caracteristicahabitacion`
--

INSERT INTO `caracteristicahabitacion` (`idCaracteristica`, `idHabitacion`, `valor`) VALUES
(1, 101, '1 plaza y media'),
(1, 102, '2 Plazas'),
(1, 103, '2 Plazas'),
(1, 104, 'Queen'),
(1, 105, '2 Plazas'),
(1, 106, 'Queen'),
(1, 201, '2 Plazas'),
(1, 202, 'Queen'),
(1, 203, 'Queen'),
(1, 204, '1 Plaza y media'),
(1, 205, '2 Plazas'),
(1, 206, '2 Plazas'),
(1, 207, '2 Plazas'),
(1, 208, '2 Plazas'),
(1, 209, '2 Plazas'),
(1, 210, '2 Plazas'),
(1, 211, '1 Plaza y media'),
(1, 301, '2 Plazas'),
(1, 302, '2 Plazas'),
(1, 303, '2 Plazas'),
(1, 304, '2 Plazas'),
(1, 305, '2 Plazas'),
(1, 306, '2 Plazas'),
(1, 307, '2 Plazas'),
(1, 308, '1 Plaza y media'),
(1, 309, '1 Plaza y media'),
(1, 401, '2 Plazas'),
(1, 402, '2 Plazas'),
(1, 403, 'Queen'),
(1, 404, '2 Plazas'),
(1, 405, '2 Plazas'),
(2, 101, '2'),
(2, 102, '1'),
(2, 103, '1'),
(2, 104, '1'),
(2, 105, '1'),
(2, 106, '1'),
(2, 201, '1'),
(2, 202, '1'),
(2, 203, '1'),
(2, 204, '2'),
(2, 205, '1'),
(2, 206, '1'),
(2, 207, '1'),
(2, 208, '1'),
(2, 209, '1'),
(2, 210, '1'),
(2, 211, '1'),
(2, 301, '1'),
(2, 302, '1'),
(2, 303, '1'),
(2, 304, '1'),
(2, 305, '1'),
(2, 306, '1'),
(2, 307, '1'),
(2, 308, '2'),
(2, 309, '1'),
(2, 401, '1'),
(2, 402, '1'),
(2, 403, '1'),
(2, 404, '1'),
(2, 405, '1'),
(3, 101, '3 Camas'),
(3, 204, '3 Camas'),
(3, 308, '2 Camas'),
(4, 101, '19.16 M²'),
(4, 102, '18.65 M²'),
(4, 103, '12.50 M²'),
(4, 104, '25.40 M²'),
(4, 105, '14.90 M²'),
(4, 106, '22.40 M²'),
(4, 201, '11.72 M²'),
(4, 202, '22.00 M²'),
(4, 203, '21.48 M²'),
(4, 204, '17.80 M²'),
(4, 205, '15.71 M²'),
(4, 206, '14.79 M²'),
(4, 207, '14.62 M²'),
(4, 209, '17.25 M²'),
(4, 210, '10.96 M²'),
(4, 211, '14.08 M²'),
(4, 301, '14.83 M²'),
(4, 302, '14.57 M²'),
(4, 303, '17.56 M²'),
(4, 304, '17.14 M²'),
(4, 305, '16.64 M²'),
(4, 306, '17.72 M²'),
(4, 307, '17.79 M²'),
(4, 308, '17.52 M²'),
(4, 309, '13.67 M²'),
(4, 401, '16.54'),
(4, 402, '14.86 M²'),
(4, 403, '24.20 M²'),
(4, 404, '17.70 M²'),
(4, 405, '19.06 M²');

--
-- Volcado de datos para la tabla `caracteristicatipohabitacion`
--

INSERT INTO `caracteristicatipohabitacion` (`idCaracteristica`, `idTipoHabitacion`, `valor`) VALUES
(1, 1, '2 Plazas'),
(2, 1, '1');

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idCiudad`, `nombre`, `idEstadoPais`) VALUES
(1, 'Arequipa', 2),
(2, 'Lima', 1),
(3, 'Arica', 4),
(4, 'Santiago', 3);

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`idColaborador`, `idTipoUsuario`, `nombreCompleto`, `usuario`, `contraseña`) VALUES
(70707070, 1, 'Usuario de Prueba', 'usuario', '1234');

--
-- Volcado de datos para la tabla `databaselog`
--

INSERT INTO `databaselog` (`idDatabaseLog`, `idColaborador`, `fechaHora`, `evento`, `tipo`, `consulta`) VALUES
(1, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO TipoHabitacion (descripcion) VALUES (Matrimonial)'),
(2, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO Caracteristica (descripcion) VALUES (Tipo de Cama)'),
(3, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO Caracteristica (descripcion) VALUES (Número de camas)'),
(4, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO Caracteristica (descripcion) VALUES (Capacidad Máxima)'),
(5, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,1,2 Plazas)'),
(6, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,1,1)'),
(7, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (101,1,3)'),
(8, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,101,2 Plazas)'),
(9, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,101,1)'),
(10, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,101,2)'),
(11, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'INSERT INTO Tarifa(idTipoHabitacion,descripcion,valor,moneda) VALUES (1,Tarifa Regular,285,S/.)'),
(12, 70707070, '2017-12-29', 'INSERT', 'Paquete', 'INSERT INTO Paquete(idPaquete,nombre,duracion,moneda) VALUES (1,Noche de Bodas,1,S/.)'),
(13, 70707070, '2017-12-29', 'INSERT', 'TipoHabitacionPaquete', 'INSERT INTO TipoHabitacionPaquete(idPaquete,idTipoHabitacion,idTarifa,nroHabitaciones) VALUES (1,1,1,1)'),
(14, 70707070, '2017-12-29', 'UPDATE', 'Paquete', 'UPDATE Paquete SET descripcion = Duración: 1 Noches; Habitaciones: Matrimonial: 1, ; Incluye: Botella de Espumante con Arreglo Floral y Cesto de Frutas, valor = 50 WHERE idPaquete = 1'),
(15, 70707070, '2017-12-29', 'INSERT', 'Huesped', 'INSERT INTO Huesped(idHuesped,idEmpresa,idCiudad,idGenero,nacionalidad_idPais,nombreCompleto,direccion,correoElectronico,codigoPostal,telefonoFijo,telefonoCelular,fechaNacimiento,preferencias)\r\n        VALUES (80808080,NULL,1,Masculino,1,Cliente Prueba,Av. Lima 512,cliente.prueba@gmail.com,04001,054-225225,974854965,1993-12-29,NULL)'),
(16, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO TipoHabitacion (descripcion) VALUES (Simple)'),
(17, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO TipoHabitacion (descripcion) VALUES (Suite)'),
(18, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO TipoHabitacion (descripcion) VALUES (Doble )'),
(19, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO TipoHabitacion (descripcion) VALUES (Simple / Ejecutiva)'),
(20, 70707070, '2017-12-29', 'INSERT CARACTERISTICA', 'INSERT', 'INSERT INTO Caracteristica (descripcion) VALUES (Área de Habitación)'),
(21, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,101,1 plaza y media)'),
(22, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (3,101,3 Camas)'),
(23, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (102,1,3)'),
(24, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,102,2 Plazas)'),
(25, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,102,1)'),
(26, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (103,,)'),
(27, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (103,1,3)'),
(28, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,103,2 Plazas)'),
(29, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,103,1)'),
(30, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (104,3,2)'),
(31, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (105,1,3)'),
(32, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,105,2 Plazas)'),
(33, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,105,1)'),
(34, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (106,3,1)'),
(35, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (201,1,3)'),
(36, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,201,2 Plazas)'),
(37, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,201,1)'),
(38, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (202,3,2)'),
(39, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (203,3,2)'),
(40, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (204,4,2)'),
(41, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (205,1,3)'),
(42, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,205,2 Plazas)'),
(43, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,205,1)'),
(44, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (206,1,3)'),
(45, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,206,2 Plazas)'),
(46, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,206,1)'),
(47, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (207,5,1)'),
(48, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (208,5,1)'),
(49, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (209,,)'),
(50, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (209,1,2)'),
(51, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,209,2 Plazas)'),
(52, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,209,1)'),
(53, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (301,1,3)'),
(54, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,301,2 Plazas)'),
(55, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,301,1)'),
(56, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (302,5,1)'),
(57, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (303,5,1)'),
(58, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (304,1,2)'),
(59, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,304,2 Plazas)'),
(60, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,304,1)'),
(61, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (305,1,2)'),
(62, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,305,2 Plazas)'),
(63, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,305,1)'),
(64, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (306,1,2)'),
(65, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,306,2 Plazas)'),
(66, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,306,1)'),
(67, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (307,1,2)'),
(68, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,307,2 Plazas)'),
(69, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,307,1)'),
(70, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (308,4,2)'),
(71, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (309,2,2)'),
(72, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (401,5,3)'),
(73, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (402,5,1)'),
(74, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (403,3,1)'),
(75, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (404,5,2)'),
(76, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (405,5,2)'),
(77, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (210,1,1)'),
(78, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,210,2 Plazas)'),
(79, 70707070, '2017-12-29', 'INSERT CARACTERISTICAS STANDARD TIPOHABITACIO', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,210,1)'),
(80, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO Habitacion VALUES (211,2,1)'),
(81, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'INSERT INTO Tarifa(idTipoHabitacion,descripcion,valor,moneda) VALUES (3,Tarifa Regular,360,S/.)'),
(82, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'INSERT INTO Tarifa(idTipoHabitacion,descripcion,valor,moneda) VALUES (3,Tarifa Corporativa,318,S/.)'),
(83, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'INSERT INTO Tarifa(idTipoHabitacion,descripcion,valor,moneda) VALUES (2,Tarifa Corporativa,156,S/.)'),
(84, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'INSERT INTO Tarifa(idTipoHabitacion,descripcion,valor,moneda) VALUES (2,Tarifa Regular,196,S/.)'),
(85, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'INSERT INTO Tarifa(idTipoHabitacion,descripcion,valor,moneda) VALUES (5,Tarifa Regular,196,S/.)'),
(86, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'INSERT INTO Tarifa(idTipoHabitacion,descripcion,valor,moneda) VALUES (5,Tarifa Corporativa,156,S/.)'),
(87, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,204,1 Plaza y media)'),
(88, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,204,2 Camas)'),
(89, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (3,204,3 Camas)'),
(90, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,204,2)'),
(91, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,308,1 Plaza y media)'),
(92, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,308,2)'),
(93, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (3,308,2)'),
(94, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 1, descripcion = Tarifa Regular Matrimonial, valor = 285, moneda = <br />\r\n<b>Notice</b>:  Undefined variable: numMoneda in <b>C:xampphtdocshotelpmseditarTarifa.php</b> on line <b>85</b><br />\r\n WHERE idTarifa = 1'),
(95, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 1, descripcion = Tarifa Regular Matrimonial, valor = 285, moneda = S/. WHERE idTarifa = 1'),
(96, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 1, descripcion = Tarifa Regular Simple, valor = 196, moneda = <br />\r\n<b>Notice</b>:  Undefined variable: numMoneda in <b>C:xampphtdocshotelpmseditarTarifa.php</b> on line <b>85</b><br />\r\n WHERE idTarifa = 11'),
(97, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 1, descripcion = Tarifa Regular Simple, valor = 196, moneda = S/. WHERE idTarifa = 11'),
(98, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 4, descripcion = Tarifa Regular Doble, valor = 285, moneda = <br />\r\n<b>Notice</b>:  Undefined variable: numMoneda in <b>C:xampphtdocshotelpmseditarTarifa.php</b> on line <b>85</b><br />\r\n WHERE idTarifa = 3'),
(99, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 4, descripcion = Tarifa Regular Doble, valor = 285, moneda = S/. WHERE idTarifa = 3'),
(100, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'INSERT INTO Tarifa(idTipoHabitacion,descripcion,valor,moneda) VALUES (1,Tarifa Corporativa Simple,156,S/.)'),
(101, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 4, descripcion = Tarifa Corporativa Doble, valor = 250, moneda = <br />\r\n<b>Notice</b>:  Undefined variable: numMoneda in <b>C:xampphtdocshotelpmseditarTarifa.php</b> on line <b>85</b><br />\r\n WHERE idTarifa = 4'),
(102, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 3, descripcion = Tarifa Regular Suite, valor = 360, moneda = <br />\r\n<b>Notice</b>:  Undefined variable: numMoneda in <b>C:xampphtdocshotelpmseditarTarifa.php</b> on line <b>85</b><br />\r\n WHERE idTarifa = 5'),
(103, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 4, descripcion = Tarifa Corporativa Doble, valor = 250, moneda = S/. WHERE idTarifa = 4'),
(104, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 3, descripcion = Tarifa Regular Suite, valor = 360, moneda = S/. WHERE idTarifa = 5'),
(105, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 3, descripcion = Tarifa Corporativa Suite, valor = 318, moneda = <br />\r\n<b>Notice</b>:  Undefined variable: numMoneda in <b>C:xampphtdocshotelpmseditarTarifa.php</b> on line <b>85</b><br />\r\n WHERE idTarifa = 6'),
(106, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 3, descripcion = Tarifa Corporativa Suite, valor = 318, moneda = S/. WHERE idTarifa = 6'),
(107, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 2, descripcion = Tarifa Regular Simple, valor = 196, moneda = S/. WHERE idTarifa = 8'),
(108, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 5, descripcion = Tarifa Regular Simple / Ejecutiva, valor = 196, moneda = S/. WHERE idTarifa = 9'),
(109, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 5, descripcion = Tarifa Corporativa Simple / Ejecutiva, valor = 156, moneda = S/. WHERE idTarifa = 10'),
(110, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 2, descripcion = Tarifa Corporativa Simple, valor = 156, moneda = <br />\r\n<b>Notice</b>:  Undefined variable: numMoneda in <b>C:xampphtdocshotelpmseditarTarifa.php</b> on line <b>85</b><br />\r\n WHERE idTarifa = 7'),
(111, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 2, descripcion = Tarifa Corporativa Simple, valor = 156, moneda = S/. WHERE idTarifa = 7'),
(112, 70707070, '2017-12-29', 'INSERT', 'Tarifa', 'UPDATE Tarifa SET idTipoHabitacion = 1, descripcion = Tarifa Corporativa Matrimonial, valor = 250, moneda = S/. WHERE idTarifa = 15'),
(113, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,101,19.16 M²)'),
(114, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,102,18.65 M²)'),
(115, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,103,12.50 M²)'),
(116, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,104,Queen)'),
(117, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,104,1)'),
(118, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,104,25.40 M²)'),
(119, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,105,14.90 M²)'),
(120, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,106,Queen)'),
(121, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,106,1)'),
(122, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,106,22.40 M²)'),
(123, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,201,11.72 M²)'),
(124, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,202,Queen)'),
(125, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,202,1)'),
(126, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,202,22.00 M²)'),
(127, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,203,Queen)'),
(128, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,203,1)'),
(129, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,203,21.48 M²)'),
(130, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,204,17.80 M²)'),
(131, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,205,15.71 M²)'),
(132, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,206,14.79 M²)'),
(133, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,207,2 Plazas)'),
(134, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,207,1)'),
(135, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,207,14.62 M²)'),
(136, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,208,2 Plazas)'),
(137, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,208,1)'),
(138, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,209,17.25 M²)'),
(139, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,210,10.96 M²)'),
(140, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,211,1 Plaza y media)'),
(141, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,211,1)'),
(142, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,211,14.08 M²)'),
(143, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,301,14.83 M²)'),
(144, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,302,2 Plazas)'),
(145, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,302,1)'),
(146, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,302,14.57 M²)'),
(147, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,303,2 Plazas)'),
(148, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,303,1)'),
(149, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,303,17.56 M²)'),
(150, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,304,17.14 M²)'),
(151, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,305,16.64 M²)'),
(152, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,306,17.72 M²)'),
(153, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,307,17.79 M²)'),
(154, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (3,308,2 Camas)'),
(155, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (3,308,2 Camas)'),
(156, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,308,17.52 M²)'),
(157, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,309,1 Plaza y media)'),
(158, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,309,1)'),
(159, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,309,13.67 M²)'),
(160, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,401,2 Plazas)'),
(161, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,401,1)'),
(162, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,401,16.54)'),
(163, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,402,2 Plazas)'),
(164, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,402,1)'),
(165, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,402,14.86 M²)'),
(166, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,403,Queen)'),
(167, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,403,1)'),
(168, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,403,24.20 M²)'),
(169, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,404,2 Plazas)'),
(170, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,404,1)'),
(171, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,404,17.70 M²)'),
(172, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (1,405,2 Plazas)'),
(173, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (4,405,19.06 M²)'),
(174, 70707070, '2017-12-29', 'INSERT HABITACION', 'INSERT', 'INSERT INTO CaracteristicaHabitacion VALUES (2,405,1)');

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idEstado`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

--
-- Volcado de datos para la tabla `estadopais`
--

INSERT INTO `estadopais` (`idEstadoPais`, `nombre`, `idPais`) VALUES
(1, 'Lima', 1),
(2, 'Arequipa', 1),
(3, 'Santiago de Chile', 2),
(4, 'Tarapacá', 2);

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idGenero`) VALUES
('Femenino'),
('Masculino');

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`idHabitacion`, `idTipoHabitacion`, `idTipoVista`) VALUES
(101, 4, 3),
(102, 1, 3),
(103, 1, 3),
(104, 3, 2),
(105, 1, 3),
(106, 3, 1),
(201, 1, 3),
(202, 3, 2),
(203, 3, 2),
(204, 4, 2),
(205, 1, 3),
(206, 1, 3),
(207, 5, 1),
(208, 5, 1),
(209, 1, 2),
(210, 1, 1),
(211, 2, 1),
(301, 1, 3),
(302, 5, 1),
(303, 5, 1),
(304, 1, 2),
(305, 1, 2),
(306, 1, 2),
(307, 1, 2),
(308, 4, 2),
(309, 2, 2),
(401, 5, 3),
(402, 5, 1),
(403, 3, 1),
(404, 5, 2),
(405, 5, 2);

--
-- Volcado de datos para la tabla `huesped`
--

INSERT INTO `huesped` (`idHuesped`, `idEmpresa`, `idCiudad`, `idGenero`, `nacionalidad_idPais`, `nombreCompleto`, `direccion`, `correoElectronico`, `codigoPostal`, `telefonoFijo`, `telefonoCelular`, `fechaNacimiento`, `preferencias`) VALUES
(80808080, NULL, 1, 'Masculino', 1, 'Cliente Prueba', 'Av. Lima 512', 'cliente.prueba@gmail.com', '04001', '054-225225', '974854965', '1993-12-29', NULL);

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idPais`, `nombre`) VALUES
(1, 'Peru'),
(2, 'Chile');

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`idPaquete`, `nombre`, `descripcion`, `valor`, `duracion`, `moneda`) VALUES
(1, 'Noche de Bodas', 'Duración: 1 Noches; Habitaciones: Matrimonial: 1, ; Incluye: Botella de Espumante con Arreglo Floral y Cesto de Frutas', 50, '1', 'S/.');

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`idTarifa`, `idTipoHabitacion`, `descripcion`, `valor`, `moneda`) VALUES
(1, 1, 'Tarifa Regular Matrimonial', '285', 'S/.'),
(3, 4, 'Tarifa Regular Doble', '285', 'S/.'),
(4, 4, 'Tarifa Corporativa Doble', '250', 'S/.'),
(5, 3, 'Tarifa Regular Suite', '360', 'S/.'),
(6, 3, 'Tarifa Corporativa Suite', '318', 'S/.'),
(7, 2, 'Tarifa Corporativa Simple', '156', 'S/.'),
(8, 2, 'Tarifa Regular Simple', '196', 'S/.'),
(9, 5, 'Tarifa Regular Simple / Ejecutiva', '196', 'S/.'),
(10, 5, 'Tarifa Corporativa Simple / Ejecutiva', '156', 'S/.'),
(11, 1, 'Tarifa Regular Simple', '196', 'S/.'),
(12, 1, 'Tarifa Corporativa Simple', '156', 'S/.'),
(13, 4, 'Tarifa Corporativa Simple', '156', 'S/.'),
(14, 4, 'Tarifa Regular Simple', '196', 'S/.'),
(15, 1, 'Tarifa Corporativa Matrimonial', '250', 'S/.'),
(16, 3, 'Tarifa Regular Simple', '196', 'S/.'),
(17, 3, 'Tarifa Corporativa Simple', '156', 'S/.');

--
-- Volcado de datos para la tabla `tipohabitacion`
--

INSERT INTO `tipohabitacion` (`idTipoHabitacion`, `descripcion`) VALUES
(1, 'Matrimonial'),
(2, 'Simple'),
(3, 'Suite'),
(4, 'Doble '),
(5, 'Simple / Ejecutiva');

--
-- Volcado de datos para la tabla `tipohabitacionpaquete`
--

INSERT INTO `tipohabitacionpaquete` (`idPaquete`, `idTipoHabitacion`, `idTarifa`, `nroHabitaciones`) VALUES
(1, 1, 1, '1');

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTipoUsuario`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Recepción');

--
-- Volcado de datos para la tabla `tipovista`
--

INSERT INTO `tipovista` (`idTipoVista`, `descripcion`) VALUES
(1, 'Jardin'),
(2, 'Calle'),
(3, 'Interior');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

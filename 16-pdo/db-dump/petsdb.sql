-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-08-2025 a las 03:11:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: petsdb
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla breeds
--

CREATE TABLE breeds (
  id int(11) NOT NULL,
  name varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla breeds
--

INSERT INTO breeds (id, name) VALUES
(1, 'Golden Retriever'),
(2, 'Pug'),
(3, 'Persian');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla pets
--

CREATE TABLE pets (
  id int(11) NOT NULL,
  name varchar(16) NOT NULL,
  specie_id int(11) NOT NULL,
  breed_id int(11) NOT NULL,
  photo varchar(64) NOT NULL,
  sex_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla pets
--

INSERT INTO pets (id, name, specie_id, breed_id, photo, sex_id) VALUES
(1, 'Ruperto', 1, 2, 'pug.png', 1),
(2, 'Michifu', 2, 3, 'michi.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla sexes
--

CREATE TABLE sexes (
  id int(11) NOT NULL,
  name varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla sexes
--

INSERT INTO sexes (id, name) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla species
--

CREATE TABLE species (
  id int(11) NOT NULL,
  name varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla species
--

INSERT INTO species (id, name) VALUES
(1, 'Dog'),
(2, 'Cat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla users
--

CREATE TABLE users (
  id int(11) NOT NULL,
  fullname varchar(32) NOT NULL,
  email varchar(64) NOT NULL,
  password varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla users
--

INSERT INTO users (id, fullname, email, password) VALUES
(1, 'Administrator', 'admin@petsdb.com', '21232f297a57a5a743894a0e4a801fc3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla breeds
--
ALTER TABLE breeds
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla pets
--
ALTER TABLE pets
  ADD PRIMARY KEY (id),
  ADD KEY specie_id (specie_id),
  ADD KEY breed_id (breed_id),
  ADD KEY sex_id (sex_id);

--
-- Indices de la tabla sexes
--
ALTER TABLE sexes
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla species
--
ALTER TABLE species
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla users
--
ALTER TABLE users
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla breeds
--
ALTER TABLE breeds
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla pets
--
ALTER TABLE pets
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla sexes
--
ALTER TABLE sexes
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla species
--
ALTER TABLE species
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla users
--
ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla pets
--
ALTER TABLE pets
  ADD CONSTRAINT pets_ibfk_1 FOREIGN KEY (specie_id) REFERENCES species (id),
  ADD CONSTRAINT pets_ibfk_2 FOREIGN KEY (breed_id) REFERENCES breeds (id),
  ADD CONSTRAINT pets_ibfk_3 FOREIGN KEY (sex_id) REFERENCES sexes (id);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
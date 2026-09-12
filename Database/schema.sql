-- ---------------------------------------------------------
-- ESTRUCTURA DE BASE DE DATOS
-- ---------------------------------------------------------
-- Velatida Atlas
-- ---------------------------------------------------------

-- Elimina la base de datos si ya existe 
DROP DATABASE IF EXISTS VELATIDA_ATLAS;

-- Crea una nueva base de datos
CREATE DATABASE VELATIDA_ATLAS;

-- Selecciona la base de datos
USE VELATIDA_ATLAS;

-- ---------------------------------------------------------

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- ---------------------------------------------------------
-- TABLA: USUARIOS
-- ---------------------------------------------------------
-- Un usuario realiza inmersiones.
-- ---------------------------------------------------------

CREATE TABLE Usuarios (
	id_usuario VARCHAR(20) PRIMARY KEY,
	nombre_usuario VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	fecha_registro DATE NOT NULL  
);

-- ---------------------------------------------------------
-- TABLA: ESPECIES
-- ---------------------------------------------------------
-- Representa cada especie del Atlas.
-- Una especie es observada en distintos avistamientos.
-- ---------------------------------------------------------

CREATE TABLE Especies (
	id_especie VARCHAR(20) PRIMARY KEY,
	nombre_comun VARCHAR(100) NOT NULL,
	nombre_cientifico VARCHAR(100) NOT NULL,
	grupo VARCHAR(50) NOT NULL,
	familia VARCHAR(50),
	descripcion VARCHAR(200),
	tamano_min_cm INT,
	tamano_max_cm INT,
	dieta VARCHAR(50),
	venenoso BOOLEAN,
	habitat VARCHAR(100),
	zona_geografica VARCHAR(100),
	profundidad_min_m INT,
	profundidad_max_m INT,
	estado_conservacion VARCHAR(30),
	imagen_url VARCHAR(255)
);

-- ---------------------------------------------------------
-- TABLA: INMERSIONES
-- ---------------------------------------------------------
-- Una inmersión es realizada por un usuario.
-- Una inmersión registra avistamientos.
-- ---------------------------------------------------------

CREATE TABLE Inmersiones (
	id_inmersion VARCHAR(20) PRIMARY KEY,
	id_usuario VARCHAR(20) NOT NULL,
	fecha DATE NOT NULL,
	lugar VARCHAR(100),
	centro_buceo VARCHAR(100),
	profundidad_max INT,
	duracion_min INT, 
	temperatura DECIMAL(4,1), 
	comentarios VARCHAR(200),
	FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

-- ---------------------------------------------------------
-- TABLA: AVISTAMIENTOS
-- ---------------------------------------------------------
-- Un avistamiento se registra en una inmersión.
-- Un avistamiento representa una especie observada. 
-- ---------------------------------------------------------

CREATE TABLE Avistamientos (
	id_avistamiento VARCHAR(20) PRIMARY KEY,
	id_especie VARCHAR(20) NOT NULL,
	id_inmersion VARCHAR(20) NOT NULL,
	profundidad INT,
	cantidad INT,
	observaciones VARCHAR(200),
	FOREIGN KEY (id_especie) REFERENCES Especies(id_especie),
	FOREIGN KEY (id_inmersion) REFERENCES Inmersiones(id_inmersion)
);

-- ---------------------------------------------------------

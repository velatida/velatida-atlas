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
-- TABLA: ESPECIES
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
-- TABLA: AVISTAMIENTOS
-- ---------------------------------------------------------

CREATE TABLE Avistamientos (
	id_avistamiento VARCHAR(20) PRIMARY KEY,
	id_especie VARCHAR(20) NOT NULL,
	fecha DATE, 
	lugar VARCHAR(100),
	profundidad INT,
	cantidad INT,
	observaciones VARCHAR(200),
	imagen_url VARCHAR(255),
	FOREIGN KEY (id_especie) REFERENCES Especies(id_especie)	
);

-- ---------------------------------------------------------

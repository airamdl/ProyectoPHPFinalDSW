CREATE DATABASE IF NOT EXISTS loldatabase_crud;

USE loldatabase_crud;

-- Tabla admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (usuario, password) VALUES ('AiramAdmin', '12345678');

-- Tabla usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabla personajes
CREATE TABLE IF NOT EXISTS personajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    rol VARCHAR(255) NOT NULL,
    procedencia VARCHAR(255) NOT NULL,
    recurso VARCHAR(255) NOT NULL,
    tipoGolpe VARCHAR(255) NOT NULL
);
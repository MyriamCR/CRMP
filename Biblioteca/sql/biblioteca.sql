

CREATE DATABASE IF NOT EXISTS biblioteca_digital
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;


USE biblioteca_digital;




CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario'
);



CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(120) NOT NULL,
    genero VARCHAR(80) NOT NULL,
    anio INT UNSIGNED NOT NULL,
    estado ENUM('Pendiente', 'Leyendo', 'Terminado')
        NOT NULL DEFAULT 'Pendiente',
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario)
);


INSERT INTO usuarios (nombre,
correo,
telefono,
password_hash, 
rol) VALUES(    
    'Administrador',
    'admin@biblioteca.com',
    '1234567890',
    '$2y$10$DPodr8iGDlnJZ0iYQPs8X.sHBBW.xlP3Toh/61hDhzo/qLBuaLf0W',
    'admin');
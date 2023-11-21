DROP DATABASE laiaData;
CREATE DATABASE laiaData;
USE laiaData;




CREATE TABLE ROLES (
idRol int PRIMARY KEY auto_increment,
rol varchar (255) NOT NULL

);
CREATE TABLE  USUARIOS(
idUsuario int PRIMARY KEY auto_increment ,
nombre  varchar(255) NOT NULL,
nombreUsuario varchar (255) UNIQUE,
contrasena varchar (255) NOT NULL,
apellido1 varchar(255) NOT NULL,

fechaNacimiento date NOT NULL,
id_Rol int ,
FOREIGN KEY (id_Rol) REFERENCES ROLES (idRol)
);



CREATE TABLE JUEGOS(
idjuegos int PRIMARY KEY,
descripcion varchar(255) NOT NULL
);

CREATE TABLE PUNTUACION(

idUsuario int,
idjuegos int,
puntuacion int,

FOREIGN KEY (idUsuario) REFERENCES USUARIOS (idUsuario),
FOREIGN KEY (idjuegos) REFERENCES JUEGOS (idjuegos)

);

-- Insertar el rol de superadmin en la tabla ROLES
INSERT INTO ROLES ( rol)
VALUES ('SUPERADMIN'),('ADMIN'),('JUGADOR');

-- Insertar un superadmin en la tabla USUARIOS
INSERT INTO USUARIOS ( nombre, nombreUsuario, contrasena, apellido1, fechaNacimiento,id_Rol)
VALUES ('WarcelonaWatcher', 'SuperAdminUser', 'superadmin123', 'Apellido1Super', '1990-01-01',1),
('Admin', 'AdminUser', 'admin123', 'Apellido1Admin',  '1990-01-01',2)

;

INSERT INTO JUEGOS ( idjuegos,descripcion)
VALUES (1,'Warcelona'),(2,'Brasil'),(3,'Kenia'),(4,'India');




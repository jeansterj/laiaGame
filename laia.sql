CREATE DATABASE laiaData;
USE laiaData;





CREATE TABLE  USUARIOS(
idUsuario int PRIMARY KEY ,
nombre  varchar(255) NOT NULL,
nombreUsuario varchar (255) UNIQUE,
contraseña varchar (255) NOT NULL,
apellido1 varchar(255) NOT NULL,
apellido2 varchar (255),
fechaNacimiento date NOT NULL

);








CREATE TABLE ROLES (
idRol int PRIMARY KEY,
idUsu int ,
superAdmin boolean,
bAdmin boolean,

FOREIGN KEY (idUsu) REFERENCES USUARIOS (idUsuario)


);









CREATE TABLE PUNTUACION(
idPuntuacion int PRIMARY KEY,
idUsu int,
puntuacionWarcelona int,
puntuacionBrasil int,
puntuacionKenia int,
puntuacionIndia int,

FOREIGN KEY (idUsu) REFERENCES USUARIOS (idUsuario)









);





-- Insertar un superadmin en la tabla USUARIOS
INSERT INTO USUARIOS (idUsuario, nombre, nombreUsuario, contraseña, apellido1, apellido2, fechaNacimiento)
VALUES (1, 'WarcelonaWatcher', 'SuperAdminUser', 'superadmin123', 'Apellido1Super', 'Apellido2Super', '1990-01-01');

-- Insertar el rol de superadmin en la tabla ROLES
INSERT INTO ROLES (idRol, idUsu, superAdmin, bAdmin)
VALUES (1, 1, TRUE,TRUE);












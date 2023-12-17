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
INSERT INTO USUARIOS (nombre, nombreUsuario, contrasena, apellido1, fechaNacimiento,id_Rol)
VALUES ( 'WarcelonaWatcher', 'SuperAdminUser', 'superadmin123', 'Apellido1Super', '1990-01-01',1),
( 'Admin', 'AdminUser', 'admin123', 'Apellido1Admin',  '1990-01-01',2)

;

INSERT INTO JUEGOS ( idjuegos,descripcion)
VALUES (1,'Warcelona'),(2,'Brasil'),(3,'Kenia'),(4,'India');

INSERT INTO PUNTUACION (idUsuario, idjuegos, puntuacion)
VALUES (14, 1, 100),
       (14, 2, 150);

-- Inserting two records for 'AdminUser' (idUsuario = 2)
INSERT INTO PUNTUACION (idUsuario, idjuegos, puntuacion)
VALUES (15, 3, 120),
       (15, 4, 90);


INSERT INTO PUNTUACION (idUsuario, idjuegos, puntuacion)
VALUES (11, 3, 250),
       (11, 4, 220);








-- sentencias para el php

-- LOGIN
select nombreUsuario , contrasena from USUARIOS;

 -- MOSTRAR TODA LA INFO DE UN USUARIO
SELECT U.idUsuario, U.nombre, U.nombreUsuario, U.contrasena, U.apellido1, U.fechaNacimiento, R.rol, P.idjuegos, P.puntuacion
FROM USUARIOS U
JOIN ROLES R ON U.id_Rol = R.idRol
LEFT JOIN PUNTUACION P ON U.idUsuario = P.idUsuario
ORDER BY U.idUsuario;





SELECT
    U.idUsuario AS usuario_id,
    U.nombre AS nombreReal,
    U.nombreUsuario AS nombreUsuario,
    U.contrasena AS contrasena,
    U.apellido1 AS usuario_apellido,
    U.fechaNacimiento AS fecha_nacimiento,
    R.rol AS rol,
    
    J.descripcion AS nombre_juego,  
    P.puntuacion AS puntuacion
FROM
    USUARIOS U
JOIN
    ROLES R ON U.id_Rol = R.idRol
LEFT JOIN
    PUNTUACION P ON U.idUsuario = P.idUsuario
LEFT JOIN
    JUEGOS J ON P.idjuegos = J.idjuegos  
ORDER BY
    U.idUsuario;


-- delete TODO EL USER 



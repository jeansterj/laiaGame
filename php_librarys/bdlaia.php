<?php
session_start();

function openDB()
{

    $servername = "localhost";
    $username = "root";
    $password = "mysql";


    $conexion = new PDO("mysql:host=$servername;dbname=laiadata", $username, $password);
    // set the PDO error mode to exception
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("set names utf8");
    return $conexion;




}






function errorMessage($e)
{
    if (!empty($e->errorInfo[1])) {
        switch ($e->errorInfo[1]) {

            case 1062:
                $mensaje = 'Registro duplicado';
                break;
            case 1451:
                $mensaje = 'Registro con elementos duplicados';
                break;
            default:
                $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
                break;
        }
    } else {
        switch ($e->getCode()) {
            case 1044:
                $mensaje = 'Usuario y/o contraseña incorrectos';
                break;

            case 1049:
                $mensaje = 'Base de datos desconocida';
                break;
            case 2002:
                $mensaje = 'No se encuentra el servidor';
                break;
            default:
                $mensaje = $e->getCode() . ' - ' . $e->getMessage();
                break;
        }
    }

    return $mensaje; // Debes agregar un retorno para obtener el mensaje.
}


function closeDB()
{



    return null;
}




function selectUser()
{



    $conexion = openDB();


    $sentenciatext = "select nombreUsuario , contrasena,id_Rol,idUsuario from USUARIOS;";



    $sentencia = $conexion->prepare($sentenciatext);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();











    $conexion = closeDB();
    return $resultado;
}






function selectAllUsers()
{



    $conexion = openDB();


    $sentenciatext = "SELECT
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
";



    $sentencia = $conexion->prepare($sentenciatext);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();











    $conexion = closeDB();
    return $resultado;
}


function selectUsers(){


    $conexion = openDB();


    $sentenciatext = "SELECT
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
WHERE
    rol = 'JUGADOR'
ORDER BY
    U.idUsuario;"
;



    $sentencia = $conexion->prepare($sentenciatext);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
 
    $conexion = closeDB();
    return $resultado;


}


















function registrarUsuario($nombre, $nombreUsuario, $contrasena, $apellido1, $fechaNacimiento, $id_Rol = 3)
{
    $conexion = openDB();

    $sentenciaText = "INSERT INTO USUARIOS (nombre, nombreUsuario, contrasena, apellido1, fechaNacimiento, id_Rol) 
    VALUES (:nombre, :nombreUsuario, :contrasena, :apellido1, :fechaNacimiento, :id_Rol)";


    $sentencia = $conexion->prepare($sentenciaText);

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':nombreUsuario', $nombreUsuario);
    $sentencia->bindParam(':contrasena', $contrasena);
    $sentencia->bindParam(':apellido1', $apellido1);
    $sentencia->bindParam(':fechaNacimiento', $fechaNacimiento);
    $sentencia->bindParam(':id_Rol', $id_Rol);

    $sentencia->execute();

    $conexion = closeDB();
}




function deleteUser ($idUsuario){
    $conexion = openDB();
    $sentenciaText = "DELETE FROM usuarios WHERE idUsuario = :idUsuario ";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idUsuario', $idUsuario);
    $sentencia->execute();
    $conexion = closeDB();



}


function deleteGameInfo($idUsuario){
    $conexion = openDB();
    $sentenciaText = "DELETE FROM puntuacion WHERE idUsuario = :idUsuario "; 
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idUsuario', $idUsuario);
    $sentencia->execute();
    $conexion = closeDB();



}


function updateNombreUsuario($idUsuario, $nombreUsuario){

    $conexion = openDB();
    $sentenciaText = "UPDATE usuarios
    SET 
    nombreUsuario = :nombreUsuario
        
    WHERE idUsuario = :idUsuario";
 
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idUsuario', $idUsuario);
    $sentencia->bindParam(':nombreUsuario', $nombreUsuario);
   


    

    $sentencia->execute();
    $conexion = closeDB();


}



function updateContrasena($idUsuario, $contrasena){

    $conexion = openDB();
    $sentenciaText = "UPDATE usuarios
    SET 
    contrasena = :contrasena
        
    WHERE idUsuario = :idUsuario";
 
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idUsuario', $idUsuario);
    $sentencia->bindParam(':contrasena', $contrasena);
   


    

    $sentencia->execute();
    $conexion = closeDB();


}







function updateNombreReal($idUsuario, $nombre){

    $conexion = openDB();
    $sentenciaText = "UPDATE usuarios
    SET 
    nombre = :nombre
        
    WHERE idUsuario = :idUsuario";
 
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idUsuario', $idUsuario);
    $sentencia->bindParam(':nombre', $nombre);
   


    

    $sentencia->execute();
    $conexion = closeDB();


}



function updateApellido($idUsuario, $apellido1){

    $conexion = openDB();
    $sentenciaText = "UPDATE usuarios
    SET 
    apellido1 = :apellido1
        
    WHERE idUsuario = :idUsuario";
 
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idUsuario', $idUsuario);
    $sentencia->bindParam(':apellido1', $apellido1);
   


    

    $sentencia->execute();
    $conexion = closeDB();


}






function updateData($idUsuario, $fechaNacimiento){

    $conexion = openDB();
    $sentenciaText = "UPDATE usuarios
    SET 
    fechaNacimiento = :fechaNacimiento
        
    WHERE idUsuario = :idUsuario";
 
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idUsuario', $idUsuario);
    $sentencia->bindParam(':fechaNacimiento', $fechaNacimiento);
   


    

    $sentencia->execute();
    $conexion = closeDB();


}




function updateRol($idUsuario, $id_Rol){

    $conexion = openDB();
    $sentenciaText = "UPDATE usuarios
    SET 
    id_Rol = :id_Rol
        
    WHERE idUsuario = :idUsuario";
 
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idUsuario', $idUsuario);
    $sentencia->bindParam(':id_Rol', $id_Rol);
   


    

    $sentencia->execute();
    $conexion = closeDB();


}



// falta crear el updatecontrasena
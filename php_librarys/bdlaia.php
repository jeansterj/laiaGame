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


    $sentenciatext = "select nombreUsuario , contrasena from USUARIOS;";



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

function updateUser(){







}


function updateGameInfo($idGame){ 
    
    


}






















function updatePokemon($idPoke, $nuevoPokedex, $nuevoNombre, $nuevaregion, $nuevadescripcion, $nuevacoleccion, $nuevaimagen, $nuevolink)
{
    try {
        $conexion = openDB();
        $sentenciaText = "UPDATE pokemon 
                         SET numPokedex = :newPokedex, 
                             nombrePoke = :newnombrePoke,  
                             idRegion = :newRegion, 
                             descripcion = :nuevadescripcion, 
                             coleccion = :nuevacoleccion, 
                             imagenPoke = :nuevaimagen, 
                             link = :nuevolink 
                         WHERE idPoke = :idPoke";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':idPoke', $idPoke);
        $sentencia->bindParam(':newPokedex', $nuevoPokedex);
        $sentencia->bindParam(':newnombrePoke', $nuevoNombre);
        $sentencia->bindParam(':newRegion', $nuevaregion);
        $sentencia->bindParam(':nuevadescripcion', $nuevadescripcion);
        $sentencia->bindParam(':nuevacoleccion', $nuevacoleccion);
        $sentencia->bindParam(':nuevaimagen', $nuevaimagen);
        $sentencia->bindParam(':nuevolink', $nuevolink);
        $sentencia->execute();

    } catch (PDOException $e) {
        $_SESSION['error'] = errorMessage($e);
    }
    $conexion = closeDB();
    return $idPoke;

}

function updateTipoPoke($idPoke, $idTipo, $idTipo2)
{
    try {
        $conexion = openDB();
        $sentenciaText = "UPDATE poketiponm
        SET 
            idTipo = :idTipo, 
            idTipo2 = :idTipo2 
        WHERE idPoke = :idPoke";

        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':idPoke', $idPoke);
        $sentencia->bindParam(':idTipo', $idTipo);
        $sentencia->bindParam(':idTipo2', $idTipo2);
        $sentencia->execute();
    } catch (Exception $e) {
        $_SESSION['error'] = errorMessage($e);

    }

    $conexion = closeDB();
}
















?>
<?php
require_once('../php_librarys/bdlaia.php');




if (isset($_POST['login'])) {
    try {
    $usuarios = selectUser();

    $username = $_POST['userName'];
    $password = $_POST['password'];

    foreach ($usuarios as $usuario) {
       
        if ($usuario['nombreUsuario'] == $username && $usuario['contrasena'] == $password) {




           
            

        header('Location: ../Planeta/tierra2.html');
        
           
        }
    }



 }catch (Exception $e) {
    


 }
    
}


if(isset($_POST['registro'])) { 
  
    $nombre = $_POST['nombre'];
    $nombreUsuario = $_POST['userName'];
    $contrasena = $_POST['password'];
    $apellido1 = $_POST['primer_Apellido'];
    $fechaNacimiento = $_POST['fecha_Nacimiento'];
    
    
    registrarUsuario( $nombre, $nombreUsuario, $contrasena, $apellido1, $fechaNacimiento);
}







if (isset($_POST['delete'])) {
    try {
        deleteGameInfo($_POST['usuario_id']);
       deleteUser($_POST['usuario_id']);
        header('Location: ../Planeta/adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " va mal cabron";
        // echo "Error: " . $e->getMessage();
    }



    
} 

















    
elseif (isset($_POST['update'])) {
    try {

        $imagenTmpPath = $_FILES['newimagenPoke']['tmp_name'];
        $imagenNombre = $_FILES['newimagenPoke']['name'];

        // Define la carpeta de destino donde se almacenará la imagen
        $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . "/coleccionM07/imgdata/";

        // Combina la carpeta de destino y el nombre del archivo para obtener la ruta completa
        $imagenRuta = $carpetaDestino . $imagenNombre;
        move_uploaded_file($imagenTmpPath, $imagenRuta);
        $imagenRuta = str_replace($_SERVER['DOCUMENT_ROOT'], '', $imagenRuta);




       $idPoke= updatePokemon( $_POST['idPoke'],$_POST['newPokedex'],$_POST['newnombre'],$_POST['newidRegion'],$_POST['newdescripcion'],
        $_POST['newcoleccion'], $imagenRuta,$_POST['newlink']);
        updateTipoPoke($_POST['idPoke'],$_POST['newidTipo'],$_POST['newidTipo2']);
// acabar el update pokemon crack

      //   function updatePokemon($idPoke,$nuevoPokedex,$nuevoNombre,$nuevaregion,$nuevadescripcion,$nuevacoleccion,$nuevaimagen,$nuevolink)
        header('Location: ../webApp/index.php');
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}



    


























?>
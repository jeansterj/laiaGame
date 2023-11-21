<?php

require_once('../php_librarys/bdlaia.php');




if (isset($_POST['login'])) {
    try {
    $usuarios = selectUser();

    $username = $_POST['userName'];
    $password = $_POST['password'];
    $loginfaile = true;

  

    foreach ($usuarios as $usuario) {
       
        if ($usuario['nombreUsuario'] === $username && $usuario['contrasena'] === $password) {
            

            $_SESSION["user"] = $usuario['nombreUsuario'];
            $_SESSION["idUser"] = $usuario['idUsuario'];
            $_SESSION["rol"] = $usuario['id_Rol'];


            	    $loginfaile = false;
       


                 //  echo($_SESSION['rol']);
            
            // echo " todo bien cabron ";
           
            

         header('Location: ../adminpage.php');
        exit();
        
           
        }else {
            header('Location: ../tierra2.php');



        }



        if ($loginfaile) {
            
$_SESSION['loginError'] = true;
header('Location: ../tierra2.php');
exit();

        }
       
    }



 }catch (Exception $e) {
    echo"algo salio mal";


 }
    
}


if(isset($_POST['registro'])) { 
    try {
    $nombre = $_POST['nombre'];
    $nombreUsuario = $_POST['userName'];
    $contrasena = $_POST['password'];
    $apellido1 = $_POST['primer_Apellido'];
    $fechaNacimiento = $_POST['fecha_Nacimiento'];
    
    
    registrarUsuario( $nombre, $nombreUsuario, $contrasena, $apellido1, $fechaNacimiento);
    
    }catch (Exception $e) {
        echo "no va ";
    }
}







if (isset($_POST['delete'])) {
    try {
        deleteGameInfo($_POST['usuario_id']);
       deleteUser($_POST['usuario_id']);
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " va mal cabron";
        // echo "Error: " . $e->getMessage();
    }



    
} 

















    
if (isset($_POST['updatenombreUsuario'])) {

    try {
        updateNombreUsuario($_POST['usuario_id'],$_POST['newnombreUsuario'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " va mal cabron";
        // echo "Error: " . $e->getMessage();
    }

   
    
}



if (isset($_POST["updateNombreReal"])) {

    try {
        updateNombreReal($_POST['usuario_id'],$_POST['newnombrereal'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " va mal cabron";
        // echo "Error: " . $e->getMessage();
    }


}

    

if (isset($_POST["updateApellido"])) {

    try {
        updateApellido($_POST['usuario_id'],$_POST['newapellido'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " va mal cabron";
        // echo "Error: " . $e->getMessage();
    }


}






if (isset($_POST["updateData"])) {

    try {
        updateData($_POST['usuario_id'],$_POST['newdata'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " va mal cabron";
        // echo "Error: " . $e->getMessage();
    }


}

if (isset($_POST["updateRol"])) {

    try {
        updateRol($_POST['usuario_id'],$_POST['newrol'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " va mal cabron";
        // echo "Error: " . $e->getMessage();
    }


}



// if (isset($_POST["updateContrasena"])) {

//     try {
//         updateRol($_POST['usuario_id'],$_POST['newcontrasena'] );
//         header('Location: ../Planeta/adminpage.php');
//         exit();
//     } catch (Exception $e) {
//         echo " va mal cabron";
//         // echo "Error: " . $e->getMessage();
//     }


// }












?>
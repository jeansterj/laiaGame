<?php require_once('../php_librarys/bdlaia.php');





if (isset($_POST['login'])) {
    $username = $_POST['userName'];
    $password = $_POST['password'];

    try {
        $userData = selectUser($username, $password);

        if ($userData !== null && isset($userData['nombreUsuario'])) {
            // Set session variables

            $_SESSION["user"] = $userData['nombreUsuario'];
            $_SESSION["idUser"] = $userData['idUsuario'];
            $_SESSION["rol"] = $userData['id_Rol'];

            // Redirect based on the user's role
            if ($_SESSION['rol'] == 3) {
                header('Location: ../tierra2.php');
                exit();
            } else {
                header('Location: ../adminpage.php');
                exit();
            }
        } else {
            throw new Exception("Usuario y/o contrasña erroneos.");
        }
    } catch (Exception $e) {
        $errorMessage = errorMessage($e);
        $_SESSION['error'] = $errorMessage;
        header('Location: ../tierra2.php');
        exit();
    }
}

    
           
            

       




if(isset($_POST['registro'])) { 
    try {
    $nombre = $_POST['nombre'];
    $nombreUsuario = $_POST['userName'];
    $contrasena = $_POST['password'];
    $apellido1 = $_POST['primer_Apellido'];
    $fechaNacimiento = $_POST['fecha_Nacimiento'];
    $idRol = $_POST['id_Rol'];
    
    
    registrarUsuario( $nombre, $nombreUsuario, $contrasena, $apellido1, $fechaNacimiento,$idRol);
    if($idRol==3){
        header('Location: ../tierra2.php');
    }elseif($idRol == 2){
        header('Location: ../adminpage.php');
    }
   

    
    }catch (Exception $e) {
        $errorMessage = errorMessage($e);
        $_SESSION['error'] = $errorMessage;
        header('Location: ../tierra2.php');
        exit();
    }
}







if (isset($_POST['delete'])) {
    try {
        deleteGameInfo($_POST['usuario_id']);
       deleteUser($_POST['usuario_id']);
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " no funciona ";
        // echo "Error: " . $e->getMessage();
    }



    
} 

















    
if (isset($_POST['updatenombreUsuario'])) {

    try {
        updateNombreUsuario($_POST['usuario_id'],$_POST['newnombreUsuario'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " no funciona";
        // echo "Error: " . $e->getMessage();
    }

   
    
}



if (isset($_POST["updateNombreReal"])) {

    try {
        updateNombreReal($_POST['usuario_id'],$_POST['newnombrereal'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo "no funciona";
        // echo "Error: " . $e->getMessage();
    }


}

    

if (isset($_POST["updateApellido"])) {

    try {
        updateApellido($_POST['usuario_id'],$_POST['newapellido'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo "no funciona";
        // echo "Error: " . $e->getMessage();
    }


}






if (isset($_POST["updateData"])) {

    try {
        updateData($_POST['usuario_id'],$_POST['newdata'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo "no funciona";
        // echo "Error: " . $e->getMessage();
    }


}

if (isset($_POST["updateRol"])) {

    try {
        updateRol($_POST['usuario_id'],$_POST['newrol'] );
        header('Location: ../adminpage.php');
        exit();
    } catch (Exception $e) {
        echo " no funciona";
        // echo "Error: " . $e->getMessage();
    }


}



// if (isset($_POST["updateContrasena"])) {

//     try {
//         updateRol($_POST['usuario_id'],$_POST['newcontrasena'] );
//         header('Location: ../Planeta/adminpage.php');
//         exit();
//     } catch (Exception $e) {
//         echo " no funciona";
//         // echo "Error: " . $e->getMessage();
//     }


// }



if (isset($_POST["brasildata"])) {

    try {
        insertBrasil($_POST['idUsuario'],$_POST['puntuacion'] );
        header('Location: ../tierra2.php');
        exit();
    } catch (Exception $e) {
        echo " no funciona";
         echo "Error: " . $e->getMessage();
    }


}

if (isset($_POST["Keniadata"])) {

    try {
        insertKenia($_POST['idUsuario'],$_POST['puntuacion'] );
        header('Location: ../tierra2.php');
        exit();
    } catch (Exception $e) {
        echo " no funciona";
         echo "Error: " . $e->getMessage();
    }


}

if (isset($_POST["Indiadata"])) {

    try {
        insertIndia($_POST['idUsuario'],$_POST['puntuacion'] );
        header('Location: ../tierra2.php');
        exit();
    } catch (Exception $e) {
        echo " no funciona";
         echo "Error: " . $e->getMessage();
    }


}

if (isset($_POST["Warcelonadata"])) {

    try {
        insertWarcelona($_POST['idUsuario'],$_POST['puntuacion'] );
        header('Location: ../tierra2.php');
        exit();
    } catch (Exception $e) {
        echo " no funciona";
         echo "Error: " . $e->getMessage();
    }


}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pais'])) {
    $paiselegido = $_POST['pais'];

    if ($paiselegido === 'Global') {
        $ranking = rankingGlobal();
    } else {
        $ranking = rankingxPais($paiselegido);
    }

    // Devuelve los datos como HTML
    foreach ($ranking as $index => $puntuacion) {
        echo "<tr>
                <td>" . ($index + 1) . "</td>
                <td>{$puntuacion['nombreUsuario']}</td>
                <td>{$puntuacion['puntuacion']}</td>
              </tr>";
    }
    exit;
}






?>
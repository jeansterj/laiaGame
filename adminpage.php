<?php require_once('./php_librarys/bdlaia.php');




?>

 <?php $usuarios = selectAllUsers(); ?>
  <?php $usuarios2 = selectUsers(); ?>  



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Your Title</title>
    <a class="logo" href="http://localhost:8080/laiaGame/tierra2.php"><img src="./Imagenes/logo.png"
            alt="logo_centiks"></a>
</head>

<body>
    <?php




    ?>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Usuario</th>
                    <th>Contraseña</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha Nacimiento</th>
                    <th>Rol</th>
                    <th>Juego</th>
                    <th>Puntuacion</th>
                    <th>Eliminar Usuario</th>

                </tr>
            </thead>

            <body>
                <?php




                $usuarios;
                if ($_SESSION['rol'] == 1) {

                    $usuarios = selectAllUsers();
                    echo "Estas logueado como" . ' ' . $_SESSION['user'] . 'y tu rol es Superadmin';
                    ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaladmin">
                        NUEVO ADMIN

                    </button>
                    <form action="./php_controllers/laiaController.php" method="POST">
                    <button type="submit"name="limpiarpuntuacion" class="btn btn-danger">LIMPIAR RANKING</button>
                    </form>
                    


                    <div class="modal fade" id="modaladmin" tabindex="-1" aria-labelledby="modaladmin" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="./php_controllers/laiaController.php" method="POST" class="mb-3">
    <div class="input-group mb-3">
        <span class="input-group-text">Nombre de Usuario</span>
        <input type="text" name="userName" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Password</span>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Nombre</span>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Apellido/s</span>
        <input type="text" name="primer_Apellido" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <label for="fecha_Nacimiento" class="input-group-text fecha_Naci">Fecha de Nacimiento</label>
        <input type="date" name="fecha_Nacimiento" class="form-control" required>
        <input type="hidden"value="2" id="id_Rol" name="id_Rol">
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" name="registro">Registro</button>
    </div>
</form>





                                <?php






                } else if ($_SESSION['rol'] == 2) {
                    $usuarios = selectUsers();
                    echo "Estas logueado como" . ' ' . $_SESSION['user'] . " y tu rol es Admin";
                } else if ($_SESSION['rol'] == 3) {
                    header('Location: ./tierra2.php');
                    exit();

                }





                ?>
                            <?php foreach ($usuarios as $usuario) { ?>
                                <tr>
                                    <td>

                                        <?= $usuario['usuario_id'] ?>
                                    </td>
                                    <td>


                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#modalnombreusu<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['nombreUsuario'] ?>

                                        </button>


                                        <div class="modal fade" id="modalnombreusu<?= $usuario['usuario_id'] ?>"
                                            tabindex="-1" aria-labelledby="modalnombreusu<?= $usuario['usuario_id'] ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
                                                            <?= $usuario['nombreUsuario'] ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="./php_controllers/laiaController.php" method="POST"
                                                            enctype="multipart/form-data">

                                                            <input type="hidden" name="usuario_id"
                                                                value="<?= $usuario['usuario_id'] ?>">
                                                            <input autofocus class="form-control mb-3" type="text"
                                                                name="newnombreUsuario">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="updatenombreUsuario">Confirmar
                                                                modificacion</button>
                                                        </form>




                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#modalcontrasena<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['contrasena'] ?>

                                        </button>


                                        <div class="modal fade" id="modalcontrasena<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['contrasena'] ?>" tabindex="-1" aria-labelledby="#modalcontrasena
                                            <?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['contrasena'] ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
                                                            <?= $usuario['contrasena'] ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="./php_controllers/laiaController.php" method="POST"
                                                            enctype="multipart/form-data">



                                                            <input type="hidden" name="usuario_id"
                                                                value="<?= $usuario['usuario_id'] ?>">
                                                            <input autofocus class="form-control mb-3" type="text"
                                                                name="newcontrasena">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="updateContrasena">Confirmar
                                                                modificacion</button>
                                                        </form>




                                                    </div>

                                                </div>
                                            </div>
                                        </div>















                                    </td>
                                    <td>


                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#modalnombre<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['nombreReal'] ?>

                                        </button>


                                        <div class="modal fade" id="modalnombre<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['nombreReal'] ?>" tabindex="-1" aria-labelledby="modalnombre
                                            <?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['nombreReal'] ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
                                                            <?= $usuario['nombreReal'] ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="./php_controllers/laiaController.php" method="POST"
                                                            enctype="multipart/form-data">



                                                            <input type="hidden" name="usuario_id"
                                                                value="<?= $usuario['usuario_id'] ?>">
                                                            <input autofocus class="form-control mb-3" type="text"
                                                                name="newnombrereal">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="updateNombreReal">Confirmar
                                                                modificacion</button>
                                                        </form>




                                                    </div>

                                                </div>
                                            </div>
                                        </div>
























                                    </td>
                                    <td>


                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#modalapellido<?= $usuario['usuario_id'] ?>">

                                            <?= $usuario['usuario_apellido'] ?>
                                        </button>


                                        <div class="modal fade" id="modalapellido<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['usuario_apellido'] ?>" tabindex="-1"
                                            aria-labelledby="modalapellido
                                            <?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['usuario_apellido'] ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
                                                            <?= $usuario['usuario_apellido'] ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="./php_controllers/laiaController.php" method="POST"
                                                            enctype="multipart/form-data">



                                                            <input type="hidden" name="usuario_id"
                                                                value="<?= $usuario['usuario_id'] ?>">
                                                            <input autofocus class="form-control mb-3" type="text"
                                                                name="newapellido">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="updateApellido">Confirmar
                                                                modificacion</button>
                                                        </form>




                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>



                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#modaldata<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['fecha_nacimiento'] ?>
                                        </button>


                                        <div class="modal fade" id="modaldata<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['fecha_nacimiento'] ?>" tabindex="-1" aria-labelledby="modaldata
                                            <?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['fecha_nacimiento'] ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
                                                            <?= $usuario['fecha_nacimiento'] ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="./php_controllers/laiaController.php" method="POST"
                                                            enctype="multipart/form-data">



                                                            <input type="hidden" name="usuario_id"
                                                                value="<?= $usuario['usuario_id'] ?>">
                                                            <input autofocus class="form-control mb-3" type="date"
                                                                name="newdata">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="updateData">Confirmar
                                                                modificacion</button>
                                                        </form>




                                                    </div>

                                                </div>
                                            </div>
                                        </div>



















                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#modalrol<?= $usuario['usuario_id'] ?>">

                                            <?= $usuario['rol'] ?>
                                        </button>


                                        <div class="modal fade" id="modalrol<?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['rol'] ?>" tabindex="-1" aria-labelledby="modalrol
                                            <?= $usuario['usuario_id'] ?>">
                                            <?= $usuario['rol'] ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel2">Actual :
                                                            <?= $usuario['rol'] ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="./php_controllers/laiaController.php" method="POST"
                                                            enctype="multipart/form-data">



                                                            <input type="hidden" name="usuario_id"
                                                                value="<?= $usuario['usuario_id'] ?>">

                                                            <select class="form-select mb-3"
                                                                aria-label="Default select example" name="newrol">

                                                                <option value="1">SuperAdmin</option>
                                                                <option value="2">Admin</option>
                                                                <option value="3">Jugador</option>
                                                            </select>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="updateRol">Confirmar
                                                                modificacion</button>
                                                        </form>




                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <?= $usuario['nombre_juego'] ?>
                                    </td>
                                    <td>
                                        <?= $usuario['puntuacion'] ?>
                                    </td>
                                    <td>


                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modaldelete<?= $usuario['usuario_id'] ?>">
                                            Eliminar</button>


                                        <div class="modal fade" id="modaldelete<?= $usuario['usuario_id'] ?>" tabindex="-1"
                                            aria-labelledby="modaldelete<?= $usuario['usuario_id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion de
                                                            eliminar
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Estas seguro que quieres borrar este usuario?
                                                        Se borraran todos sus registros.

                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="./php_controllers/laiaController.php" method="POST"
                                                            enctype="multipart/form-data">


                                                            <input type="hidden" name="usuario_id"
                                                                value="<?= $usuario['usuario_id'] ?>">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="delete">Confirmar
                                                                eliminacion</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </td>

                                </tr>
                            <?php } ?>
                            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php require_once('./php_librarys/bdlaia.php'); 




?>

<!-- <?php $usuarios = selectAllUsers(); ?>
  <?php $usuarios2 = selectUsers(); ?>  -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Your Title</title>
</head>

<body>
<?php




?>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre Usuario</th>
                    <th>Juego</th>
                    <th>Puntuacion</th>
                  
               
                </tr>
            </thead>

            <body>
                <?php 
                


                
                
                
                
                ?>
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <td>
                            echo prueba1;

                        
                        </td>
                        <td>


                           prueba2;


                        </td>
                        <td>
 prueba3;
                          



                        </td>

                    </tr>
                <?php } ?>
                </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
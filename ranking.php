<?php require_once('./php_librarys/bdlaia.php'); ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Your Title</title>
    
    <a class="logo" href="http://localhost:8080/laiaGame/tierra2.php"><img src="./Imagenes/logo.png" alt="logo_centiks"></a>
    
</head>

<body>
<?php




?>
    <div class="container">
    <form method="post" action="">
            <button type="submit" name="españa" value="1">WARCELONA</button>
            <button type="submit" name="brasil" value="2">BRASIL</button>
            <button type="submit" name="kenia" value="3">KENIA</button>
            <button type="submit" name="india" value="4">INDIA</button>
            <button type="submit" name="global" value="Global">GLOBAL</button>
        </form>

                
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre Usuario</th>
                    
                    <th>Puntuacion</th>
                  
               
                </tr>
            </thead>

            <body>
                <?php 
                  
                 
                  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['brasil'])) {
                      $paiselegido = $_POST['brasil'];
                      $ranking = rankingxPais($paiselegido);
          
                    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['españa'])) {
                        $paiselegido = $_POST['españa'];
                        $ranking = rankingxPais($paiselegido);
                  }
                  else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kenia'])) {
                    $paiselegido = $_POST['kenia'];
                    $ranking = rankingxPais($paiselegido);
                }
                 else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['india'])) {
                    $paiselegido = $_POST['india'];
                    $ranking = rankingxPais($paiselegido);
                 }
                 else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['global'])) {
                    $paiselegido = $_POST['global'];
                    $ranking = rankingGlobal();
                 }
                 else{
                    $ranking = rankingxPais(1);
                 }


               
                
                
                ?>
                <?php foreach ($ranking as $puntuacion) { ?>
                    <tr>
                        <td>
                       
                           <?php echo $puntuacion['nombreUsuario']; ?>

                        
                        </td>
                       
                        <td>
                            <?php
                            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['global'])) {
                               echo $puntuacion['totalPuntuacion'];
                                
                            }else{
                                 echo $puntuacion['puntuacion']; 
                            }
                             
                                ?>
           



                        </td>

                    </tr>
                <?php } ?>
                </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
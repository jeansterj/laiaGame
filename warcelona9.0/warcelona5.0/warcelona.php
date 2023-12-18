<?php


include('../../php_librarys/bdlaia.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warcelona</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   
    <div id="gameContainer">     
    <div class ="alfinal" id="alfinal">
    <form action="../../php_controllers/laiaController.php" METHOD="POST">
            <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>" <?php echo $_SESSION['idUser'] ?>
            <input type="hidden" name="puntuacion" value="">
            <button  type="submit" name="Warcelonadata" id="siguientejuego">siguientejuego</button>
        </form>
    </div> 
    </div>
    <button id="restartGameButton" style="display: none;">Vuelve a empezar</button>
    <div id="healthContainer">     
    </div>   
    <script type="module" src="main.js"></script> 

    
</body>
</html>

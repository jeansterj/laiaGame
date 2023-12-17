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
        
    <form action="../../php_controllers/laiaController.php" METHOD="POST">
          <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUser']; ?>" <?php echo $_SESSION['idUser'] ?>>
          <input type="hidden" name="puntuacion" value="">
          <button type="submit" name="Warcelonadata" id="siguientejuego">Envia los Datos
          </button>
        </form>  
        <button id="restartGameButton" onclick="window.location.href='../../tierra2.php'" style="display: none;">Vuelve al Menu</button>
    </div>
    <div id="healthContainer">     
    </div>
    <div id="timer">00:00</div>
    <div id="portraitContainer"></div>
    <script type="module" src="main.js"></script> 

    
</body>
</html>

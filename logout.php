<?php

session_start();


session_unset();

// Destruye la sesión
session_destroy();


header("Location: ./tierra2.php"); 
exit();
?>
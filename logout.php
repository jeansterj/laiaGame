<?php

session_start();


session_unset();

session_destroy();


header("Location: ./tierra2.php"); 
exit();
?>
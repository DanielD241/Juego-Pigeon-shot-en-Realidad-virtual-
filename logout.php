<?php

session_start();

// BORRAR TODA LA SESIÓN
session_unset();
session_destroy();

// REDIRIGIR AL LOGIN
header("Location: login.html");
exit();

?>

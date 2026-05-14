<?php

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

// usuario fijo (hardcodeado)
$correo_valido = "test@gmail.com";
$contraseña_valida = "1234";

if ($correo == $correo_valido && $contraseña == $contraseña_valida) {
    header("Location: home.html");
    exit();
} else {
    echo "Correo o contraseña incorrectos";
}

?>
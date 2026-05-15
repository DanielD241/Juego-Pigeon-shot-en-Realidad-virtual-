<?php

include "db.php";

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$password = $_POST['password'];

// VALIDAR CAMPOS VACÍOS
if (empty($usuario) || empty($correo) || empty($password)) {
    die("❌ Debes llenar todos los campos");
}

// VALIDAR CORREO
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("❌ Correo inválido");
}

// ENCRIPTAR CONTRASEÑA
$hash = password_hash($password, PASSWORD_DEFAULT);

// INSERTAR EN BD
$sql = "INSERT INTO usuarios (usuario, correo, password)
        VALUES ('$usuario', '$correo', '$hash')";

if ($conn->query($sql) === TRUE) {
    echo "✔ Usuario registrado correctamente";
    header("Location: login.html");
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();

?>
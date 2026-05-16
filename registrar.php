<?php

include "db.php";

// OBTENER DATOS DEL FORMULARIO
$usuario = trim($_POST['usuario'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

// VALIDAR CAMPOS VACÍOS
if (empty($usuario) || empty($correo) || empty($password)) {
    die("❌ Debes llenar todos los campos.");
}

// VALIDAR USUARIO (solo letras y espacios)
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,20}$/u", $usuario)) {
    die("❌ Usuario inválido. Solo letras y espacios (3 a 20 caracteres).");
}

// VALIDAR CORREO
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("❌ Correo electrónico inválido.");
}

// VALIDAR CONTRASEÑA
if (strlen($password) < 6) {
    die("❌ La contraseña debe tener al menos 6 caracteres.");
}

// ESCAPAR DATOS
$usuario = $conn->real_escape_string($usuario);
$correo = $conn->real_escape_string($correo);

// VERIFICAR SI EL CORREO YA EXISTE
$sql = "SELECT id FROM usuarios WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    die("❌ Este correo ya está registrado.");
}

// ENCRIPTAR CONTRASEÑA
$hash = password_hash($password, PASSWORD_DEFAULT);

// INSERTAR USUARIO
$sql = "INSERT INTO usuarios (usuario, correo, password)
        VALUES ('$usuario', '$correo', '$hash')";

// EJECUTAR INSERT
if ($conn->query($sql) === TRUE) {
    // REDIRIGIR AL LOGIN
    header("Location: login.html");
    exit();
} else {
    die("❌ Error al registrar el usuario: " . $conn->error);
}

// CERRAR CONEXIÓN
$conn->close();

?>
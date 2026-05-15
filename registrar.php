<?php

include "db.php";

/* =========================
   OBTENER DATOS DEL FORMULARIO
========================= */
$usuario = trim($_POST['usuario'] ?? '');
$correo   = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

/* =========================
   VALIDACIONES
========================= */

// Campos vacíos
if (empty($usuario) || empty($correo) || empty($password)) {
    die("❌ Debes llenar todos los campos.");
}

// Usuario: solo letras y espacios (3 a 20 caracteres)
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,20}$/u", $usuario)) {
    die("❌ Usuario inválido (solo letras, 3-20 caracteres).");
}

// Correo válido
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("❌ Correo inválido.");
}

// Contraseña mínima de 6 caracteres
if (strlen($password) < 6) {
    die("❌ La contraseña debe tener al menos 6 caracteres.");
}

/* =========================
   ESCAPAR DATOS
========================= */
$usuario = $conn->real_escape_string($usuario);
$correo  = $conn->real_escape_string($correo);

/* =========================
   VERIFICAR SI EL CORREO YA EXISTE
========================= */
$sql = "SELECT id FROM usuarios WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    die("❌ Este correo ya está registrado.");
}

/* =========================
   ENCRIPTAR CONTRASEÑA
========================= */
$hash = password_hash($password, PASSWORD_DEFAULT);

/* =========================
   GUARDAR USUARIO
========================= */
$sql = "INSERT INTO usuarios (usuario, correo, password)
        VALUES ('$usuario', '$correo', '$hash')";

if ($conn->query($sql) === TRUE) {
    // Redirigir al login después del registro
    header("Location: login.html");
    exit();
} else {
    die("❌ Error al registrar el usuario: " . $conn->error);
}

/* =========================
   CERRAR CONEXIÓN
========================= */
$conn->close();

?>
<?php

include "db.php";

/* =========================
   DATOS
========================= */
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$password = $_POST['password'];

/* =========================
   VALIDACIONES
========================= */

// campos vacíos
if (empty($usuario) || empty($correo) || empty($password)) {
    die("❌ Debes llenar todos los campos");
}

// usuario solo letras (evita aaaaa, 123, etc.)
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,20}$/", $usuario)) {
    die("❌ Usuario inválido (solo letras, 3-20 caracteres)");
}

// correo válido real
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("❌ Correo inválido");
}

// contraseña mínima
if (strlen($password) < 6) {
    die("❌ Contraseña muy corta (mínimo 6 caracteres)");
}

/* =========================
   VERIFICAR SI YA EXISTE
========================= */
$sql = "SELECT id FROM usuarios WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    die("❌ Este correo ya está registrado");
}

/* =========================
   (OPCIONAL) RECAPTCHA
========================= */
/*
$secret = "TU_SECRET_KEY";
$response = $_POST['g-recaptcha-response'];

$verify = file_get_contents(
    "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response"
);

$captcha_success = json_decode($verify);

if (!$captcha_success->success) {
    die("❌ Verifica que no eres un robot");
}
*/

/* =========================
   GUARDAR USUARIO
========================= */
$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (usuario, correo, password)
        VALUES ('$usuario', '$correo', '$hash')";

if ($conn->query($sql) === TRUE) {
    echo "✔ Usuario registrado correctamente";
    header("Location: login.html");
    exit();
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();

?>
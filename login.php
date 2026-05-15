<?php
session_start();
include "db.php";

/*
    En login.html el campo de contraseña se llama:
    name="password"

    Por eso aquí debemos leer:
    $_POST['password']
*/

$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

// Validar campos vacíos
if (empty($correo) || empty($password)) {
    die("❌ Debes ingresar el correo y la contraseña.");
}

// Limpiar el correo
$correo = $conn->real_escape_string($correo);

// Buscar usuario por correo
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$result = $conn->query($sql);

// Si el usuario no existe
if ($result->num_rows === 0) {
    die("❌ Usuario no registrado.");
}

$user = $result->fetch_assoc();

/*
    Validar contraseña.
    La columna en la base de datos debe llamarse "password".
*/
if (!password_verify($password, $user['password'])) {
    die("❌ Contraseña incorrecta.");
}

// Guardar datos en la sesión
$_SESSION['id'] = $user['id'];
$_SESSION['usuario'] = $user['usuario'];
$_SESSION['correo'] = $user['correo'];

// Regenerar ID de sesión por seguridad
session_regenerate_id(true);

/*
    Tu archivo en la carpeta es Home.html
    (con H mayúscula), así que redirigimos a ese archivo.
*/
header("Location: Home.html");
exit();
?>
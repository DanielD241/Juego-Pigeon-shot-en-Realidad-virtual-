<?php

session_start();

// BLOQUEAR ACCESO DIRECTO
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: login.html");
    exit();
}

include "db.php";

$correo = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

if(empty($correo) || empty($password)){
    die("❌ Completa todos los campos");
}

// VALIDAR LOGIN
$user = validarLogin($correo, $password);

if(!$user){
    die("❌ Correo o contraseña incorrectos");
}

// CREAR SESIÓN
$_SESSION['id'] = $user['id'];
$_SESSION['usuario'] = $user['usuario'];

// REDIRECCIÓN
header("Location: panel.php");
exit();

?>

session_start();

include "db.php";

/* =========================
   VALIDAR MÉTODO POST
   ========================= */

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: login.html");
    exit();
}

/* =========================
   OBTENER DATOS
   ========================= */

$correo  = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

/* =========================
   VALIDAR CAMPOS VACÍOS
   ========================= */

if (
    empty($correo) ||
    empty($password)
) {

    die("❌ Debes ingresar el correo y la contraseña.");
}

/* =========================
   VALIDAR GMAIL
   ========================= */

if (
    !preg_match(
        "/^[a-zA-Z0-9._%+-]+@gmail\.com$/",
        $correo
    )
) {

    die("❌ Correo Gmail inválido.");
}

/* =========================
   LIMPIAR CORREO
   ========================= */

$correo = $conn->real_escape_string($correo);

/* =========================
   BUSCAR USUARIO
   ========================= */

$sql = "SELECT *
        FROM usuarios
        WHERE correo = '$correo'";

$result = $conn->query($sql);

/* =========================
   USUARIO NO EXISTE
   ========================= */

if (!$result || $result->num_rows === 0) {

    die("❌ Usuario no registrado.");
}

/* =========================
   OBTENER USUARIO
   ========================= */

$user = $result->fetch_assoc();

/* =========================
   VALIDAR CONTRASEÑA
   ========================= */

if (
    !password_verify(
        $password,
        $user['password']
    )
) {

    die("❌ Contraseña incorrecta.");
}

/* =========================
   CREAR SESIÓN
   ========================= */

$_SESSION['id'] = $user['id'];

$_SESSION['usuario'] = $user['usuario'];

$_SESSION['correo'] = $user['correo'];

/* =========================
   SEGURIDAD EXTRA
   ========================= */

session_regenerate_id(true);

/* =========================
   REDIRECCIÓN
   ========================= */

header("Location: home.php");

exit();

?>
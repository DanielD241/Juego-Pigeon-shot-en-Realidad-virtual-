<?php

session_start();

include "db.php";

/* =========================
   BLOQUEAR ACCESO DIRECTO
   ========================= */

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: login.html");
    exit();
}

/* =========================
   OBTENER DATOS
   ========================= */

$correo = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

/* =========================
   VALIDAR CAMPOS
   ========================= */

if (empty($correo) || empty($password)) {

    echo "<script>
    alert('Completa todos los campos');
    window.location='login.html';
    </script>";

    exit();
}

/* =========================
   VALIDAR LOGIN
   ========================= */

$user = validarLogin($correo, $password);

/* =========================
   LOGIN INCORRECTO
   ========================= */

if (!$user) {

    echo "<script>
    alert('Correo o contraseña incorrectos');
    window.location='login.html';
    </script>";

    exit();
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

header("Location: Home.html");
exit();

?>
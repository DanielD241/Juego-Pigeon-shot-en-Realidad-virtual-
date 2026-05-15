<?php

session_start();
include "db.php";

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

// VALIDAR CAMPOS VACÍOS
if (empty($correo) || empty($contraseña)) {
    die("❌ Debes llenar todos los campos");
}

// PROTEGER DATOS (SEGURIDAD EXTRA)
$correo = $conn->real_escape_string($correo);

// BUSCAR USUARIO EN LA BASE DE DATOS
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$result = $conn->query($sql);

// ❌ SI NO EXISTE EL USUARIO
if ($result->num_rows == 0) {
    die("❌ Usuario no registrado");
}

$user = $result->fetch_assoc();

// ❌ VALIDAR CONTRASEÑA
if (!password_verify($contraseña, $user['password'])) {
    die("❌ Contraseña incorrecta");
}

// ✔ LOGIN CORRECTO (SESIONES SEGURAS)
$_SESSION['id'] = $user['id'];
$_SESSION['usuario'] = $user['usuario'];
$_SESSION['correo'] = $user['correo'];

// EVITAR CACHE / ACCESO RÁPIDO SIN LOGIN
session_regenerate_id(true);

// REDIRECCIÓN SEGURA
header("Location: home.php");
exit();

?>
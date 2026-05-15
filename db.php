<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "pigeon_shot";

// CONEXIÓN
$conn = new mysqli($host, $user, $pass, $db);

// VERIFICAR CONEXIÓN
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// UTF-8
$conn->set_charset("utf8");


/* =========================
   🔐 FUNCIONES ÚTILES
   ========================= */

// LIMPIAR DATOS (evitar inyección SQL)
function limpiar($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// VERIFICAR SI USUARIO EXISTE
function usuarioExiste($correo) {
    global $conn;

    $correo = limpiar($correo);

    $sql = "SELECT id FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    return ($result->num_rows > 0);
}

// REGISTRAR USUARIO
function registrarUsuario($usuario, $correo, $password) {
    global $conn;

    $usuario = limpiar($usuario);
    $correo = limpiar($correo);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (usuario, correo, password)
            VALUES ('$usuario', '$correo', '$password')";

    return $conn->query($sql);
}

// VALIDAR LOGIN
function validarLogin($correo, $password) {
    global $conn;

    $correo = limpiar($correo);

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        return false; // no existe
    }

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        return $user; // login correcto
    }

    return false;
}

?>
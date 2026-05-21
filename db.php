<?php

/* =========================
   CONFIGURACIÓN MYSQL
   ========================= */

$host = "localhost";
$user = "root";
$pass = "";
$db   = "pigeon_shot";

/* =========================
   CONEXIÓN
   ========================= */

$conn = new mysqli($host, $user, $pass, $db);

/* =========================
   VERIFICAR CONEXIÓN
   ========================= */

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

/* =========================
   UTF-8
   ========================= */

$conn->set_charset("utf8mb4");


/* =========================
   🔐 FUNCIONES SEGURAS
   ========================= */

/* LIMPIAR DATOS */
function limpiar($data) {

    global $conn;

    return $conn->real_escape_string(trim($data));
}


/* VERIFICAR SI EL USUARIO EXISTE */
function usuarioExiste($correo) {

    global $conn;

    $correo = limpiar($correo);

    $sql = "SELECT id FROM usuarios
            WHERE correo = '$correo'";

    $result = $conn->query($sql);

    if (!$result) {
        return false;
    }

    return ($result->num_rows > 0);
}


/* REGISTRAR USUARIO */
function registrarUsuario($usuario, $correo, $password) {

    global $conn;

    $usuario = limpiar($usuario);
    $correo  = limpiar($correo);

    /* ENCRIPTAR CONTRASEÑA */
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios
            (usuario, correo, password)

            VALUES

            ('$usuario', '$correo', '$password')";

    return $conn->query($sql);
}


/* VALIDAR LOGIN */
function validarLogin($correo, $password) {

    global $conn;

    $correo = limpiar($correo);

    $sql = "SELECT *
            FROM usuarios
            WHERE correo = '$correo'";

    $result = $conn->query($sql);

    if (!$result || $result->num_rows == 0) {
        return false;
    }

    $user = $result->fetch_assoc();

    /* VERIFICAR CONTRASEÑA */
    if (password_verify($password, $user['password'])) {

        return $user;
    }

    return false;
}


/* =========================
   🏆 RANKING UNITY READY
   ========================= */


/* GUARDAR PUNTAJE */
function guardarPuntaje($usuario_id, $puntos) {

    global $conn;

    $usuario_id = intval($usuario_id);
    $puntos     = intval($puntos);

    $sql = "INSERT INTO ranking
            (usuario_id, puntos)

            VALUES

            ($usuario_id, $puntos)";

    return $conn->query($sql);
}


/* OBTENER TOP JUGADORES */
function obtenerRanking() {

    global $conn;

    $sql = "SELECT
                u.usuario,
                r.puntos

            FROM ranking r

            INNER JOIN usuarios u
            ON r.usuario_id = u.id

            ORDER BY r.puntos DESC

            LIMIT 10";

    return $conn->query($sql);
}

?>
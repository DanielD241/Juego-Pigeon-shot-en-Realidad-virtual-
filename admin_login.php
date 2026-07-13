<?php

session_start();

include "db.php";

/* =========================
   BLOQUEAR ACCESO DIRECTO
   ========================= */

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: admin_login.html");
    exit();
}

$usuario  = trim($_POST['usuario']  ?? '');
$password = $_POST['password'] ?? '';

if (empty($usuario) || empty($password)) {
    header("Location: admin_login.html?error=campos");
    exit();
}

/* =========================
   PREPARED STATEMENT (sin inyección SQL)
   ========================= */

$stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: admin_login.html?error=usuario");
    exit();
}

$admin = $result->fetch_assoc();

if (!password_verify($password, $admin['password'])) {
    header("Location: admin_login.html?error=pass");
    exit();
}

$_SESSION['admin'] = $admin['usuario'];

header("Location: admin_panel.php");
exit();

?>

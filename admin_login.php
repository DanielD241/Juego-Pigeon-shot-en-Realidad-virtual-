<?php

session_start();

include "db.php";

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

if(empty($usuario) || empty($password)){
    die("Completa todos los campos");
}

$sql = "SELECT * FROM admins WHERE usuario='$usuario'";

$result = $conn->query($sql);

if($result->num_rows == 0){
    die("Admin no encontrado");
}

$admin = $result->fetch_assoc();

if(!password_verify($password, $admin['password'])){
    die("Contraseña incorrecta");
}

$_SESSION['admin'] = $admin['usuario'];

echo "🎉 Bienvenido Admin " . $admin['usuario'];

?>
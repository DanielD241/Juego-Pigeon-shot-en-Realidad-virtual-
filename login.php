<?php
$conn = new mysqli("localhost", "root", "", "pigeon_shot");

if ($conn->connect_error) {
    die("Error de conexión");
}

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$sql = "SELECT * FROM usuarios WHERE correo='$correo' AND contraseña='$contraseña'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: home.html");
    exit();
} else {
    echo "Correo o contraseña incorrectos";
}
?>
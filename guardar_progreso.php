<?php
$conn = new mysqli("localhost", "root", "", "juego_historia");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$nivel = $_POST['nivel'];
$mision = $_POST['mision'];
$puntaje = $_POST['puntaje'];

$sql = "INSERT INTO progreso (nombre, nivel, mision, puntaje)
VALUES ('$nombre', '$nivel', '$mision', '$puntaje')";

if ($conn->query($sql) === TRUE) {
    echo "PROGRESO GUARDADO";
} else {
    echo "ERROR AL GUARDAR";
}

$conn->close();
?>
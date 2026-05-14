<?php

$conn = new mysqli("localhost", "root", "tu_password", "pigeon_game");

if ($conn->connect_error) {
    die("Error de conexión");
}

$action = $_POST['action'] ?? "";

/* =========================
   REGISTRO
========================= */
if ($action == "register") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(username, password) VALUES('$username','$password')";

    echo $conn->query($sql) ? "REGISTRADO ✔" : "ERROR ❌";
}

/* =========================
   LOGIN
========================= */
if ($action == "login") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password'";

    $result = $conn->query($sql);

    echo ($result->num_rows > 0) ? "LOGIN OK 🎮" : "ERROR LOGIN ❌";
}

/* =========================
   GUARDAR PUNTOS
========================= */
if ($action == "score") {

    $username = $_POST['username'];
    $points = $_POST['points'];

    $sql = "INSERT INTO scores(username, points) 
            VALUES('$username', '$points')";

    echo $conn->query($sql) ? "PUNTAJE GUARDADO ✔" : "ERROR ❌";
}

/* =========================
   RANKING
========================= */
if ($action == "ranking") {

    $sql = "SELECT username, SUM(points) AS total 
            FROM scores 
            GROUP BY username 
            ORDER BY total DESC";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo $row['username'] . " - " . $row['total'] . "<br>";
    }
}

$conn->close();

?>
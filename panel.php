<?php
session_start();

// SI NO HAY SESIÓN → BLOQUEAR
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel - Pigeon Shot</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#0b0f1a;
    color:white;
    text-align:center;
}

.box{
    margin-top:100px;
    padding:30px;
}

button{
    padding:10px 20px;
    border:none;
    background:red;
    color:white;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="box">

    <h1>🎮 Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
    <p>Correo: <?php echo $_SESSION['correo']; ?></p>

    <hr>

    <h2>Panel del Juego</h2>
    <p>Aquí puedes conectar Unity, puntajes o ranking</p>

    <br>

    <a href="logout.php">
        <button>Cerrar sesión</button>
    </a>

</div>

</body>
</html>
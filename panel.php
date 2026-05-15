<?php
session_start();

// SI NO HAY SESIÓN → BLOQUEAR
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// EVITAR CACHE (no volver atrás y entrar sin login)
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
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
    margin-top:80px;
    padding:30px;
}

.card{
    background:#111a2e;
    padding:20px;
    margin:20px auto;
    width:60%;
    border-radius:15px;
    box-shadow:0 0 10px black;
}

button{
    padding:10px 20px;
    border:none;
    color:white;
    cursor:pointer;
    margin:5px;
    border-radius:8px;
}

.logout{
    background:red;
}

.play{
    background:#00c6ff;
    color:black;
}

.refresh{
    background:green;
}
</style>
</head>

<body>

<div class="box">

    <h1>🎮 Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
    <p>Correo: <?php echo $_SESSION['correo']; ?></p>

    <hr>

    <!-- PANEL DEL JUEGO -->
    <div class="card">
        <h2>Panel del Juego</h2>
        <p>Aquí puedes conectar Unity, puntajes o ranking</p>

        <!-- 🔥 ESPACIO PARA FUTURO RANKING -->
        <h3>🏆 Puntuación actual</h3>
        <p>Aún no disponible (conectar con Unity)</p>
    </div>

    <!-- BOTONES -->
    <a href="logout.php">
        <button class="logout">Cerrar sesión</button>
    </a>

    <a href="index.html">
        <button class="play">Ir al juego</button>
    </a>

    <!-- 🔄 REFRESCAR SESIÓN -->
    <button class="refresh" onclick="location.reload()">
        Recargar panel
    </button>

</div>

</body>
</html>
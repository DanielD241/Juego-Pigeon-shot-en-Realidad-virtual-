<?php

session_start();

/* =========================
   PROTEGER LA PÁGINA
   ========================= */

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pigeon Shot VR</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>

<header class="site-header">
    <div class="logo">🎮 Pigeon Shot VR</div>

    <div class="header-buttons">
        <a href="Pigeonshot.apk" download class="btn btn-primary">⬇ Descargar APK</a>
        <div class="user-pill">
            👤 <?php echo htmlspecialchars($_SESSION['usuario']); ?>
            | <a href="logout.php">Cerrar sesión</a>
        </div>
    </div>
</header>

<!-- PORTADA -->
<section class="hero">
    <h1>PIGEON SHOT VR</h1>
    <p>
        Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>.
        Protege tus cultivos de trigo eliminando palomas invasoras en esta
        experiencia de disparo en realidad virtual.
    </p>

    <img src="imagenes/Portada-pigeon-shot.jpeg" alt="Portada de Pigeon Shot VR">

    <div class="hero-actions">
        <a href="Pigeonshot.apk" download class="btn btn-primary">⬇ Descargar APK</a>
    </div>
</section>

<!-- GALERÍA -->
<section class="section">
    <h2>GALERÍA DEL JUEGO</h2>
    <div class="gallery">
        <img src="imagenes/cazador-trigo 1.jpeg" alt="Captura de pantalla 1">
        <img src="imagenes/cazador-trigo 2.jpeg" alt="Captura de pantalla 2">
    </div>
</section>

<!-- ACERCA DEL PROYECTO -->
<section class="section">
    <h2>ACERCA DEL PROYECTO</h2>
    <p>
        Pigeon Shot VR es un videojuego desarrollado en Unity con realidad virtual.
        El objetivo del jugador es proteger los cultivos de trigo eliminando las
        palomas invasoras. Este proyecto académico integra programación, diseño 3D,
        desarrollo web y bases de datos.
    </p>
</section>

<!-- CARACTERÍSTICAS -->
<section class="section">
    <h2>CARACTERÍSTICAS</h2>
    <ul class="features">
        <li>Realidad Virtual (VR)</li>
        <li>Desarrollado en Unity</li>
        <li>Sistema de login y registro</li>
        <li>Descarga directa del APK</li>
        <li>Página web oficial del proyecto</li>
    </ul>
</section>

<footer class="site-footer">
    © 2026 Pigeon Shot VR — Todos los derechos reservados
</footer>

</body>
</html>

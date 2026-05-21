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

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Orbitron', sans-serif;
    background:#050816;
    color:white;
}

/* HEADER */

header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 8%;
    background:#111a2e;
}

/* LOGO */

.logo{
    color:#00c6ff;
    font-size:1.5rem;
}

/* USUARIO */

.user{
    color:#ccc;
}

/* HERO */

.hero{
    text-align:center;
    padding:80px 20px;
}

.hero h1{
    font-size:3rem;
    color:#00c6ff;
}

.hero p{
    max-width:700px;
    margin:20px auto;
    color:#ccc;
}

/* IMAGEN */

.hero img{
    width:100%;
    max-width:900px;
    border-radius:20px;
    margin-top:20px;
}

/* BOTONES */

.btn{
    display:inline-block;
    margin-top:20px;
    padding:15px 30px;
    background:#00c6ff;
    color:black;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
}

/* FOOTER */

footer{
    text-align:center;
    padding:40px;
    color:#777;
}

</style>

</head>

<body>

<header>

    <div class="logo">
        Pigeon Shot VR
    </div>

    <div class="user">

        👤

        <?php
            echo htmlspecialchars($_SESSION['usuario']);
        ?>

        |

        <a
            href="logout.php"
            style="color:#00c6ff; text-decoration:none;"
        >
            Cerrar sesión
        </a>

    </div>

</header>

<!-- CONTENIDO -->

<section class="hero">

    <h1>PIGEON SHOT VR</h1>

    <p>
        Bienvenido al juego de realidad virtual donde
        debes proteger tus cultivos de las palomas.
    </p>

    <img
        src="imagenes/Portada-Pigeon-shot.jpeg"
        alt="Pigeon Shot VR"
    >

    <br>

    <!-- DESCARGA APK -->

    <a
        href="Pigeonshot.apk"
        download
        class="btn"
    >
        Descargar APK
    </a>

</section>

<footer>

    © 2026 Pigeon Shot VR

</footer>

</body>
</html>
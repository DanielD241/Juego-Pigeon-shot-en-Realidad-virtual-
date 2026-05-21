<?php

session_start();

/* =========================
   ELIMINAR VARIABLES
   ========================= */

$_SESSION = [];

/* =========================
   ELIMINAR COOKIE DE SESIÓN
   ========================= */

if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

/* =========================
   DESTRUIR SESIÓN
   ========================= */

session_destroy();

/* =========================
   REDIRIGIR
   ========================= */

header("Location: login.html");

exit();

?>
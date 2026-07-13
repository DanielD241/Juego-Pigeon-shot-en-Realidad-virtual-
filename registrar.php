<?php

session_start();

include "db.php";

/* =========================
   BLOQUEAR ACCESO DIRECTO
   ========================= */

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: login.html");
    exit();
}

/* =========================
   OBTENER DATOS
   ========================= */

$usuario = trim($_POST['usuario'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

/* =========================
   VALIDAR CAMPOS
   ========================= */

if (
    empty($usuario) ||
    empty($correo) ||
    empty($password)
) {

    echo "<script>
    alert('Completa todos los campos');
    window.location='login.html';
    </script>";

    exit();
}

/* =========================
   VALIDAR USUARIO
   ========================= */

if (
    !preg_match(
        "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{3,20}$/u",
        $usuario
    )
) {

    echo "<script>
    alert('Usuario inválido');
    window.location='login.html';
    </script>";

    exit();
}

/* =========================
   VALIDAR GMAIL
   ========================= */

if (
    !preg_match(
        "/^[a-zA-Z0-9._%+-]+@gmail\.com$/",
        $correo
    )
) {

    echo "<script>
    alert('Solo se permiten correos Gmail');
    window.location='login.html';
    </script>";

    exit();
}

/* =========================
   VALIDAR CONTRASEÑA
   ========================= */

if (
    strlen($password) < 8 ||
    !preg_match("/[A-Z]/", $password) ||
    !preg_match("/[0-9]/", $password)
) {

    echo "<script>
    alert('La contraseña debe tener mínimo 8 caracteres, una mayúscula y un número');
    window.location='login.html';
    </script>";

    exit();
}

/* =========================
   VERIFICAR SI YA EXISTE
   ========================= */

if (usuarioExiste($correo)) {

    echo "<script>
    alert('Este Gmail ya está registrado');
    window.location='login.html';
    </script>";

    exit();
}

/* =========================
   REGISTRAR USUARIO
   ========================= */

if (registrarUsuario($usuario, $correo, $password)) {

    echo "<script>
    alert('Registro exitoso');
    window.location='login.html';
    </script>";

    exit();

} else {

    echo "<script>
    alert('Error al registrar');
    window.location='login.html';
    </script>";

    exit();
}

?>

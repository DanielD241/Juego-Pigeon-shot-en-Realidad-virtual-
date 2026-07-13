

<?php

session_start();

include "db.php";

/* EVITAR ACCESO DIRECTO */
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: login.html");
    exit();
}

/* DATOS */
$correo = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

/* VALIDAR */
if(empty($correo) || empty($password)){

    echo "<script>
    alert('Completa todos los campos');
    window.location='login.html';
    </script>";

    exit();
}

/* VALIDAR LOGIN */
$user = validarLogin($correo, $password);

if(!$user){

    echo "<script>
    alert('Correo o contraseña incorrectos');
    window.location='login.html';
    </script>";

    exit();
}

/* SESIÓN */
$_SESSION['id'] = $user['id'];
$_SESSION['usuario'] = $user['usuario'];
$_SESSION['correo'] = $user['correo'];

/* REDIRECCIÓN */
header("Location: Home.php");
exit();

?>

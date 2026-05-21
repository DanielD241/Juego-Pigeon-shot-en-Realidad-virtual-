Tu registrar.php ya está bastante bien. ✅
Solo voy a corregirlo para:

✅ evitar error 405,

✅ aceptar solo Gmail,

✅ validar contraseña segura,

✅ evitar warnings,

✅ mejorar seguridad,

✅ evitar errores si alguien abre el PHP directamente.


<?php

include "db.php";

/* =========================
   VALIDAR MÉTODO POST
   ========================= */

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: login.html");
    exit();
}

/* =========================
   OBTENER DATOS
   ========================= */

$usuario = trim($_POST['usuario'] ?? '');
$correo  = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

/* =========================
   VALIDAR CAMPOS VACÍOS
   ========================= */

if (
    empty($usuario) ||
    empty($correo) ||
    empty($password)
) {

    die("❌ Debes llenar todos los campos.");
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

    die("❌ Usuario inválido.");
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

    die("❌ Debes usar un correo Gmail válido.");
}

/* =========================
   VALIDAR CONTRASEÑA
   ========================= */

if (strlen($password) < 8) {

    die("❌ La contraseña debe tener mínimo 8 caracteres.");
}

/* =========================
   ESCAPAR DATOS
   ========================= */

$usuario = $conn->real_escape_string($usuario);
$correo  = $conn->real_escape_string($correo);

/* =========================
   VERIFICAR SI YA EXISTE
   ========================= */

$sql = "SELECT id
        FROM usuarios
        WHERE correo = '$correo'";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    die("❌ Este correo ya está registrado.");
}

/* =========================
   ENCRIPTAR CONTRASEÑA
   ========================= */

$hash = password_hash($password, PASSWORD_DEFAULT);

/* =========================
   INSERTAR USUARIO
   ========================= */

$sql = "INSERT INTO usuarios
        (usuario, correo, password)

        VALUES

        ('$usuario', '$correo', '$hash')";

/* =========================
   EJECUTAR INSERT
   ========================= */

if ($conn->query($sql) === TRUE) {

    header("Location: login.html");
    exit();

} else {

    die("❌ Error al registrar: " . $conn->error);
}

/* =========================
   CERRAR CONEXIÓN
   ========================= */

$conn->close();

?>
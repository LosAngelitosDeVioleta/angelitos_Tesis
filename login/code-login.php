<?php
require_once "conexion.php";

// Si ya está logueado, redirigir
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: bienvenida.php");
    exit;
}

$login_err = "";

// Procesar el login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $login_err = "Por favor completa todos los campos.";
    } else {
        $sql = "SELECT id, usuario, email, clave,rol FROM usuarios WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username_db, $email_db, $password_hash,$rol);
                mysqli_stmt_fetch($stmt);

                if (password_verify($password, $password_hash)) {
                    // Login OK
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username_db;
                     $_SESSION["rol"] = $rol; // Guardamos el rol del usuario
                    mysqli_stmt_close($stmt);

                      //  Redirigir según el rol
                    if ($rol == 1) {
                        header("Location: dashboard.php"); // Admin
                        exit;
                    } elseif ($rol == 2) {
                        header("Location: inicio.php"); // Usuario normal
                        exit;
                    } else {
                        header("Location: bienvenida.php"); // Por si acaso
                        exit;
                    }
                } else {
                    $login_err = "Correo o contraseña incorrectos.";
                }
            } else {
                $login_err = "Correo o contraseña incorrectos.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $login_err = "Error al preparar la consulta: " . $link->error;
        }
    }
}

mysqli_close($link);

// Guardamos el error en la sesión para mostrarlo en index.php
if ($login_err !== '') {
    $_SESSION['login_err'] = $login_err;
}
?>

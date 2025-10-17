<?php
// ------------------- INCLUIR ARCHIVO DE CONEXIÓN -------------------
require_once "conexion.php";

// ------------------- INICIALIZAR VARIABLES -------------------
$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

// ------------------- PROCESAR FORMULARIO AL ENVIAR -------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ------------------- VALIDAR USERNAME -------------------
    $username = trim($_POST["username"] ?? "");

    if (empty($username)) {
        $username_err = "Por favor, ingresa un nombre de usuario.";
    } else {
        // Preparar declaración SQL para verificar si el usuario ya existe
        $sql = "SELECT id FROM usuarios WHERE usuario = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este nombre de usuario ya está en uso.";
                }
            } else {
                echo "¡Ups! Algo salió mal, vuelve a intentarlo más tarde.";
            }

            mysqli_stmt_close($stmt); // cerrar statement
        }
    }

    // ------------------- VALIDAR EMAIL -------------------
    $email = trim($_POST["email"] ?? "");

    if (empty($email)) {
        $email_err = "Por favor, ingresa un email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validar formato de email
        $email_err = "El email no tiene un formato válido.";
    } else {
        // Preparar declaración SQL para verificar si el email ya existe
        $sql = "SELECT id FROM usuarios WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "Este email ya está en uso.";
                }
            } else {
                echo "¡Ups! Algo salió mal, vuelve a intentarlo más tarde.";
            }

            mysqli_stmt_close($stmt); // cerrar statement
        }
    }

    // ------------------- VALIDAR PASSWORD -------------------
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, ingresa una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // ------------------- INSERTAR DATOS EN LA BASE DE DATOS -------------------
    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO usuarios (usuario, email, clave,rol) VALUES (?, ?, ?,?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_password,$rol);

            // Establecer parámetros a almacenar
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Encriptar la contraseña
            $rol="2";//se le asigna el rol user automaticamente para evitar que se agreguen admin

            // Ejecutar statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php"); // Redirigir al login
                exit;
            } else {
                echo "¡Ups! Algo salió mal, vuelve a intentarlo más tarde.";
            }

            mysqli_stmt_close($stmt); // cerrar statement
        }
    }

    // ------------------- CERRAR CONEXIÓN -------------------
    mysqli_close($link);
}
?>

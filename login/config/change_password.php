<?php
// change_password.php
require_once "../conexion.php";

if (isset($_POST['email']) && isset($_POST['new_password'])) {
    $email = trim($_POST['email']);
    $new_pass = $_POST['new_password'];

    if ($email === '' || $new_pass === '') {
        die("Faltan datos.");
    }

    $hashedPass = password_hash($new_pass, PASSWORD_DEFAULT);

    $stmt = $link->prepare("UPDATE usuarios SET clave = ? WHERE email = ?");
    if ($stmt === false) {
        die("Error prepare: " . $link->error);
    }

    $stmt->bind_param("ss", $hashedPass, $email);

    if ($stmt->execute()) {
        // opcional: verificar filas afectadas
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            header("Location: ../index.php?message=success_password");
            exit;
        } else {
            // No afectó ninguna fila → email no encontrado
            echo "No se encontró el usuario (email).";
        }
    } else {
        echo "Error al ejecutar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: faltan datos del formulario.";
}
?>

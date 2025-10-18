<?php
// ==================================================
// 🔹 CONEXIÓN A LA BASE DE DATOS
// ==================================================
require_once "../conexion.php";

// ==================================================
// 🔹 CONFIGURACIÓN DE PHPMailer
// ==================================================
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

// ==================================================
// 🔹 VALIDAR EMAIL ENVIADO POR POST
// ==================================================
$email = trim($_POST["email"] ?? "");

if (!empty($email)) {

    // Verificar si el correo existe
    $stmt = $link->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $mail = new PHPMailer(true);

        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ladvprueba@gmail.com'; 
            $mail->Password   = 'npazlnqmlpqglyug';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Codificación UTF-8
            $mail->CharSet = 'UTF-8';
            // No usar base64 manualmente, PHPMailer lo maneja
            // $mail->Encoding = 'base64'; // eliminar

            // Remitente y destinatario
            $mail->setFrom('bonfigliemilia07@gmail.com', 'Bonfigli Emilia');
            $mail->addAddress($email); // envía al correo del usuario

            // Contenido HTML
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = '
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Recuperar contraseña</title>
            </head>
            <body>
                <h2>Hola 👋🐾</h2>
                <p>Recibimos una solicitud para restablecer tu contraseña en <strong>Los Angelitos de Violeta Fundación Animal</strong> 💙.</p>
                <p>Para crear una nueva contraseña, hacé clic en el siguiente enlace:</p>
                <p><a href="http://localhost/login/change_password.php?email=' . urlencode($email) . '" style="color: #00aaff; font-weight: bold;">🐾 Restablecer contraseña 🐾</a></p>
                <p>Si no solicitaste este cambio, podés ignorar este correo sin problema.</p>
                <p>¡Gracias por ayudarnos a cuidar y proteger a nuestros angelitos peludos! 💙🐾</p>
            </body>
            </html>
            ';

            // Contenido alternativo en texto plano (sin emojis)
            $mail->AltBody = "Hola!\nRecibimos una solicitud para restablecer tu contraseña en Los Angelitos de Violeta Fundación Animal.\n\n"
                . "Para crear una nueva contraseña, hacé clic en el siguiente enlace:\n"
                . "http://localhost/login/change_password.php?email=" . urlencode($email) . "\n\n"
                . "Si no solicitaste este cambio, podés ignorar este correo.\n\n"
                . "Gracias por ayudarnos a cuidar y proteger a nuestros angelitos peludos.";

            // Enviar correo
            $mail->send();
            header("Location: ../index.php?message=ok");
            exit;
        } catch (Exception $e) {
            header("Location: ../index.php?message=error");
            exit;
        }

    } else {
        header("Location: ../index.php?message=not_found");
        exit;
    }

} else {
    // Redirigir con mensaje de error en lugar de mostrar echo
    header("Location: ../recovery.php?message=empty_email");
    exit;
}
?>
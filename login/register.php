<?php 
    include 'code-register.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-b..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Registro - LADV</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="ctn-all">
        <!-- Formulario -->
        <div class="ctn-form">
            <img src="images/logo.png" alt="Logo Los Angelitos de Violeta" class="logo">
            <h1 class="title">Registrarse</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                <span class="msg-error">
                    <?php echo $username_err; ?>
                </span>

                <label for="email">Correo electrónico:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="msg-error">
                    <?php echo $email_err; ?>
                </span>

                <label for="password">Contraseña:</label>
                <div class="campo-password">
                    <input type="password" id="password" name="password">
                    <button type="button" class="toggle-password" onclick="mostrarOcultar()">
                        <i id="icono-ojo" class="fa-regular fa-eye" style="color:#1aa5db;"></i>
                    </button>
                </div>
                <span class="msg-error">
                    <?php echo $password_err; ?>
                </span>

                <button type="submit" class="enviar">Crear cuenta</button>
            </form>

            <span class="text-footer">
                ¿Ya tienes una cuenta?
                <a class="link" href="index.php">Inicia sesión</a>
            </span>
        </div>

        <!-- Lado derecho -->
        <div class="ctn-text">
            <div class="capa">
                <h2 class="title-description">¡Únete a nuestra familia!</h2>
                <p class="text-description">
                    Al registrarte en <strong>Los Angelitos de Violeta Fundación Animal</strong> podrás apoyar la
                    adopción
                    responsable, recibir novedades y participar en nuestras actividades para dar amor a quienes más lo
                    necesitan.
                </p>
            </div>
        </div>
    </div>

<script>
function mostrarOcultar() {
    const passInput = document.getElementById('password');
    const icono = document.getElementById('icono-ojo');

    if (passInput.type === 'password') {
        passInput.type = 'text';
        icono.classList.remove('fa-eye');
        icono.classList.add('fa-eye-slash');
    } else {
        passInput.type = 'password';
        icono.classList.remove('fa-eye-slash');
        icono.classList.add('fa-eye');
    }
}
</script>

</body>

</html>
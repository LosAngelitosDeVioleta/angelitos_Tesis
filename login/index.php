<?php
session_start();
require_once "code-login.php"; // Este archivo procesa el login y setea $_SESSION['login_err'] si falla

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validaciones
    if ($email === '') {
        $errors['email'] = 'El correo es obligatorio';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Ingrese un correo válido';
    }

    if ($password === '') {
        $errors['password'] = 'La contraseña es obligatoria';
    }


    // Si no hay errores de validación, procesamos login
    if (empty($errors)) {
        // code-login.php debería verificar usuario y contraseña
        // Si falla, setea $_SESSION['login_err']
        if (isset($_SESSION['login_err'])) {
            $errors['general'] = $_SESSION['login_err'];
            unset($_SESSION['login_err']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Login - LADV</title>
<link rel="stylesheet" href="css/style.css">
<style>
/* Contenedor de alertas flotantes centrado arriba */
.toast-container {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
}
</style>
</head>
<body>
<div class="ctn-all">
    <div class="ctn-form">
        <img src="images/logo.png" alt="" class="logo">
        <h1 class="title">Iniciar Sesión</h1>

        <form action="index.php" method="POST">
            <label for="">Correo electrónico:</label>
            <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <?php if (!empty($errors['email'])): ?>
                <div class="text-danger small"><?= $errors['email'] ?></div>
            <?php endif; ?>

            <label for="">Contraseña</label>
            <div class="campo-password">
                <input type="password" id="password" name="password">
                <button type="button" class="toggle-password" onclick="mostrarOcultar()">
                    <i id="icono-ojo" class="fa-regular fa-eye" style="color:#1aa5db;"></i>
                </button>
            </div>
            <?php if (!empty($errors['password'])): ?>
                <div class="text-danger small"><?= $errors['password'] ?></div>
            <?php endif; ?>

            <?php if (!empty($errors['general'])): ?>
                <div class="text-danger small mt-2"><?= $errors['general'] ?></div>
            <?php endif; ?>

            <button type="submit" class="enviar">Iniciar sesión</button>
        </form>

        <a class="recovery" href="recovery.php">¿Olvidaste tu contraseña?</a>

        <span class="text-footer">¿Aún no tienes cuenta?
            <a class="link" href="register.php">Registrate</a>
        </span>
    </div>

    <div class="ctn-text">
        <div class="capa">
            <h2 class="title-description">Panel de Administración</h2>
            <p class="text-description">
                Este espacio está diseñado exclusivamente para el equipo de <strong>Los Angelitos de Violeta
                    Fundación Animal</strong>. Aquí podrás gestionar la información, mantener el sitio actualizado y seguir
                construyendo un puente de amor entre nuestros angelitos y las familias que les darán un hogar.<br>
            </p>
        </div>
    </div>
</div>

<!-- Contenedor de alertas flotantes solo para recuperación de contraseña -->
<div class="toast-container">
<?php
if (isset($_GET['message'])) {
    switch($_GET['message']){
        case 'ok':
            $color = 'primary';
            $text = 'Por favor revisa tu correo electrónico';
            break;
        case 'success_password':
            $color = 'success';
            $text = '¡Inicia sesión con tu nueva contraseña!';
            break;
        default:
            $color = 'danger';
            $text = 'Algo salió mal, inténtalo de nuevo más tarde';
            break;
    }
    echo <<<HTML
    <div class="toast show align-items-center text-bg-$color border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">$text</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
HTML;
}
?>
</div>

<?php
// Mostrar mensaje cuando la redirección viene por falta de permisos
if (isset($_GET['error']) && $_GET['error'] === 'sin_permiso') {
    $color = 'warning';
    $text = 'No tienes permisos para acceder a esa sección. Por favor inicia sesión como administrador.';
    echo <<<HTML
    <div class="toast show align-items-center text-bg-$color border-0" role="alert" aria-live="assertive" aria-atomic="true" style="top:80px;">
        <div class="d-flex">
            <div class="toast-body">$text</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
HTML;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
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

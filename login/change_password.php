<?php 
    include 'code-register.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Registro - LADV</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #c2e59c;
            background: -webkit-linear-gradient(to right, #c2e59c, #64b3f4);
            background: linear-gradient(to right, #c2e59c, #64b3f4);
        }

        .ctn-form {
            background: #ffffffdd; /* Fondo blanco semi-transparente */
            padding: 50px 40px;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            width: 420px;
            max-width: 90%;
            text-align: center;
        }

        .ctn-form .logo {
            width: 120px;
            margin: 0 auto 5px auto;
        }

        .ctn-form .title {
            font-size: 30px;
            color: #2a9df4; /* Azul intenso para contraste */
            margin-bottom: 30px;
        }

        .ctn-form label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .campo-password {
            position: relative;
            margin-bottom: 15px;
        }

        .campo-password input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border-radius: 12px;
            border: 1px solid #76c7d0;
            font-size: 15px;
            outline: none;
            transition: all 0.3s;
        }

        .campo-password input:focus {
            border-color: #2a9df4;
            box-shadow: 0 0 10px rgba(42,157,244,0.3);
        }

        .campo-password .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .msg-error {
            display: block;
            color: #e74c3c;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: left;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            background: linear-gradient(90deg, #2a9df4, #32d8c1); /* Azul y verde agua */
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.9s ease-in-out, transform 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
        }

        .text-footer {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #333;
        }

        .text-footer .link {
            color: #df620fff; /* Naranja para contraste */
            font-weight: bold;
            text-decoration: none;
        }

        .text-footer .link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="ctn-form">
        <img src="images/logo.png" alt="Logo Los Angelitos de Violeta" class="logo">
        <h1 class="title">Actualizar contraseña</h1>

        <!-- change_password page -->
        <form action="config/change_password.php" method="POST">
            <label for="new_password">Ingresa tu nueva contraseña:</label>
            <div class="campo-password">
                <input type="password" id="new_password" name="new_password">
                <button type="button" class="toggle-password" onclick="mostrarOcultar()">
                    <i id="icono-ojo" class="fa-regular fa-eye" style="color:#1aa5db;"></i>
                </button>
            </div>

            <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">

            <button type="submit" class="btn-submit">Establecer contraseña</button>
        </form>


        <span class="text-footer">
            ¿Ya tienes una cuenta? 
            <a class="link" href="index.php">Inicia sesión</a>
        </span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function mostrarOcultar() {
        const passInput = document.getElementById('new_password');
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

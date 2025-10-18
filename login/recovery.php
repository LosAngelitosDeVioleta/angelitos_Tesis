<?php 
    require_once "code-login.php";
    include 'code-register.php';
    
    // Obtener mensaje de error si existe
    $email_err = "";
    if (isset($_GET['message'])) {
        switch ($_GET['message']) {
            case 'empty_email':
                $email_err = "Debe ingresar un correo válido.";
                break;
            // Puedes agregar más casos si necesitas otros mensajes
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña - LADV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            font-size: 28px;
            color: #2a9df4; /* Azul intenso */
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        label {
            text-align: left;
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border-radius: 12px;
            border: 1px solid #76c7d0;
            font-size: 15px;
            outline: none;
            transition: all 0.3s;
            margin-bottom: 10px;
        }

        input[type="text"]:focus {
            border-color: #2a9df4;
            box-shadow: 0 0 10px rgba(42,157,244,0.3);
        }

        .msg-error {
            display: block;
            color: #e74c3c;
            font-size: 15px;
            margin-bottom: 10px;
            text-align: left;
            min-height: 10px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            margin-top: 5px;
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
            color: #1d8eff;
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
        <h1 class="title">Recupera tu contraseña</h1>

        <form action="config/recovery.php" method="POST">
            <label for="email">Ingresa tu correo electrónico:</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <span class="msg-error"><?php echo $email_err; ?></span>

            <button type="submit" class="btn-submit">Recuperar contraseña</button>
        </form>

        <span class="text-footer">
            ¿Recordaste tu contraseña? 
            <a class="link" href="index.php">Inicia sesión</a>
        </span>
    </div>
</body>

</html>
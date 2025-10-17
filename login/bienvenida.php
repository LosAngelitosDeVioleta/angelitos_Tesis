<?php 
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido 🎉</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #c2e59c;
            background: -webkit-linear-gradient(to right, #64b3f4, #c2e59c);
            background: linear-gradient(to right, #64b3f4, #c2e59c);
            color: #1a1a1a; 
        }

        .container {
            background: rgba(255, 255, 255, 0.85); 
            padding: 50px 60px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            animation: fadeIn 1s ease-out;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #064663;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #064663;
        }

        a.close-sesion {
            display: inline-block;
            width: 100%;
            height: 50px;
            margin-top: 5px;
            font-size: 20px;
            font-weight: 600;
            color: #1aa5db;
            border: 2px solid #1aa5db;
            border-radius: 10px;
            background-color: transparent;
            text-align: center;
            line-height: 46px; /* centra el texto verticalmente */
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        a.close-sesion:hover {
            font-size: 22px;
            background-color: #1aa5db;
            color: white;
            box-shadow: 0 5px 15px rgba(0, 128, 255, 0.4);
            transform: translateY(-3px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Bienvenido!</h1>
        <p>Tu login fue exitoso 🎉</p>
        <a href="close-session.php" class="close-sesion">Cerrar sesión</a>
    </div>
</body>
</html>

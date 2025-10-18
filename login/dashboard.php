<?php
session_start();
use Dba\Connection;
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: close-session.php");
    exit;
}
// ------------------- INCLUIR ARCHIVO DE CONEXIÓN -------------------
require_once "code-admi.php";



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-pink-600 text-white flex flex-col py-6 px-4">
            <div class="flex items-center mb-10">
                <span class="text-2xl font-bold tracking-wide">Accusoft</span>
            </div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li><a href="#" onclick="showSection('dashboard')" id="menu-dashboard"
                            class="flex items-center px-3 py-2 rounded bg-pink-700 font-semibold"><span
                                class="material-icons mr-2">dashboard</span>Dashboard</a></li>
                    <li><a href="#" onclick="showSection('mascotas')" id="menu-mascotas"
                            class="flex items-center px-3 py-2 rounded hover:bg-pink-500"><span
                                class="material-icons mr-2">pets</span>Mascotas</a></li>
                    <li><a href="#" onclick="showSection('novedades')" id="menu-novedades"
                            class="flex items-center px-3 py-2 rounded hover:bg-pink-500"><span
                                class="material-icons mr-2">feed</span>Novedades</a></li>
                    <li><a href="#" onclick="showSection('usuarios')" id="menu-usuarios"
                            class="flex items-center px-3 py-2 rounded hover:bg-pink-500"><span
                                class="material-icons mr-2">group</span>Usuarios</a></li>
                </ul>
            </nav>
            <a href="close-session.php"
                class="mt-10 flex items-center px-3 py-2 rounded bg-white text-pink-600 font-semibold hover:bg-pink-100 border border-pink-200"><span
                    class="material-icons mr-2">logout</span>Cerrar sesión</a>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-8">
            <!-- DASHBOARD SECTION -->
            <section id="section-dashboard">
                <header class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold">Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700 font-semibold">John Doe</span>
                        <span class="text-xs bg-pink-100 text-pink-700 px-2 py-1 rounded">Super admin</span>
                    </div>
                </header>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                        <span class="text-2xl font-bold text-pink-600">54</span>
                        <span class="text-gray-500">Mascotas</span>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                        <span class="text-2xl font-bold text-pink-600">12</span>
                        <span class="text-gray-500">Novedades</span>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                        <span class="text-2xl font-bold text-pink-600">5</span>
                        <span class="text-gray-500">Usuarios</span>
                    </div>
                    <div class="bg-pink-600 rounded-lg shadow p-6 flex flex-col items-center text-white">
                        <span class="text-2xl font-bold">$6k</span>
                        <span>Donaciones</span>
                    </div>
                </div>
            </section>

            <!-- MASCOTAS SECTION -->
            <section id="section-mascotas" class="hidden">
                <h2 class="text-2xl font-bold mb-4">Gestión de Mascotas</h2>
                <button class="mb-4 px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Agregar Mascota</button>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Listado de Mascotas</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Nombre</th>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Sexo</th>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Edad</th>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Tamaño</th>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Descripción</th>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Necesidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($query)): ?>
                                    <tr class="border-b">
                                        <td><?= $row["nombre_mascota"] ?></td>
                                        <td><?= $row["Sexo"] ?></td>
                                        <td><?= $row["Edad"] ?></td>
                                        <td><?= $row["Tamaño"] ?></td>
                                        <td><?= $row["Descripción"] ?></td>
                                        <td><?= $row["Necesidad"] ?></td>
                                        <td><img src="mostrar_foto.php?id=<?= $row['id'] ?>" alt=""></td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- NOVEDADES SECTION -->
            <section id="section-novedades" class="hidden">
                <h2 class="text-2xl font-bold mb-4">Gestión de Novedades</h2>
                <button class="mb-4 px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Agregar Novedad</button>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-2">Listado de Novedades</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Título</th>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Fecha</th>
                                    <th class="py-2 px-4 font-semibold text-gray-600">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-2 px-4">Nueva campaña de adopción</td>
                                    <td class="py-2 px-4">2025-10-17</td>
                                    <td class="py-2 px-4"><span
                                            class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs">Publicado</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- USUARIOS SECTION -->
            <section id="section-usuarios" class="hidden">
                <h2 class="text-2xl font-bold mb-4">Gestión de Usuarios</h2>
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <div class="flex-1">
                        <button id="btnMostrarFormUsuario" class="mb-4 px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Agregar Usuario</button>
                        <!-- Tabla de usuarios -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold mb-2">Listado de Usuarios</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-left text-sm">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 font-semibold text-gray-600">Usuario</th>
                                            <th class="py-2 px-4 font-semibold text-gray-600">Email</th>
                                            <th class="py-2 px-4 font-semibold text-gray-600">Clave</th>
                                            <th class="py-2 px-4 font-semibold text-gray-600">Rol</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($query_usuarios) && mysqli_num_rows($query_usuarios) > 0): ?>
                                            <?php while ($row = mysqli_fetch_array($query_usuarios)): ?>
                                                <tr class="border-b">
                                                    <td><?= htmlspecialchars($row["usuario"]) ?></td>
                                                    <td><?= htmlspecialchars($row["email"]) ?></td>
                                                    <td>******</td>
                                                    <td><?= htmlspecialchars($row["rol"]) ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="py-4 px-4 text-center text-gray-500">No hay usuarios registrados.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario oculto (aparece al costado con JS) -->
                    <div id="formUsuarioContainer" class="hidden w-full max-w-md">
                        <form id="formUsuario" method="post" class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold mb-4">Agregar Nuevo Usuario Administrador</h3>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Usuario</label>
                                <input type="text" name="usuario" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Clave</label>
                                <input type="password" name="clave" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <input type="hidden" name="rol" value="1">
                            <div class="flex justify-end space-x-3">
                                <button type="button" id="btnCancelarFormUsuario" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Cancelar</button>
                                <button type="submit" name="guardar_usuario" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btnMostrarFormUsuario = document.getElementById('btnMostrarFormUsuario');
            var formUsuarioContainer = document.getElementById('formUsuarioContainer');
            var btnCancelarFormUsuario = document.getElementById('btnCancelarFormUsuario');

            if (btnMostrarFormUsuario) {
                btnMostrarFormUsuario.addEventListener('click', function() {
                    formUsuarioContainer.classList.remove('hidden');
                });
            }

            if (btnCancelarFormUsuario) {
                btnCancelarFormUsuario.addEventListener('click', function() {
                    formUsuarioContainer.classList.add('hidden');
                });
            }
        });

        function showSection(section) {
            // Oculta todas las secciones
            document.getElementById('section-dashboard').classList.add('hidden');
            document.getElementById('section-mascotas').classList.add('hidden');
            document.getElementById('section-novedades').classList.add('hidden');
            document.getElementById('section-usuarios').classList.add('hidden');

            // Quita el fondo activo del menú
            document.getElementById('menu-dashboard').classList.remove('bg-pink-700', 'font-semibold');
            document.getElementById('menu-mascotas').classList.remove('bg-pink-700', 'font-semibold');
            document.getElementById('menu-novedades').classList.remove('bg-pink-700', 'font-semibold');
            document.getElementById('menu-usuarios').classList.remove('bg-pink-700', 'font-semibold');

            // Muestra la sección seleccionada
            document.getElementById('section-' + section).classList.remove('hidden');
            // Marca el menú activo
            document.getElementById('menu-' + section).classList.add('bg-pink-700', 'font-semibold');
        }
    </script>
</body>

</html>
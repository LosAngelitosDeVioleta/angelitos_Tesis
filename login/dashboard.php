
<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: close-session.php");
    exit;
}
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
                <li><a href="#" onclick="showSection('dashboard')" id="menu-dashboard" class="flex items-center px-3 py-2 rounded bg-pink-700 font-semibold"><span class="material-icons mr-2">dashboard</span>Dashboard</a></li>
                <li><a href="#" onclick="showSection('mascotas')" id="menu-mascotas" class="flex items-center px-3 py-2 rounded hover:bg-pink-500"><span class="material-icons mr-2">pets</span>Mascotas</a></li>
                <li><a href="#" onclick="showSection('novedades')" id="menu-novedades" class="flex items-center px-3 py-2 rounded hover:bg-pink-500"><span class="material-icons mr-2">feed</span>Novedades</a></li>
                <li><a href="#" onclick="showSection('usuarios')" id="menu-usuarios" class="flex items-center px-3 py-2 rounded hover:bg-pink-500"><span class="material-icons mr-2">group</span>Usuarios</a></li>
            </ul>
        </nav>
        <a href="close-session.php" class="mt-10 flex items-center px-3 py-2 rounded bg-white text-pink-600 font-semibold hover:bg-pink-100 border border-pink-200"><span class="material-icons mr-2">logout</span>Cerrar sesión</a>
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
                                <th class="py-2 px-4 font-semibold text-gray-600">Especie</th>
                                <th class="py-2 px-4 font-semibold text-gray-600">Raza</th>
                                <th class="py-2 px-4 font-semibold text-gray-600">Edad</th>
                                <th class="py-2 px-4 font-semibold text-gray-600">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-2 px-4">Luna</td>
                                <td class="py-2 px-4">Perro</td>
                                <td class="py-2 px-4">Labrador</td>
                                <td class="py-2 px-4">3</td>
                                <td class="py-2 px-4"><span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">Adoptada</span></td>
                            </tr>
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
                                <td class="py-2 px-4"><span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs">Publicado</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- USUARIOS SECTION -->
        <section id="section-usuarios" class="hidden">
            <h2 class="text-2xl font-bold mb-4">Gestión de Usuarios</h2>
            <button class="mb-4 px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Agregar Usuario</button>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-2">Listado de Usuarios</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 font-semibold text-gray-600">Nombre</th>
                                <th class="py-2 px-4 font-semibold text-gray-600">Email</th>
                                <th class="py-2 px-4 font-semibold text-gray-600">Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-2 px-4">Admin Ejemplo</td>
                                <td class="py-2 px-4">admin@ejemplo.com</td>
                                <td class="py-2 px-4">Administrador</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</div>
<!-- Material Icons CDN -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script>
function showSection(section) {
    // Oculta todas las secciones
    document.getElementById('section-dashboard').classList.add('hidden');
    document.getElementById('section-mascotas').classList.add('hidden');
    document.getElementById('section-novedades').classList.add('hidden');
    document.getElementById('section-usuarios').classList.add('hidden');

    // Quita el fondo activo del menú
    document.getElementById('menu-dashboard').classList.remove('bg-pink-700','font-semibold');
    document.getElementById('menu-mascotas').classList.remove('bg-pink-700','font-semibold');
    document.getElementById('menu-novedades').classList.remove('bg-pink-700','font-semibold');
    document.getElementById('menu-usuarios').classList.remove('bg-pink-700','font-semibold');

    // Muestra la sección seleccionada
    document.getElementById('section-' + section).classList.remove('hidden');
    // Marca el menú activo
    document.getElementById('menu-' + section).classList.add('bg-pink-700','font-semibold');
}
</script>
</body>
</html>
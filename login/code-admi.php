<?php
// ------------------- INCLUIR ARCHIVO DE CONEXIÓN -------------------
require_once "conexion.php";

// ---------------PARA MOSTRAR LAS MASCOTAS----------------
$sql="SELECT * FROM mascotas";
$query=mysqli_query($link,$sql);

// -----------------PARA MOSTRAR LOS USUARIOS ADMINISTRADORES--------------------
$query_usuarios = mysqli_query($link, "SELECT * FROM usuarios");

?>
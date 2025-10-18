<?php
require_once "conexion.php";


$id = $_GET['id'];
$sql = "SELECT Foto FROM mascotas WHERE id = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($foto);
$stmt->fetch();

echo $foto;
?>

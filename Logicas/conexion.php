<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "proyecto_nativa";

$conexion = mysqli_connect($host, $user, $password, $db);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>
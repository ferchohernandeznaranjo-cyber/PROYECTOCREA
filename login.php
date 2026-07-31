<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $clave   = $_POST['clave'];

    $consulta = "SELECT * FROM usuarios WHERE nombre = '$usuario' AND clave = '$clave'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        header("Location: datosdelcliente.php");
        exit();
    } else {
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location.href = 'login.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicar Sesion-Nativa</title>
</head>
<body>
    <h2>Iniciar sesion</h2>
    <form action="datosdelcliente.php" method="Post" >
        <label for="usuario">Usuario</label><br>
        <input type="text" id="usuario" name="usuario" placeholder="Nombre" ><br><br>

        <label for="clave">Contraseña:</label><br>
        <input type="password" id="clave" name="clave" placeholder="Contraseña" required><br><br>

        <button type="submit" name="Iniciar">Iniciar sesion</button>
 
</body>
</html>
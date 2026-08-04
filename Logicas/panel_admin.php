<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
include("conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: procesar_login.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $puntos_sumar = (int)$_POST['puntos'];

    $checkClient = "SELECT * FROM usuarios WHERE nombre = '$cliente' AND rol = 'cliente'";
    $resCheck = mysqli_query($conexion, $checkClient);

    if (mysqli_num_rows($resCheck) > 0) {
        $updateQuery = "UPDATE usuarios SET puntos = puntos + $puntos_sumar WHERE nombre = '$cliente'";
        if (mysqli_query($conexion, $updateQuery)) {
            $mensaje = "<div style='background: rgba(130, 201, 155, 0.2); border: 1px solid #82c99b; color: #82c99b; padding: 10px; border-radius: 6px; font-size: 0.85rem; margin-bottom: 1.2rem;'>¡Se sumaron $puntos_sumar puntos a $cliente correctamente!</div>";
        } else {
            $mensaje = "<div class='alert-error'>Error al actualizar los puntos.</div>";
        }
    } else {
        $mensaje = "<div class='alert-error'>El cliente '$cliente' no existe.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nativa · Panel Administrador</title>
  <link rel="stylesheet" href="../Pag-principal-NATIVA/styles.css">
</head>
<body class="login-body">

  <main class="login-container">
    <div class="login-card">
      <h2>Panel Administrador</h2>
      <p class="subtitle">Acreditar botellas devueltas</p>

      <?php echo $mensaje; ?>

      <form action="panel_admin.php" method="POST" class="form-nativa">
        <div class="input-group">
          <label for="cliente">Nombre exacto del cliente</label>
          <input type="text" id="cliente" name="cliente" placeholder="Ej. cliente1" required>
        </div>

        <div class="input-group">
          <label for="puntos">Cantidad de puntos a sumar</label>
          <input type="number" id="puntos" name="puntos" placeholder="Ej. 10" min="1" required>
        </div>

        <button type="submit" class="btn-primary">Cargar Puntos</button>
      </form>

      <div class="card-footer" style="margin-top: 20px;">
        <a href="logout.php" style="background: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">Cerrar Sesión</a>
      </div>
    </div>
  </main>

</body>
</html>
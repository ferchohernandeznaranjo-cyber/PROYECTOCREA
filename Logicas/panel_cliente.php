<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
include("conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: procesar_login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$query = "SELECT puntos FROM usuarios WHERE nombre = '$usuario'";
$resultado = mysqli_query($conexion, $query);
$datos = mysqli_fetch_assoc($resultado);
$puntos = $datos['puntos'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nativa · Mi Cuenta</title>
  <link rel="stylesheet" href="../Pag-principal-NATIVA/styles.css">
</head>
<body class="login-body">

  <main class="login-container">
    <div class="login-card">
      <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?></h2>
      <p class="subtitle">Puntos acumulados por Plan Retorna</p>

      <div style="background: #82c99b; color: #0f382c; font-size: 2.5rem; font-weight: bold; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <?php echo $puntos; ?> pts
      </div>

      <p style="font-size: 0.85rem; color: #a3b8b0;">Devuelve tus botellas de Nativa y canjea tus puntos por descuentos.</p>

      <div class="card-footer" style="margin-top: 20px;">
        <a href="logout.php" style="background: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">Cerrar Sesión</a>
      </div>
    </div>
  </main>

</body>
</html>
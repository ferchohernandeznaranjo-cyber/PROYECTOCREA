<?php
session_start();
include("conexion.php");

$error_login = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

    $consulta = "SELECT * FROM usuarios WHERE nombre = '$usuario' AND clave = '$clave'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $datos = mysqli_fetch_assoc($resultado);
        
        $_SESSION['usuario'] = $datos['nombre'];
        $_SESSION['rol'] = $datos['rol'];
        $_SESSION['user_id'] = $datos['id'];

        if ($datos['rol'] == 'admin') {
            header("Location: panel_admin.php");
        } else {
            header("Location: panel_cliente.php");
        }
        exit();
    } else {
        $error_login = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nativa · Iniciar Sesión</title>
  <link rel="stylesheet" href="../Pag-principal-NATIVA/styles.css">
</head>
<body class="login-body">

  <main class="login-container">
    <div class="login-card">
      <h2>Iniciar Sesión</h2>
      <p class="subtitle">Ingresa a tu cuenta de Plan Retorna</p>

      <?php if (!empty($error_login)): ?>
        <div class="alert-error">
          <?php echo $error_login; ?>
        </div>
      <?php endif; ?>

      <form action="procesar_login.php" method="POST" class="form-nativa">
        <div class="input-group">
          <label for="usuario">Usuario</label>
          <input type="text" id="usuario" name="usuario" placeholder="Ej. cliente1" required>
        </div>

        <div class="input-group">
          <label for="clave">Contraseña</label>
          <input type="password" id="clave" name="clave" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-primary">Ingresar</button>
      </form>

      <div class="card-footer">
        <a href="procesar_registro.php">¿No tienes cuenta? Regístrate aquí</a>
        <br><br>
        <a href="../index.html" class="link-back">← Volver al inicio</a>
      </div>
    </div>
  </main>

</body>
</html>
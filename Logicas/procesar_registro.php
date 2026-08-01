<?php
session_start();
include("conexion.php");

$mensaje = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

    $check_user = "SELECT * FROM usuarios WHERE nombre = '$usuario'";
    $res_check = mysqli_query($conexion, $check_user);

    if (mysqli_num_rows($res_check) > 0) {
        $error = "El nombre de usuario ya está registrado.";
    } else {
        $insert_query = "INSERT INTO usuarios (nombre, clave, rol, puntos) VALUES ('$usuario', '$clave', 'cliente', 0)";
        
        if (mysqli_query($conexion, $insert_query)) {
            $mensaje = "¡Cuenta creada exitosamente! Ya puedes iniciar sesión.";
        } else {
            $error = "Error al registrar el usuario. Inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nativa · Crear Cuenta</title>
  <link rel="stylesheet" href="../Pag-principal-NATIVA/styles.css">
</head>
<body class="login-body">

  <main class="login-container">
    <div class="login-card">
      <h2>Crear Cuenta</h2>
      <p class="subtitle">Únete al Plan Retorna y acumula puntos</p>

      <?php if (!empty($mensaje)): ?>
        <div class="alert-success" style="background: rgba(130, 201, 155, 0.2); border: 1px solid #82c99b; color: #82c99b; padding: 10px; border-radius: 6px; font-size: 0.85rem; margin-bottom: 1.2rem;">
          <?php echo $mensaje; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($error)): ?>
        <div class="alert-error">
          <?php echo $error; ?>
        </div>
      <?php endif; ?>

      <form action="procesar_registro.php" method="POST" class="form-nativa">
        <div class="input-group">
          <label for="usuario">Nuevo Usuario</label>
          <input type="text" id="usuario" name="usuario" placeholder="Crea tu usuario" required>
        </div>

        <div class="input-group">
          <label for="clave">Contraseña</label>
          <input type="password" id="clave" name="clave" placeholder="Crea tu contraseña" required>
        </div>

        <button type="submit" class="btn-primary">Registrarse</button>
      </form>

      <div class="card-footer">
        <a href="procesar_login.php">¿Ya tienes cuenta? Inicia sesión aquí</a>
        <br><br>
        <a href="../Pag-principal-NATIVA/index.html" class="link-back">← Volver al inicio</a>
      </div>
    </div>
  </main>

</body>
</html>
<?php session_start(); 
  if (!isset($_SESSION['usuario'])) {
    header("location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
  <h1 class="px-5 pt-5">Bienvenido</h1>
  <p class="px-5">¿Que tal tu día? <span style="color: violet; font-weight: 600; font-size: x-large;"><?php echo $_SESSION['usuario']; ?></span></p>
  <a href="servidor/login/logout.php" class="px-5">Cerrar sesión</a>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
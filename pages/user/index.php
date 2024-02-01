<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../../index.php");
    exit();
}

include '../../clases/auth.php';

$auth = new auth();
$rol = $auth->obtenerRol($_SESSION['usuario']);

if ($rol != 1) {
    header("location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido <?php echo $_SESSION['usuario']?></title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
<nav class="navbar bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="https://cdn-icons-png.flaticon.com/512/6029/6029009.png" alt="Bootstrap" width="35" height="35">
    </a>
  </div>
</nav>
  <h1 class="px-5 pt-5">Bienvenido usuario</h1>
  <p class="px-5">¿Que tal tu día? <span style="color: violet; font-weight: 600; font-size: x-large;">
  <?php echo $_SESSION['usuario'] ?>
  </span></p>
  <a href="../../servidor/login/logout.php" class="px-5">Cerrar sesión</a>
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
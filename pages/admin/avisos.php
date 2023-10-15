<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("location:../../index.php");
  exit();
}

include '../../clases/auth.php';

$auth = new auth();
$rol = $auth->obtenerRol($_SESSION['usuario']);

if ($rol != 2) {
  header("location: ../../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/4919/4919646.png">
  <link rel="stylesheet" href="css/index.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

  <div class="sidebar close">

    <!-- Logo -->
    <div class="logo-details">
      <i class='bx bx-building-house'></i>
      <span class="logo_name">House +</span>
    </div>

    <ul class="nav-links">

      <!-- Incio -->
      <li>

        <a href="index.php">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Inicio</span>
        </a>

        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Inicio 🏠</a></li>
        </ul>
      </li>


      <!-- Pagos -->
      <li>
        <a href="pagos.php">
          <i class='bx bx-wallet'></i>
          <span class="link_name">Pagos</span>
        </a>

        <ul class="sub-menu blank">
          <li><a class="link_name" href="pagos.php">Pagos 💵</a></li>
        </ul>
      </li>

      <!-- Residentes -->
      <li>
        <a href="residentes.php">
          <i class='bx bx-user'></i>
          <span class="link_name">Residentes</span>
        </a>

        <ul class="sub-menu blank">
          <li><a class="link_name" href="residentes.php">Residentes 👨🏻‍👩🏻‍👧🏼</a></li>
        </ul>
      </li>

      <!-- Avisos -->
      <li style="background-color: #107FA3;">
        <a href="avisos.php">
        <i class='bx bx-bell' ></i>
          <span class="link_name">Avisos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="avisos.php">Avisos 🚨</a></li>
        </ul>
      </li>

    <!-- Usuario Admin -->
     <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="https://cdn-icons-png.flaticon.com/512/2206/2206368.png" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name fs-6">Administrador</div>
            <div class="job text-capitalize"><?php echo $_SESSION['usuario'] ?></div>
          </div>
          <a href="../../servidor/login/logout.php"><i class='bx bx-log-out'></i></a>
        </div>
        </li>


    </ul>
  </div>


  <!-- Sección dentro del Dashboard -->
  <section class="home-section">
    
    <!-- Titulo de sección -->
    <div class="home-content mx-2">
        <i class='bx bx-menu'></i>
        <span class="fw-bold fs-4">
            <span id="saludo" style="color: #107FA3;" class="text-capitalize fs-3">Avisos 🚨</span> 
        </span>
    </div>

    

  </section>


<script>
let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});
</script>

  <script src="../../assets/js/bootstrap.bundle.min.js"></script>

  <script src="script.js"></script>

</body>

</html>
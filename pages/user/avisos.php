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

        <a href="inicio.php">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Inicio</span>
        </a>

        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Inicio 🏠</a></li>
        </ul>
      </li>

      <!-- Avisos -->
      <li style="background-color: #107FA3;">
        <a href="avisos.php">
          <i class='bx bx-bell'></i>
          <span class="link_name">Avisos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="avisos.php">Avisos 🚨</a></li>
        </ul>
      </li>

      <!-- Usuario User -->
      <li>
        <div class="profile-details">
          <div class="name-job">
            <div class="profile_name fs-6">Residente</div>
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

    


    <?php
    // Verifica si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      include '../conexion.php'; // Incluye tu archivo de conexión

      // Obtén los datos del formulario
      $nombreAviso = $_POST['nombre_aviso'];
      $descripcion = $_POST['descripcion'];
      $importancia = $_POST['aviso'];
      $fecha = date('Y-m-d');

      // Inserta los datos en la base de datos
      $sql = "INSERT INTO t_avisos (nombre_aviso, descripcion, fecha, importancia) 
            VALUES ('$nombreAviso', '$descripcion', '$fecha', '$importancia')";

      if ($conn->query($sql) === TRUE) {
        $conn->close(); // Cierra la conexión
        echo "El aviso fue generado correctamente";
        print "<script>window.setTimeout(function() { window.location = '/sistemas-de-informacion/pages/admin/avisos.php' }, 1000);</script>";
      } else {
        echo "Error al registrar el aviso: " . $conn->error;
      }
    }
    ?>

    <div class="container mt-5">
      <h1 class="mb-4">Lista de Avisos</h1>
      <div class="container mt-5">
      <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha</th>
            <th scope="col">Importancia</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../conexion.php';

        $sql = "SELECT * FROM t_avisos";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $i = 1;
            while ($fila = $resultado->fetch_assoc()) {
                $idAviso = $fila['id_aviso'];
                $nombreAviso = $fila['nombre_aviso'];
                $descripcion = $fila['descripcion'];
                $fecha = $fila['fecha'];
                $importancia = $fila['importancia'];

                $importanciaClasses = [
                    'Alta' => 'bg-danger',
                    'Media' => 'bg-warning',
                    'Baja' => 'bg-success',
                    'Resuelto' => 'bg-primary',
                    'Desconocida' => 'bg-secondary',
                ];

                $importanciaClass = $importanciaClasses[$importancia] ?? $importanciaClasses['Desconocida'];
                ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $nombreAviso ?></td>
                    <td><?= $descripcion ?></td>
                    <td><?= $fecha ?></td>
                    <td><span class="badge <?= $importanciaClass ?>"><?= $importancia ?></span></td>
                </tr>
                <?php
                $i++;
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron avisos.</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>

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
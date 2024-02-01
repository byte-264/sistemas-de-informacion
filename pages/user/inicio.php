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

include '../conexion.php';

$usuario = $_SESSION['usuario'];
$id_usuario = $auth->obtenerIdUsuario($usuario);

$sql = "SELECT id_gasto FROM t_pagos WHERE id_usuario = $id_usuario";
$resultado = $conn->query($sql);

$pagos = [];

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $pagos[] = $fila['id_gasto'];
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido <?php echo $_SESSION['usuario'] ?></title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/4919/4919646.png">
  <link rel="stylesheet" href="css/index.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<style>
    .card:hover {
        border-radius: 4px;
        background-color: #CEEEF9; 
        transition: 0.3s;
        cursor: pointer;
    }

    .card .card-body a.btn-primary:hover {
        background-color: #007bff;
    }
  </style>

  <div class="sidebar close">

    <!-- Logo -->
    <div class="logo-details">
      <i class='bx bx-building-house'></i>
      <span class="logo_name">House +</span>
    </div>

    <ul class="nav-links">

      <!-- Incio -->
      <li style="background-color: #107FA3;">

        <a href="#">
        <i class='bx bx-money'></i>
          <span class="link_name">Inicio</span>
        </a>

        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Inicio 🏠</a></li>
        </ul>
      </li>

      <!-- Avisos -->
      <li>
        <a href="avisos.php">
        <i class='bx bx-bell' ></i>
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
    
  <div class="home-content mx-2">
    <i class='bx bx-menu'></i>
    <span class="fw-bold fs-4">
        <span id="saludo" style="color: #107FA3;" class="text-capitalize"></span> 
    </span>
    <br>
    <br>
      <span id="textoPagos">(Pagos 💸)</span>
  </div>


    <!-- CARDS   -->
<!-- CARDS   -->
<!-- CARDS   -->
<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
        include '../conexion.php'; // Incluye tu archivo de conexión

        $sql = "SELECT * FROM t_gastos";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                ?>

                  <div class="col" id="card_<?php echo $fila['Id_gasto']; ?>" data-nombre="<?php echo $fila['nombre_gasto']; ?>" data-descripcion="<?php echo $fila['descripcion']; ?>" data-fecha="<?php echo $fila['fecha']; ?>" data-monto="<?php echo $fila['monto']; ?>">
                    <div class="card shadow">
                        <div class="card-body" data-bs-toggle="modal" data-bs-target="#modal_<?php echo $fila['Id_gasto']; ?>">

                            <h5 class="card-title"><?php echo $fila['nombre_gasto']; ?></h5>
                            <p class="card-text"><?php echo $fila['descripcion']; ?></p>
                            <p class="card-text">Fecha: <?php echo $fila['fecha']; ?></p>
                            <p class="card-text">Monto: <?php echo $fila['monto']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal_<?php echo $fila['Id_gasto']; ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modalLabel_<?php echo $fila['Id_gasto']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel_<?php echo $fila['Id_gasto']; ?>">Formulario de
                                    Pago</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí va tu formulario de pago -->
                                <form id="formularioPago_<?php echo $fila['Id_gasto']; ?>" action="procesar_pago.php" method="post">
                                    <input type="hidden" name="id_gasto" value="<?php echo $fila['Id_gasto']; ?>">
                                    <div class="mb-3">
                                        <label for="monto">Monto a pagar:</label>
                                        <input type="text" class="form-control" id="monto" name="monto">
                                    </div>
                                    <div class="mb-3">
                                        <label for="concepto">Concepto:</label>
                                        <input type="text" class="form-control" id="concepto" name="concepto">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Realizar Pago</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "No se encontraron gastos.";
        }

        $conn->close(); // Cierra la conexión
        ?>
    </div>
</div>

<script>
    // Esta función rellena el formulario con los datos de la tarjeta
    function llenarFormulario(idGasto) {
        var tarjeta = document.querySelector('#card_' + idGasto);
        if (tarjeta) {
            var nombre = tarjeta.dataset.nombre;
            var descripcion = tarjeta.dataset.descripcion;
            var fecha = tarjeta.dataset.fecha;
            var monto = tarjeta.dataset.monto;

            // Rellenar el formulario con los datos de la tarjeta
            var formulario = document.querySelector('#formularioPago_' + idGasto);
            formulario.querySelector('#monto').value = monto;
            formulario.querySelector('#concepto').value = nombre + ': ' + descripcion;
        } else {
            console.error("Card not found");
        }
    }

    // Código para manejar el evento de apertura del modal
    document.addEventListener('DOMContentLoaded', function() {
        var modales = document.querySelectorAll('.modal');

        modales.forEach(function(modal) {
            modal.addEventListener('show.bs.modal', function(event) {
                var idGasto = event.relatedTarget.dataset.bsTarget.split('_')[1];
                llenarFormulario(idGasto);
            });
        });

    });
</script>

<script src="eliminar_tarjeta.js"></script>
<script>
    // Luego de que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        <?php
        foreach ($pagos as $idGasto) {
            echo "eliminarTarjeta($idGasto);";
        }
        ?>
    });
</script>


</section>

<script>
   // Obtener la hora actual

const textoPagos = document.getElementById('textoPagos');

let hora = new Date().getHours();
let saludo = "";

let xhr = new XMLHttpRequest();
xhr.open('GET', 'nombre.php', true);

xhr.onload = function() {
  if (xhr.status === 200) {
    let usuario = xhr.responseText;

    if (hora >= 6 && hora < 12) {
        saludo = "Buenos días " + usuario + " 🌅";
    } else if (hora >= 12 && hora < 18) {
      saludo = "Buenas tardes " + usuario +" 🌇";
    } else {
        saludo = "Buenas noches " + usuario +" 🌔";
    }

    // Actualizar el texto del saludo en el elemento con ID "saludo"
    document.getElementById("saludo").textContent = saludo;

    document.getElementById("saludo").parentElement.appendChild(textoPagos);
  }
};

xhr.send();


// * ---------------------------------------------------- *


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
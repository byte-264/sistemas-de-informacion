<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2484/2484004.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <style>
    body {
      background: rgb(92,209,173);
      background: linear-gradient(90deg, rgba(92,209,173,1) 55%, rgba(39,199,146,1) 98%);
    }
  </style>

  <div class="d-flex justify-content-center"">

  </div>

  <div class="container w-75 mt-5 rounded shadow login custom-container" style="background-color: #fff;">
    <div class="row alig-items-stretch">
      
      <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 d-flex align-items-center justify-content-center p-0">
        <img id="imagenAleatoria" src="" alt="Imagen Aleatoria" class="rounded-start img-fluid">
      </div>

      <!-- <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6"></div> -->

      <div class="col p-5 rounded-end">
        <div class="text-start fw-bold">🏘️ House+</div>
        <h1 class="fw-bold text-start pt-5 pb-5">Regístrate ✍🏻</h1>

        <!-- Register -->
        <form action="servidor/registro/registrar.php" method="post" class="needs-validation" novalidate>

          <div class="mb-4">
            <label for="usuario" class="form-label fw-bold" id="usuario">Usuario</label>
            <input type="text" class="form-control" name="usuario" placeholder="Ingresa un usuario" id="usuario" require>
          </div>

          <div class="mb-4">
            <label for="password" class="form-label fw-bold" id="password">Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ingresa una contraseña" id="password">
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary btb-subir">Registrarse</button>
          </div>

          <div class="my-3">
            <span>¿Ya tienes cuenta? <a href="index.php" class="text-decoration-none">Inicia sesión</a></span>
          </div>

        </form>
      </div>

    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const imagenes = [
        'img/login-1.webp',
        'img/login-2.jpg',
        'img/login-3.jpg',
        'img/login-4.jpg'
        // Agrega más URLs de imágenes según sea necesario
    ];

    const imagenAleatoria = document.getElementById('imagenAleatoria');
    const imagenSeleccionada = imagenes[Math.floor(Math.random() * imagenes.length)];
    imagenAleatoria.src = imagenSeleccionada;
    });
  </script>
  <script>
    (() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
  </script>
</body>

</html>
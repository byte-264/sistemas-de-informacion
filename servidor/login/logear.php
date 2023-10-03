<?php session_start();

 include "../../clases/auth.php";
 $usuario = $_POST['usuario'];
 $password = $_POST['password'];

 $auth = new auth();
  if ($auth->logear($usuario, $password)){
    header("location:../../inicio.php");
  }
  else{
    echo "No se pudo logear";
    // header("location:../../index.php"); poner una pantalla de error
  }
?>
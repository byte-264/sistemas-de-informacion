<?php
include '../../clases/auth.php';

$usuario=$_POST['usuario'];
$password=password_hash($_POST['password'], PASSWORD_DEFAULT);

$auth=new auth();

if($auth->registrar($usuario, $password)){
    header("location:../../index.php");
}
else{
    echo "No se pudo registrar";
}
?>

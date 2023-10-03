<?php
include 'conexion.php';

class auth extends conexion{
    public function registrar($usario, $password){
        $conexion=parent::conectar();
        $sql='INSERT INTO t_usuarios (usuario, password) VALUES (?,?)';
        $query=$conexion->prepare($sql);
        $query->bind_param('ss',$usario,$password);
        return $query->execute();
    }

    public function logear($usario, $password){
        $conexion = parent::conectar();
        $passwordExistente="";
        $sql="SELECT * FROM t_usuarios
        WHERE usuario = '$usario'";
        $respuesta = mysqli_query($conexion, $sql);
        $passwordExistente = mysqli_fetch_array($respuesta)['password'];

        if (password_verify($password, $passwordExistente)){
            $_SESSION['usuario']=$usario;
            return true;
        }
        else{
            return false;
        }
    }
}
?>
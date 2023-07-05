<?php
require_once 'includes/conexion.php';


if(isset($_POST)){
    //borrar error antiguo
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }
    //recoger datos del formulario
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
//comprobar contraseña /cifrar
   
    $query = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $login = mysqli_query($db, $query);

    if( $login && mysqli_num_rows($login) == 1 ){
        
        $usuario = mysqli_fetch_assoc($login);
        $verify = password_verify($pass, $usuario['password']);

        if($verify){
            $_SESSION['usuario'] = $usuario;

        }else{

            $_SESSION['error_login'] = "login incorrecto";
        
        }

    } else{
        // error msg
        $_SESSION['error_login'] = "login incorrecto";
    }
}

header("Location: index.php");
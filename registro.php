<?php
if (isset($_POST)){
    
    require_once 'includes/conexion.php';
    if(!isset($_SESSION)){
        session_start();
    }
    $nombre   = isset( $_POST['nombre'] )   ? mysqli_real_escape_string( $db, $_POST['nombre']): false ;
    $apellido = isset( $_POST['apellido'] ) ? mysqli_real_escape_string( $db, $_POST['apellido']) : false;
    $email    = isset( $_POST['email'] )    ? mysqli_real_escape_string( $db, $_POST['email']): false ;
    $pass     = isset( $_POST['password'] ) ? mysqli_real_escape_string( $db, $_POST['password']): false ;
    
    //*Array de errores
    $report = array();
    
    //*validacion de datos
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_validate=true;
    }else{
        $nombre_validate=false;
        $report['nombre'] = "Error en el nombre $nombre";
    }
    //validacion de apellidos
    if (!empty($apellido) && !is_numeric($apellido) && !preg_match('/[0-9]/',$apellido)){
        $apellido_validate=true;
    }else{
        $apellido_validate=false;
        $report['apellido'] = "Error en el apellido";
    }
    //validacion de email
    if (!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_validate=true;
    }else{
        $email_validate=false;
        $report['email'] = "Error en el email";

    }
    //validar contraseña
    if (!empty($pass)){
        $pass_validate=true;
    }else{
        $pass_validate=false;
        $report['pass'] = "Error en la contraseña";

    }

    $guardar_usuario=false;

    if (empty($report)){
        $guardar_usuario=true;
        //cifrar contraseña
        $encripted_pass = password_hash($pass, PASSWORD_BCRYPT,['cost'=> 10]);
        $sql = "insert into usuarios Values(null, '$nombre','$apellido','$email','$encripted_pass',CURDATE());";
        $save = mysqli_query($db,$sql);
        
        if($save){
            $_SESSION['completado'] = "el registro se ha completado con exito";
        
        }else{
            $_SESSION['report']['general'] = "Fallo al guardar al usuario";
        }
        
    }else{
        $_SESSION['report'] = $report;
        header('Location: index.php');
    }
}
header('Location: index.php');

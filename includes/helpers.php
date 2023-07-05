<?php

function Showerror($error,$field){
    $alert='';
    if( isset($error[$field]) && !empty($field) ){
        $alert = "<div class= 'alerta alerta-error'>".$error[$field]."</div>";
    }
    return $alert;

}


function borrarerrores(){

    if(isset($_SESSION['report'])){
        unset($_SESSION['report']);
    }

    if(isset($_SESSION['completado'])){
        unset($_SESSION['completado']);
    }
    
}
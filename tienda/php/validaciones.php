<?
require './bbdd.php';
function vacio($nombre){
    if(empty($_REQUEST[$nombre])){
        return true;
    }
    return false;
}
function enviado(){
    if(isset($_REQUEST['enviar'])){
        return true;
    }
    return false;
}
function pass($pass){
    $patron='/[A-Z][a-z][0-9]{8,}/';
    if($preg_match($patron, $_REQUEST[$pass])==1){
        return true;
    }
    return false;
}
function comprobarPass($pass, $pass1){
    if($_REQUEST[$pass] == $_REQUEST[$pass1]){
        return true;
    }
    return false;
}
function validarFormUser(){
    if(enviado()){
        if(!vacio('nombre') && !vacio('email') && !vacio('fecha') && !vacio('pass') && !pass('pass')){
            insertarUser($_REQUEST['usuario'], $_REQUEST['email'], $_REQUEST['fecha'], $_REQUEST['pass']);
        }
    }
}
?>
<?
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
?>
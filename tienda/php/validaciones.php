<?
 require ('../php/bbdd.php');
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
/*function pass($pass){
    $patron='/[A-Z][a-z][0-9]{8,}/';
    if(preg_match($patron, $_REQUEST[$pass])==1){
        return true;
    }[a-zA-Z0-9_]
    return false;
}*/
function pass($pass){
    $patron='[a-zA-Z0-9]{8,}';
    if(preg_match($patron, $_REQUEST[$pass])==1){
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
            header('Location:index.html');
            exit;
        }
    }
}
function validaProducto(){
    if(enviado()){
        if(!vacio('codProd') && !vacio('nombre') && !vacio('descripcion') && !vacio('precio')){
            insertarProducto($_REQUEST['codProd'], $_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['precio'], $_REQUEST['img']);
            
        }
    }
}

function estaValidado(){
    if(isset($_SESSION['validado'])){
        return true;
    }
    return false;
}

function esAdmin(){
    if(isset($_SESSION['perfil'])){
        if($_SESSION['perfil']=='ADM'){
            return true;
        }
    }
    return false;
}

function esModerador(){
    if(isset($_SESSION['perfil'])){
        if($_SESSION['perfil']=='MOD'){
            return true;
        }
    }
    return false;
}
?>
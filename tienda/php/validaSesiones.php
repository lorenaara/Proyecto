<?php
    session_start();
    include './bbdd.php';
    $user=$_REQUEST['usuario'];
    $pass=$_REQUEST['pass'];

    if(empty($user)){
        $_SESSION['error']='Debes introducir un nombre';
        header('Location:../html/usuario.php');
        exit;
    }elseif(empty($pass)){
        $_SESSION['error']='Debes introducir una clave';
        header('Location:../html/usuario.php');
        exit;      
    }else{
        if(sesiones($user, $pass)){
            if(isset($_SESSION['perfil'])){

           
            if($_SESSION['perfil']=='ADM'){
                header('Location:../html/administrador.php');
                exit;
                /*echo '<nav>
                
                <ul>
                <li><a href="./html/albaran.php">Albaran</a></li>
                <li><a href="./html/ventas.php">Ventas</a></li>
                </ul>
                </nav>';*/
            }elseif($_SESSION['perfil']=='MOD'){
              header('Location:../html/productos.php');
            }else{
                header('Location:../index.php');
                exit;
            }
        }else{
            $_SESSION['error']='El usuario o la clave no existen';
            header('Location:../html/usuario.php');
            exit;
        }
    }
    }
?>
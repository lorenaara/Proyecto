<?php
    session_start();
    require './bbdd.php';
    $user=$_REQUEST['usuario'];
    $pass=$_REQUEST['pass'];

    if(empty($user)){
        header('Location:../php/usuario.php');
        exit;
    }elseif(empty($pass)){
        header('Location:../php/usuario.php');
        exit;      
    }else{
        if(sesiones($user, $pass)){
            if($_SESSION['perfil']=='ADM'){

                echo '<nav>
                <ul>
                <li><a href="./html/albaran.php">Albaran</a></li>
                <li><a href="./html/ventas.php">Ventas</a></li>
                </ul>
                </nav>';
            }elseif($_SESSION['perfil']=='MOD'){
                echo '<nav>
                <ul>
                <li><a href="./html/insertarProducto.php">Albaran</a></li>
                <li><a href="./html/stock.php">Albaran</a></li>
                <li><a href="./html/albaran.php">Albaran</a></li>
                <li><a href="./html/ventas.php">Ventas</a></li>
                </ul>
                </nav>';
            }else{
                header('Location:../index.php');
                exit;
            }
        }else{
            header('Location:../php/usuario.php');
            exit;
        }
    }
?>
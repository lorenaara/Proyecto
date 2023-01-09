<?
    require '../php/validaciones.php';
    require '../php/bbdd.php';
    $correcto= false;

    if(enviado()){
        if(validarFormUser()){
            $correcto=true;
        }
    }
    if(!enviado() || $correcto==false){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="shortcut icon" href="../img/logo-footer.svg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="../index.html"><img src="../img/logo.png" alt="toy Planet" id="logo"></a>
        <h1>TOY PLANET</h1>
        <div id="iconos">
            <a href="usuario.html"><img src="../img/icons8-usuario-de-género-neutro-32.png" alt="usuario" class="icono"></a>
            <a href="carrito.html"><img src="../img/icons8-carrito-de-compras-32.png" alt="carrito" class="icono"></a>
        </div>
    </header>
    <main>
        <form action="registrarse.php"  method="post">
            <h2>Registro</h2>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?
                if(enviado() && !vacio('usuario')){
                    echo $_REQUEST['usuario'];
                }
            ?>">
            <?
            if(enviado() && vacio('usuario')){
            ?>
            <span>El usuario no puede estar vacio</span>
            <?
            }
            ?>
            <input type="email" name="email" id="email" placeholder="Email" value="<?
                if(enviado() && !vacio('email')){
                    echo $_REQUEST['email'];
                }
            ?>">
            <?
                if(enviado() && vacio('email')){
            ?>
            <span>El correo no puede estar vacio</span>
            <?
                }
            ?>
            <input type="text" placeholder="Fecha Nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')" name="fecha" value="<?
                if(enviado() && !vacio('fecha')){
                    echo $_REQUEST['fecha'];
                }
            ?>">
            <?
                if(enviado() && vacio('fecha')){
            ?>
                <span>La fecha de nacimiento no puede estar vacia</span>
            <?
                }
            ?>
            <input type="password" name="pass" id="pass" placeholder="Contraseña" value="<?
                if(enviado() && !vacio('pass') && pass('pass')){
                    echo $_REQUEST['pass'];
                }
            ?>">
            <?
                if(enviado() && vacio('pass')){
            ?>
            <span>La contraseña no puede estar vacia</span>
            <?
                }
                if(enviado() && !vacio('pass') && !pass('pass')){
            ?>
                <span>La contraseña tiene que ser valida</span>
            <?
                }
            ?>
            <input type="password" name="pass2" id="pass2" placeholder="Confirmar Contraseña" value="<?
                if(enviado() && !vacio('pass2') && pass('pass2') && comprobarPass('pass', 'pass2')){
                    echo $_REQUEST['pass2'];
                }
            ?>">
            <?
                if(enviado() && vacio('pass2')){
            ?>
                <span>La contraseña no puede estar vacia</span>
            <?
                }
                if(enviado() && !vacio('pass2') && !pass('pass2')){
            ?>
                <span>La contraseña debe ser valida</span>
            <?
                }
                if(enviado() && !vacio('pass2') && pass('pass2') && !comprobarPass('pass', 'pass2')){
                ?>
                    <span>Las contraseñas deben de ser iguales</span>
                <?
                }
            ?>
            <input type="submit" value="Crear Cuenta" id="sesion" name="enviar">
        </form>
    </main>
    <footer>
        <img src="../img/logo-footer.svg" alt="toy Planet" id="logoFooter">
        <section>
        <article id="redes">
            <a href="#"><img src="../img/icons8-facebook-50.png" alt="facebook"></a>
            <a href="#"><img src="../img/icons8-instagram-50.png" alt="instagram"></a>
            <a href="#"><img src="../img/icons8-twitter-50.png" alt="twitter"></a>
        </article>
        <article class="text">
            <a href="#"><img src="../img/icons8-teléfono-50.png" alt="telefono">666 654 632</a>  
             <a href="#"><img src="../img/icons8-casa-50.png" alt="direccion">c/Corredera 85</a>
        </article>
        <article class="frame">
         <img src="../img/frame.png" alt="QR">
        </article>
    </section>
    </footer>
</body>
</html>
<?php
 }
?>
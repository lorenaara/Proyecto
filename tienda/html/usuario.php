
<!DOCTYPE html>
<html lang="es">
<?
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
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
       
        <form action="usuario.html" method="get"> 
            
            <h2>Iniciar Sesión</h2>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
            
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            <input type="submit" value="Iniciar Sesión" id="sesion">
        </form>
        <div>
            <p>¿No tienes cuenta? <a href="registrarse.php">Registrate</a></p>
        </div>
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
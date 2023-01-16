<?php
require '../seguro/conexion.php';
function insertarProducto($codProd, $nombre, $descripcion, $precio, $stock, $img){
   try {
    $conexion = new PDO('mysql:host='.HOST .';dbname='. BBDD, USER, PASS);
    $consulta= 'insert into producto values(?,?,?,?,?,?);';
    $preparada= $conexion->prepare($consulta);
    $preparada->bindParam(1,$codProd);
    $preparada->bindParam(2,$nombre);
    $preparada->bindParam(3,$descripcion);
    $preparada->bindParam(4,$precio);
    $preparada->bindParam(5, $stock);
    $preparada->bindParam(6,$img);
    $preparada->execute();
    header('Location:./productos.php');
    exit;
   }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }
}

function modificarUser(){
  if(isset($_REQUEST['guardar'])){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta= 'update usuario set clave=?, email=?, fecha=? where user=?';
        $preparada=$conexion->prepare($consulta);
        $clave =$_REQUEST['clave'];
        $email=$_REQUEST['email'];
        $fecha=$_REQUEST['fecha'];
        $user= $_REQUEST['user'];
        $preparada->bindParam(1, $clave);
        $preparada->bindParam(2, $email);
        $preparada->bindPam(3, $fecha);
        $preparada->bindPam(4,$user);
        $preparada->execute();
        header('Location:../index.php');
        exit;
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }
  }

  try{
    $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
    $consulta= 'select * from usuario where user=?';
    $preparada=$conexion->prepare($consulta);
  
    $user= $_REQUEST['name'];
    $preparada->bindParam(1, $user);
    $preparada->execute();
    echo '<table><thead><th>id</th> <th>usuario</th><th>clave</th><th>email</th><th>fecha</th>
    </thead><form action="../index.php" method="post">';
    while($row =$preparada->fetch(PDO::FETCH_ASSOC)){
        //echo '<tr>';
        foreach($row as $key=>$value){
            if($key=='id'){
                echo '<td><input type="text" name="id" readonly value='. $row['id'].'></td>';
            }elseif($key== 'user'){
                echo '<td><input type="text" name="name" readonly value='. $row['user'].'></td>';
            }elseif($key =='clave'){
                echo '<td><input type="password" name="clave"  value='. $row['clave'].'></td>';
            }elseif($key=='email'){
                echo '<td><input type="email" name="email"  value='. $row['email'].'></td>';
            }elseif($key=='fecha'){
                echo '<td><input type="date" name="fecha"  value='. $row['fecha'].'></td>';
            }
            //echo '</tr>';
        }
        echo '<td><input type="submit" name="guardar" value="Guardar"></td>';
        echo '</form></table>';
    }

   }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }
}

function ventasAdmin(){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta = 'select * from venta';
        $resultado= $conexion->query($consulta);
        echo '<table><thead><tr><td>Ventas</td><tr><td>id</td><td>Usuario</td><td>Fecha</td><td>cod Producto</td><td>Cantidad</td><td>Precio Total</td></tr></tr></thead>';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            foreach($row as $key => $value){
                echo '<td>'. $value.'</td>';
            }
            echo '<td><a href="./modificarVenta.php?name='.$row['id'].'">Modificar</a></td><td><a href="./borrarVenta.php?name='.$row['id'].'">Borrar</a></td></tr>';
        }
        echo '</table>';
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
}
function ventasMod(){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta = 'select * from venta';
        $resultado= $conexion->query($consulta);
        echo '<table><thead><tr><td>Ventas</td><tr><td>id</td><td>Usuario</td><td>Fecha</td><td>cod Producto</td><td>Cantidad</td><td>Precio Total</td></tr></tr></thead>';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            foreach($row as $key => $value){
                echo '<td>'. $value.'</td>';
            }
        }
        echo '</table>';
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
}
function modVentas(){
    if(isset($_REQUEST['guardar'])){
        try{
            $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
            $consulta='update venta set user=?, fecha=?, codprod=?, cantida=?, precio=? where id=?';
            $preparada=$conexion->prepare($consulta);
            $user=$_REQUEST['user'];
            $fecha=$_REQUEST['fecha'];
            $codProd=$_REQUEST['codProd'];
            $cantidad=$_REQUEST['cantidad'];
            $precio=$_REQUEST['precio'];
            $id=$_REQUEST['name'];
            $preparada->bindParam(1, $user);
            $preparada->bindParam(2, $fecha);
            $preparada->bindParam(3, $codProd);
            $preparada->bindParam(4, $cantidad);
            $preparada->bindParam(5, $precio);
            $preparada->bindParam(6, $id);
            $preparada->execute();
            header('Location:../ventas.php');
            exit;
        }catch(Exception $ex) {
            echo 'error';
            print_r($ex);
        }finally{
            unset($conexion); 
        }   
    }
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta ='select * from venta where id =:id';
        $preparada=$conexion->prepare($consulta);
        $array= array(':id'=>$_REQUEST['name']);
        $preparada->execute($array);
        echo '<table><thead><tr><td>Ventas</td><tr><td>id</td><td>Usuario</td><td>Fecha</td><td>cod Producto</td><td>Cantidad</td><td>Precio Total</td></tr></tr></thead><form action="./ventas.php" method="post">';
        while($row= $preparada->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';     
            foreach ($row as $key => $value) {
                if($key=='id'){
                    echo '<td><input type="text" name="id" readonly value='. $row['id'].'></td>';
                }elseif($key== 'user'){
                    echo '<td><input type="text" name="name"  value='. $row['user'].'></td>';
                }elseif($key=='fecha'){
                    echo '<td><input type="date" name="fecha"  value='. $row['fecha'].'></td>';
                }elseif($key=='codProd'){
                    echo '<td><input type="text" name="codProd"  value='. $row['codProd'].'></td>';
                }elseif($key=='cantidad'){
                    echo '<td><input type="number" name="cantidad"  value='. $row['cantidad'].'></td>';
                }elseif($key=='precio'){
                    echo '<td><input type="number" name="precio" step="0.01"  value='. $row['precio'].'></td>';
                }
            }
            echo '<td style="border: #000 1px solid; padding:10px;"><input type="submit" name="guardar" value="Guardar"></td>';
            echo '</tr>';
    }
    echo '</form></table>';

    }catch(Exception $ex) {
            echo 'error';
            print_r($ex);
        }finally{
            unset($conexion); 
        }   
}
function borrarVenta(){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta='Delete from venta where id=?';
        $preparada=$conexion->prepare($consulta);
        $preparada->bindParam(1, $_REQUEST['name']);
        $preparada->execute();
        header('Location:./ventas.php');
        exit;
    }catch(Exception $ex) {
        echo 'error';
    print_r($ex);
    }finally{
    unset($conexion); 
    }
}
function albaranAdmin(){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta = 'select * from albaran';
        $resultado= $conexion->query($consulta);
        echo '<table><thead><tr><td>Albaran</td><tr><td>id</td><td>Fecha</td><td>cod Producto</td><td>Cantidad</td><td>Usuario</td></tr></tr></thead>';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            foreach($row as $key => $value){
                echo '<td>'. $value.'</td>';
            }
            echo '<td><a href="./modificarAlbaran.php?name='.$row['id'].'">Modificar</a></td><td><a href="./borrarAlbaran.php?name='.$row['id'].'">Borrar</a></td></tr>';
        }
        echo '</table>';
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
}
function albaranMod(){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta = 'select * from albaran';
        $resultado= $conexion->query($consulta);
        echo '<table><thead><tr><td>Albaran</td><tr><td>id</td><td>Fecha</td><td>cod Producto</td><td>Cantidad</td><td>Usuario</td></tr></tr></thead>';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            foreach($row as $key => $value){
                echo '<td>'. $value.'</td>';
            }
           
        }
        echo '</table>';
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
}
function modificarAlbaran(){
    if(isset($_REQUEST['guardar'])){
        try{
            $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
            $consulta= 'update albaran set fecha=? codProd=? cantidad=? user=? where id=?';
            $preparada = $conexion->prepare($consulta);
            $fecha= $_REQUEST['fecha'];
            $codProd= $_REQUEST['codProd'];
            $cantidad= $_REQUEST['cantidad'];
            $user=$_REQUEST['user'];
            $id=$_REQUEST['id'];
            $preparada->bindParam(1, $fecha);
            $preparada->bindParam(2, $codProd);
            $preparada->bindParam(3, $cantidad);
            $preparada->bindParam(4, $user);
            $preparada->bindParam(5, $id);
            $preparada->execute();
            header('Location:../albaran.php');
            exit;
        }catch(Exception $ex) {
            echo 'error';
            print_r($ex);
        }finally{
            unset($conexion); 
        } 
    }

    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta= 'select * from albaran where id=:id';
        $preparada=$conexion->prepare($consulta);
        $array= array(':id'=>$_REQUEST['name']);
        $preparada->execute($array);
        echo '<table><thead><tr><th>id</th><th>fecha</th><th>Cod Producto</th><th>Cantidad</th><th>Usuario</th></tr><form action="./albaran.php" method="post"> ';
        while($row=$preparada->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            foreach ($row as $key => $value) {
            if($key=='id'){
                echo '<td><input type="text" name="id" readonly value='. $row['id'].'></td>';
            }elseif($key=='fecha'){
                    echo '<td><input type="date" name="fecha"  value='. $row['fecha'].'></td>';
            }elseif($key=='codProd'){
                echo '<td><input type="text" name="codProd"  value='. $row['codProd'].'></td>';
            }elseif($key=='cantidad'){
                echo '<td><input type="number" name="cantidad"  value='. $row['cantidad'].'></td>';
            }elseif($key== 'user'){
                echo '<td><input type="text" name="name"  value='. $row['user'].'></td>';
            }
        }
            echo '<td style="border: #000 1px solid; padding:10px;"><input type="submit" name="guardar" value="Guardar"></td>';
                echo '</tr>';
        }
        echo '</form></table>';
    }catch(Exception $ex) {
        echo 'error';
    print_r($ex);
    }finally{
    unset($conexion); //Se cierra la conexion
    }
      
}
function borrarAlbaran(){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta='Delete from albaran where id=?';
        $preparada=$conexion->prepare($consulta);
        $preparada->bindParam(1, $_REQUEST['name']);
        $preparada->execute();
        header('Location:../albaran.php');
        exit;
    }catch(Exception $ex) {
        echo 'error';
    print_r($ex);
    }finally{
    unset($conexion); 
    }
}

function insertarUser($nombre, $email, $fecha, $pass){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta = 'insert into usuario values (?,?,?,?)';
        $preparada= $conexion->prepare($consulta);
        $preparada->bindParam(1,$nombre);
        $preparada->bindParam(2, $pass);
        $preparada->bindParam(3, $email);
        $preparada->bindParam(4, $fecha);
        $preparada->execute();

    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
}

function productos(){
    echo '<section>';
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta= 'select * from producto';
        $resultado= $conexion->query($consulta);
        echo '<div id="producto">';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){  
                echo '<article>';
                echo "<img src='../".$row['img'] ."'><h3>".$row['nombre']."</h3><p>". $row['descripcion']."</p><p>".$row['precio']."</p>"; 
                echo '</article>' ;     
        }
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
    echo '</section>';
}
function productosAdmin(){
    echo '<section>';
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta= 'select * from producto';
        $resultado= $conexion->query($consulta);
        echo '<div id="producto">';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){  
                echo '<article>';
                echo "<img src='../".$row['img'] ."'><h3>".$row['nombre']."</h3><p>". $row['descripcion']."</p><p>".$row['precio']."</p>"; 
                echo '<a href="./modProducto.php?name='.$row['codProd'].'">Modificar</a>';
                echo '</article>' ;     
        }
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
    echo '</section>';
}
function productosUser(){
    echo '<section>';
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta= 'select * from producto';
        $resultado= $conexion->query($consulta);
        echo '<div id="producto">';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){  
                echo '<article>';
                echo "<img src='../".$row['img'] ."'><h3>".$row['nombre']."</h3><p>". $row['descripcion']."</p><p>".$row['precio']."</p>"; 
                echo '<a href="./comprar.php?name='.$row['codProd'].'">Comprar</a>';
                echo '</article>' ;     
        }
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
    echo '</section>';
}
function comprar(){
    if(isset($_REQUEST['guardar'])){
        try{
            $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
            $consulta= 'update producto set descripcion=?, precio=? stock=? where codProd=?';
            $preparada=$conexion->prepare($consulta);
            $descripcion=$_REQUEST['descripcion'];
            $precio=$_REQUEST['precio'];
            $stock=$_REQUEST['stock'];
            $codProd=$_REQUEST['name'];
            $preparada->bindParam(1,$descripcion);
            $preparada->bindParam(2,$precio);
            $preparada->bindParam(3,$stock);
            $preparada->bindParam(4, $codProd);
            $preparada->execute();
            header('Location:../producto.php');
            exit;
        }catch(Exception $ex) {
            echo 'error';
            print_r($ex);
        }finally{
            unset($conexion); 
        }   
    }
        try{
            $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
            $sql = 'select * from producto where codProd = :codProd';
            $preparada=$conexion->prepare($sql);
            $array= array(':codProd'=>$_REQUEST['name']);
            $preparada->execute($array);
            echo '<table><thead><tr><th>codProd</th><th>nombre</th><th>descripcion</th><th>img</th><th>cantidad</th></tr></thead><form action="../html/productos.php" method="post"> ';
            while($row= $preparada->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';       
                foreach ($row as $key => $value) {
                    if($key=='codProd'){
                        echo '<td><input type="text" name="codProd" readonly value='. $row['codProd'].'></td>';
                    }elseif($key=='nombre'){
                            echo '<td><input type="text" name="descripcion" readonly value='. $row['descripcion'].'></td>';
                    }elseif($key=='precio'){
                        echo '<td><input type="number" name="precio" step="0.01"  value='. $row['precio'].'></td>';
                    }elseif($key=='img'){
                        echo '<td><img src="../'.$row['img'] .'"></td>';
                    }
                }
                echo '<td><input type="number" name="cantidad"></td>';
                
            }
                       echo '<td style="border: #000 1px solid; padding:10px;"><input type="submit" name="guardar" value="comprar"></td>';
            echo '</tr>';
             echo '</form></table>';
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }

            
            try{
                $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
                $consulta='update producto set stock=? wherecodProd = :codProd';
                $preparada=$conexion->prepare($sql);
                $array= array(':codProd'=>$_REQUEST['name']);
                $preparada->execute($array);
            }catch(Exception $ex) {
    echo 'error';
    print_r($ex);
}finally{
    unset($conexion); 
}   
            
}       



function modificarProducto(){
    if(isset($_REQUEST['guardar'])){
        try{
            $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
            $consulta= 'update producto set descripcion=?, precio=? stock=? where codProd=?';
            $preparada=$conexion->prepare($consulta);
            $descripcion=$_REQUEST['descripcion'];
            $precio=$_REQUEST['precio'];
            $stock=$_REQUEST['stock'];
            $codProd=$_REQUEST['name'];
            $preparada->bindParam(1,$descripcion);
            $preparada->bindParam(2,$precio);
            $preparada->bindParam(3,$stock);
            $preparada->bindParam(4, $codProd);
            $preparada->execute();
            header('Location:../producto.php');
            exit;
        }catch(Exception $ex) {
            echo 'error';
            print_r($ex);
        }finally{
            unset($conexion); 
        }   
    }
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $sql = 'select * from producto where codProd = :codProd';
        $preparada=$conexion->prepare($sql);
        $array= array(':codProd'=>$_REQUEST['name']);
        $preparada->execute($array);
        echo '<table><thead><tr><th>codProd</th><th>nombre</th><th>descripcion</th><th>precio</th><th>stock</th><th>img</th></tr></thead><form action="../html/productos.php" method="post"> ';
        while($row= $preparada->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';       
            foreach ($row as $key => $value) {
                if($key=='codProd'){
                    echo '<td><input type="text" name="codProd" readonly value='. $row['codProd'].'></td>';
                }elseif($key=='nombre'){
                        echo '<td><input type="text" name="descripcion" readonly value='. $row['descripcion'].'></td>';
                }elseif($key=='precio'){
                    echo '<td><input type="number" name="precio" step="0.01"  value='. $row['precio'].'></td>';
                }elseif($key=='stock'){
                    echo '<td><input type="number" name="stock" value='. $row['stock'].'></td>';
                }elseif($key=='img'){
                    echo '<td><img src="../'.$row['img'] .'"></td>';
                }
            }
            echo '<td style="border: #000 1px solid; padding:10px;"><input type="submit" name="guardar" value="Guardar"></td>';
            echo '</tr>';
        }
                   
         echo '</form></table>';
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
}

function sesiones($user, $pass){
    try{
        $conexion= new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta= 'select * from usuario where user=? and clave=?';
        $preparada=$conexion->prepare($consulta);
        $user=$_REQUEST['usuario'];
        $pass=$_REQUEST['pass'];
        $preparada->bindParam(1, $user);
        $preparada->bindParam(2,$pass);
        $preparada->execute();
        
        if($preparada->rowCount()==1){
            $_SESSION['valido']=true;
            $row=$preparada->fetch();
            $_SESSION['user']=$row['user'];
            $_SESSION['perfil']= $row['perfil'];
            unset($conexion);
            return true;
        }else{
            unset($con);
            return false;
        }

    }catch(Exception $ex){
        print_r($ex);
        unset($con);
    }
}
?>
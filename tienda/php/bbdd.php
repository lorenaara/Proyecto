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
   }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); //Se cierra la conexion
    }
}

function modificarUser($id, $pass, $email, $fecha){
    try {
        $conexion = new PDO('mysql:host='.HOST .';dbname='. BBDD, USER, PASS);
        $consulta='update usuario set clave=?, email=?, fecha=? where id=?';
        $preparada=$conexion->prepare($consulta);
        $preparada->bindParam(1, $pass);
        $preparada->bindParam(2, $email);
        $preparada->bindParam(3, $fecha);
        $preparada->bindParam(4,$id);
        $preparada->execute();

      }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }
}

function usuario($id){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta='select * from usuario where id=:id';
        $preparada=$conexion->prepare($consulta);
        $array= array(':id'=>$id);
        $preparada->execute($array);
        echo '<table><thead><tr><th>Usuario</th> <tr><th>id</th> <th>usuario</th><th>clave</th><th>email</th><th>fecha</th>
        </tr></tr></thead><form action="./bbdd.php" method="post">';
        while($row =$preparada->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
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
                echo '<td><input type="submit" name="guardar" value="Guardar"></td>';
            echo '</tr>';
            }
            echo '</form></table>';
        }

    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); //Se cierra la conexion
    }
}

function ventas(){
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
            echo '<td><a href="./modificar.php?name='.$row['id'].'">Modificar</a></td><td><a href="./borrar.php?name='.$row['id'].'">Borrar</a></td></tr>';
        }
        echo '</table>';
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
}

function albaran(){
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta = 'select * from alabaran';
        $resultado= $conexion->query($consulta);
        echo '<table><thead><tr><td>Albaran</td><tr><td>id</td><td>Fecha</td><td>cod Producto</td><td>Cantidad</td><td>Usuario</td></tr></tr></thead>';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            foreach($row as $key => $value){
                echo '<td>'. $value.'</td>';
            }
            echo '<td><a href="./modificar.php?name='.$row['id'].'">Modificar</a></td><td><a href="./borrar.php?name='.$row['id'].'">Borrar</a></td></tr>';
        }
        echo '</table>';
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
    try{
        $conexion = new PDO('mysql:host=' . HOST . ';dbname=' . BBDD, USER, PASS);
        $consulta= 'select * from producto';
        $resultado= $conexion->query($consulta);
        echo '<div id="producto">';
        while($row= $resultado->fetch(PDO::FETCH_ASSOC)){
            foreach($row as $key =>$value){
                echo '<img src="'.$row['img'] .'>'.
                '<h3>'.$row['nombre'].'</h3><p>'. $row['descripcion'].'</p><p>'.$row['precio'].'</p>';
            }
        }
    }catch(Exception $ex) {
        echo 'error';
        print_r($ex);
    }finally{
        unset($conexion); 
    }   
}
?>
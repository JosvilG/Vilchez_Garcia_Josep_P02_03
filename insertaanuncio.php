<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inserta persona</title>
</head>

<body>
<?php 
require_once("conexion_pdo.php");

// Creamos el objeto 
$db = new Conexion();

$dbTabla='P02anuncios';
$dbTabla2='P02categorias';
$dbTabla3='P02usuarios';

$titulo = $_POST["titulo"];
$precio = $_POST["precio"];
$descripcion = $_POST["descripcion"];
$ip = $_SERVER['REMOTE_ADDR'];
$data = date('Y-m-d H:i:s');
$catId = $_POST["id"];
$propietario = $_POST["email"];

    /*print "<p>".$titulo."<br>";
    print $precio."<br>";
    print $descripcion."<br>";
    print $ip."<br>";
    print $data."<br>";
    print $catId."<br>";
    print $propietario;*/
    
    $consulta2 = "SELECT * FROM $dbTabla3 WHERE email='$propietario'";
    
    $result2 = $db->prepare($consulta2); 
    $result2->execute();
    if (!$result2){ 
	print "<p> Error en la consulta. </p>\n";
}else{ 
    /*?> 
    <nav>
        <ul>
    <?
	foreach( $result2 as $valor2){
        print "<li>";
        print $valor2["email"];
        print "</li><li>";
        print $valor2["nombre"];
        print "</li>";
    }
    ?> 
        </ul>
    </nav>
    <?*/
    $consulta = "INSERT INTO $dbTabla (titulo,precio,descripcion,ip,vendido,fechahora,categoria,propietario) VALUES ('$titulo',$precio,'$descripcion','$ip','no','$data',$catId,'$propietario')";
    $result = $db->prepare($consulta);  
    $result->execute();    
    }
    
  /*  $consulta = "SELECT * FROM $dbTabla3 WHERE email=$propietario";
    
    $result = $db->prepare($consulta); 
    $result->execute();
    
    foreach( $result as $valor){
        print "<p>";
        print $valor["email"];
        print "<\p>";
       }
    
    if (!$result)
     { 
        print "<p>El usuario no existe en la base de datos.</p>\n"; 
     } else {
        print "<p>Correcto</p>";
    }/*
$consulta = "INSERT INTO $dbTabla (titulo,precio,descripcion,ip,vendido,fechahora,categoria,propietario) VALUES ($titulo,$precio,$descripcion,$ip,'no',$data,$catId,$propietario)";
$result = $db->prepare($consulta);
    $consulta = "INSERT INTO $dbTabla (titulo, imagen, enlace, fecha, resumen) VALUES (:t, :i, :e, :f, :r)"; 

$result = $db->prepare($consulta);

if ($result->execute(array(":t" => $titulo, ":i" => $imagen, ":e" => $enlace, ":f" => $fecha, ":r" => $resumen)))
 { 
 	print "<p>Noticia insertada correctamente.</p>\n"; 
 } else {
	print "<p>Error al insertar la noticia.</p>\n"; 
}*/
?>

<p><a href="listaanuncios.php">Volver al listado de anuncios</a></p>
</body>
</html>
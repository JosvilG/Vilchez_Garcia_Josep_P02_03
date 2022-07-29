<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modicicacion anuncio</title>
</head>

<body>
<?php 
require_once("conexion_pdo.php");

// Creamos el objeto 
$db = new Conexion();

$dbTabla='Noticies'; 

$titulo = $_POST["titulo"];
$enlace = $_POST["enlace"];
$imagen = $_POST["imagen"];
$fecha = $_POST["fecha"];
$resumen = $_POST["resumen"];
//$consulta = "INSERT INTO $dbTabla (dni, nombre, apellido1, apellido2) VALUES ($dni, $nombre, $apellido1, $apellido2)"; 

$consulta = "INSERT INTO $dbTabla (titulo, imagen, enlace, fecha, resumen) VALUES (:t, :i, :e, :f, :r)"; 

$result = $db->prepare($consulta);

if ($result->execute(array(":t" => $titulo, ":i" => $imagen, ":e" => $enlace, ":f" => $fecha, ":r" => $resumen)))
 { 
 	print "<p>Noticia agregada correctamente</p>\n"; 
 } else {
	print "<p>No se pudo añadir la noticia</p>\n"; 
}
?>

<p><a href="noticias.php">Volver al listado de personas</a></p>
</body>
</html>
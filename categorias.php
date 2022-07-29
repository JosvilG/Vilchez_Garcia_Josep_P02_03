<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Categorias</title>
</head>
<?
require_once("conexion_pdo.php");
?>
<body>
    <style>
        body{
         text-align: center; 
        }
    </style>
<?

$db = new Conexion();

$id=$_GET['idC'];    
    
$dbTabla1='P02anuncios';
$dbTabla2='P02usuarios';
$dbTabla3='P02categorias'; 
    /*
print "<div id=cabecera>";
$fecha = date ("j/n/Y H:i");
print ("$fecha");
print "</div>";
*/
// En tres líneas 
    
$consulta = "SELECT $dbTabla1.id, $dbTabla1.titulo, $dbTabla1.precio, $dbTabla3.nombre, $dbTabla1.descripcion, $dbTabla2.nombre AS usuarios FROM $dbTabla1, $dbTabla2, $dbTabla3 WHERE $dbTabla1.categoria=$dbTabla3.id AND $dbTabla1.propietario=$dbTabla2.email AND $dbTabla3.id=$id"; 
$result = $db->prepare($consulta); 
$result->execute(array(":id" => $id));

if (!$result){ 
	print "<p> Error en la consulta. </p>\n";
}else{ 
	foreach( $result as $valor){
        print "<article>";
        print "<h2><a href=\"anuncios.php?id=$valor[id]\">".$valor["titulo"]."</a></h2>";
        print "<p style='font-size:20px; font-family:monospace;'>".$valor["descripcion"]."</p>";
        print "<p>".$valor["usuarios"]."</p>";
        print "<p>"."Categoria: ".$valor["nombre"]."</p>";
        print "<h4>".$valor["precio"]."€"."</h4><br>";
        print "</article>";
	}
    
    print "<a href='listaanunciosS.php'>Click para volver al home</a>";
}

//Cerramos conexión 
$db=NULL;
?>
</body>
</html>
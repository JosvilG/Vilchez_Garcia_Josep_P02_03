<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Estado anuncio</title>
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
$dbTabla1='P02anuncios';
$vendido=$_GET['id'];    
    

    /*
print "<div id=cabecera>";
$fecha = date ("j/n/Y H:i");
print ("$fecha");
print "</div>";
*/
// En tres líneas
$consulta = "UPDATE $dbTabla1 SET vendido='SI' WHERE $vendido=id";
$result = $db->prepare($consulta); 
   
    
if ($result->execute(array(":id" => $id))){
	print "<p> Actualización exitosa </p>\n";
}else{ 
    print "<p> No se pudo actualizar </p>";
    }


//Cerramos conexión 
$db=NULL;
?>
<a href='listaanunciosS.php'>Click para volver al home</a>;
</body>
</html>
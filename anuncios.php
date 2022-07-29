<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Anuncios</title>
</head>
<?
require_once("conexion_pdo.php");
?>
<body>
    <style>
        body{
         text-align: center; 
        }
        
        body{
            
        text-align: center;
        float: left;
        width: 100%;
        max-width: 100%;
        height: auto;
        max-height: auto;
        }
        
        article{
            text-align: center;
            padding: 0.2em;
            margin-top: -18em;
        }
        
        .vertical-menu {
          width: 200px; /* Set a width if you like */
        }

        .vertical-menu a {
          background-color: #eee; /* Grey background color */
          color: black; /* Black text color */
          display: block; /* Make the links appear below each other */
          padding: 12px; /* Add some padding */
          text-decoration: none; /* Remove underline from links */
        }

        .vertical-menu a:hover {
          background-color: #ccc; /* Dark grey background on mouse-over */
        }

        .vertical-menu a.active {
          background-color: #4CAF50; /* Add a green color to the "active/current" link */
          color: white;
        }
        
        .contenidor{
            max-width: 1000px;
            padding-left: 25%;
            position: initial;
        }
        
</style>
<?

$db = new Conexion();

$id=$_GET['id'];    
    
$dbTabla1='P02anuncios';
$dbTabla2='P02usuarios';
$dbTabla3='P02categorias'; 
$dbTabla4='P02visualizaciones';
    /*
print "<div id=cabecera>";
$fecha = date ("j/n/Y H:i");
print ("$fecha");
print "</div>";
*/ 
$consulta = "SELECT * FROM $dbTabla3";
$result = $db->prepare($consulta);
$result->execute();

print "<div class='vertical-menu'>";
    print "<aside class='MenuCompleto'>";
        print "<ul id=listaCat>";
            print "<h4>".Categorias."</h4>";
    
            foreach($result as $valor){
                print "<li><a href=\"categorias.php?idC=$valor[id]\">".$valor["nombre"]."</a></li>";
            }
        print"</ul>";
    print "</aside>";
print "</div>";
// En tres líneas 
    
$consulta = "SELECT $dbTabla1.id, $dbTabla1.titulo, $dbTabla1.precio, $dbTabla3.nombre, $dbTabla1.descripcion, $dbTabla2.nombre AS usuarios FROM $dbTabla1, $dbTabla2, $dbTabla3 WHERE $dbTabla1.categoria=$dbTabla3.id AND $dbTabla1.propietario=$dbTabla2.email AND $dbTabla1.id=$id"; 
$result = $db->prepare($consulta); 
$result->execute(array(":id" => $id));

if (!$result){ 
	print "<p> Error en la consulta. </p>\n";
}else{ 
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $date=date("Y-m-d H:i:s");
    $consulta2="INSERT INTO $dbTabla4 (ip, fechahora, useragent, anuncio) VALUES ('$ip','$date','$useragent','$id')";
    $result2=$db->prepare($consulta2);
    $result2->execute();
    print"<div class='contenidor'>";
	foreach( $result as $valor){
        print "<article>";
        print "<h2>".$valor["titulo"]."</a></h2>";
        print "<p style='font-size:20px; font-family:monospace;'>".$valor["descripcion"]."</p>";
        print "<p>".$valor["usuarios"]."</p>";
        print "<p>"."Categoria: ".$valor["nombre"]."</p>";
        print "<h4>".$valor["precio"]."€"."</h4><br>";
        print "</article>";
	}
    print"</div>";
}

//Cerramos conexión 
$db=NULL;
?>
<form action="estadoanuncio.php" method="get" name="form1">
     <input name="id" id="id" type="hidden" value="<? print $id; ?>" autofocus><br>
    <input name="" type="submit" value="Vendido"><br><br>
    <a href="listaanunciosS.php">Click para volver al home</a>
</form>

    
</body>
</html>
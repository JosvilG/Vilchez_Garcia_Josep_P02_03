<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mercachino</title>
</head>
<?
require_once("conexion_pdo.php");
?>
<body>
    <style>
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
            margin-top: -7em; 
        }
        .MenuCompleto{
            margin-top: -12em;
        }
        
        
    </style>
<?
//Conexion
$db = new Conexion();

$dbTabla1='P02anuncios';
$dbTabla2='P02usuarios';
$dbTabla3='P02categorias';
    
$consulta = "SELECT COUNT(*) FROM $dbTabla1";
$result = $db->prepare($consulta);
$result->execute(); 
$total = $result->fetchColumn();

    
print "<div id=cabecera>";

print "<h1 id=homeTitle>Mercachino</h1>";
print "<h6><a href=listaanuncios.php> Click para ver los articulos disponibles </a></h6>";
print "<h2>$total articulos están publicados en nuestra página.</h2><h3><a href=\"nuevoanuncio.php\">¿Quieres añadir un anuncio?</a></h3>\n";
    
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
            
/*$fecha = date ("j/n/Y H:i");
print ("$fecha"); */
print "</div>";
// Consultas
    
$consulta = "SELECT $dbTabla1.id, $dbTabla1.titulo, $dbTabla1.precio, $dbTabla1.vendido, $dbTabla3.nombre, $dbTabla2.nombre AS usuarios FROM $dbTabla1, $dbTabla2, $dbTabla3 WHERE $dbTabla1.categoria=$dbTabla3.id AND $dbTabla1.propietario=$dbTabla2.email ORDER BY fechahora DESC";
    
$result = $db->prepare($consulta);
$result->execute();
 
if (!$result){ 
	print "<p> Error en la consulta. </p>\n";
}else{
print "<div class='contenidor'>";
	foreach( $result as $valor){
        print "<article>";
        print "<h2><a href=\"anuncios.php?id=$valor[id]\">".$valor["titulo"]."</a></h2>";
        //print "<h3><a href=\"deletenoticia.php?id=$valor[id]\">Eliminar Noticia</a></h3>";
        //print "<h3><a href=\"modificanoticia.php?id=$valor[id]\">Modificar la noticia</a></h3>";
        print "<h2><p>".$valor["usuarios"]."</p></h2>";
        print "<h3>".$valor["nombre"]."</h3>";
        print "<p>".$valor["precio"]."€"."</p><br>";
        print "<p>"."Estado vendido: ".$valor["vendido"]."</p><br>";
      
        /* if("$dbTabla1.vendido='NO'"){
            print "Estado: Disponible";
        }else{
            print "Estado: Agotado";
        }
        
        */
        
        print "</article>";
    }
print "</div>";
}

//Cerramos conexión 
$db=NULL;
?>
</body>
</html>
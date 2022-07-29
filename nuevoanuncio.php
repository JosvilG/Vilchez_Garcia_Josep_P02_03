<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Nuevo anuncio</title>
</head>

<body>
    
    <style>
    
        body{
            text-align: center;
            font-family: sans-serif;
        }
        
        
    
    </style>
<?
require_once("conexion_pdo.php");
$db = new Conexion();
$dbTabla3='P02usuarios';
$dbTabla='P02anuncios';
$dbTabla2='P02categorias';

$consulta = "SELECT * FROM P02categorias";
$result = $db->prepare($consulta);
$result->execute();  
?>
    
<h1>Crea una nueva noticia</h1>;

    <form action='insertaanuncio.php' method='post' name='form1' id='formulario'>
    <label for=titulo>TÍTULO*</label><br><textarea cols=100 rows=1 name=titulo id=titulo autofocus placeholder='Titulo de la noticia' required maxlength=255></textarea><br>
        
    <label for='precio'>PRECIO*</label><br><textarea type="number" cols=100 rows=2 name='precio' id='precio' autofocus placeholder='Precio del objeto (max.99999€)' required maxlength=5></textarea><br>
    
    <label for='email'>PROPIETARIO*</label><br><textarea cols='100' rows='2' name='email' id='email' placeholder='Correo del propietario' required maxlength='255'></textarea><br>
        
       <?
        foreach($result as $valor){
            print "<input type='radio' name='id' id='id' value='";
            print $valor["id"];
            print "'required>$valor[nombre]<br>";
        }
        
        ?>
        
    <label for='descripcion'>DESCRIPCION</label><br><textarea cols='70' rows='20' name='descripcion' id='descripcion' type='text' placeholder='Escribe un resumen del anuncio si lo ves necesario.' ></textarea><br>
    <input name="" type='submit' value='Añadir'>
    </form>
    
    <h6 style='color: red'>Los campos con * son obligatorios</h6>
<?
$db=NULL;
?>
</body>
</html>
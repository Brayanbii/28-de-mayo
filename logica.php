<?php

date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d H:i:s");  

require 'vendor/autoload.php'; // Cargar Composer

try {
    // 1. Obtenemos la cadena de conexión desde la variable de entorno en Render
    $uri = getenv('MONGO_URI');
    
    // 2. Si pruebas en local (XAMPP/Docker local) y la variable no existe, usará este respaldo.
    // OJO: No dejes tu contraseña real escrita aquí cuando subas el código a GitHub.
    if (!$uri) {
        $uri = "mongodb+srv://brayan:TU_PASSWORD_AQUI@clusterone.xnd3dxa.mongodb.net/?appName=Clusterone"; 
    }

    // 3. Conexión a Mongo
    $cliente = new MongoDB\Client($uri);
    
    // 4. Seleccionamos la base de datos y la colección correctas (las que creaste en Atlas)
    $db = $cliente->prueba;	
    $coleccion = $db->gustos;	
    
    // 5. Insertamos los datos del formulario
    $resultado = $coleccion->insertOne([
        "apellidos" => $_POST["apellidos"],
        "nombres" => $_POST["nombres"],
        "color" => $_POST["color"],
        "comida" => $_POST["comida"],
        "pelicula" => $_POST["pelicula"],
        "registro" => $hoy
    ]);
    
    echo "<center><h3 style='border:1px solid green;background-color:rgb(64,145,108);color:white;padding:1%;'>Documento insertado con ID: " . $resultado->getInsertedId() . "</h3></center>";

} catch (Exception $e) {
    // Si la conexión falla, se imprimirá el error aquí
    echo "<center><h3 style='border:1px solid red;background-color:rgb(220,53,69);color:white;padding:1%;'>Error de conexión a MongoDB: " . $e->getMessage() . "</h3></center>";
}
    
include "index.html";

?>

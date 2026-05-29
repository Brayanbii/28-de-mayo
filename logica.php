<?php
// Configuración de la zona horaria colombiana para registrar la hora exacta
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d H:i:s");  

// Requerir el cargador de dependencias de Composer para el driver de Mongo
require 'vendor/autoload.php';

// Validamos estrictamente que la petición venga mediante el método POST de envío
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtenemos la cadena de conexión de las variables de entorno de Render
        $uri = getenv('MONGO_URI');
        
        // Respaldo seguro en caso de que se realice una prueba en entorno local
        if (!$uri) {
            $uri = "mongodb+srv://brayan:5Lp8OEHxZa1ZLBYk@clusterone.xnd3dxa.mongodb.net/?appName=Clusterone"; 
        }

        // Conectar a MongoDB Atlas
        $cliente = new MongoDB\Client($uri);
        
        // Definir la base de datos y la colección del clúster de Atlas
        $db = $cliente->prueba;	
        $coleccion = $db->gustos;	
        
        // Insertamos los datos enviados del formulario de "Boleto de Cine"
        $resultado = $coleccion->insertOne([
            "apellidos" => $_POST["apellidos"] ?? '',
            "nombres" => $_POST["nombres"] ?? '',
            "color" => $_POST["color"] ?? '',
            "comida" => $_POST["comida"] ?? '',
            "pelicula" => $_POST["pelicula"] ?? '',
            "registro" => $hoy
        ]);
        
        // Obtenemos el ID autogenerado único por MongoDB
        $insertedId = $resultado->getInsertedId();
        
        // Redirigimos de vuelta al index.php enviando una bandera de éxito y el ID del boleto emitido
        header("Location: index.php?status=success&id=" . urlencode($insertedId));
        exit();

    } catch (Exception $e) {
        // En caso de fallo de conexión, redireccionamos con bandera de error y el mensaje detallado
        header("Location: index.php?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    // Si intentan acceder al archivo logica.php directamente por la URL, los devolvemos al index.php
    header("Location: index.php");
    exit();
}
?>

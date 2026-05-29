<?php
// Configuración de zona horaria colombiana
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d H:i:s");  

// Requerir el cargador de dependencias de Composer
require 'vendor/autoload.php';

// Validamos estrictamente que la petición venga mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Intentamos obtener la cadena de conexión de las variables de entorno de Render
        $uri = getenv('MONGO_URI');
        
        // Respaldo en caso de que estemos probando en un entorno local
        if (!$uri) {
            $uri = "mongodb+srv://brayan:5Lp8OEHxZa1ZLBYk@clusterone.xnd3dxa.mongodb.net/?appName=Clusterone"; 
        }

        // Conectar a MongoDB Atlas
        $cliente = new MongoDB\Client($uri);
        
        // Definir la base de datos y la colección
        $db = $cliente->prueba;	
        $coleccion = $db->gustos;	
        
        // Insertar los datos enviados desde el formulario
        $resultado = $coleccion->insertOne([
            "apellidos" => $_POST["apellidos"] ?? '',
            "nombres" => $_POST["nombres"] ?? '',
            "color" => $_POST["color"] ?? '',
            "comida" => $_POST["comida"] ?? '',
            "pelicula" => $_POST["pelicula"] ?? '',
            "registro" => $hoy
        ]);
        
        // Obtener el ID autogenerado del documento insertado
        $insertedId = $resultado->getInsertedId();
        
        // Redirigimos al index.php enviando una bandera de éxito y el ID del registro
        header("Location: index.php?status=success&id=" . urlencode($insertedId));
        exit();

    } catch (Exception $e) {
        // En caso de fallar, redireccionamos con una bandera de error y el mensaje correspondiente
        header("Location: index.php?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    // Si acceden a logica.php por URL directamente, los devolvemos al index.php
    header("Location: index.php");
    exit();
}
?>

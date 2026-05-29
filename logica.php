<?php
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d H:i:s");  

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $uri = getenv('MONGO_URI');
        if (!$uri) {
            $uri = "mongodb+srv://brayan:5Lp8OEHxZa1ZLBYk@clusterone.xnd3dxa.mongodb.net/?appName=Clusterone"; 
        }

        $cliente = new MongoDB\Client($uri);
        $db = $cliente->prueba;	
        $coleccion = $db->gustos;	
        
        $resultado = $coleccion->insertOne([
            "apellidos" => $_POST["apellidos"] ?? '',
            "nombres" => $_POST["nombres"] ?? '',
            "color" => $_POST["color"] ?? '',
            "comida" => $_POST["comida"] ?? '',
            "pelicula" => $_POST["pelicula"] ?? '',
            "registro" => $hoy
        ]);
        
        $insertedId = $resultado->getInsertedId();
        
        header("Location: index.php?status=success&id=" . urlencode($insertedId));
        exit();

    } catch (Exception $e) {
        header("Location: index.php?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<?php
date_default_timezone_set('America/Bogota');
require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibir los datos del formulario de soporte
    $contacto = $_POST['contacto'] ?? '';
    $tipo_fallo = $_POST['tipo_fallo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    
    // Validación básica
    if(empty($contacto) || empty($tipo_fallo) || empty($descripcion)) {
        header("Location: soporte.php?status=error&msg=Todos los campos son obligatorios");
        exit;
    }

    try {
        $uri = getenv('MONGO_URI');
        if (!$uri) {
            $uri = "mongodb+srv://brayan:5Lp8OEHxZa1ZLBYk@clusterone.xnd3dxa.mongodb.net/?appName=Clusterone"; 
        }
        
        $cliente = new MongoDB\Client($uri);
        $db = $cliente->prueba;	 // Tu base de datos actual
        $coleccion = $db->soporte; // ¡AQUÍ ES DONDE SE GUARDA! En tu nueva colección 'soporte'
        
        $documento = [
            'contacto' => $contacto,
            'tipo_fallo' => $tipo_fallo,
            'descripcion' => $descripcion,
            'registro' => date('Y-m-d H:i:s'),
            'estado' => 'Pendiente'
        ];
        
        $resultado = $coleccion->insertOne($documento);
        
        // Redirigir según el resultado
        if($resultado->getInsertedCount() > 0){
            header("Location: soporte.php?status=success");
            exit;
        } else {
            header("Location: soporte.php?status=error&msg=No se pudo guardar el reporte");
            exit;
        }

    } catch (Exception $e) {
        header("Location: soporte.php?status=error&msg=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // Si alguien intenta entrar directo al archivo sin enviar formulario, lo devolvemos
    header("Location: soporte.php");
    exit;
}
?>

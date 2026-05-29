<?php
// Script para procesar el formulario de soporte técnico
date_default_timezone_set('America/Bogota');
require 'vendor/autoload.php'; // Asegúrate de que esto apunta correctamente a tu autoload de Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $contacto = $_POST['contacto'] ?? '';
    $tipo_fallo = $_POST['tipo_fallo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    
    // Validar que no estén vacíos
    if(empty($contacto) || empty($tipo_fallo) || empty($descripcion)) {
        header("Location: soporte.php?status=error&msg=Todos los campos son obligatorios");
        exit;
    }

    try {
        // Conexión a MongoDB (Usa la misma URI de tu proyecto)
        $uri = getenv('MONGO_URI');
        if (!$uri) {
            $uri = "mongodb+srv://brayan:5Lp8OEHxZa1ZLBYk@clusterone.xnd3dxa.mongodb.net/?appName=Clusterone"; 
        }
        
        $cliente = new MongoDB\Client($uri);
        $db = $cliente->prueba;	 // Base de datos "prueba"
        $coleccion = $db->soporte; // NUEVA Colección "soporte"
        
        // Crear el documento a insertar
        $documento = [
            'contacto' => $contacto,
            'tipo_fallo' => $tipo_fallo,
            'descripcion' => $descripcion,
            'registro' => date('Y-m-d H:i:s'),
            'estado' => 'Pendiente' // Un campo extra útil para soporte
        ];
        
        // Insertar en la base de datos
        $resultado = $coleccion->insertOne($documento);
        
        if($resultado->getInsertedCount() > 0){
            header("Location: soporte.php?status=success");
            exit;
        } else {
            header("Location: soporte.php?status=error&msg=No se pudo guardar el reporte");
            exit;
        }

    } catch (Exception $e) {
        // Redirigir con error si falla la conexión a Mongo
        header("Location: soporte.php?status=error&msg=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // Si intentan entrar directo por URL sin mandar el formulario
    header("Location: soporte.php");
    exit;
}
?>

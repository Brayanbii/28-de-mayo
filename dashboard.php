<?php
date_default_timezone_set('America/Bogota');
require 'vendor/autoload.php';

$error_mongo = null;
$documentos = [];

try {
    $uri = getenv('MONGO_URI');
    if (!$uri) {
        $uri = "mongodb+srv://brayan:5Lp8OEHxZa1ZLBYk@clusterone.xnd3dxa.mongodb.net/?appName=Clusterone"; 
    }
    $cliente = new MongoDB\Client($uri);
    $db = $cliente->prueba;	
    $coleccion = $db->gustos;	
    $documentos = $coleccion->find([], ['sort' => ['registro' => -1]]);
} catch (Exception $e) {
    $error_mongo = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Comando ATLAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #050814;
            color: #00d2ff;
            font-family: 'Courier New', Courier, monospace;
            background-image: linear-gradient(rgba(0, 210, 255, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 210, 255, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        .radar-container {
            border: 2px solid #00d2ff;
            border-radius: 10px;
            background: rgba(0, 20, 40, 0.8);
            padding: 2rem;
            box-shadow: inset 0 0 20px rgba(0, 210, 255, 0.2);
            margin-top: 3rem;
        }
        .data-row {
            border-bottom: 1px dashed rgba(0, 210, 255, 0.3);
            padding: 1rem 0;
            transition: background 0.2s;
        }
        .data-row:hover {
            background: rgba(0, 210, 255, 0.1);
        }
        .btn-volver {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #00d2ff;
            text-decoration: none;
            border: 1px solid #00d2ff;
            padding: 5px 15px;
        }
        .btn-volver:hover {
            background: #00d2ff;
            color: #000;
        }
    </style>
</head>
<body>

    <a href="index.php" class="btn-volver"><i class="bi bi-arrow-left"></i> DESCONECTAR</a>

    <div class="container pb-5">
        <div class="text-center mt-5">
            <h1 class="text-uppercase" style="letter-spacing: 5px; text-shadow: 0 0 10px #00d2ff;">Centro de Comando</h1>
            <p class="text-muted">DATOS EXTRAÍDOS DE MONGODB ATLAS</p>
        </div>

        <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="alert alert-success bg-transparent border-success text-success text-center mt-3">
                > TRANSMISIÓN COMPLETADA: Nuevo operativo registrado en la red.
            </div>
        <?php endif; ?>

        <?php if ($error_mongo): ?>
            <div class="alert alert-danger bg-transparent border-danger text-danger text-center mt-3">
                > ERROR DE CONEXIÓN SATELITAL: <?= htmlspecialchars($error_mongo) ?>
            </div>
        <?php else: ?>
            <div class="radar-container">
                <div class="row text-white-50 border-bottom border-info pb-2 fw-bold text-uppercase">
                    <div class="col-3">Operativo</div>
                    <div class="col-2">Firma Color</div>
                    <div class="col-3">Suministro</div>
                    <div class="col-2">Clasificación</div>
                    <div class="col-2">Timestamp</div>
                </div>

                <?php 
                $hay_datos = false;
                foreach ($documentos as $doc): 
                    $hay_datos = true;
                ?>
                    <div class="row data-row align-items-center">
                        <div class="col-3 fw-bold text-white">
                            <?= htmlspecialchars($doc['apellidos'] ?? '') ?>, <br>
                            <span class="small fw-normal text-muted"><?= htmlspecialchars($doc['nombres'] ?? '') ?></span>
                        </div>
                        <div class="col-2"><?= htmlspecialchars($doc['color'] ?? '') ?></div>
                        <div class="col-3"><?= htmlspecialchars($doc['comida'] ?? '') ?></div>
                        <div class="col-2"><?= htmlspecialchars($doc['pelicula'] ?? '') ?></div>
                        <div class="col-2 small text-muted"><?= htmlspecialchars($doc['registro'] ?? '') ?></div>
                    </div>
                <?php endforeach; ?>

                <?php if (!$hay_datos): ?>
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-hdd-network fs-1 d-block mb-3"></i>
                        > BASE DE DATOS VACÍA.
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>

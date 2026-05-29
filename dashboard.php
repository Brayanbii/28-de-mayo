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
    <title>Centro de Comando ATLAS | DB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --cyan: #00f3ff;
            --dark-bg: #030712;
            --panel-bg: rgba(6, 15, 30, 0.7);
        }

        body {
            background-color: var(--dark-bg);
            color: var(--cyan);
            font-family: 'Rajdhani', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Fondo Animado Holográfico */
        .hologram-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: 
                linear-gradient(rgba(0, 243, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 243, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: -1;
            perspective: 1000px;
        }

        .hologram-bg::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at center, transparent 20%, var(--dark-bg) 90%);
        }

        /* Botón de Retirada Táctica */
        .btn-volver {
            position: absolute;
            top: 30px;
            left: 30px;
            color: var(--cyan);
            text-decoration: none;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            border: 1px solid rgba(0, 243, 255, 0.5);
            padding: 10px 25px;
            border-radius: 4px;
            transition: all 0.3s ease;
            background: rgba(0, 243, 255, 0.05);
            backdrop-filter: blur(5px);
            z-index: 100;
            overflow: hidden;
        }

        .btn-volver::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 243, 255, 0.4), transparent);
            transition: all 0.5s ease;
        }

        .btn-volver:hover::before {
            left: 100%;
        }

        .btn-volver:hover {
            background: rgba(0, 243, 255, 0.2);
            color: #fff;
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.4);
        }

        /* Contenedor Principal Radar */
        .radar-container {
            border: 1px solid rgba(0, 243, 255, 0.3);
            border-radius: 15px;
            background: var(--panel-bg);
            backdrop-filter: blur(15px);
            padding: 2.5rem;
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.05), inset 0 0 40px rgba(0, 243, 255, 0.05);
            margin-top: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Línea Láser Escaneando la Data */
        .radar-container::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            background: var(--cyan);
            box-shadow: 0 0 15px 3px var(--cyan);
            opacity: 0.5;
            animation: laserScan 4s ease-in-out infinite alternate;
            pointer-events: none;
        }

        /* Encabezados de Tabla */
        .table-header {
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            text-shadow: 0 0 10px var(--cyan);
            border-bottom: 2px solid rgba(0, 243, 255, 0.4);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            letter-spacing: 2px;
        }

        /* Filas de Datos con Animación de Entrada */
        .data-row {
            background: rgba(0, 243, 255, 0.02);
            border: 1px solid rgba(0, 243, 255, 0.1);
            border-radius: 8px;
            padding: 1.2rem;
            margin-bottom: 0.8rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            transform: translateX(-20px);
            animation: slideInRight 0.6s ease forwards;
        }

        .data-row:hover {
            background: rgba(0, 243, 255, 0.1);
            border-color: rgba(0, 243, 255, 0.5);
            transform: scale(1.01) translateX(5px);
            box-shadow: -5px 0 15px rgba(0, 243, 255, 0.2);
            z-index: 2;
        }

        .data-row .col-fw-bold {
            font-size: 1.2rem;
            color: #fff;
            font-weight: 600;
        }

        .data-row .timestamp {
            font-family: monospace;
            color: rgba(0, 243, 255, 0.6);
            background: rgba(0, 0, 0, 0.3);
            padding: 3px 8px;
            border-radius: 4px;
            border: 1px solid rgba(0, 243, 255, 0.2);
        }

        /* Títulos Globales */
        .title-hologram {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            color: transparent;
            -webkit-text-stroke: 1px var(--cyan);
            text-shadow: 0 0 20px rgba(0, 243, 255, 0.4);
            letter-spacing: 8px;
            margin-bottom: 0;
            animation: glowText 3s infinite alternate;
        }

        /* Alertas */
        .cyber-alert-success {
            background: rgba(0, 255, 136, 0.1);
            border: 1px solid #00ff88;
            color: #00ff88;
            box-shadow: 0 0 15px rgba(0, 255, 136, 0.2);
            font-family: 'Orbitron', sans-serif;
        }

        .cyber-alert-danger {
            background: rgba(255, 42, 42, 0.1);
            border: 1px solid #ff2a2a;
            color: #ff2a2a;
            box-shadow: 0 0 15px rgba(255, 42, 42, 0.2);
            font-family: 'Orbitron', sans-serif;
        }

        /* Keyframes */
        @keyframes slideInRight {
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes laserScan {
            0% { top: 0; }
            100% { top: 100%; }
        }
        @keyframes glowText {
            from { text-shadow: 0 0 10px rgba(0, 243, 255, 0.2); }
            to { text-shadow: 0 0 30px rgba(0, 243, 255, 0.8), 0 0 50px rgba(0, 243, 255, 0.4); color: #fff; }
        }
    </style>
</head>
<body>

    <div class="hologram-bg"></div>

    <a href="index.php" class="btn-volver">
        <i class="bi bi-broadcast me-2"></i> DESCONECTAR ENLACE
    </a>

    <div class="container pb-5" style="padding-top: 6rem;">
        <div class="text-center mb-5">
            <h1 class="title-hologram text-uppercase">COMANDO ATLAS</h1>
            <p class="mt-2" style="font-size: 1.2rem; letter-spacing: 3px; color: rgba(0, 243, 255, 0.7);">
                <i class="bi bi-database-fill-gear"></i> DATOS SATELITALES SINCRONIZADOS
            </p>
        </div>

        <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="alert cyber-alert-success text-center py-3 mb-4 rounded-3 fw-bold">
                <i class="bi bi-check-circle-fill fs-5 me-2"></i> TRANSMISIÓN COMPLETADA: Nuevo operativo registrado en la red segura.
            </div>
        <?php endif; ?>

        <?php if ($error_mongo): ?>
            <div class="alert cyber-alert-danger text-center py-3 mb-4 rounded-3 fw-bold">
                <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ERROR DE ENLACE CUÁNTICO: <?= htmlspecialchars($error_mongo) ?>
            </div>
        <?php else: ?>
            <div class="radar-container">
                <div class="row table-header align-items-center text-uppercase">
                    <div class="col-3"><i class="bi bi-person-bounding-box me-2"></i> Operativo</div>
                    <div class="col-2"><i class="bi bi-palette-fill me-2"></i> Firma Color</div>
                    <div class="col-3"><i class="bi bi-box-seam-fill me-2"></i> Suministro</div>
                    <div class="col-2"><i class="bi bi-film me-2"></i> Clasificación</div>
                    <div class="col-2"><i class="bi bi-clock-history me-2"></i> Registro (T)</div>
                </div>

                <?php 
                $hay_datos = false;
                $delay = 0; // Para animación en cascada
                foreach ($documentos as $doc): 
                    $hay_datos = true;
                    $delay += 0.1; // Incrementa el retraso de animación por fila
                ?>
                    <div class="row data-row align-items-center" style="animation-delay: <?= $delay ?>s;">
                        <div class="col-3">
                            <div class="col-fw-bold text-uppercase"><?= htmlspecialchars($doc['apellidos'] ?? '') ?></div>
                            <div class="text-white-50" style="font-size: 0.95rem;"><?= htmlspecialchars($doc['nombres'] ?? '') ?></div>
                        </div>
                        <div class="col-2 fw-semibold" style="color: #fff;">
                            <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:var(--cyan); box-shadow: 0 0 10px var(--cyan); margin-right:8px;"></span>
                            <?= htmlspecialchars($doc['color'] ?? '') ?>
                        </div>
                        <div class="col-3" style="color: #e2e8f0;">
                            <?= htmlspecialchars($doc['comida'] ?? '') ?>
                        </div>
                        <div class="col-2" style="color: #e2e8f0;">
                            <?= htmlspecialchars($doc['pelicula'] ?? '') ?>
                        </div>
                        <div class="col-2">
                            <span class="timestamp"><?= htmlspecialchars($doc['registro'] ?? 'N/A') ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (!$hay_datos): ?>
                    <div class="text-center py-5" style="opacity: 0.5; animation: pulse-glow 2s infinite alternate;">
                        <i class="bi bi-hdd-network" style="font-size: 5rem; text-shadow: 0 0 20px var(--cyan);"></i>
                        <h3 class="mt-4 font-monospace">> RED VACÍA. ESPERANDO DATOS...</h3>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>

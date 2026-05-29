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
    <title>S.H.I.E.L.D. | Iniciativa Atlas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --stark-blue: #00d2ff;
            --stark-glow: rgba(0, 210, 255, 0.4);
            --bg-dark: #050608;
            --panel-bg: rgba(10, 15, 25, 0.85);
            --border-tech: #1a2b4c;
        }

        body {
            background-color: var(--bg-dark);
            color: #e2e8f0;
            font-family: 'Rajdhani', sans-serif;
            background-image: 
                radial-gradient(circle at 50% 0%, rgba(0, 210, 255, 0.05) 0%, transparent 50%),
                linear-gradient(rgba(0, 210, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 210, 255, 0.03) 1px, transparent 1px);
            background-size: 100% 100%, 30px 30px, 30px 30px;
            min-height: 100vh;
        }

        .navbar-shield {
            border-bottom: 1px solid var(--stark-blue);
            box-shadow: 0 0 20px var(--stark-glow);
            background: #000;
            padding: 1rem 0;
        }

        .brand-logo {
            font-family: 'Share Tech Mono', monospace;
            font-size: 1.8rem;
            color: #fff;
            letter-spacing: 2px;
        }

        .brand-logo span { color: var(--stark-blue); text-shadow: 0 0 10px var(--stark-blue); }

        .tech-panel {
            background: var(--panel-bg);
            border: 1px solid var(--border-tech);
            border-radius: 8px;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .tech-panel::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 2px;
            background: linear-gradient(90deg, transparent, var(--stark-blue), transparent);
        }

        .panel-header {
            font-family: 'Share Tech Mono', monospace;
            color: var(--stark-blue);
            border-bottom: 1px solid var(--border-tech);
            padding: 1rem 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .tactical-input {
            background: rgba(0, 0, 0, 0.5) !important;
            border: 1px solid var(--border-tech) !important;
            color: var(--stark-blue) !important;
            font-family: 'Share Tech Mono', monospace;
            border-radius: 4px;
        }

        .tactical-input:focus {
            border-color: var(--stark-blue) !important;
            box-shadow: 0 0 15px var(--stark-glow) !important;
        }

        .btn-authorize {
            background: transparent;
            color: var(--stark-blue);
            border: 1px solid var(--stark-blue);
            font-family: 'Share Tech Mono', monospace;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-authorize:hover {
            background: var(--stark-blue);
            color: #000;
            box-shadow: 0 0 20px var(--stark-glow);
        }

        .data-table { color: #fff; }
        .data-table th {
            font-family: 'Share Tech Mono', monospace;
            color: var(--stark-blue);
            border-bottom: 1px solid var(--stark-blue);
            background: transparent;
        }
        .data-table td {
            background: transparent;
            border-bottom: 1px solid var(--border-tech);
            vertical-align: middle;
        }
        .data-table tbody tr:hover td { background: rgba(0, 210, 255, 0.05); }

        .search-box {
            background: rgba(0,0,0,0.6);
            border: 1px solid var(--stark-blue);
            color: #fff;
            padding: 0.8rem 1rem;
            font-family: 'Share Tech Mono', monospace;
            width: 100%;
        }
    </style>
</head>
<body>

    <nav class="navbar-shield mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="brand-logo"><i class="bi bi-shield-shaded me-2"></i>S.H.I.E.L.D. <span>// ATLAS</span></div>
            <div class="font-monospace text-success"><i class="bi bi-hdd-network"></i> SYS.STATUS: ONLINE</div>
        </div>
    </nav>

    <div class="container">
        <!-- ALERTAS DEL SISTEMA -->
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'success'): ?>
                <div class="alert alert-success bg-dark text-success border-success font-monospace alert-dismissible fade show">
                    <i class="bi bi-check2-square me-2"></i> AUTORIZACIÓN CONCEDIDA. ID: <?= htmlspecialchars($_GET['id'] ?? '') ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            <?php elseif ($_GET['status'] == 'error'): ?>
                <div class="alert alert-danger bg-dark text-danger border-danger font-monospace alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle me-2"></i> ANOMALÍA: <?= htmlspecialchars($_GET['msg'] ?? '') ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($error_mongo): ?>
            <div class="alert alert-danger bg-dark text-danger border-danger font-monospace">
                <i class="bi bi-x-circle me-2"></i> ENLACE PERDIDO (ATLAS): <?= htmlspecialchars($error_mongo) ?>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            
            <!-- PANEL DE INGRESO -->
            <div class="col-lg-4">
                <div class="tech-panel h-100">
                    <div class="panel-header"><i class="bi bi-fingerprint me-2"></i>Añadir Operativo</div>
                    <div class="p-4">
                        <form action="logica.php" method="POST">
                            <div class="mb-3">
                                <label class="text-uppercase small text-muted font-monospace mb-1">Apellidos</label>
                                <input type="text" required name="apellidos" class="form-control tactical-input" placeholder="Ej. Romanoff">
                            </div>
                            <div class="mb-3">
                                <label class="text-uppercase small text-muted font-monospace mb-1">Nombres</label>
                                <input type="text" required name="nombres" class="form-control tactical-input" placeholder="Ej. Natasha">
                            </div>
                            <div class="mb-3">
                                <label class="text-uppercase small text-muted font-monospace mb-1">Firma Energética (Color)</label>
                                <input type="text" required name="color" class="form-control tactical-input" placeholder="Ej. Rojo Viuda">
                            </div>
                            <div class="mb-3">
                                <label class="text-uppercase small text-muted font-monospace mb-1">Suministro (Comida)</label>
                                <input type="text" required name="comida" class="form-control tactical-input" placeholder="Ej. Shawarma">
                            </div>
                            <div class="mb-4">
                                <label class="text-uppercase small text-muted font-monospace mb-1">Clasificación (Cine)</label>
                                <input type="text" required name="pelicula" class="form-control tactical-input" placeholder="Ej. Espionaje / Acción">
                            </div>
                            <button type="submit" class="btn w-100 btn-authorize py-2">Cargar Datos <i class="bi bi-upload ms-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- DIRECTORIO DE BASE DE DATOS -->
            <div class="col-lg-8">
                <div class="tech-panel h-100 d-flex flex-column">
                    <div class="panel-header d-flex justify-content-between align-items-center">
                        <div><i class="bi bi-database me-2"></i>Directorio Global</div>
                        <?php if (!$error_mongo && isset($coleccion)): ?>
                            <span class="badge border border-info text-info">TOTAL: <?= $coleccion->countDocuments() ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="p-3 border-bottom border-secondary">
                        <input type="text" id="dbSearch" class="search-box" placeholder=">_ FILTRAR OPERATIVO POR NOMBRE...">
                    </div>

                    <div class="table-responsive p-3 flex-grow-1" style="max-height: 500px; overflow-y: auto;">
                        <table class="table data-table w-100">
                            <thead>
                                <tr>
                                    <th>Operativo</th>
                                    <th>Firma / Suministro</th>
                                    <th>Clasificación</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (!$error_mongo && isset($documentos)): 
                                    $has_records = false;
                                    foreach ($documentos as $doc): 
                                        $has_records = true;
                                ?>
                                        <tr class="db-row" data-search="<?= mb_strtolower(($doc['apellidos'] ?? '') . ' ' . ($doc['nombres'] ?? '')) ?>">
                                            <td>
                                                <div class="fw-bold text-uppercase"><?= htmlspecialchars($doc['apellidos'] ?? '') ?></div>
                                                <div class="small text-muted"><?= htmlspecialchars($doc['nombres'] ?? '') ?></div>
                                            </td>
                                            <td>
                                                <span class="badge border border-secondary text-light mb-1 d-inline-block"><?= htmlspecialchars($doc['color'] ?? '') ?></span>
                                                <div class="small text-white-50"><i class="bi bi-box-seam me-1"></i><?= htmlspecialchars($doc['comida'] ?? '') ?></div>
                                            </td>
                                            <td class="font-monospace text-info small"><?= htmlspecialchars($doc['pelicula'] ?? '') ?></td>
                                            <td class="font-monospace text-muted small"><?= htmlspecialchars($doc['registro'] ?? '') ?></td>
                                        </tr>
                                <?php 
                                    endforeach; 
                                    if (!$has_records):
                                ?>
                                        <tr><td colspan="4" class="text-center py-5 font-monospace text-muted">DIRECTORIO VACÍO</td></tr>
                                <?php
                                    endif;
                                else:
                                ?>
                                    <tr><td colspan="4" class="text-center py-5 font-monospace text-danger">CONEXIÓN RECHAZADA</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('dbSearch').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            document.querySelectorAll('.db-row').forEach(row => {
                row.style.display = row.getAttribute('data-search').includes(term) ? 'table-row' : 'none';
            });
        });
    </script>
</body>
</html>

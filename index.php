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

    $documentos = $coleccion->find([], [
        'sort' => ['registro' => -1]
    ]);

} catch (Exception $e) {
    $error_mongo = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciativa Atlas | S.H.I.E.L.D. Database</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter para lectura, JetBrains Mono para datos técnicos) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --shield-bg: #050507;
            --shield-surface: #0a0b10;
            --shield-border: #1f2335;
            --stark-cyan: #00d2ff;
            --stark-cyan-glow: rgba(0, 210, 255, 0.2);
            --text-main: #e2e8f0;
            --text-muted: #64748b;
            --alert-red: #ef4444;
            --success-green: #10b981;
        }

        body {
            background-color: var(--shield-bg);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            background-image: 
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            background-position: center center;
            min-height: 100vh;
        }

        /* Scanline Overlay (Efecto de monitor táctico) */
        body::after {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.1) 50%);
            background-size: 100% 4px;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.3;
        }

        .navbar-stark {
            background-color: rgba(5, 5, 7, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--shield-border);
            padding: 1.2rem 0;
        }

        .brand-logo {
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            letter-spacing: 2px;
            color: #fff;
            text-transform: uppercase;
        }

        .brand-logo span {
            color: var(--stark-cyan);
        }

        .glass-panel {
            background: var(--shield-surface);
            border: 1px solid var(--shield-border);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        }

        .glass-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 3px;
            background: linear-gradient(90deg, transparent, var(--stark-cyan), transparent);
            opacity: 0.5;
        }

        .panel-header {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--shield-border);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
        }

        .panel-header i {
            color: var(--stark-cyan);
        }

        .form-control-tactical {
            background-color: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--shield-border);
            color: var(--text-main);
            border-radius: 6px;
            padding: 0.8rem 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .form-control-tactical:focus {
            background-color: rgba(0, 210, 255, 0.05);
            border-color: var(--stark-cyan);
            box-shadow: 0 0 15px var(--stark-cyan-glow);
            color: #fff;
        }

        .form-control-tactical::placeholder {
            color: #475569;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 0.4rem;
        }

        .btn-authorize {
            background: transparent;
            color: var(--stark-cyan);
            border: 1px solid var(--stark-cyan);
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            padding: 0.8rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-authorize:hover {
            background: var(--stark-cyan);
            color: #000;
            box-shadow: 0 0 20px var(--stark-cyan-glow);
        }

        .table-tactical {
            color: var(--text-main);
            margin-bottom: 0;
        }

        .table-tactical th {
            background-color: rgba(255, 255, 255, 0.02);
            color: var(--text-muted);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid var(--shield-border);
            padding: 1rem 1.5rem;
        }

        .table-tactical td {
            background-color: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 1.2rem 1.5rem;
            vertical-align: middle;
        }

        .table-tactical tbody tr:hover td {
            background-color: rgba(0, 210, 255, 0.03);
        }

        .data-value {
            font-weight: 600;
            color: #fff;
        }

        .data-mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            color: var(--stark-cyan);
        }

        .badge-status {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
            border: 1px solid rgba(16, 185, 129, 0.2);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            padding: 0.4em 0.8em;
        }

        .search-wrapper {
            position: relative;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--shield-border);
        }
        
        .search-icon {
            position: absolute;
            top: 50%;
            left: 2.2rem;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .search-tactical {
            background-color: rgba(0,0,0,0.2);
            border: 1px solid var(--shield-border);
            color: #fff;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border-radius: 4px;
            width: 100%;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
        }

        .search-tactical:focus {
            outline: none;
            border-color: var(--stark-cyan);
        }

        .sys-alert {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-left: 4px solid;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            border-radius: 4px;
        }
        .sys-alert-success { border-color: var(--success-green); box-shadow: 0 0 20px rgba(16, 185, 129, 0.1); }
        .sys-alert-danger { border-color: var(--alert-red); box-shadow: 0 0 20px rgba(239, 68, 68, 0.1); }
    </style>
</head>
<body>

    <nav class="navbar-stark sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="brand-logo fs-4">
                <i class="bi bi-shield-check text-cyan me-2" style="color: #00d2ff;"></i> ATLAS <span>INITIATIVE</span>
            </div>
            <div class="font-monospace text-muted small">
                <i class="bi bi-hdd-network me-1"></i> SYS.STATUS: <span class="text-success">ONLINE</span>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'success'): ?>
                <div class="alert sys-alert sys-alert-success alert-dismissible fade show d-flex align-items-center p-4 mb-4" role="alert">
                    <i class="bi bi-check2-square fs-3 me-3" style="color: #10b981;"></i>
                    <div>
                        <div class="text-uppercase fw-bold mb-1" style="color: #10b981; letter-spacing: 1px;">AUTORIZACIÓN CONCEDIDA</div>
                        <div class="text-white-50 small">Nuevo agente registrado en la red Atlas. ID de acceso: <?= htmlspecialchars($_GET['id'] ?? '') ?></div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['status'] == 'error'): ?>
                <div class="alert sys-alert sys-alert-danger alert-dismissible fade show d-flex align-items-center p-4 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle fs-3 me-3" style="color: #ef4444;"></i>
                    <div>
                        <div class="text-uppercase fw-bold mb-1" style="color: #ef4444; letter-spacing: 1px;">ANOMALÍA EN EL SISTEMA</div>
                        <div class="text-white-50 small">Protocolo fallido: <?= htmlspecialchars($_GET['msg'] ?? 'Error desconocido.') ?></div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($error_mongo): ?>
            <div class="alert sys-alert sys-alert-danger d-flex align-items-center p-4 mb-4" role="alert">
                <i class="bi bi-x-circle fs-3 me-3" style="color: #ef4444;"></i>
                <div>
                    <div class="text-uppercase fw-bold mb-1" style="color: #ef4444; letter-spacing: 1px;">ENLACE UPLINK PERDIDO</div>
                    <div class="text-white-50 small">Error crítico de conexión a base de datos externa: <?= htmlspecialchars($error_mongo) ?></div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            
            <div class="col-xl-4 col-lg-5">
                <div class="glass-panel h-100">
                    <div class="panel-header">
                        <i class="bi bi-person-bounding-box me-2"></i> Añadir Operativo
                    </div>
                    <div class="p-4">
                        <form action="logica.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Apellidos</label>
                                <input type="text" required maxlength="200" name="apellidos" class="form-control form-control-tactical" placeholder="Ej. Romanoff">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nombres</label>
                                <input type="text" required maxlength="200" name="nombres" class="form-control form-control-tactical" placeholder="Ej. Natasha">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Firma Energética (Color)</label>
                                <input type="text" required maxlength="200" name="color" class="form-control form-control-tactical" placeholder="Ej. Rojo Viuda">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Suministro Táctico (Comida)</label>
                                <input type="text" required maxlength="200" name="comida" class="form-control form-control-tactical" placeholder="Ej. Shawarma">
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Clasificación de Archivo (Cine)</label>
                                <input type="text" required maxlength="200" name="pelicula" class="form-control form-control-tactical" placeholder="Ej. Espionaje / Acción">
                            </div>
                            
                            <button type="submit" class="btn w-100 btn-authorize">
                                <i class="bi bi-fingerprint me-2"></i> Cargar Datos
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="glass-panel h-100 d-flex flex-column">
                    <div class="panel-header justify-content-between">
                        <div><i class="bi bi-database me-2"></i> Base de Datos Global</div>
                        <?php if (!$error_mongo && isset($coleccion)): ?>
                            <span class="badge" style="background: rgba(0, 210, 255, 0.1); color: var(--stark-cyan); border: 1px solid rgba(0, 210, 255, 0.3);">
                                TOTAL: <?= $coleccion->countDocuments() ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Buscador Táctico -->
                    <div class="search-wrapper">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="dbSearch" class="search-tactical" placeholder="Filtrar por nombre o apellido de operativo...">
                    </div>

                    <div class="table-responsive flex-grow-1" style="max-height: 600px; overflow-y: auto;">
                        <table class="table table-borderless table-tactical w-100">
                            <thead class="sticky-top" style="z-index: 1;">
                                <tr>
                                    <th>Operativo</th>
                                    <th>Firma (Color)</th>
                                    <th>Suministro</th>
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
                                                <div class="data-value text-uppercase"><?= htmlspecialchars($doc['apellidos'] ?? '') ?></div>
                                                <div class="text-muted small"><?= htmlspecialchars($doc['nombres'] ?? '') ?></div>
                                            </td>
                                            <td>
                                                <span class="badge badge-status">
                                                    <?= htmlspecialchars($doc['color'] ?? '') ?>
                                                </span>
                                            </td>
                                            <td class="text-white-50 small"><?= htmlspecialchars($doc['comida'] ?? '') ?></td>
                                            <td class="data-mono"><?= htmlspecialchars($doc['pelicula'] ?? '') ?></td>
                                            <td class="text-muted" style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem;">
                                                <?= htmlspecialchars($doc['registro'] ?? '') ?>
                                            </td>
                                        </tr>
                                <?php 
                                    endforeach; 
                                    
                                    if (!$has_records):
                                ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <i class="bi bi-hdd-fill d-block mb-3" style="font-size: 2rem; color: #1f2335;"></i>
                                                <span class="text-muted font-monospace small">NO HAY OPERATIVOS EN EL DIRECTORIO ACTUAL</span>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                else:
                                ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="bi bi-exclamation-triangle-fill d-block mb-3" style="font-size: 2rem; color: var(--alert-red); opacity: 0.5;"></i>
                                            <span class="text-muted font-monospace small">CONEXIÓN RECHAZADA. VERIFIQUE LA RED.</span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Script de filtro táctico (búsqueda en tiempo real)
        document.getElementById('dbSearch').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.db-row');
            
            rows.forEach(row => {
                const searchable = row.getAttribute('data-search');
                if (searchable.includes(term)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
